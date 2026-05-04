<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ComplaintController extends Controller
{

    public function submit(Request $request)
    {

        $request->validate([
            'account_name' => 'required',
            'address' => 'required',
            'mobile_number' => 'required',
            'branch' => 'required',
            'remarks' => 'required',
            'email' => 'required|email'
        ]);

        $today = now()->toDateString();

        $existing = DB::table('complaints')
            ->where('email', $request->email)
            ->whereDate('created_at', $today)
            ->first();

        if ($existing) {
            return redirect()
                ->back()
                ->with('error', '❌ You have already submitted a complaint today. Please try again tomorrow.');
        }

        /* =========================================
           INSERT COMPLAINT
        ========================================= */

        $id = DB::table('complaints')->insertGetId([
            'account_name'   => $request->account_name,
            'account_number' => $request->account_no,
            'address'        => $request->address,
            'branch'           => $request->branch,
            'mobile_number'  => $request->mobile_number,
            'email'          => $request->email,
            'category'       => $request->category,
            'remarks'        => $request->remarks,
            'status'         => 'Pending',
            'created_at'     => now()
        ]);

        /* =========================================
           GENERATE TICKET NUMBER
        ========================================= */

        $ticket = 'FP-' . date('Y') . '-' . str_pad($id, 6, '0', STR_PAD_LEFT);

        DB::table('complaints')
        ->where('id', $id)
        ->update([
            'ticket_number' => $ticket
        ]);

        /* =========================================
           SEND DATA TO GOOGLE SHEETS (PER BRANCH)
        ========================================= */

        $sheetUrls = [
    'Calbayog' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
    'San Jorge/Gandara' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
    'Catbalogan' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
    'Allen' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
    'Catarman' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
    'Mondragon' => 'https://script.google.com/macros/s/AKfycbzAon6ilmqXLIfkD1tHQhmizs08DQ_rtk-aaABvyg-IcGKxLrVb8TzoNuIWYS2bn2Rv/exec',
];

$branch = $request->branch;

if (isset($sheetUrls[$branch])) {

    Http::post($sheetUrls[$branch], [
        "date" => now()->format('Y-m-d'),
        "mobile" => $request->mobile_number,
        "subscriber_name" => $request->account_name,
        "address" => $request->address,
        "remarks" => $request->remarks,     
        "prepared_by" => "Website",         
        "branch" => $branch
    ]);

} else {
    Log::error("No Google Sheet URL for branch: " . $branch);
}

        /* =========================================
           SEND EMAILS (FIXED + STABLE + MODERNIZED)
        ========================================= */

        try {

            $mail = new PHPMailer(true);

            $mail->isSMTP();

            /* ✅ USE CPANEL SMTP (MORE STABLE) */
            $mail->Host = 'mail.filproducts-cyg.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'noreply@filproducts-cyg.com';
            $mail->Password = '8kKAahOE*.E,7uJZ';

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            /* ✅ SSL FIX */
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            /* ✅ FROM */
            $mail->setFrom('noreply@filproducts-cyg.com', 'Fil Products Samar');

            /* ✅ IMPORTANT FOR OUTLOOK */
            $mail->Sender = 'noreply@filproducts-cyg.com';
            $mail->addCustomHeader('X-Mailer', 'PHP/' . phpversion());

            /* ✅ SAFE VARIABLES (Added htmlspecialchars to prevent layout breaking/XSS) */
            $accountName   = htmlspecialchars($request->account_name ?? 'Customer');
            $accountNo     = htmlspecialchars($request->account_no ?? 'N/A');
            $email         = filter_var($request->email ?? '', FILTER_SANITIZE_EMAIL);
            $mobile        = htmlspecialchars($request->mobile_number ?? 'N/A');
            $address       = htmlspecialchars($request->address ?? 'N/A');
            $branch        = htmlspecialchars($request->branch ?? 'N/A');
            $category      = htmlspecialchars($request->category ?? 'N/A');
            
            // nl2br ensures line breaks from textareas are preserved in HTML
            $remarks       = nl2br(htmlspecialchars($request->remarks ?? 'No remarks provided.')); 

            /* ✅ REPLY TO */
            if ($email) {
                $mail->addReplyTo($email, $accountName);
            }

            /* =========================================
               1️⃣ SEND TO SUPPORT TEAM
            ========================================= */

            $mail->addAddress('info.cyg@filproducts.ph');

            $mail->Subject = "New Customer Complaint - {$accountName}";

            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;'>
                    
                    <div style='background-color: #003366; color: #FFFFFF; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 20px;'>New Customer Complaint</h2>
                    </div>
                    
                    <div style='padding: 25px;'>
                        <table style='width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 14px;'>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280; width: 40%;'><strong>Account Name:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$accountName}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Account Number:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$accountNo}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Email:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$email}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Mobile Number:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$mobile}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Address:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$address}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Branch:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$branch}</td></tr>
                            <tr><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #6b7280;'><strong>Category:</strong></td><td style='padding: 10px 0; border-bottom: 1px solid #f3f4f6; color: #111827;'>{$category}</td></tr>
                        </table>

                        <h4 style='color: #003366; margin-bottom: 10px; font-size: 15px;'>Complaint Details:</h4>
                        <div style='background-color: #f3f4f6; padding: 15px; border-left: 4px solid #003366; border-radius: 4px; color: #374151; font-size: 14px;'>
                            {$remarks}
                        </div>
                    </div>

                    <div style='background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb;'>
                        System Generated Email • Submitted via Fil Products Website
                    </div>
                    
                </div>
            </div>
            ";

            /* =========================
               SEND
            ========================== */
            $mail->send();

            /* =========================================
               2️⃣ SEND AUTO-REPLY TO CUSTOMER
            ========================================= */

            $mail->clearAddresses();
            $mail->addAddress($email);

            $mail->Subject = "Complaint Received - Fil Products Samar";

            $mail->Body = "
            <div style='font-family: Arial, sans-serif; background-color: #f9fafb; padding: 20px; line-height: 1.6; color: #333;'>
                <div style='max-width: 600px; margin: 0 auto; background-color: #FFFFFF; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border: 1px solid #e5e7eb;'>
                    
                    <div style='background-color: #003366; color: #FFFFFF; padding: 20px; text-align: center;'>
                        <h2 style='margin: 0; font-size: 20px;'>We've Received Your Complaint</h2>
                    </div>
                    
                    <div style='padding: 25px;'>
                        <p style='margin-top: 0;'>Dear <strong>{$accountName}</strong>,</p>
                        <p>Thank you for contacting <strong>Fil Products Samar</strong>. This email is to confirm that your complaint has been successfully received.</p>
                        <p>Our support team will review your concern and contact you shortly to provide assistance.</p>
                        
                        <h4 style='color: #003366; margin-top: 25px; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 5px;'>Complaint Summary</h4>
                        <div style='background-color: #f3f4f6; padding: 15px; border-left: 4px solid #003366; border-radius: 4px; color: #4b5563; font-style: italic; font-size: 14px;'>
                            {$remarks}
                        </div>

                        <p style='margin-top: 25px; margin-bottom: 5px;'>Thank you,</p>
                        <p style='margin-top: 0;'><strong>Fil Products Samar Support Team</strong></p>
                    </div>

                    <div style='background-color: #f9fafb; padding: 15px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb;'>
                        This is an automated response. Please do not reply directly to this email.
                    </div>

                </div>
            </div>
            ";

            $mail->send();

        } catch (\Exception $e) {
            // silently ignore email errors
        }

        /* =========================================
           RETURN SUCCESS
        ========================================= */

        return redirect()
            ->route('complaint')
            ->with('success', "Your complaint has been successfully submitted. Our support team will review your concern and contact you shortly."
        );

    }
}
@extends('layouts.navbar')

@section('content')

<div
    id="dataPrivacyModal"
    class="data-privacy-overlay"
>

    <div class="data-privacy-modal">


        <div class="data-privacy-modal-header">

            <div class="privacy-title-wrapper">

                <div class="privacy-icon">

                    <i class="fas fa-shield-alt"></i>

                </div>

                <div>

                    <h2>
                        Data Privacy Notice
                    </h2>

                    <p>
                        Fil Products Service Television Inc.
                        | Please read before proceeding.
                    </p>

                </div>

            </div>

        </div>


        <div
            class="data-privacy-modal-body"
            id="privacyScrollContent"
        >


            <section class="privacy-section">

                <h3>
                    WHY WE COLLECT YOUR INFORMATION
                </h3>

                <p>
                    In compliance with the
                    <strong>
                        Data Privacy Act of 2012
                        (Republic Act No. 10173)
                    </strong>,
                    Fil Products Service Television Inc. informs you
                    that we collect, use, and process your personal
                    information for the following purposes:
                </p>

                <ul>

                    <li>
                        Processing and evaluating your subscription
                        application
                    </li>

                    <li>
                        Verifying your identity and address for
                        service installation
                    </li>

                    <li>
                        Communicating with you regarding your
                        application status and services
                    </li>

                    <li>
                        Billing and account management
                    </li>

                    <li>
                        Compliance with legal and regulatory
                        requirements
                    </li>

                </ul>

            </section>



            <section class="privacy-section">

                <h3>
                    WHAT INFORMATION WE COLLECT
                </h3>

                <ul>

                    <li>
                        Full name, birth date, civil status,
                        gender, and citizenship
                    </li>

                    <li>
                        Contact details (phone number, landline,
                        email address)
                    </li>

                    <li>
                        Home or business address and location details
                    </li>

                    <li>
                        SAMELCO account information and utility
                        documents
                    </li>

                    <li>
                        Valid government-issued identification
                        or passport
                    </li>

                    <li>
                        Location sketch of the installation site
                    </li>

                </ul>

            </section>



            <section class="privacy-section">

                <h3>
                    HOW WE USE YOUR INFORMATION
                </h3>

                <p>
                    Your personal data will be used solely for the
                    purpose of processing your subscription application
                    and delivering our services.
                </p>

                <p>
                    We will
                    <strong>
                        not sell, share, or disclose
                    </strong>
                    your information to third parties without your
                    consent, except as required by law.
                </p>

            </section>


            <section class="privacy-section">

                <h3>
                    DATA RETENTION
                </h3>

                <p>
                    Your information will be retained for as long as
                    your subscription is active and for a reasonable
                    period thereafter as required by applicable laws
                    and regulations.
                </p>

            </section>



            <section class="privacy-section">

                <h3>
                    YOUR RIGHTS
                </h3>

                <p>
                    Under the Data Privacy Act, you have the right to
                    <strong>
                        access, correct, and object
                    </strong>
                    to the processing of your personal data.
                </p>

                <p>
                    To exercise these rights or for any privacy-related
                    concerns, contact us at:
                </p>

                <ul class="privacy-contact-list">

                    <li>
                        <strong>Email:</strong>

                        <a href="mailto:info.cyg@filproducts.ph">
                            info.cyg@filproducts.ph
                        </a>
                    </li>

                    <li>
                        <strong>Address:</strong>

                        Bernate Compound, Brgy. Capoocan,
                        Calbayog City, Samar 6710
                    </li>

                    <li>
                        <strong>Phone:</strong>

                        <a href="tel:09173205871">
                            0917 320 5871
                        </a>

                        ,

                        <a href="tel:09383205871">
                            0938-320-5871
                        </a>
                    </li>

                </ul>

            </section>



            <section class="privacy-section privacy-final-section">

                <h3>
                    ACKNOWLEDGEMENT
                </h3>

                <p>
                    By proceeding with this application, you acknowledge
                    that you have read and understood this Data Privacy
                    Notice and agree to the collection and processing
                    of your personal information for the purposes
                    stated above.
                </p>

            </section>



            <div
                id="privacyScrollMessage"
                class="privacy-scroll-message"
            >

                <i class="fas fa-arrow-down"></i>

                Please scroll to the bottom to continue.

            </div>

        </div>


        <div class="data-privacy-modal-footer">

            <button
                type="button"
                id="privacyDeclineBtn"
                class="privacy-decline-btn"
            >
                Decline
            </button>


            <form
                id="privacyAcceptForm"
                action="{{ route('data.privacy.accept') }}"
                method="POST"
            >
                @csrf

                <button
                    type="submit"
                    id="privacyAgreeBtn"
                    class="privacy-agree-btn"
                    disabled
                >
                    I Agree &amp; Proceed
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>

        </div>

    </div>

</div>


<style>


.data-privacy-overlay {

    position: fixed;

    inset: 0;

    z-index: 99999;

    display: flex;

    align-items: center;

    justify-content: center;

    padding: 20px;

    background: rgba(255, 255, 255, 0);

    backdrop-filter: blur(7px);

    -webkit-backdrop-filter: blur(7px);

}


.data-privacy-modal {

    width: 100%;

    max-width: 1000px;

    max-height: 90vh;

    display: flex;

    flex-direction: column;

    background: #ffffff;

    border-radius: 16px;

    overflow: hidden;

    box-shadow:
        0 25px 60px rgba(0, 51, 102, 0.30);

}


.data-privacy-modal-header {

    flex-shrink: 0;

    padding: 18px 26px;

    background: #ffffff;

    border-bottom: 1px solid #e5e9ee;

}


.privacy-title-wrapper {

    display: flex;

    align-items: center;

    gap: 14px;

}


.privacy-icon {

    width: 40px;

    height: 40px;

    flex-shrink: 0;

    display: flex;

    align-items: center;

    justify-content: center;

    background: #eaf5ff;

    border-radius: 10px;

    color: #003366;

    font-size: 19px;

}


.privacy-title-wrapper h2 {

    margin: 0;

    color: #003366;

    font-size: 18px;

    font-weight: 700;

}


.privacy-title-wrapper p {

    margin: 2px 0 0;

    color: #7a8aa0;

    font-size: 11px;

    line-height: 1.4;

}


/* ============================================================
   SCROLLABLE BODY
   ============================================================ */

.data-privacy-modal-body {

    flex: 1;

    min-height: 0;

    overflow-y: auto;

    padding: 18px 26px 25px;

    background: #ffffff;

    scroll-behavior: smooth;

}


/* Scrollbar */

.data-privacy-modal-body::-webkit-scrollbar {

    width: 8px;

}


.data-privacy-modal-body::-webkit-scrollbar-track {

    background: #ffffff;

}


.data-privacy-modal-body::-webkit-scrollbar-thumb {

    background: #003366;

    border-radius: 10px;

}


.data-privacy-modal-body::-webkit-scrollbar-thumb:hover {

    background: #003366;

}


/* ============================================================
   PRIVACY SECTIONS
   ============================================================ */

.privacy-section {

    margin-bottom: 22px;

}


.privacy-section h3 {

    margin: 0 0 9px;

    color: #003366;

    font-size: 12px;

    font-weight: 800;

    letter-spacing: 0.6px;

    text-transform: uppercase;

}


.privacy-section p {

    margin: 0 0 9px;

    color: #52627a;

    font-size: 13px;

    line-height: 1.7;

}


.privacy-section strong {

    color: #003366;

    font-weight: 700;

}


/* ============================================================
   LIST
   ============================================================ */

.privacy-section ul {

    margin: 5px 0 0;

    padding-left: 19px;

}


.privacy-section li {

    margin-bottom: 8px;

    padding-left: 2px;

    color: #52627a;

    font-size: 13px;

    line-height: 1.55;

}


.privacy-contact-list {

    list-style: none;

    padding-left: 0 !important;

}


.privacy-contact-list li {

    margin-bottom: 7px;

}


.privacy-contact-list a {

    color: #003366;

    font-weight: 600;

    text-decoration: none;

}


.privacy-contact-list a:hover {

    text-decoration: underline;

}


/* ============================================================
   FINAL SECTION
   ============================================================ */

.privacy-final-section {

    padding-bottom: 5px;

}


/* ============================================================
   SCROLL MESSAGE
   ============================================================ */

.privacy-scroll-message {

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 8px;

    margin-top: 12px;

    padding: 10px;

    color: #003366;

    font-size: 11px;

    font-weight: 600;

    background: #ffffff;

    border: 1px solid #003366;

    border-radius: 6px;

}


.privacy-scroll-message i {

    font-size: 10px;

}


/* ============================================================
   FOOTER
   ============================================================ */

.data-privacy-modal-footer {

    flex-shrink: 0;

    display: flex;

    justify-content: flex-end;

    align-items: center;

    gap: 10px;

    padding: 15px 26px 17px;

    background: #ffffff;

    border-top: 1px solid #e5e9ee;

}

.data-privacy-modal-footer form {
    margin: 0;
    padding: 0;
    display: inline-flex;
    align-items: center;
}


.privacy-agree-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 10px 22px;

    border: 1px solid #003366;
    border-radius: 22px;

    background: #003366;
    color: #ffffff;

    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    transition: 0.2s ease;
}

/* Enabled button */
.privacy-agree-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;

    padding: 10px 22px;

    border: 1px solid #003366;
    border-radius: 22px;

    background: #003366;
    color: #ffffff;

    font-size: 12px;
    font-weight: 700;

    cursor: pointer;

    transition: all 0.2s ease;
}


/* Hover only when enabled */
.privacy-agree-btn:hover:not(:disabled) {
    background: #00264d;
    border-color: #00264d;
    transform: translateY(-1px);
}


/* DISABLED — user has not reached the bottom */
.privacy-agree-btn:disabled {
    background: #cbd5e1;
    border-color: #cbd5e1;
    color: #ffffff;

    cursor: not-allowed;
    opacity: 0.75;

    transform: none;
}

/* ============================================================
   DECLINE BUTTON
   ============================================================ */

.privacy-decline-btn {

    padding: 10px 20px;

    border: 1px solid #dbe3ec;

    border-radius: 22px;

    background: #ffffff;

    color: #718096;

    font-size: 12px;

    font-weight: 700;

    cursor: pointer;

    transition: 0.2s ease;

}


.privacy-decline-btn:hover {

    border-color: #003366;

    color: #003366;

}


/* ============================================================
   MOBILE
   ============================================================ */

@media (max-width: 600px) {

    .data-privacy-overlay {

        padding: 10px;

    }


    .data-privacy-modal {

        max-height: 94vh;

        border-radius: 14px;

    }


    .data-privacy-modal-header {

        padding: 15px 18px;

    }


    .data-privacy-modal-body {

        padding: 16px 18px 22px;

    }


    .data-privacy-modal-footer {

        padding: 13px 18px 15px;

    }


    .privacy-title-wrapper {

        gap: 10px;

    }


    .privacy-icon {

        width: 36px;

        height: 36px;

        font-size: 16px;

    }


    .privacy-title-wrapper h2 {

        font-size: 16px;

    }


    .privacy-title-wrapper p {

        font-size: 10px;

    }


    .privacy-section h3 {

        font-size: 11px;

    }


    .privacy-section p,

    .privacy-section li {

        font-size: 12px;

    }


    .privacy-decline-btn,

    .privacy-agree-btn {

        padding: 10px 15px;

        font-size: 11px;

    }

}

</style>



{{-- ============================================================
     JAVASCRIPT
   ============================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('dataPrivacyModal');

    const scrollContent =
        document.getElementById('privacyScrollContent');

    const agreeButton =
        document.getElementById('privacyAgreeBtn');

    const declineButton =
        document.getElementById('privacyDeclineBtn');

    const scrollMessage =
        document.getElementById('privacyScrollMessage');


    /*
    |--------------------------------------------------------------------------
    | CHECK REQUIRED ELEMENTS
    |--------------------------------------------------------------------------
    */

    if (
        !modal ||
        !scrollContent ||
        !agreeButton ||
        !declineButton
    ) {
        return;
    }

    agreeButton.disabled = true;
    agreeButton.setAttribute('disabled', 'disabled');


function checkPrivacyScroll() {

    const scrollTop = scrollContent.scrollTop;
    const scrollHeight = scrollContent.scrollHeight;
    const clientHeight = scrollContent.clientHeight;

    const reachedBottom =
        Math.ceil(scrollTop + clientHeight) >= scrollHeight - 5;

    if (reachedBottom) {

        agreeButton.disabled = false;
        agreeButton.removeAttribute('disabled');

        if (scrollMessage) {
            scrollMessage.innerHTML =
                '<i class="fas fa-check"></i> ' +
                'You may now proceed.';
        }

    } else {

        agreeButton.disabled = true;
        agreeButton.setAttribute('disabled', 'disabled');

        if (scrollMessage) {
            scrollMessage.innerHTML =
                '<i class="fas fa-arrow-down"></i> ' +
                'Please scroll to the bottom to continue.';
        }
    }
}


    /*
    |--------------------------------------------------------------------------
    | SCROLL EVENT
    |--------------------------------------------------------------------------
    */

    scrollContent.addEventListener(
        'scroll',
        checkPrivacyScroll
    );


    /*
    |--------------------------------------------------------------------------
    | CHECK ON PAGE LOAD
    |--------------------------------------------------------------------------
    */

    setTimeout(function () {

        checkPrivacyScroll();

    }, 100);


    /*
    |--------------------------------------------------------------------------
    | DECLINE
    |--------------------------------------------------------------------------
    */

    declineButton.addEventListener(
        'click',
        function () {

            const confirmDecline = confirm(
                'You must agree to the Data Privacy Notice to continue with the application. Do you want to return to the home page?'
            );

            if (confirmDecline) {

                window.location.href =
                    "{{ route('home') }}";

            }

        }
    );

});

</script>


<style>

.privacy-modal-hidden {

    display: none !important;

}

</style>

@endsection
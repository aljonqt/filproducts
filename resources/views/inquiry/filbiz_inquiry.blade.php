@extends('layouts.navbar')

@section('content')

@vite(['resources/js/app.js'])

<link rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/filbiz.css') }}">


<div class="page-wrapper">

    <div class="form-container">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        {{-- VALIDATION ERRORS --}}
        @if($errors->any())
            <div class="error-message">
                <strong>Please check the following:</strong>

                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- =========================================================
             FORM
        ========================================================== --}}

        <form id="filbizForm"
              method="POST"
              action="{{ route('filbiz.submit') }}"
              enctype="multipart/form-data">

            @csrf


            {{-- =====================================================
                 HEADER
            ====================================================== --}}

            <div class="section-header">
                Filbiz Application Form
            </div>


            {{-- =====================================================
                 STEP INDICATOR
            ====================================================== --}}

            <div class="steps-container">

                <div class="step-item active" data-step="1">
                    <div class="step-number">1</div>
                    <div class="step-label">Branch</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="2">
                    <div class="step-number">2</div>
                    <div class="step-label">Plan</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="3">
                    <div class="step-number">3</div>
                    <div class="step-label">Business</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="4">
                    <div class="step-number">4</div>
                    <div class="step-label">Personal</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="5">
                    <div class="step-number">5</div>
                    <div class="step-label">Attachments</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="6">
                    <div class="step-number">6</div>
                    <div class="step-label">Location</div>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="7">
                    <div class="step-number">7</div>
                    <div class="step-label">Review</div>
                </div>

            </div>


            {{-- =====================================================
                 STEP 1 - BRANCH
            ====================================================== --}}

            <div class="form-step active" data-step="1">

                <div class="step-heading">
                    <h2>Select Branch</h2>
                    <p>Select the branch where you want to process your Filbiz application.</p>
                </div>

                <div class="step-card">

                <div class="form-group">

                    <label>
                        Select Branch <span class="required">*</span>
                    </label>

                    <div class="select-wrapper">

                        <select name="branch"
                                id="branch"
                                required>

                            <option value="">Select Branch</option>

                            <option value="calbayog">Calbayog</option>
                            <option value="catbalogan">Catbalogan</option>
                            <option value="sanjorge">San Jorge</option>
                            <option value="allen">Allen</option>
                            <option value="catarman">Catarman</option>
                            <option value="mondragon">Mondragon</option>

                        </select>

                        <i class="fas fa-chevron-down"></i>

                    </div>

                </div>

            </div>

            </div>


            {{-- =====================================================
                 STEP 2 - PLAN
            ====================================================== --}}

            <div class="form-step" data-step="2">

                <div class="step-heading">

                    <h2>Choose Your Filbiz Plan</h2>

                    <p>
                        Select the internet plan that best fits your business needs.
                    </p>

                </div>


                <div class="plan-grid">


                    {{-- PLAN 1 --}}

                    <label class="plan-card">

                        <input type="radio"
                               name="monthly_subscription"
                               value="Up to 100MBPS + Premium Cable TV PHP 1,299"
                               required>

                        <div class="plan-icon">
                        </div>

                        <h3>Business Starter</h3>

                        <div class="speed">
                            100 Mbps
                        </div>

                        <div class="price">
                            ₱1,299
                        </div>

                        <p>
                            Free Premium Cable TV
                        </p>

                    </label>


                    {{-- PLAN 2 --}}

                    <label class="plan-card">

                        <input type="radio"
                               name="monthly_subscription"
                               value="Up to 200MBPS + Premium Cable TV PHP 1,599">

                        <div class="plan-icon">
                        </div>

                        <h3>Business Pro</h3>

                        <div class="speed">
                            200 Mbps
                        </div>

                        <div class="price">
                            ₱1,599
                        </div>

                        <p>
                            Free Premium Cable TV
                        </p>

                    </label>


                    {{-- PLAN 3 --}}

                    <label class="plan-card">

                        <input type="radio"
                               name="monthly_subscription"
                               value="Up to 300MBPS + Premium Cable TV PHP 1,899">

                        <div class="plan-icon">
                        </div>

                        <h3>Business Premium</h3>

                        <div class="speed">
                            300 Mbps
                        </div>

                        <div class="price">
                            ₱1,899
                        </div>

                        <p>
                            Free Premium Cable TV
                        </p>

                    </label>


                    {{-- PLAN 4 --}}

                    <label class="plan-card">

                        <input type="radio"
                               name="monthly_subscription"
                               value="Up to 500MBPS + Premium Cable TV PHP 2,000">

                        <div class="plan-icon">
                        </div>

                        <h3>Enterprise</h3>

                        <div class="speed">
                            500 Mbps
                        </div>

                        <div class="price">
                            ₱2,000
                        </div>

                        <p>
                            Free Premium Cable TV
                        </p>

                    </label>

                </div>

                <div id="selectedPlanBox" class="selected-plan-box">
                    <i class="fas fa-info-circle"></i>
                    <span>Please select a plan.</span>
                </div>

            </div>


            {{-- =====================================================
                 STEP 3 - BUSINESS INFORMATION
            ====================================================== --}}

            <div class="form-step" data-step="3">

                <div class="step-heading">

                    <h2>Business or Company Information</h2>

                    <p>
                        Provide the basic information about your business or company.
                    </p>

                </div>


                <div class="row row-2">

                    <div class="form-group">

                        <label>
                            Business or Company Name
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="companyname"
                               id="companyname"
                               required>

                    </div>


                    <div class="form-group">

                        <label>
                            Nature of Business
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="natureofbusiness"
                               id="natureofbusiness"
                               required>

                    </div>

                </div>


                <div class="form-group">

                    <label>
                        Business or Main Office Address
                        <span class="required">*</span>
                    </label>

                    <input type="text"
                           name="businessaddress"
                           id="businessaddress"
                           required>

                </div>


                <div class="business-info-card">

                    <i class="fas fa-building"></i>

                    <div>

                        <strong>Business Information</strong>

                        <p>
                            Please make sure that the company name and
                            business address match your official business
                            registration documents.
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 STEP 4 - PERSONAL INFORMATION
            ====================================================== --}}

            <div class="form-step" data-step="4">

                <div class="step-heading">

                    <h2>Personal Information</h2>

                    <p>
                        Enter the information of the authorized signatory.
                    </p>

                </div>


                <div class="form-subtitle">
                    Authorized Signatory
                </div>


                <div class="row row-3">

                    <div class="form-group">

                        <label>
                            First Name
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="first_name"
                               id="first_name"
                               required>

                    </div>


                    <div class="form-group">

                        <label>
                            Middle Name
                        </label>

                        <input type="text"
                               name="middle_name"
                               id="middle_name">

                    </div>


                    <div class="form-group">

                        <label>
                            Last Name
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="last_name"
                               id="last_name"
                               required>

                    </div>

                </div>


                <div class="row row-3">

                    <div class="form-group">

                        <label>
                            Mobile No.
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="mobile_no"
                               id="mobile_no"
                               required>

                    </div>


                    <div class="form-group">

                        <label>
                            Email Address
                            <span class="required">*</span>
                        </label>

                        <input type="email"
                               name="email"
                               id="email"
                               required>

                    </div>


                    <div class="form-group">

                        <label>
                            Landline
                        </label>

                        <input type="text"
                               name="landline"
                               id="landline">

                    </div>

                </div>


                <div class="row row-2">

                    <div class="form-group">

                        <label>
                            Position
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="position"
                               id="position"
                               required>

                    </div>


                    <div class="form-group">

                        <label>
                            Company Contact Person
                            <span class="required">*</span>
                        </label>

                        <input type="text"
                               name="contact_person"
                               id="contact_person"
                               required>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 STEP 5 - ATTACHMENTS
            ====================================================== --}}

            <div class="form-step" data-step="5">

                <div class="step-heading">

                    <h2>Required Documents</h2>

                    <p>
                        Upload the required documents for your business application.
                    </p>

                </div>


                <div class="attachment-grid">


                    {{-- BUSINESS PERMIT --}}

                    <div class="upload-card">

                        <label>
                            Business Permit
                            <span class="required">*</span>
                        </label>

                        <div class="upload-box">

                            <i class="fas fa-building"></i>

                            <strong>
                                Upload Business Permit
                            </strong>

                            <small>
                                JPG, PNG, PDF
                            </small>

                            <small>
                                Maximum 5MB
                            </small>

                            <input type="file"
                                   name="business_permit"
                                   class="file-input"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   required>

                            <div class="file-name">
                                No file chosen
                            </div>

                        </div>

                    </div>


                    {{-- DTI / SEC --}}

                    <div class="upload-card">

                        <label>
                            DTI / SEC Registration
                            <span class="required">*</span>
                        </label>

                        <div class="upload-box">

                            <i class="fas fa-file-contract"></i>

                            <strong>
                                Upload Registration
                            </strong>

                            <small>
                                JPG, PNG, PDF
                            </small>

                            <small>
                                Maximum 5MB
                            </small>

                            <input type="file"
                                   name="dti_sec"
                                   class="file-input"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   required>

                            <div class="file-name">
                                No file chosen
                            </div>

                        </div>

                    </div>


                    {{-- BIR --}}

                    <div class="upload-card">

                        <label>
                            BIR Form 2303
                            <span class="required">*</span>
                        </label>

                        <div class="upload-box">

                            <i class="fas fa-file-invoice"></i>

                            <strong>
                                Upload BIR Form
                            </strong>

                            <small>
                                JPG, PNG, PDF
                            </small>

                            <small>
                                Maximum 5MB
                            </small>

                            <input type="file"
                                   name="bir_form"
                                   class="file-input"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   required>

                            <div class="file-name">
                                No file chosen
                            </div>

                        </div>

                    </div>


                    {{-- VALID ID --}}

                    <div class="upload-card">

                        <label>
                            Authorized Signatory Valid ID
                            <span class="required">*</span>
                        </label>

                        <div class="upload-box">

                            <i class="fas fa-id-card"></i>

                            <strong>
                                Upload Valid ID
                            </strong>

                            <small>
                                JPG, PNG, PDF
                            </small>

                            <small>
                                Maximum 5MB
                            </small>

                            <input type="file"
                                   name="valid_id"
                                   class="file-input"
                                   accept=".jpg,.jpeg,.png,.pdf"
                                   required>

                            <div class="file-name">
                                No file chosen
                            </div>

                        </div>

                    </div>

                </div>


                <div class="upload-notice">

                    <i class="fas fa-shield-alt"></i>

                    <span>
                        Make sure all uploaded documents are clear,
                        readable, valid, and not larger than 5MB.
                    </span>

                </div>

            </div>


            {{-- =====================================================
                STEP 6 - LOCATION
            ====================================================== --}}

            <div class="form-step" data-step="6">


                    <div class="section-title location-title">
                        BUSINESS LOCATION
                    </div>


                    <div class="map-section">

                        <div class="map-header">

                            <div>

                                <h3>
                                    Mark Your Business Location
                                </h3>

                                <p>
                                    Click on the map to mark the exact location of your business.
                                </p>

                            </div>

                            <button type="button"
                                    data-get-location
                                    class="location-btn">

                                <i class="fas fa-location-arrow"></i>

                                Auto Detect My Location

                            </button>

                        </div>


                        <div id="map"></div>


                        <input type="hidden"
                               name="latitude"
                               id="latitude">

                        <input type="hidden"
                               name="longitude"
                               id="longitude">

                        <input type="hidden"
                               name="map_image"
                               id="mapImage">


                        <div class="coordinates">

                            Latitude:
                            <strong id="latitudeDisplay">Not selected</strong>

                            &nbsp;&nbsp;

                            Longitude:
                            <strong id="longitudeDisplay">Not selected</strong>

                        </div>

                    </div>


                </div>


            {{-- =====================================================
                 STEP 7 - REVIEW
            ====================================================== --}}

            <div class="form-step" data-step="7">

                <div class="step-heading">

                    <h2>Review Your Application</h2>

                    <p>
                        Review all information before submitting your Filbiz application.
                    </p>

                </div>


                {{-- BRANCH --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-store"></i>
                            Branch
                        </h3>

                        <button type="button"
                                onclick="goToStep(1)">
                            Edit
                        </button>

                    </div>

                    <div class="review-content">

                        <div>
                            <span>Selected Branch</span>
                            <strong id="reviewBranch">-</strong>
                        </div>

                    </div>

                </div>


                {{-- PLAN --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-wifi"></i>
                            Subscription Plan
                        </h3>

                        <button type="button"
                                onclick="goToStep(2)">
                            Edit
                        </button>

                    </div>

                    <div class="review-content">

                        <div>
                            <span>Plan</span>
                            <strong id="reviewPlan">-</strong>
                        </div>

                    </div>

                </div>


                {{-- BUSINESS --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-building"></i>
                            Business Information
                        </h3>

                        <button type="button"
                                onclick="goToStep(3)">
                            Edit
                        </button>

                    </div>

                    <div class="review-grid">

                        <div>
                            <span>Company Name</span>
                            <strong id="reviewCompany">-</strong>
                        </div>

                        <div>
                            <span>Nature of Business</span>
                            <strong id="reviewNature">-</strong>
                        </div>

                        <div class="full">
                            <span>Business Address</span>
                            <strong id="reviewBusinessAddress">-</strong>
                        </div>

                    </div>

                </div>


                {{-- PERSONAL --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-user"></i>
                            Authorized Signatory
                        </h3>

                        <button type="button"
                                onclick="goToStep(4)">
                            Edit
                        </button>

                    </div>

                    <div class="review-grid">

                        <div>
                            <span>Name</span>
                            <strong id="reviewName">-</strong>
                        </div>

                        <div>
                            <span>Position</span>
                            <strong id="reviewPosition">-</strong>
                        </div>

                        <div>
                            <span>Mobile</span>
                            <strong id="reviewMobile">-</strong>
                        </div>

                        <div>
                            <span>Email</span>
                            <strong id="reviewEmail">-</strong>
                        </div>

                        <div>
                            <span>Landline</span>
                            <strong id="reviewLandline">-</strong>
                        </div>

                        <div>
                            <span>Contact Person</span>
                            <strong id="reviewContactPerson">-</strong>
                        </div>

                    </div>

                </div>


                {{-- ATTACHMENTS --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-paperclip"></i>
                            Attachments
                        </h3>

                        <button type="button"
                                onclick="goToStep(5)">
                            Edit
                        </button>

                    </div>

                    <div class="review-files">

                        <div id="reviewBusinessPermit">
                            <i class="fas fa-file"></i>
                            Business Permit
                        </div>

                        <div id="reviewDti">
                            <i class="fas fa-file"></i>
                            DTI / SEC Registration
                        </div>

                        <div id="reviewBir">
                            <i class="fas fa-file"></i>
                            BIR Form 2303
                        </div>

                        <div id="reviewValidId">
                            <i class="fas fa-id-card"></i>
                            Valid ID
                        </div>

                    </div>

                </div>


                {{-- LOCATION --}}

                <div class="review-card">

                    <div class="review-card-header">

                        <h3>
                            <i class="fas fa-map-marker-alt"></i>
                            Business Location
                        </h3>

                        <button type="button"
                                onclick="goToStep(6)">
                            Edit
                        </button>

                    </div>

                    <div class="review-content">

                        <div>
                            <span>Latitude</span>
                            <strong id="reviewLatitude">-</strong>
                        </div>

                        <div>
                            <span>Longitude</span>
                            <strong id="reviewLongitude">-</strong>
                        </div>

                    </div>

                </div>


                {{-- =================================================
                     DECLARATION
                ================================================== --}}

                <div class="declaration-section">

                    <h3>
                        Subscriber's Declaration
                    </h3>


                    <label class="agreement-row">

                        <input type="checkbox"
                               id="declarationCheck"
                               name="declaration_agree"
                               value="1"
                               required>

                        <span>
                            I have read and agree to the
                            <a href="javascript:void(0)"
                               data-open-declaration>
                                Subscriber's Declaration
                            </a>
                        </span>

                    </label>


                    <label class="agreement-row">

                        <input type="checkbox"
                               id="contractCheck"
                               name="contract_agree"
                               value="1"
                               required>

                        <span>
                            I agree to the
                            <a href="javascript:void(0)"
                               data-open-contract>
                                Terms & Contract Agreement
                            </a>
                        </span>

                    </label>

                </div>


                {{-- =================================================
                     SIGNATURE
                ================================================== --}}

                <div class="signature-section">

                    <div class="signature-left">

                        <h3>
                            Digital Signature
                        </h3>

                        <button type="button"
                                data-open-signature
                                class="signature-button">

                            <i class="fas fa-signature"></i>

                            Add Digital Signature

                        </button>

                        <input type="hidden"
                               name="digital_signature"
                               id="digitalSignatureInput">

                    </div>


                    <div class="signature-preview">

                        <label>
                            Signature Preview
                        </label>

                        <div class="signature-preview-box">

                            <img id="signaturePreview"
                                 alt="Digital Signature">

                            <span id="signaturePlaceholder">
                                No signature yet
                            </span>

                        </div>

                    </div>

                </div>


                {{-- NOTICE --}}

                <div class="submit-notice">

                    <i class="fas fa-exclamation-circle"></i>

                    <span>
                        Please verify that all information and documents
                        are correct before submitting this application.
                    </span>

                </div>


                {{-- SUBMIT --}}

                <div class="submit-button-container">
                    <button type="submit"
                            id="submitBtn"
                            class="submit-button">

                        <i class="fas fa-paper-plane"></i>

                        Submit Application

                    </button>
                </div>
            </div>


            {{-- =====================================================
                 NAVIGATION
            ====================================================== --}}

            <div class="form-navigation">

                <button type="button"
                        id="prevBtn"
                        class="nav-button secondary"
                        onclick="previousStep()">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </button>


                <div class="step-counter">

                    Step
                    <strong id="currentStepText">1</strong>
                    of
                    7

                </div>


                <button type="button"
                        id="nextBtn"
                        class="nav-button primary"
                        onclick="nextStep()">

                    Next

                    <i class="fas fa-arrow-right"></i>

                </button>

            </div>

        </form>

    </div>

</div>



{{-- ================================================================
     DECLARATION MODAL
================================================================ --}}

<div class="modal-overlay"
     id="declarationModal">

    <div class="modal-content modal-declaration">

        <h3>
            SUBSCRIBER'S DECLARATION
        </h3>

        <div class="modal-body">

            <p>
                1. I hereby confirm that the foregoing information is true and correct,
                that supporting documents attached hereto are genuine and authentic,
                and that I voluntarily submitted the said information and documents
                for the purpose of facilitating my application to the Service.
            </p>

            <p>
                2. I hereby further confirm that I applied for and, once my application
                is approved, that I have voluntarily availed of the plans, products
                and/or services chosen by me in this application form.
            </p>

            <p>
                3. I hereby authorize FIL PRODUCTS SERVICE TELEVISION OF CALBAYOG, INC.
                to verify any information about me and/or documents available from
                whatever source for purposes related to my application.
            </p>

            <p>
                4. I give permission to use, disclose and share information contained
                in this application for processing applications, improving products
                and services, credit investigation, advertising and promoting products
                and services, and improving customer experience.
            </p>

            <p>
                5. I consent to disclosure of relevant Personal Information for the
                purposes stated above.
            </p>

            <p>
                6. I authorize communication through SMS or other communication
                regarding products and services.
            </p>

            <p>
                7. I acknowledge and agree to the Holding Period for the relevant
                service availed of.
            </p>

            <p>
                8. I am aware of the fees, rates and charges relevant to the service
                availed of and agree to pay the same within the due dates.
            </p>

            <p>
                9. I confirm that I have read and understood the Terms and Conditions
                of the Subscription Agreement.
            </p>

            <p>
                10. I agree that this Subscription Agreement shall govern our
                relationship for the service currently availed of and services
                I may avail of in the future.
            </p>

            <p>
                11. I agree to pay my application's cancellation fee equivalent
                to 20% of application charges.
            </p>

        </div>

        <button type="button"
                data-close-declaration
                class="modal-close-btn">

            Close

        </button>

    </div>

</div>

{{-- ================================================================
     CONTRACT MODAL
================================================================ --}}

<div class="modal-overlay"
     id="contractModal">

    <div class="contract-container">

        <h3 class="contract-title">
            CONTRACT AGREEMENT
        </h3>

        <div class="contract-scroll">

            <div class="contract-page">

                <div class="page-inner">

                    <p class="center">
                        <strong>
                            KNOW ALL MEN BY THESE PRESENTS:
                        </strong>
                    </p>

                    <p>
                        This <strong>CONTRACT SUBSCRIPTION</strong> is made and
                        entered into this day by and between
                        <strong>
                            FIL PRODUCTS SERVICE TELEVISION OF CALBAYOG, INC.
                        </strong>,
                        a corporation duly organized and existing under and
                        by virtue of Philippine laws with principal office at
                        Bernate Compound, Brgy. Capoocan, Calbayog City,
                        Philippines.
                    </p>

                    <p>
                        AND
                    </p>

                    <p>
                        I
                        <span class="fill-line"
                              id="contract_name">
                            __________________
                        </span>,
                        of legal age, and resident of
                        <span class="fill-line"
                              id="contract_address">
                            __________________
                        </span>
                        hereinafter referred to as the SUBSCRIBER.
                    </p>

                    <p class="center">
                        <strong>
                            WITNESSETH:
                        </strong>
                    </p>

                    <p>
                        <strong>1.</strong>
                        FPSTI is an entity authorized by law to build and
                        maintain satellite receiver and cable lines and
                        provide the SUBSCRIBER with cable TV and internet
                        connection.
                    </p>

                    <p>
                        <strong>2.</strong>
                        FPSTI does not give warranty or guarantee that the
                        cable TV and internet connection it will provide
                        will be free from interruption.
                    </p>

                    <p>
                        <strong>3.</strong>
                        FPSTI exercises no control over the content of the
                        information that would pass through its cable TV and
                        internet connection facilities.
                    </p>

                    <p>
                        <strong>4.</strong>
                        The SUBSCRIBER agrees to pay FPSTI the applicable
                        installation charges, deposit and other applicable
                        basic charges and fees.
                    </p>

                    <p>
                        <strong>5.</strong>
                        The monthly subscription fee shall become due and
                        payable at the end of each billing cycle.
                    </p>

                    <p>
                        <strong>6.</strong>
                        FPSTI reserves the right to increase subscription
                        fees and other charges upon prior notice.
                    </p>

                    <p>
                        <strong>7.</strong>
                        All payment of subscription fees and charges shall
                        be made at authorized FPSTI collection offices or
                        authorized collecting agencies.
                    </p>

                    <p>
                        <strong>8.</strong>
                        The Internet Modem assigned to the SUBSCRIBER is not
                        transferable. The service is subject to the applicable
                        lock-in period and pre-termination conditions stated
                        in the Subscription Agreement.
                    </p>

                    <p>
                        <strong>9.</strong>
                        FPSTI shall be responsible for maintenance and repair
                        of its cable and fiber optic lines.
                    </p>

                    <p>
                        <strong>10.</strong>
                        The SUBSCRIBER agrees to grant FPSTI reasonable
                        easement for installation and maintenance of its
                        facilities.
                    </p>

                    <p>
                        <strong>11.</strong>
                        Tampering with the INTERNET MODEM is strictly prohibited.
                    </p>

                    <p>
                        <strong>12.</strong>
                        Materials, equipment and accessories charged to the
                        SUBSCRIBER remain FPSTI property subject to the
                        applicable agreement.
                    </p>

                    <p>
                        <strong>13.</strong>
                        The SUBSCRIBER shall take responsibility for
                        safeguarding FPSTI property installed within the
                        premises.
                    </p>

                    <p>
                        <strong>14.</strong>
                        The SUBSCRIBER shall be liable for damage caused by
                        negligence, misuse or abuse.
                    </p>

                    <p>
                        <strong>15.</strong>
                        The SUBSCRIBER acknowledges the use of utility poles
                        and agrees to applicable conditions.
                    </p>

                    <p>
                        <strong>16.</strong>
                        FPSTI shall not be responsible for delays or
                        interruptions beyond its operational limits.
                    </p>

                    <p>
                        <strong>17.</strong>
                        The system installed and operated by FPSTI is
                        passive-oriented and low voltage.
                    </p>

                    <p>
                        <strong>18.</strong>
                        FPSTI may deactivate the Internet Modem in cases
                        provided under the agreement.
                    </p>

                    <p>
                        <strong>19.</strong>
                        Reconnection may be requested subject to applicable
                        conditions.
                    </p>

                    <p>
                        <strong>20.</strong>
                        Any delay or forbearance shall not prejudice FPSTI's
                        right to enforce the provisions of the agreement.
                    </p>

                    <p>
                        <strong>21.</strong>
                        Any action arising from this contract shall be filed
                        in the appropriate Trial Court in Calbayog City,
                        subject to applicable law.
                    </p>

                    <p>
                        <strong>22.</strong>
                        This contract shall be enforced until terminated
                        according to the applicable terms and conditions.
                    </p>

                    <br>

                    <p class="center">
                        <strong>
                            IN WITNESS WHEREOF
                        </strong>
                    </p>

                    <div class="contract-signatures">

                        <div>

                            <img id="contract_signature_img">

                            <span class="fill-line"
                                  id="contract_signature_name">
                                ___________________________
                            </span>

                            <br>

                            SUBSCRIBER

                        </div>

                        <div>

                            ___________________________

                            <br>

                            FPSTI REPRESENTATIVE

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <button type="button"
                data-close-contract
                class="modal-close-btn">

            Close

        </button>

    </div>

</div>



{{-- ================================================================
     SIGNATURE MODAL
================================================================ --}}

<div class="modal-overlay"
     id="signatureModal">

    <div class="modal-content modal-signature">

        <h3>
            Digital Signature
        </h3>

        <p class="signature-instruction">
            Draw your signature inside the box below.
        </p>

        <div class="signature-canvas-container">

            <canvas id="signatureCanvas"></canvas>

        </div>

        <div class="signature-buttons">

            <button type="button"
                    data-clear-signature
                    class="modal-clear-btn">

                Clear

            </button>

            <button type="button"
                    data-save-signature
                    class="modal-close-btn">

                Save Signature

            </button>

        </div>

    </div>

    
</div>



@include('layouts.footer')

@endsection
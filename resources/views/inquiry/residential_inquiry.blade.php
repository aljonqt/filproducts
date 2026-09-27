@extends('layouts.navbar')

@section('content')


@vite(['resources/js/app.js'])

<link rel="stylesheet" 
href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


<link rel="stylesheet" href="{{ asset('css/residential.css') }}">

<div class="page-wrapper">

    <div class="form-container">

        @if(session('success'))
            <div class="alert alert-success">
                {!! session('success') !!}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form id="residentialForm"
              method="POST"
              enctype="multipart/form-data"
              action="{{ route('residential.inquiry.submit') }}">

            @csrf

            {{-- =========================================================
                 HEADER
            ========================================================== --}}

            <div class="section-header">
                Residential Application
            </div>

            <p class="form-subtitle">
                Fill out the form below to apply for a residential internet/cable connection.
            </p>


            {{-- =========================================================
                 STEP PROGRESS
            ========================================================== --}}

            <div class="step-progress">

                <div class="step-item active" data-step="1">
                    <div class="step-circle">1</div>
                    <span>BRANCH</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="2">
                    <div class="step-circle">2</div>
                    <span>PLAN</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="3">
                    <div class="step-circle">3</div>
                    <span>PERSONAL</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="4">
                    <div class="step-circle">4</div>
                    <span>ADDRESS</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="5">
                    <div class="step-circle">5</div>
                    <span>EMPLOYMENT</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="6">
                    <div class="step-circle">6</div>
                    <span>AUTHORIZED</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="7">
                    <div class="step-circle">7</div>
                    <span>ATTACHMENTS</span>
                </div>

                <div class="step-line"></div>

                <div class="step-item" data-step="8">
                    <div class="step-circle">8</div>
                    <span>REVIEW</span>
                </div>

            </div>

            <div class="steps-container">

                <div class="form-step active" data-step="1">

                    <div class="step-heading">
                        <h2>Select Branch</h2>
                        <p>Please select the branch where you want to apply.</p>
                    </div>

                    <div class="step-card">

                        <div class="form-group branch-field">

                            <label>
                                Branch <span class="required">*</span>
                            </label>

                            <div class="custom-select">

                                <select name="branch" id="branch" required>

                                    <option value="">
                                        Select Branch
                                    </option>

                                    <option value="calbayog">
                                        Calbayog
                                    </option>

                                    <option value="catbalogan">
                                        Catbalogan
                                    </option>

                                    <option value="sanjorge">
                                        San Jorge
                                    </option>

                                    <option value="allen">
                                        Allen
                                    </option>

                                    <option value="catarman">
                                        Catarman
                                    </option>

                                    <option value="mondragon">
                                        Mondragon
                                    </option>

                                </select>

                                <i class="fas fa-chevron-down"></i>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="form-step" data-step="2">

                    <div class="step-heading">
                        <h2>Select Plan</h2>
                        <p>Choose the residential subscription plan you want.</p>
                    </div>

                    <div class="section-title">
                        RESIDENTIAL SUBSCRIPTION
                    </div>

                    <div class="plan-grid">

                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="50Mbps PHP 799"
                                   required>

                            <h4>Starter</h4>

                            <p class="speed">
                                50 Mbps
                            </p>

                            <span class="price">
                                ₱799
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>


                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="80Mbps PHP 899">

                            <h4>Basic</h4>

                            <p class="speed">
                                80 Mbps
                            </p>

                            <span class="price">
                                ₱899
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>


                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="100Mbps PHP 999">

                            <h4>Standard</h4>

                            <p class="speed">
                                100 Mbps
                            </p>

                            <span class="price">
                                ₱999
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>


                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="150Mbps PHP 1,199">

                            <h4>Advanced</h4>

                            <p class="speed">
                                150 Mbps
                            </p>

                            <span class="price">
                                ₱1,199
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>


                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="250Mbps PHP 1,299">

                            <h4>Premium</h4>

                            <p class="speed">
                                250 Mbps
                            </p>

                            <span class="price">
                                ₱1,299
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>


                        <label class="plan-card">

                            <input type="radio"
                                   name="monthly_subscription"
                                   value="300Mbps PHP 1,499">

                            <h4>Ultra</h4>

                            <p class="speed">
                                300 Mbps
                            </p>

                            <span class="price">
                                ₱1,499
                            </span>

                            <p class="plan-desc">
                                Free Premium Cable TV
                            </p>

                        </label>

                    </div>

                </div>


                {{-- =====================================================
                     STEP 3 - PERSONAL INFORMATION
                ====================================================== --}}

                <div class="form-step" data-step="3">

                    <div class="step-heading">
                        <h2>Personal Information</h2>
                        <p>Please provide your personal information.</p>
                    </div>

                    <div class="row row-3">

                        <div class="form-group">

                            <label>Salutation <span class="required">*</span></label>

                            <select name="salutation" required>

                                <option value="">Select</option>
                                <option>Mr.</option>
                                <option>Ms.</option>
                                <option>Mrs.</option>
                                <option>Others</option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>Gender <span class="required">*</span></label>

                            <select name="gender" required>

                                <option value="">Select</option>
                                <option>Male</option>
                                <option>Female</option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>Birthday <span class="required">*</span></label>

                            <input type="date"
                                   name="birthday"
                                   required>

                        </div>

                    </div>


                    <div class="row row-2">

                        <div class="form-group">

                            <label>Civil Status <span class="required">*</span></label>

                            <select name="civil_status" required>

                                <option value="">Select</option>
                                <option>Single</option>
                                <option>Married</option>
                                <option>Widow/Widower</option>
                                <option>Legally Separated</option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>Citizenship <span class="required">*</span></label>

                            <input type="text"
                                   name="citizenship"
                                   required>

                        </div>

                    </div>


                    <div class="row row-4">

                        <div class="form-group">

                            <label>First Name <span class="required">*</span></label>

                            <input type="text"
                                   name="first_name"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Middle Name <span class="required">*</span></label>

                            <input type="text"
                                   name="middle_name"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Last Name <span class="required">*</span></label>

                            <input type="text"
                                   name="last_name"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Mobile No. <span class="required">*</span></label>

                            <input type="text"
                                   name="mobile_no"
                                   required>

                        </div>

                    </div>


                    <div class="row row-4">

                        <div class="form-group">

                            <label>TIN No.</label>

                            <input type="text"
                                   name="tin_no">

                        </div>


                        <div class="form-group">

                            <label>Email Address <span class="required">*</span></label>

                            <input type="email"
                                   name="email"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Home Tel. No.</label>

                            <input type="text"
                                   name="home_tel">

                        </div>


                        <div class="form-group">

                            <label>GSIS / SSS No.</label>

                            <input type="text"
                                   name="gsis_sss">

                        </div>

                    </div>


                    <div class="section-title">
                        MOTHER'S FULL MAIDEN NAME
                    </div>


                    <div class="row row-3">

                        <div class="form-group">

                            <label>First Name <span class="required">*</span></label>

                            <input type="text"
                                   name="mother_first"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Middle Name <span class="required">*</span></label>

                            <input type="text"
                                   name="mother_middle"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>Last Name <span class="required">*</span></label>

                            <input type="text"
                                   name="mother_last"
                                   required>

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     STEP 4 - ADDRESS
                ====================================================== --}}

                <div class="form-step" data-step="4">

                    <div class="step-heading">
                        <h2>Home Address</h2>
                        <p>Please provide your complete residential address.</p>
                    </div>


                    <div class="row row-4">

                        <div class="form-group">

                            <label>
                                Room / Floor / Bldg. / No. / Street
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="street"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>
                                Barangay / Municipality / Town
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="barangay"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>
                                City / Province
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="city"
                                   required>

                        </div>


                        <div class="form-group">

                            <label>
                                Postal Code / Zip Code
                                <span class="required">*</span>
                            </label>

                            <input type="text"
                                   name="zip"
                                   required>

                        </div>

                    </div>


                    <div class="row row-2">

                        <div class="form-group">

                            <label>Home Ownership</label>

                            <select name="home_ownership">

                                <option>Owned</option>
                                <option>Living with relatives</option>
                                <option>Company-owned</option>
                                <option>Rented</option>
                                <option>Mortgage</option>

                            </select>

                        </div>


                        <div class="form-group">

                            <label>Years of Stay <span class="required">*</span></label>

                            <input type="text"
                                   name="years_of_stay"
                                   required>

                        </div>
                    <div class="location-preview-card">

                        <div>
                            <h3>House Location</h3>
                            <p>
                                You can mark your house location on the map in Step 7.
                            </p>
                        </div>

                    </div>

                    </div>
                </div>


                {{-- =====================================================
                     STEP 5 - EMPLOYMENT
                ====================================================== --}}

                <div class="form-step" data-step="5">

                    <div class="step-heading">
                        <h2>Employment / Financial Information</h2>
                        <p>Please provide your employment or business information.</p>
                    </div>

                    <div class="row row-2">

                        <div class="form-group">

                            <label>
                                Employer / Business Industry
                            </label>

                            <select name="industry"
                                    id="industry"
                                    onchange="toggleOtherIndustry(this)">

                                <option value="">
                                    Select Industry
                                </option>

                                <option>
                                    Banking and Finance
                                </option>

                                <option>
                                    Power / Energy / Utilities
                                </option>

                                <option>
                                    IT / Telecommunications / Manufacturing
                                </option>

                                <option>
                                    Service
                                </option>

                                <option value="Others">
                                    Others
                                </option>

                            </select>

                        </div>


                        <div class="form-group"
                             id="otherIndustryBox"
                             style="display:none;">

                            <label>
                                If Others, specify
                            </label>

                            <input type="text"
                                   name="industry_other">

                        </div>

                    </div>


                    <div class="section-title">
                        EMPLOYER ADDRESS
                    </div>


                    <div class="row row-4">

                        <div class="form-group">

                            <label>
                                Room / Floor / Bldg. / No. / Street
                            </label>

                            <input type="text"
                                   name="office_street">

                        </div>


                        <div class="form-group">

                            <label>
                                Barangay / Municipality / Town
                            </label>

                            <input type="text"
                                   name="office_barangay">

                        </div>


                        <div class="form-group">

                            <label>
                                City / Province
                            </label>

                            <input type="text"
                                   name="office_city">

                        </div>


                        <div class="form-group">

                            <label>
                                Postal Code / Zip Code
                            </label>

                            <input type="text"
                                   name="office_zip">

                        </div>

                    </div>


                    <div class="section-title">
                        EMPLOYMENT DETAILS
                    </div>


                    <div class="row row-4">

                        <div class="form-group">

                            <label>
                                Office Tel. No.
                            </label>

                            <input type="text"
                                   name="office_tel">

                        </div>


                        <div class="form-group">

                            <label>
                                Years in Company (mm/yy)
                            </label>

                            <input type="text"
                                   name="years_company">

                        </div>


                        <div class="form-group">

                            <label>
                                Current Position
                            </label>

                            <input type="text"
                                   name="position">

                        </div>


                        <div class="form-group">

                            <label>
                                Monthly Income
                            </label>

                            <input type="text"
                                   name="monthly_income">

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     STEP 6 - AUTHORIZED CONTACT
                ====================================================== --}}

                <div class="form-step" data-step="6">

                    <div class="step-heading">
                        <h2>Authorized Contact Person</h2>

                        <p>
                            Please provide a person who may be contacted in your absence.
                        </p>
                    </div>


                    <div class="section-title">
                        AUTHORIZED CONTACT PERSON IN YOUR ABSENCE
                    </div>


                    <div class="row row-3">

                        <div class="form-group">

                            <label>First Name</label>

                            <input type="text"
                                   name="auth_first">

                        </div>


                        <div class="form-group">

                            <label>Middle Name</label>

                            <input type="text"
                                   name="auth_middle">

                        </div>


                        <div class="form-group">

                            <label>Last Name</label>

                            <input type="text"
                                   name="auth_last">

                        </div>

                    </div>


                    <div class="row row-2">

                        <div class="form-group">

                            <label>Relation</label>

                            <input type="text"
                                   name="auth_relation">

                        </div>


                        <div class="form-group">

                            <label>Contact No.</label>

                            <input type="text"
                                   name="auth_contact">

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                     STEP 7 - ATTACHMENTS
                ====================================================== --}}

                <div class="form-step" data-step="7">

                    <div class="step-heading">
                        <h2>Attachments & Location</h2>

                        <p>
                            Upload the required documents and mark your house location.
                        </p>
                    </div>


                    <div class="section-title">
                        REQUIRED ATTACHMENTS
                    </div>


                    <div class="attachment-grid">


                        <!-- VALID ID -->
                    <div class="upload-card">
                        <label>
                            Valid Government ID <span style="color:red;">*</span>
                        </label>

                        <div class="upload-box">
                            <i class="fas fa-id-card"></i>

                            <span class="upload-text">Click or Drag File</span>
                            <small>JPG, PNG, PDF (Max 5MB)</small>

                            <span class="file-name"></span>

                            <input
                                type="file"
                                name="valid_id"
                                class="file-input"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                            >
                        </div>
                    </div>


                        <!-- PROOF OF BILLING -->
                    <div class="upload-card">
                        <label>
                            Proof of Billing / Address <span style="color:red;">*</span>
                        </label>

                        <div class="upload-box">
                            <i class="fas fa-file-invoice"></i>

                            <span class="upload-text">Upload Document</span>
                            <small>JPG, PNG, PDF (Max 5MB)</small>

                            <span class="file-name"></span>

                            <input
                                type="file"
                                name="proof_billing"
                                class="file-input"
                                accept=".jpg,.jpeg,.png,.pdf"
                                required
                            >
                        </div>
                    </div>


                        <!-- OTHER -->
                    <div class="upload-card">
                        <label>Other Supporting Document</label>

                        <div class="upload-box">
                            <i class="fas fa-folder-open"></i>

                            <span class="upload-text">Optional Upload</span>
                            <small>Any supporting file</small>

                            <span class="file-name"></span>

                            <input
                                type="file"
                                name="other_attachment"
                                class="file-input"
                                accept=".jpg,.jpeg,.png,.pdf"
                            >
                        </div>
                    </div>

                    </div>


                    {{-- LOCATION --}}

                    <div class="section-title location-title">
                        HOUSE LOCATION
                    </div>


                    <div class="map-section">

                        <div class="map-header">

                            <div>

                                <h3>
                                    Mark Your House Location
                                </h3>

                                <p>
                                    Click on the map to mark the exact location of your house.
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
                     STEP 8 - REVIEW
                ====================================================== --}}

                <div class="form-step" data-step="8">

                    <div class="step-heading">

                        <h2>Review Application</h2>

                        <p>
                            Please review your information before submitting your application.
                        </p>

                    </div>


                    {{-- REVIEW BRANCH --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-building"></i>
                                Branch & Plan
                            </h3>

                            <button type="button"
                                    onclick="goToStep(1)">
                                Edit
                            </button>

                        </div>


                        <div class="review-grid">

                            <div>
                                <span>Branch</span>
                                <strong id="reviewBranch">-</strong>
                            </div>

                            <div>
                                <span>Subscription</span>
                                <strong id="reviewPlan">-</strong>
                            </div>

                        </div>

                    </div>


                    {{-- REVIEW PERSONAL --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-user"></i>
                                Personal Information
                            </h3>

                            <button type="button"
                                    onclick="goToStep(3)">
                                Edit
                            </button>

                        </div>


                        <div class="review-grid">

                            <div>
                                <span>Full Name</span>
                                <strong id="reviewName">-</strong>
                            </div>

                            <div>
                                <span>Gender</span>
                                <strong id="reviewGender">-</strong>
                            </div>

                            <div>
                                <span>Birthday</span>
                                <strong id="reviewBirthday">-</strong>
                            </div>

                            <div>
                                <span>Civil Status</span>
                                <strong id="reviewCivilStatus">-</strong>
                            </div>

                            <div>
                                <span>Citizenship</span>
                                <strong id="reviewCitizenship">-</strong>
                            </div>

                            <div>
                                <span>Mobile No.</span>
                                <strong id="reviewMobile">-</strong>
                            </div>

                            <div>
                                <span>Email</span>
                                <strong id="reviewEmail">-</strong>
                            </div>

                        </div>

                    </div>


                    {{-- REVIEW ADDRESS --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-home"></i>
                                Home Address
                            </h3>

                            <button type="button"
                                    onclick="goToStep(4)">
                                Edit
                            </button>

                        </div>


                        <div class="review-grid">

                            <div class="review-full">

                                <span>Complete Address</span>

                                <strong id="reviewAddress">
                                    -
                                </strong>

                            </div>

                            <div>

                                <span>Home Ownership</span>

                                <strong id="reviewOwnership">
                                    -
                                </strong>

                            </div>

                            <div>

                                <span>Years of Stay</span>

                                <strong id="reviewStay">
                                    -
                                </strong>

                            </div>

                        </div>

                    </div>


                    {{-- REVIEW EMPLOYMENT --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-briefcase"></i>
                                Employment / Financial
                            </h3>

                            <button type="button"
                                    onclick="goToStep(5)">
                                Edit
                            </button>

                        </div>


                        <div class="review-grid">

                            <div>
                                <span>Industry</span>
                                <strong id="reviewIndustry">-</strong>
                            </div>

                            <div>
                                <span>Position</span>
                                <strong id="reviewPosition">-</strong>
                            </div>

                            <div>
                                <span>Monthly Income</span>
                                <strong id="reviewIncome">-</strong>
                            </div>

                            <div>
                                <span>Office Telephone</span>
                                <strong id="reviewOfficeTel">-</strong>
                            </div>

                        </div>

                    </div>


                    {{-- REVIEW AUTHORIZED CONTACT --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-address-book"></i>
                                Authorized Contact
                            </h3>

                            <button type="button"
                                    onclick="goToStep(6)">
                                Edit
                            </button>

                        </div>


                        <div class="review-grid">

                            <div>
                                <span>Name</span>
                                <strong id="reviewAuthName">-</strong>
                            </div>

                            <div>
                                <span>Relation</span>
                                <strong id="reviewAuthRelation">-</strong>
                            </div>

                            <div>
                                <span>Contact No.</span>
                                <strong id="reviewAuthContact">-</strong>
                            </div>

                        </div>

                    </div>


                    {{-- REVIEW ATTACHMENTS --}}

                    <div class="review-card">

                        <div class="review-card-header">

                            <h3>
                                <i class="fas fa-paperclip"></i>
                                Attachments & Location
                            </h3>

                            <button type="button"
                                    onclick="goToStep(7)">
                                Edit
                            </button>

                        </div>


                        <div class="review-files">

                            <div>
                                <i class="fas fa-id-card"></i>
                                <span>Valid Government ID</span>
                                <strong id="reviewValidId">
                                    Not uploaded
                                </strong>
                            </div>

                            <div>
                                <i class="fas fa-file-invoice"></i>
                                <span>Proof of Billing</span>
                                <strong id="reviewBilling">
                                    Not uploaded
                                </strong>
                            </div>

                            <div>
                                <i class="fas fa-folder"></i>
                                <span>Other Document</span>
                                <strong id="reviewOther">
                                    Not uploaded
                                </strong>
                            </div>

                        </div>


                        <div class="review-location">

                            <span>
                                <i class="fas fa-map-marker-alt"></i>
                                House Location
                            </span>

                            <strong id="reviewCoordinates">
                                Not selected
                            </strong>

                        </div>

                    </div>


                    {{-- DECLARATION --}}

                    <div class="review-agreement">

                        <div class="agreement-item">

                            <input type="checkbox"
                                   id="declarationCheck"
                                   name="declaration_agree"
                                   value="1">

                            <label for="declarationCheck">

                                I have read and agree to the
                                <span data-open-declaration>
                                    Subscriber's Declaration
                                </span>

                            </label>

                        </div>


                        <div class="agreement-item">

                            <input type="checkbox"
                                   id="contractCheck"
                                   name="contract_agree"
                                   value="1">

                            <label for="contractCheck">

                                I agree to the
                                <span data-open-contract>
                                    Terms & Contract Agreement
                                </span>

                            </label>

                        </div>


                        {{-- SIGNATURE --}}

                        <div class="signature-area">

                            <div>

                                <label class="label-title">
                                    Digital Signature
                                </label>

                                <button type="button"
                                        data-open-signature
                                        class="signature-btn">

                                    <i class="fas fa-signature"></i>

                                    Add Digital Signature

                                </button>

                            </div>


                            <div class="signature-box">

                                <img id="signaturePreview"
                                     style="max-height:100px;display:none;">

                                <span id="signaturePlaceholder">
                                    No signature yet
                                </span>

                            </div>

                        </div>


                        <input type="hidden"
                               name="digital_signature"
                               id="digitalSignatureInput">


                        <div class="notice-box">

                            <strong>Notice:</strong>

                            By submitting this application, the applicant acknowledges
                            that they have carefully read, understood, and agreed to
                            the terms and conditions outlined in the contract.

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                 NAVIGATION
            ========================================================== --}}

            <div class="step-navigation">

                <button type="button"
                        id="backBtn"
                        class="nav-btn back-btn"
                        onclick="previousStep()">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </button>


                <div class="step-counter">

                    Step <strong id="currentStepNumber">1</strong>
                    of 8

                </div>


                <button type="button"
                        id="nextBtn"
                        class="nav-btn next-btn"
                        onclick="nextStep()">

                    Next

                    <i class="fas fa-arrow-right"></i>

                </button>


                <button type="submit"
                        id="submitBtn"
                        class="nav-btn submit-btn"
                        style="display:none;">

                    <i class="fas fa-paper-plane"></i>

                    Submit Application

                </button>

            </div>

        </form>

    </div>

</div>


{{-- =========================================================
     DECLARATION MODAL
========================================================== --}}

<div class="modal-overlay"
     id="declarationModal">

    <div class="modal-content modal-large">

        <h3>
            SUBSCRIBER'S DECLARATION
        </h3>

        <div class="modal-body">

            <p>
                1. I hereby confirm that the foregoing information is true and correct, that supporting documents attached hereto are genuine and authentic, and that I voluntarily submitted the said information and documents for the purpose of facilitating my application to the Service.
            </p>

            <p>
                2. I hereby further confirm that I applied for and, once my application is approved, that I have voluntarily availed of the plans, products and/or services chosen by me in this application form, as well as the inclusions and special features of such plans, products and/or services and that any enrolment I have indicated herein have been knowingly made by me.
            </p>

            <p>
                3. I hereby authorize FIL PRODUCTS SERVICE TELEVISION OF CALBAYOG, INC. (hereinafter "you") or any person or entity authorized by you, to verify any information about me and/or documents available from whatever source including but not limited to (i) your subsidiaries, affiliates, and/or their service providers: or (ii) banks, credit card companies, and other lending and/or financial institution, and I hereby authorize the holder, controller and processor of such information and/or document, has the same is defined in Republic Act No. 10173 (otherwise known as "Data Privacy Act of 2012), or any amendment or modification of the same, to conform, release and verify the existence, truthfulness, and/or accuracy of such information and/or document.
            </p>

            <p>
                4. I give you permission to use, disclose and share with your business partners, subsidiaries and affiliates (and their business partners) information contained in this application about me and my subscription, my network and connections, my service usage and payment patterns, information about the device and equipment I use to access you service, websites and app used in your services, information from your third party partners and advertisers, including any data or analytics derived therefrom, in whatever form (hereinafter "Personal Information"), for the following purposes: processing any application or request for availment of any product and/or service which they offer, improving your/ their products and services, credit investigation and scoring, advertising and promoting new products and services, to the end of improving my and/or the public's customer experience.
            </p>

            <p>
                5. I consent to your business partners', subsidiaries' and affiliates' (and their business partners') disclosure to you of any Personal Information in their possession to achieve any of the purposes stated above.
            </p>

            <p>
                6. I hereby likewise authorize you, your business partners, subsidiaries and affiliates, to send me SMS alerts or any communication, advertisement or promotional material pertaining to any new or current product and/or service offered by you, your business partners, subsidiaries and affiliates
            </p>

            <p>
                7. I acknowledge and agree to the Holding Period for the relevant service availed of. If I choose to downgrade my plan, transfer and rights or obligations of my subscription or pre-terminate or cancel my subscription within the Holding Period then I agree to pay the relevant fees, charges and penalties imposed by you.
            </p>

            <p>
                8. I am aware of the fees, rates and charges relevant of the service availed of and I agree to pay the same within the due dates. I understand that I will be subject to, and hereby agree and undertake, interest and penalties for late payment or non-payment stated in the terms and condition.
            </p>

            <p>
                9. I hereby confirm that I have read and understood the Terms and Conditions of our Subscription Agreement and that I shall strictly comply and abide by these terms and conditions and any future amendments thereto.
            </p>

            <p>
                10. I agree that this Subscription Agreement shall govern our relationship for the service currently availed of and the service I will avail of in the future.
            </p>

            <p>
                11. I agree to pay my application's cancellation fee equivalent to 20% of application charges (Deposit, Installation fee and equipments).
            </p>

        </div>

        <button type="button"
                data-close-declaration
                class="modal-btn secondary">

            Close

        </button>

    </div>

</div>


{{-- =========================================================
     CONTRACT MODAL
========================================================== --}}

<div class="modal-overlay"
     id="contractModal">

    <div class="contract-viewer">

        <h3 class="contract-title">
            CONTRACT AGREEMENT
        </h3>

        <div class="contract-scroll">

            <div class="contract-pages">

                <div class="contract-page">

                    <div class="page-inner">

                        <p class="center">
                            <strong>
                                KNOW ALL MEN BY THESE PRESENTS:
                            </strong>
                        </p>

                        <p>
                            This <strong>CONTRACT SUBSCRIPTION</strong> is made and
                            entered into this day of
                            <span class="line-date"
                                  id="contract_day">
                                __
                            </span>
                            of
                            <span class="line-date"
                                  id="contract_month">
                                ________
                            </span>,
                            <span class="line-date"
                                  id="contract_year">
                                20__
                            </span>
                            by and between
                            <strong>
                                FIL PRODUCTS SERVICE TELEVISION OF CALBAYOG, INC.
                            </strong>, a corporation 
                    duly organized and existing under and by virtue of Philippine laws with principal office at Bernate Compound, 
                    Brgy. Capoocan, Calbayog City, Philippines, hereinafter referred to as <strong>FPSTI</strong>:
                        </p>

                        <p class="center">
                            <strong>AND</strong>
                        </p>

                        <p>

                            I
                            <span class="fill-line"
                                  id="contract_name">
                                ________________
                            </span>

                            of legal age and resident of

                            <span class="fill-line"
                                  id="contract_address">
                                ________________
                            </span>

                            hereinafter referred to as the SUBSCRIBER.

                        </p>

                        <p class="center">
                            <strong>WITNESSETH:</strong>
                        </p>

                        <p>
                            <strong>1.</strong>
                            FPSTI is an entity authorized by law to build and maintain satellite receiver and cable lines in <span class="line-date" id="contract_branch">__________</span>, Samar, and provide the SUBSCRIBER with cable TV and internet connection.FPSTIshall not be held legally liable for any change, injury, or illegal acts that the subscribers might have caused in the use of the said services.
                        </p>

                        <p>
                            <strong>2.</strong>
                            FPSTI does not give warranty or guarantee that the cable TV and internet connection it will provide to the subscriber will be free from interruption.
                        </p>

                        <p>
                            <strong>3.</strong>
                            FPSTI exercises no control over the content of the information that would pass through FPSTI’s cable TV and internet connection facilities, thereby freeing it from any liability whatsoever in whatever form.
                        </p>

                        <p>
                            <strong>4.</strong>
                            The SUBSCRIBER agrees to pay FPSTIthe one-time installation charges, one-month deposit and other applicable basic charges and fees as agreed upon by the SUBSCRIBERin the application form that is signed. All charges and fees shall be non-refundable.The one-month deposit being non-refundable may be consumed to cover the last month of this contract, or may be made part of the Pre-Termination Fee as provided in paragraph 8 hereof.
                        </p>

                        <p>
                            <strong>5.</strong>
                            The monthly subscription fee for the cable TV and internet connection, whether individually separate or as a package, shall become due and payable without necessity of demand or billing upon the end of each billing cycle.
                        </p>

                        <p>
                            <strong>6.</strong>
                            FPSTI reserves the right to increase the subscription fees and other charges upon prior notice to the subscriber. The FPSTIshall notify the subscriber 15 days prior to its implementation by posting the same in all FPSTIcollection offices.
                        </p>

                        <p>
                            <strong>7.</strong>
                            All payment of subscription fees and charges shall be made at any FPSTI collection office or by collecting agencies authorized and accredited by FPSTI.
                        </p>

                        <p>
                            <strong>8.</strong>
                            The Internet Modem that FPSTI assigns to SUBSCRIBER, once connected, is not transferrable. The right to use the Internet Modem shall not be leased, transferred or assigned to another person without a written consent and notification from FPSTI. The right to use the service is not transferrable. Accounts are for SUBSCRIBER’s use only. The cable TV and internet connection provided by FPSTIfor the SUBSCRIBER are subject to a lock-in period of three (3) years. A pre-termination fee of the equivalent in PESOS (Monthly Subscription Fee x 3 months)shall be payable by the SUBSCRIBER to FPSTI; otherwise, the billing for the monthly subscription will continue to take effect.
                        </p>

                        <p>
                            <strong>9.</strong>
                            FPSTI shall be responsible in the maintenance and repair of its cable and fiber optic lines. The SUBSCRIBER agrees that only duly authorized employees/technicians of FPSTI shall be allowed to enter the former’s premises for ocular inspection/installation/disconnection/pull-out of equipments and/or repair purposes during the reasonable hours of the day.
                        </p>

                        <p>
                            <strong>10.</strong>
                            The SUBSCRIBER agrees to grant FPSTIeasement to use an existing passage forcable TV and internet connection in the interior or neighboring premises or areas. FPSTI shall be entitled free of charge to an easement over the SUBSCRIBER’s premises for the passage of repairmen, crossing or laying of cable wire, whether aerial or underground and other connection facilities.
                        </p>

                        <p>
                            <strong>11.</strong>
                            Tampering with the INTERNET MODEM is strictly prohibited. FPSTIreserves the right to immediately suspend the service, blacklist the subscriber and confiscate the INTERNET MODEM foundtampered.
                        </p>

                        <p>
                            <strong>12.</strong>
                            Materials, equipments and accessories charged to the SUBSCRIBER are considered as FPSTIproperty during the existence and validity of the contract and even beyond the termination thereof if the SUBSCRIBER still has an outstanding or unpaid account with FPSTI.
                        </p>

                        <p>
                            <strong>13.</strong>
                            The SUBSCRIBER shall take full responsibility in safeguarding and preserving all properties of FPSTI, entrusted and installed within the premises of the SUBSCRIBER property until the same are officially turned over to the latter.
                        </p>

                        <p>
                            <strong>14.</strong>
                            The SUBSCRIBER shall be liable and responsible for any damage to FPSTI’s property, facilities and equipment entrusted to the former, caused by the negligence, misuse and abuse by the SUBSCRIBER, except through the normal wear and tear. The SUBSCRIBER shall pay corresponding charges, if any, for the necessary repair or replacement of damaged property facilities and equipment.
                        </p>

                        <p>
                            <strong>15.</strong>
                            The SUBSCRIBER is aware and cognizant of the fact that FPSTI is making use of poles owned by one or more utility companies, and that, these companies have controlling interests over the utilization of such poles. Thus, the SUBSCRIBER agrees to hold FPSTIfree from any and all claims, losses or damage that the SUBSCRIBER may incur or suffer in the event that discontinuance of the use of the said poles will transpire beyond the control of FPSTI.
                        </p>

                        <p>
                            <strong>16.</strong>
                            FPSTI shall not be responsible for any delays, interruptions, non-service which are out of bounds of its operational limits due to power failure, acts of God, acts of nature, acts of any government or supernatural authority, war or public emergency, accident, fire, lightning, riot, strikes, lock-outs, industrial disputes and failure/breakdown of SUBSCRIBER’S owned and managed network facilities.
                        </p>

                        <div class="page-number">
                            Page 1 of 2
                        </div>

                    </div>

                </div>


                <div class="contract-page">

                    <div class="page-inner">

                        <p>
                            <strong>17.</strong>
                            The system installed and operated by FPSTI is passive-oriented, low voltage DC-type incapable of causing any damage to the computer or television set. This system has been tested and approved by the proper government agency and its satisfactory reception is dependent on a properly functioning computer or television set to be provided and maintained by the SUBSCRIBER under his exclusive responsibility. FPSTIshall not have any responsibility whatsoever with respect to the condition, defect or performance of the SUBSCRIBER’s computer and/or television set(s) or any such other damages.
                        </p>

                        <p>
                            <strong>18.</strong>
                            FPSTI shall have the right to automatically deactivate the INTERNET MODEM in case of:
                        </p>

                        <p style="margin-left:20px;"><strong>a.)</strong> Non-payment of one (1) month for Bundle Subscribers. (Internet and Cable), and/or effect immediate disconnection and removal of the INTERNET MODEM/ equipment/properties from the SUBSCRIBER’s premises upon non-settlement of the account FIFTEEN DAYS (15) after the grace period extended from due date;</p>

                        <p style="margin-left:20px;"><strong>b.)</strong> Violation by the SUBSCRIBER of any of the foregoing provisions of this CONTRACT, subject to FPSTI’s right to collect all the unpaid dues through the proper authority or court of jurisdiction.</p>

                        <p>
                            <strong>19.</strong>
                            If disconnection and discontinuation of internet services are effected by FPSTIdue to default of bill payments on the part of the SUBSCRIBER, the latter may apply for reconnection and resumption of subscription services for the remainder of the present CONTRACT after satisfying the conditions for reconnection.
                        </p>

                        <p>
                            <strong>20.</strong>
                            Except by expressed written waiver, any delay, neglect of forbearance of FPSTIto require or enforce any of the provisions of this CONTRACT shall not prejudice the right of FPSTIto exercise or to act strictly afterwards in accordance with the said provisions.
                        </p>

                        <p>
                            <strong>21.</strong>
                            Any action arising from this CONTRACT shall be filed in the appropriate Trial Court in Calbayog Cityto the exclusion of any court. The aggrieved party shall be entitled to attorney’s fees and collection expenses equivalent to 25% of the total amount due which in no case shall be less than Php 3,000.00.
                        </p>

                        <p>
                            <strong>22.</strong>
                            This contract shall be enforced until terminated by FPSTI or by the SUBSCRIBER upon five-day (5) prior notice in writing with or without cause. All unpaid dues, arrears and monthly subscriptions for the period shall be settled by the latter prior to the effectivity of the termination.
                        </p>

                        <br>

                        <p class="center">
                            <strong>IN WITNESS WHEREOF</strong>
                            the parties have hereunto signed this contract.
                        </p>

                        <br><br>

                        <div class="contract-signatures">

                            <div>

                                <img id="contract_signature_img"
                                     style="max-height:70px;display:none;">

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

                        <br><br>

                        <p class="center">
                            <strong>
                                Signed in the presence of:
                            </strong>
                        </p>

                        <div class="contract-signatures">

                            <div>
                                ___________________________
                                <br>
                                Witness
                            </div>

                            <div>
                                ___________________________
                                <br>
                                Witness
                            </div>

                        </div>

                        <br>

                        <p class="center">
                            <strong>
                                ACKNOWLEDGEMENT
                            </strong>
                        </p>

                        <p>
                            REPUBLIC OF THE PHILIPPINES
                        </p>

                        <p>
                            CITY OF CALBAYOG
                        </p>

                        <p>
                            PROVINCE OF SAMAR
                        </p>

                        <p>
                            BEFORE ME, personally appeared this day of______in________, Calbayog City, Philippines 
                    the following with their evidence of identity written opposite their name below:
                        </p>

                        <br>

                        <table class="ack-table">

                            <tr>
                                <td>Name</td>
                                <td>ID No.</td>
                                <td>Date/Place of Issue</td>
                            </tr>

                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                        </table>

                        <br>

                        <p>
                            All known to me and to me known to be the same persons who executed the foregoing instrument and they acknowledged that the same is their free and voluntary act and deed. This instrument consists of two (2) pages including the page where this acknowledgement is written, signed by the parties together with their instrumental witnesses in all pages hereof.
                        </p>

                        <p>
                    Witness my hand and seal, on the day, year and place first written above.
                    </p>

                        <br>

                        <p>
                            Doc. No. _______<br>
                            Page No. _______<br>
                            Book No. _______<br>
                            Series of _______
                        </p>

                        <div class="page-number">
                            Page 2 of 2
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <button type="button"
                data-close-contract
                class="modal-btn secondary">

            Close

        </button>

    </div>

</div>


{{-- =========================================================
     SIGNATURE MODAL
========================================================== --}}

<div class="modal-overlay"
     id="signatureModal">

    <div class="modal-content signature-modal">

        <h3>
            Digital Signature
        </h3>

        <div class="signature-canvas-wrapper">

            <canvas id="signatureCanvas"></canvas>

        </div>


        <div class="signature-actions">

            <button type="button"
                    data-clear-signature
                    class="modal-btn secondary">

                Clear

            </button>

            <button type="button"
                    data-save-signature
                    class="modal-btn primary">

                Save Signature

            </button>

        </div>

    </div>
</div>

</div>


@include('layouts.footer')

@endsection
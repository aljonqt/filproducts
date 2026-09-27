@extends('layouts.navbar')

@section('content')

<style>

    .application-page {
        min-height: calc(100vh - 80px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: #ffffff;
    }

    .application-container {
        width: 100%;
        max-width: 850px;
    }

    /* HEADER */

    .application-header {
        text-align: center;
        margin-bottom: 35px;
    }

    .application-icon {
        width: 58px;
        height: 58px;
        margin: 0 auto 15px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #003366;
        color: #ffffff;

        border-radius: 14px;

        font-size: 24px;

        box-shadow:
            0 8px 20px rgba(0, 51, 102, 0.20);
    }

    .application-header h1 {
        margin: 0;

        color: #003366;

        font-size: 28px;
        font-weight: 800;
    }

    .application-header p {
        margin: 10px auto 0;

        max-width: 600px;

        color: #64748b;

        font-size: 14px;
        line-height: 1.6;
    }


    /* APPLICATION CARDS */

    .application-options {
        display: grid;

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

        gap: 20px;
    }

    .application-card {
        position: relative;

        display: flex;
        align-items: center;

        padding: 25px;

        min-height: 170px;

        background: #ffffff;

        border: 2px solid #e5edf5;

        border-radius: 16px;

        text-decoration: none;

        transition:
            transform 0.2s ease,
            border-color 0.2s ease,
            box-shadow 0.2s ease;

        box-shadow:
            0 6px 20px rgba(0, 51, 102, 0.08);
    }

    .application-card:hover {
        transform: translateY(-4px);

        border-color: #003366;

        box-shadow:
            0 12px 28px rgba(0, 51, 102, 0.15);
    }


    /* ICON */

    .application-card-icon {
        width: 60px;
        height: 60px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-right: 20px;

        background: #003366;

        color: #ffffff;

        border-radius: 14px;

        font-size: 25px;
    }


    /* TEXT */

    .application-card-content {
        flex: 1;
    }

    .application-card-content h2 {
        margin: 0 0 7px;

        color: #003366;

        font-size: 19px;
        font-weight: 800;
    }

    .application-card-content p {
        margin: 0;

        color: #64748b;

        font-size: 13px;
        line-height: 1.6;
    }


    /* ARROW */

    .application-arrow {
        margin-left: 15px;

        color: #003366;

        font-size: 18px;

        transition:
            transform 0.2s ease;
    }

    .application-card:hover .application-arrow {
        transform: translateX(5px);
    }


    /* BACK BUTTON */

    .application-back {
        display: flex;

        justify-content: center;

        margin-top: 30px;
    }

    .back-button {
        display: inline-flex;

        align-items: center;
        gap: 8px;

        padding: 11px 22px;

        background: #ffffff;

        color: #003366;

        border: 1px solid #d8e2ec;

        border-radius: 25px;

        text-decoration: none;

        font-size: 13px;
        font-weight: 700;

        transition: 0.2s ease;
    }

    .back-button:hover {
        background: #003366;
        color: #ffffff;

        border-color: #003366;
    }


    /* MOBILE */

    @media (max-width: 700px) {

        .application-page {
            padding: 30px 15px;
        }

        .application-header h1 {
            font-size: 24px;
        }

        .application-header p {
            font-size: 13px;
        }

        .application-options {
            grid-template-columns: 1fr;
        }

        .application-card {
            min-height: 145px;
            padding: 20px;
        }

        .application-card-icon {
            width: 52px;
            height: 52px;

            margin-right: 15px;

            font-size: 21px;
        }

        .application-card-content h2 {
            font-size: 17px;
        }

        .application-card-content p {
            font-size: 12px;
        }

    }

</style>


<div class="application-page">

    <div class="application-container">

        <!-- HEADER -->

        <div class="application-header">

            <div class="application-icon">
                <i class="fas fa-file-signature"></i>
            </div>

            <h1>Select Application Type</h1>

            <p>
                Please select the type of application you would like
                to submit. Choose the option that best matches your
                service requirements.
            </p>

        </div>


        <!-- APPLICATION OPTIONS -->

        <div class="application-options">

            <!-- RESIDENTIAL -->

            <a
                href="{{ route('residential.inquiry') }}"
                class="application-card"
            >

                <div class="application-card-icon">
                    <i class="fas fa-house"></i>
                </div>

                <div class="application-card-content">

                    <h2>Residential</h2>

                    <p>
                        For individual homeowners and families
                        applying for a personal internet or
                        television connection.
                    </p>

                </div>

                <div class="application-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>

            </a>


            <!-- BUSINESS -->

            <a
                href="{{ route('filbiz.inquiry') }}"
                class="application-card"
            >

                <div class="application-card-icon">
                    <i class="fas fa-building"></i>
                </div>

                <div class="application-card-content">

                    <h2>Filbiz</h2>

                    <p>
                        For businesses, offices, organizations,
                        and commercial establishments applying
                        for a service connection.
                    </p>

                </div>

                <div class="application-arrow">
                    <i class="fas fa-chevron-right"></i>
                </div>

            </a>

        </div>

    </div>

</div>

@endsection
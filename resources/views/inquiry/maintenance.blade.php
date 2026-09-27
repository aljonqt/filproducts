
@extends('layouts.navbar')

@section('content')

<style>
    .maintenance-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 60px 20px;
        background: #f5f7fa;
        color: #333;
    }

    .maintenance-container {
        width: 90%;
        max-width: 500px;
        padding: 50px 30px;
        text-align: center;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
    }

    .maintenance-icon {
        margin-bottom: 20px;
        font-size: 60px;
    }

    .maintenance-container h1 {
        margin-bottom: 15px;
        color: #003366;
        font-size: 30px;
    }

    .maintenance-container p {
        margin: 8px 0;
        color: #666;
        line-height: 1.6;
    }

    .back-button {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 25px;
        border-radius: 6px;
        background: #003366;
        color: #fff;
        text-decoration: none;
        transition: background 0.2s ease;
    }

    .back-button:hover {
        background: #002244;
    }
</style>

<div class="maintenance-page">

    <div class="maintenance-container">

        <div class="maintenance-icon">
            🛠️
        </div>

        <h1>Page Under Maintenance</h1>

        <p>
            The Application page is temporarily unavailable
            while we perform system improvements.
        </p>

        <p>
            Please check back again later.
        </p>


    </div>

</div>

@include('layouts.footer')

@endsection


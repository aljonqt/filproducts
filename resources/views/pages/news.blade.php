@extends('layouts.navbar')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('public/css/news.css') }}">

<section class="news-page">

<div class="news-container">

<div class="news-header">
    <h1>Latest News & Updates</h1>
    <p>Stay updated with the latest announcements from Fil Products Eastern Visayas.</p>
</div>

<div class="news-list">

<!-- NEWS 1 -->
<div class="news-card">

    <div class="news-image-wrapper">
        <img src="{{ asset('images/mondragon.jfif') }}" class="news-image">
        <span class="news-date">January 2026</span>
    </div>

    <div class="news-content">

        <h3>Fil Products Samar – Mondragon Branch is Now Open</h3>

        <p class="news-location">
            <i class="fas fa-map-marker-alt"></i> Mondragon, Northern Samar
        </p>

        <p>
            <strong>How to get there:</strong><br>
            • From Public Market – right side<br>
            • From San Roque – left side, after Cebuana Lhuillier
        </p>

        <p class="news-highlight">
            Fast • Reliable • Local Support
        </p>

        <a href="#" class="news-cta">
            Visit Our Office →
        </a>

    </div>
</div>

<!-- NEWS 2 -->
<div class="news-card">

    <div class="news-image-wrapper">
        <img src="{{ asset('images/networkexpansion.png') }}" class="news-image">
        <span class="news-date">2026</span>
    </div>

    <div class="news-content">

        <h3>Fiber Expansion Across Samar</h3>

        <p class="news-location">
            <i class="fas fa-broadcast-tower"></i> Network Expansion
        </p>

        <p>
            Fil Products continues expanding its fiber network across Samar to provide
            faster and more reliable internet services for homes and businesses.
        </p>

        <a href="#" class="news-cta">
            Read More →
        </a>

    </div>
</div>

<!-- NEWS 3 -->
<div class="news-card">

    <div class="news-image-wrapper">
        <img src="{{ asset('images/customersupport.png') }}" class="news-image">
        <span class="news-date">2026</span>
    </div>

    <div class="news-content">

        <h3>New Customer Service Portal</h3>

        <p class="news-location">
            <i class="fas fa-headset"></i> Customer Support
        </p>

        <p>
            Customers can now submit inquiries, complaints, and service upgrades online
            through the Fil Products digital portal.
        </p>

        <a href="#" class="news-cta">
            Explore Portal →
        </a>

    </div>
</div>

</div>
</div>
</section>



@include('layouts.footer') 

@endsection
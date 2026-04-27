@extends('layouts.navbar')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">

<!-- HERO -->

<section class="hero-section">
    <div class="glow-blob"></div>
    
    <div class="container hero-grid">
        
        <div class="hero-content">
            <div class="badge-wrapper">
                <span class="status-indicator animate-pulse"></span>
                <span class="hero-badge">Fiber & Cable TV now live in Eastern Visayas</span>
            </div>

            <h1 class="hero-title">
                Experience the Speed of <br>
                <span class="gradient-text">Pure Fiber Connectivity</span>
            </h1>

            <p class="hero-description">
                Unleash the full potential of your home and business with Eastern Visayas most reliable network. High-speed internet meets premium entertainment.
            </p>

            <div class="hero-actions">
                <div class="button-group">
                    <a href="{{ route('residential.inquiry') }}" class="btn btn-primary">
                        <i class="fas fa-home"></i> 
                        <span>For Home</span>
                    </a>
                    <a href="{{ route('filbiz.inquiry') }}" class="btn btn-secondary">
                        <i class="fas fa-building"></i> 
                        <span>For Business</span>
                    </a>
                    <a href="{{ route('complaint') }}" class="btn btn-outline">
                        <i class="fas fa-headset"></i> 
                        <span>Support & Complaints</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="hero-visual">
            <div class="device-composition">
                <div class="device-wrapper modem-wrap">
                    <img src="{{ asset('images/modem.png') }}" alt="Fiber Router" class="floating-img">
                    <div class="glass-card card-internet">
                        <div class="icon-box"><i class="fas fa-bolt"></i></div>
                        <div>
                            <p class="card-label">Fiber Speed</p>
                        </div>
                    </div>
                </div>

                <div class="device-wrapper tv-wrap">
                    <img src="{{ asset('images/tv.png') }}" alt="HD Cable TV" class="floating-img delay-1">
                    <div class="glass-card card-tv">
                        <div class="icon-box"><i class="fas fa-tv"></i></div>
                        <div>
                            <p class="card-label">HD Channels</p>
                            <p class="card-value">64 Stations</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- WHY CHOOSE FIL PRODUCTS -->

<section class="services">

<h2>Why Choose Fil Products?</h2>
<p class="section-sub">
Reliable Internet and Cable TV built for homes and businesses in Easter Visayas.
</p>

<div class="service-grid">

<div class="service-card">
<i class="fas fa-bolt service-icon"></i>
<h3>High Speed Fiber</h3>
<p style="color: #333;">Experience ultra-fast and stable fiber internet designed for streaming, gaming, and work.</p>
</div>

<div class="service-card">
<i class="fas fa-tv service-icon"></i>
<h3>Free Cable TV</h3>
<p style="color: #333;">Enjoy premium cable TV channels included with selected internet plans.</p>
</div>

<div class="service-card">
<i class="fas fa-building service-icon"></i>
<h3>Business Solutions</h3>
<p style="color: #333;">Dedicated internet solutions for offices, enterprises, and organizations.</p>
</div>

<div class="service-card">
<i class="fas fa-headset service-icon"></i>
<h3>Local Support</h3>
<p style="color: #333;">Our support team is always ready to assist you with technical and service concerns.</p>
</div>

</div>

</section>



<!-- INTERNET PLANS -->

<section class="packages">

<h2>Internet Plans</h2>
<p class="section-sub">
Affordable high-speed internet packages for every household and business.
</p>

<h3 class="plan-title">Residential Plans</h3>

<div class="package-grid">

<div class="package">
<h4>Starter</h4>
<div class="price">₱799</div>
<p class="speed">50 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Standard</h4>
<div class="price">₱899</div>
<p class="speed">80 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Premium</h4>
<div class="price">₱999</div>
<p class="speed">100 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

</div>

<div class="package-grid">

<div class="package">
<h4>Plus</h4>
<div class="price">₱1,199</div>
<p class="speed">150 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Pro</h4>
<div class="price">₱1,299</div>
<p class="speed">250 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Ultra</h4>
<div class="price">₱1,499</div>
<p class="speed">300 Mbps</p>
<ul>
<li>Unlimited Internet</li>
<li>Free Cable TV</li>
</ul>
<a href="{{ route('residential.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

</div>


<h3 class="plan-title">Business Plans</h3>

<div class="package-grid">

<div class="package">
<h4>Business Starter</h4>
<div class="price">₱1,299</div>
<p class="speed">100 Mbps</p>
<ul>
<li>Stable Connectivity</li>
<li>Business Ready</li>
<li>Priority Support</li>
</ul>
<a href="{{ route('filbiz.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Business Pro</h4>
<div class="price">₱1,599</div>
<p class="speed">200 Mbps</p>
<ul>
<li>Stable Connectivity</li>
<li>Business Ready</li>
<li>Priority Support</li>
</ul>
<a href="{{ route('filbiz.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Business Premium</h4>
<div class="price">₱1,899</div>
<p class="speed">300 Mbps</p>
<ul>
<li>Stable Connectivity</li>
<li>Business Ready</li>
<li>Priority Support</li>
</ul>
<a href="{{ route('filbiz.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

<div class="package">
<h4>Enterprise</h4>
<div class="price">₱2,000</div>
<p class="speed">500 Mbps</p>
<ul>
<li>Stable Connectivity</li>
<li>Business Ready</li>
<li>Priority Support</li>
</ul>
<a href="{{ route('filbiz.inquiry') }}" class="plan-btn">Apply Now</a>
</div>

</div>

</section>



<section class="about">

  <div class="slider">

    <button class="slide-btn prev">&#10094;</button>

    <div class="slider-wrapper">
      <div class="slides">

        <div class="slide active">
          <img src="images/dongle.png" alt="">
        </div>

        <div class="slide">
          <img src="images/plans.jpg" alt="">
        </div>

        <div class="slide">
          <img src="images/offer.jpg" alt="">
        </div>

        <div class="slide">
          <img src="images/partners.png" alt="">
        </div>

      </div>
    </div>

    <button class="slide-btn next">&#10095;</button>

  </div>

</section>



<!-- LATEST NEWS -->

<section class="news">

<h2>Latest Updates</h2>

<div class="news-grid">

<div class="news-card">

<img src="{{ asset('images/mondragon.jfif') }}" class="news-image">

<h3>New Mondragon Branch Now Open</h3>

<p style="color: #333;">
Fil Products Eastern Visayas proudly announces the opening of our new branch in Mondragon,
Northern Samar to better serve our growing subscribers.
</p>

<p class="news-highlight">
Fast • Reliable • Local Support
</p>

</div>

<div class="news-card">

<h3>Free Cable TV Promo</h3>

<p style="color: #333;">
All residential internet plans now include FREE cable TV access,
giving subscribers more entertainment options.
</p>

</div>

<div class="news-card">
<img src="{{ asset('images/customersupport.png') }}" class="news-image">
<h3>Online Customer Portal</h3>

<p style="color: #333;">
Subscribers can now submit inquiries, upgrade requests, and complaints
through our new online customer portal.
</p>

</div>

</div>

</section>

<script>
const slides = document.querySelectorAll(".slide");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");

let index = 0;

function updateSlider() {
  slides.forEach(slide => {
    slide.classList.remove("active", "prev", "next");
  });

  const prevIndex = (index - 1 + slides.length) % slides.length;
  const nextIndex = (index + 1) % slides.length;

  slides[index].classList.add("active");
  slides[prevIndex].classList.add("prev");
  slides[nextIndex].classList.add("next");
}

/* BUTTONS */
nextBtn.addEventListener("click", () => {
  index = (index + 1) % slides.length;
  updateSlider();
});

prevBtn.addEventListener("click", () => {
  index = (index - 1 + slides.length) % slides.length;
  updateSlider();
});

/* AUTO SLIDE */
let autoSlide = setInterval(() => {
  index = (index + 1) % slides.length;
  updateSlider();
}, 4000);

/* PAUSE ON HOVER (Desktop UX) */
document.querySelector(".slider").addEventListener("mouseenter", () => {
  clearInterval(autoSlide);
});

document.querySelector(".slider").addEventListener("mouseleave", () => {
  autoSlide = setInterval(() => {
    index = (index + 1) % slides.length;
    updateSlider();
  }, 4000);
});

/* INIT */
updateSlider();
</script>


@include('layouts.footer') 
@endsection
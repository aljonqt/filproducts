@php
$inquiryRoutes = [
    'residential.inquiry',
    'residential.upgrade',
    'filbiz.inquiry',
    'filbiz.upgrade'
];

$isInquiry = request()->routeIs($inquiryRoutes);


$fbSamar = "https://m.me/109284174663318";
@endphp

<!DOCTYPE html>
<html>
<head>
<title>Fil Products Samar</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="{{ asset('images/fil-products-logo.png') }}">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">

</head>

<body>

<div class="navbar">
<div class="nav-container">

<div class="nav-left">
<a href="{{ route('home') }}">
<img src="{{ asset('images/fil-products-logo.png') }}" class="logo">
</a>
<div class="brand-label">Fil Products Samar</div>
</div>

<div class="menu-toggle" onclick="toggleMenu(this)">
<span></span>
<span></span>
<span></span>
</div>

<div class="nav-right" id="navMenu">

<a href="{{ route('home') }}"
class="nav-btn {{ request()->routeIs('home') ? 'active' : '' }}">
<i class="fas fa-home"></i> Home
</a>

<a href="{{ route('news') }}"
class="nav-btn {{ request()->routeIs('news') ? 'active' : '' }}">
<i class="fas fa-newspaper"></i> News
</a>

<a href="{{ route('data.privacy') }}"
class="nav-btn {{ request()->routeIs('data.privacy') ? 'active' : '' }}">
<i class="fas fa-paper-plane"></i> Apply Now
</a>

<a href="{{ route('complaint') }}"
class="nav-btn {{ request()->routeIs('complaint') ? 'active' : '' }}">
<i class="fas fa-headset"></i> Support
</a>

<a href="{{ route('branch') }}"
class="nav-btn {{ request()->routeIs('branch') ? 'active' : '' }}">
<i class="fas fa-map-marker-alt"></i> Branches
</a>

<a href="{{ route('faq') }}"
class="nav-btn {{ request()->routeIs('faq') ? 'active' : '' }}">
<i class="fas fa-circle-question"></i> FAQ
</a>

<a href="{{ route('about') }}"
class="nav-btn {{ request()->routeIs('about') ? 'active' : '' }}">
<i class="fas fa-building"></i> About Us
</a>

</div>
</div>
</div>

@yield('content')

<div id="chat-toggle" onclick="toggleChat()">
    <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
         xmlns="http://www.w3.org/2000/svg">
        <path
            d="M21 11.5C21 16.1944 16.9706 20 12 20C10.7386 20 9.53785 19.7549 8.44898 19.312L3 21L4.60714 16.124C3.59327 14.8241 3 13.2231 3 11.5C3 6.80558 7.02944 3 12 3C16.9706 3 21 6.80558 21 11.5Z"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"/>
        <path
            d="M8 11.5H8.01M12 11.5H12.01M16 11.5H16.01"
            stroke="currentColor"
            stroke-width="2.5"
            stroke-linecap="round"/>
    </svg>
</div>

<div id="chat-panel">
    <div class="chat-header">
        <img src="{{ asset('images/fil-products-logo.png') }}">
        <div>
            <strong>Fil Products Samar</strong><br>
            <small>Online now</small>
        </div>
        <span onclick="toggleChat()">✕</span>
    </div>

    <div class="chat-body">
        <p class="greetings">👋 Hi! How can we help you?</p>

        <div class="chat-option messenger" onclick="openModal('chatModal')">
            <i class="fab fa-facebook-messenger"></i> Chat with us
        </div>

        <div class="chat-option call" onclick="openModal('callModal')">
            <i class="fas fa-phone"></i> Call Support
        </div>

        <a href="{{ route('data.privacy') }}" class="chat-option apply">
            <i class="fas fa-file-signature"></i> Apply Now
        </a>
    </div>
</div>

<div class="modal" id="callModal">
    <div class="modal-content">
        <h3>Select Network</h3>

        <a href="tel:+639173205871" class="modal-btn globe">
            📱 Globe
        </a>

        <a href="tel:+639383205871" class="modal-btn smart">
            📱 Smart
        </a>

        <button onclick="closeModal('callModal')" class="close-btn">Cancel</button>
    </div>
</div>

<div class="modal" id="chatModal">
    <div class="modal-content">
        <h3>Select Branch</h3>

        <a href="{{ $fbSamar }}" target="_blank" class="modal-btn" style="background:#003366;">
            📍 Fil Products Samar
        </a>

        <button onclick="closeModal('chatModal')" class="close-btn">Cancel</button>
    </div>
</div>

<script>


function toggleMenu(el){
    const menu = document.getElementById("navMenu");
    menu.classList.toggle("open");
    el.classList.toggle("active");
}


document.querySelectorAll('.nav-btn').forEach(link => {
    link.addEventListener('click', () => {
        document.getElementById("navMenu").classList.remove("open");

        const toggle = document.querySelector('.menu-toggle');

        if(toggle) {
            toggle.classList.remove("active");
        }
    });
});

function toggleChat(){
    let panel = document.getElementById("chat-panel");
    panel.classList.toggle("active");
}


function openModal(id){
    document.getElementById(id).classList.add("active");

    document.getElementById("chat-panel").classList.remove("active");
}

function closeModal(id){
    document.getElementById(id).classList.remove("active");
}


window.onclick = function(e){
    document.querySelectorAll('.modal').forEach(modal => {
        if(e.target === modal){
            modal.classList.remove("active");
        }
    });
};
</script>

</body>
</html>
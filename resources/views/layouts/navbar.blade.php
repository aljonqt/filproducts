@php
$inquiryRoutes = [
    'residential.inquiry',
    'residential.upgrade',
    'filbiz.inquiry',
    'filbiz.upgrade'
];

$isInquiry = request()->routeIs($inquiryRoutes);

/* ============================= */
/* ✅ NEW: BRANCH DETECTION */
/* ============================= */

/*
| Adjust this depending on your routes
| Example: leyte.home, leyte.inquiry, etc.
*/
$isLeyte = request()->routeIs('leyte.*');

/* FACEBOOK LINKS */
$fbSamar = "https://m.me/109284174663318";
$fbLeyte = "https://m.me/1045229935570610";
@endphp

<!DOCTYPE html>
<html>
<head>
<title>Fil Products Eastern Visayas</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" type="image/png" href="{{ asset('public/images/fil-products-logo.png') }}">

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
<div class="brand-label">Fil Products Eastern Visayas</div>
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

<div class="dropdown" id="inquiryDropdown">

<div class="nav-btn dropdown-toggle {{ $isInquiry ? 'active' : '' }}"
onclick="toggleDropdown(event,'inquiryDropdown')">
<i class="fas fa-paper-plane"></i> Apply Now
<i class="fas fa-angle-down arrow"></i>
</div>

<div class="submenu">
<a href="{{ route('residential.inquiry') }}">Residential Application</a>
<a href="{{ route('residential.upgrade') }}">Residential Upgrade</a>
<a href="{{ route('filbiz.inquiry') }}">Filbiz Application</a>
<a href="{{ route('filbiz.upgrade') }}">Filbiz Upgrade</a>
</div>

</div>

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
    <i class="fas fa-comment-dots"></i>
</div>

<div id="chat-panel">
    <div class="chat-header">
        <img src="{{ asset('images/fil-products-logo.png') }}">
        <div>
            <strong>Fil Products Eastern Visayas</strong><br>
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

        <div class="chat-option apply" onclick="openModal('applyModal')">
            <i class="fas fa-file-signature"></i> Apply Now
        </div>
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

<div class="modal" id="applyModal">
    <div class="modal-content">
        <h3>Select Application Type</h3>

        <a href="{{ route('residential.inquiry') }}" class="modal-btn residential">
            🏠 Residential Plan
        </a>

        <a href="{{ route('filbiz.inquiry') }}" class="modal-btn business">
            🏢 Business Plan
        </a>

        <button onclick="closeModal('applyModal')" class="close-btn">Cancel</button>
    </div>
</div>

<div class="modal" id="chatModal">
    <div class="modal-content">
        <h3>Select Branch</h3>

        <a href="{{ $fbSamar }}" target="_blank" class="modal-btn" style="background:#003366;">
            📍 Fil Products Samar
        </a>

        <a href="{{ $fbLeyte }}" target="_blank" class="modal-btn" style="background:#28a745;">
            📍 Fil Products Leyte
        </a>

        <button onclick="closeModal('chatModal')" class="close-btn">Cancel</button>
    </div>
</div>

<script>
// DROPDOWN
function toggleDropdown(event, id){
    event.stopPropagation();

    document.querySelectorAll('.dropdown').forEach(d => {
        if(d.id !== id){ d.classList.remove('open'); }
    });

    document.getElementById(id).classList.toggle('open');
}

// BURGER MENU
function toggleMenu(el){
    const menu = document.getElementById("navMenu");
    menu.classList.toggle("open");
    el.classList.toggle("active");
}

// CLOSE MENU ONLY FOR REAL LINKS (NOT DROPDOWN TOGGLE)
document.querySelectorAll('.nav-btn:not(.dropdown-toggle), .submenu a').forEach(link => {
    link.addEventListener('click', () => {
        // if submenu item → close whole menu
        document.getElementById("navMenu").classList.remove("open");
        const toggle = document.querySelector('.menu-toggle');
        if(toggle) toggle.classList.remove("active");

        // also close dropdown
        document.querySelectorAll('.dropdown').forEach(d => {
            d.classList.remove('open');
        });
    });
});

// CLICK OUTSIDE CLOSE
document.addEventListener('click', function(e){
    document.querySelectorAll('.dropdown').forEach(d => {
        if(!d.contains(e.target)){ d.classList.remove('open'); }
    });
});

// TOGGLE CHAT (CSS Class Based Animation)
function toggleChat(){
    let panel = document.getElementById("chat-panel");
    panel.classList.toggle("active");
}

// MODAL FUNCTIONS (CSS Class Based Animation)
function openModal(id){
    document.getElementById(id).classList.add("active");
    // Optionally close the chat widget when opening a modal
    document.getElementById("chat-panel").classList.remove("active");
}

function closeModal(id){
    document.getElementById(id).classList.remove("active");
}

// CLOSE MODAL OUTSIDE CLICK
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Ceylon Trails</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="top-bar">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Ceylon Trails">
    </div>
    <div class="menu">
        <a href="#">Explore Sri Lanka</a>
        <a href="#">Things To Do</a>
        <a href="#">Events & Happenings</a>
        <a href="#">Travel Ideas</a>
        <a href="#">Travel Information</a>
    </div>
    <div class="actions">
        <a href="#"><img src="{{ asset('images/search-icon.png') }}" alt="Search"></a>
        <a href="{{ route('login') }}">Sign In</a>
    </div>
</div>
<div class="banner">
    <h1>WELCOME TO<br>SRI LANKA</h1>
</div>
<div class="bottom-links">
    <div class="related-sites">
        <p>Related Sites</p>
        <ul>
            <li><a href="#">Sri Lanka Tourism Development Authority</a></li>
            <li><a href="#">Ministry of Tourism</a></li>
            <li><a href="#">SriLankan Airlines</a></li>
            <li><a href="#">Department of Immigration and Emigration</a></li>
        </ul>
    </div>
    <div class="connect">
        <p>Connect With Us</p>
        <ul>
            <li><a href="#"><img src="{{ asset('images/youtube-icon.png') }}" alt="YouTube"></a></li>
            <li><a href="#"><img src="{{ asset('images/facebook-icon.png') }}" alt="Facebook"></a></li>
            <li><a href="#"><img src="{{ asset('images/twitter-icon.png') }}" alt="Twitter"></a></li>
            <li><a href="#"><img src="{{ asset('images/instagram-icon.png') }}" alt="Instagram"></a></li>
            <li><a href="#"><img src="{{ asset('images/pinterest-icon.png') }}" alt="Pinterest"></a></li>
        </ul>
    </div>
    <div class="legal">
        <p><a href="#">Terms of Use</a></p>
        <p><a href="#">Privacy</a></p>
        <p><a href="#">Cookie Policy</a></p>
        <p><a href="#">Report Site Issues</a></p>
    </div>
</div>
</body>
</html>

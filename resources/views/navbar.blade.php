<nav class="main-nav">
    <a href="/" class="mt-3 item header-text logo d-flex justify-content-center align-items-center">
        <img style="width: 50px" src="assets/images/animegg-big.png">
        <h3 style="color: #03a4ed; font-style: normal;">{{ config('data.name') }}</h3>
    </a>
    <ul class="nav">
        <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
        <li class="scroll-to-section"><a href="#services">Services</a></li>
        <li class="scroll-to-section"><a href="#about">About</a></li>
        <li class="scroll-to-section"><a href="#portfolio">Portfolio</a></li>
        <li class="scroll-to-section"><a href="#testing-api">Testing API</a></li>
        <li class="scroll-to-section">
            <form id="download" action="{{ route('download') }}" method="POST" class="main-red-button-hover">
                @csrf
                <a href="javascript:void(0);" onclick="document.getElementById('download').submit();"><i
                        class="fa fa-android me-2"></i>Download APK</a>
            </form>
        </li>
    </ul>
    <a class='menu-trigger'>
        <span>Menu</span>
    </a>
</nav>
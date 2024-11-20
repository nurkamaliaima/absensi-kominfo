<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Presensi Online</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ (request()->segment(2) == 'home') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/home') }}">Home</a>
            </li>
            <li class="nav-item {{ (request()->segment(2) == 'about') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/about') }}">About</a>
            </li>
            <li class="nav-item {{ (request()->segment(2) == 'guide') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('user/guide') }}">Guide</a>
            </li>
        </ul>
        
    </div>
</nav>
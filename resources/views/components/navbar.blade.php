<nav class="navbar navbar-expand-lg site-navbar">
  <div class="container">
    <a class="navbar-brand" href="{{ route('homepage') }}">Fiorini Tommaso</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav mb-2 mb-lg-0">

        <a class="nav-link {{ request()->routeIs('homepage') ? 'active' : '' }}" href="{{ route('homepage') }}">
          <span>Homepage</span>
        </a>

        <a class="nav-link {{ request()->routeIs('work') ? 'active' : '' }}" href="{{ route('work') }}">
          <span>Work</span>
        </a>

        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
          <span>About</span>
        </a>

        <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
          <span>Contact</span>
        </a>

      </ul>
    </div>
  </div>
</nav>
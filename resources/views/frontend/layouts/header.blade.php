<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img height="44" src="{{asset('images/addispay-logo.png')}}" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link {{ \Illuminate\Support\Facades\Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ \Illuminate\Support\Facades\Request::is('customer-support') ? 'active' : '' }}" href="{{ route('customer.support') }}">Customer Support</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Business Support
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Link 1</a></li>
              <li><a class="dropdown-item" href="#">Link 2</a></li>
              <li><a class="dropdown-item" href="#">Link 3</a></li>
            </ul>
          </li>
        </ul>
        <div class="d-flex gap-2">
            @auth('web')
                <a class="btn btn-outline-effect" href="{{ route(\App\Helpers\GeneralHelper::WHO_AM_I().'.index') }}">Dashboard</a>
            @else
                <a class="btn btn-outline-effect" href="{{ route('login') }}">Login</a>
                <a class="btn btn-theme-effect" href="{{ route('register') }}">Signup</a>
            @endauth
        </div>
      </div>
    </div>
  </nav>

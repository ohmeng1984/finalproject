<nav class="navbar navbar-expand-lg bg-danger navbar-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
  <!-- Brand -->
  <a class="navbar-brand" href="{{ url('/') }}">Click Side</a>

  <!-- Links -->
  <ul class="navbar-nav mr-auto">
    <li class="nav-item">
      <a class="nav-link" href="/">Home</a>
    </li>
    @if(Auth::guest()||Auth::user()->role=='user')
{{--       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="/forum" id="navbardrop" data-toggle="dropdown">
          Forum
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('forum') }}">View Forums</a>
          <a class="dropdown-item" href="#">Search Forums</a>
          <a class="dropdown-item" href="#">New Topics</a>
          <a class="dropdown-item" href="#">Sticky Threads</a>
        </div>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('forum') }}">Forums</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/whatsnew">What's New</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/groups">Groups</a>
      </li>  
    @else
      <li class="nav-item">
        <a class="nav-link" href="{{ route('adminpage') }}">Admin Dashboard</a>
      </li>
    @endif
    <!-- Dropdown -->

  </ul>
  <ul class="navbar-nav">

    @guest
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> Register</a>
    </li>
    @else
    <li class="nav-item dropdown pr-1">
      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" onclick="markAsRead({{count(auth()->user()->unreadNotifications)}})">
        <i class="far fa-bell"></i> Notifications <span class="badge badge-light">{{count(auth()->user()->unreadNotifications)}}</span>
      </a>
      <div class="dropdown-menu dropdown-menu-left">
      @forelse(auth()->user()->unreadNotifications as $notification)
      @include('notification.replied_to_thread')
      @empty
      <a class="dropdown-item" href="#">
        <i class="far fa-bell"></i> No Notifications</a>
      @endforelse
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
        {{ Auth::user()->name }} <span class="caret"></span>
      </a>
      <div class="dropdown-menu">
      <a class="dropdown-item" href="/user/profile/{{Auth::user()->name}}">
        <i class="fas fa-user-tie"></i> User Profile</a>
      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Logout</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
      </form>
      </div>
    </li>
    @endguest
  </ul>

  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
  </form>

 </div>
</nav>
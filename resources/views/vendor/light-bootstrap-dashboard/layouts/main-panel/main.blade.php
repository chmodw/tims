<div class="main-panel">
  <nav class="navbar navbar-expand-lg " color-on-scroll="500">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">@yield('content-title', 'Title')</a>
      <button href="" class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
        <span class="navbar-toggler-bar burger-lines"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="nav navbar-nav mr-auto">
          <li class="nav-item ">
            <a href="/dash" class="nav-link active">
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a href="/programs" class="nav-link ">
              Programs
            </a>
          </li>
          <li class="nav-item">
            <a href="/reports" class="nav-link">
              Reports
            </a>
          </li>
          <li class="nav-item">
            <a href="/trainees" class="nav-link">
              Trainees
            </a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="clock">
              <span id="hr">00</span>
              <span> : </span>
              <span id="min">00</span>
              <span> : </span>
              <span id="sec">00</span>
            </div>
          </li>
          @if (auth()->check())
            <li class="nav-item">
              <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="no-icon">Logout</span>
              </a>
            </li>
          @elseif(!isset($exception))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">
                <span class="no-icon">Login</span>
              </a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>

  <div class="content">

    @yield('content')

  </div>

  @include('light-bootstrap-dashboard::layouts.main-panel.footer.main')
</div>

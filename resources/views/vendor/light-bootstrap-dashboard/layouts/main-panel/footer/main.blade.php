<footer class="footer">
  <div class="container">
    <nav>
      @section('footer-menu')
      <ul class="footer-menu">
        <li>
          <a href="#">
            Home
          </a>
        </li>
      </ul>
      @show
      <p class="copyright text-center">
       TIMS &copy; {{ date('Y') }}
      </p>
    </nav>
  </div>
</footer>

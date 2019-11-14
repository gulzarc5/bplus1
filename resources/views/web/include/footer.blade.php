<div class="gap">
</div>
<footer class="main-footer" style="margin-top:60px">
  <div class="container">
    <div class="row row-col-gap" data-gutter="60">
      <div class="col-md-3">
        <a class="navbar-brand" href="Home" style="margin-top: -13px;">
            <img src="{{asset('src/img/logo-w.png')}}" alt="Image Alternative text" title="Image Title" />
            </a>
        <br><br>
        <p>Bplus is a network centric B2B trade platform, designed specifically for small & medium businesses in India</p>
        <ul class="main-footer-social-list">
          <li><a class="fa fa-facebook" href="#"></a></li>
          <li><a class="fa fa-twitter" href="#"></a></li>
          <li><a class="fa fa-pinterest" href="#"></a></li>
          <li><a class="fa fa-instagram" href="#"></a></li>
          <li><a class="fa fa-google-plus" href="#"></a></li>
        </ul>
      </div>
      <div class="col-md-3 foot-link">
        <h3 class="widget-title-sm" style="text-decoration: underline;">Addtional Links
        </h3>
        <ul style="list-style :none;padding: 0 7px;">
          <li><a href="{{url('about_us')}}">About us</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Terms of use</a></li>
          <li><a href="{{url('contact_us')}}">Contact us</a></li>
        </ul>
      </div>
      <div class="col-md-3 foot-link">
        <h3 class="widget-title-sm" style="text-decoration: underline;">My Account
        </h3>
        <ul style="list-style :none;padding: 0 7px;">
          <li><a href="{{route('web.myprofile')}}">My Profile</a></li>
          <li><a href="{{route('web.order_history')}}">My Orders</a></li>
          <li><a href="{{route('web.viewCart')}}">My Cart</a></li>
          <li><a href="{{url('seller_login')}}">Login to seller panel</a></li>
        </ul>
      </div>
    </div>
    {{-- <ul class="main-footer-links-list">
      <li>
        <a href="">About Us
        </a>
      </li>
      <li>
        <a href="#">Support & Customer Service
        </a>
      </li>
      <li>
        <a href="#">Blog
        </a>
      </li>
      <li>
        <a href="#">Privacy
        </a>
      </li>
      <li>
        <a href="#">Terms
        </a>
      </li>
      <li>
        <a href="#">Shipping
        </a>
      </li>
      <li>
        <a href="#">Payments & Refunds
        </a>
      </li>
    </ul> --}}
    <img class="main-footer-img" src="{{asset('src/img/test_footer2.png')}}" alt="Image Alternative text" title="Image Title" />
  </div>
</footer>
<div class="copyright-area">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p class="copyright-text">Copyright &copy; 
          <a href="#">Bplus
          </a> 2019. Design by
          <a href="https://webinfotech.net.in/" target="_blank">WEB INFOTECH
          </a>. All rights reseved
        </p>
      </div>
      <div class="col-md-6">
        <ul class="payment-icons-list">
          <li>
            <img src="{{asset('src/img/payment/visa-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Visa" />
          </li>
          <li>
            <img src="{{asset('src/img/payment/mastercard-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Mastercard" />
          </li>
          <li>
            <img src="{{asset('src/img/payment/paypal-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Paypal" />
          </li>
          <li>
            <img src="{{asset('src/img/payment/visa-electron-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Visa-electron" />
          </li>
          <li>
            <img src="{{asset('src/img/payment/maestro-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Maestro" />
          </li>
          <li>
            <img src="{{asset('src/img/payment/discover-straight-32px.png')}}" alt="Image Alternative text" title="Pay with Discover" />
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
</div>
<script src="{{asset('src/js/jquery.js')}}">
</script>
<script src="{{asset('src/js/bootstrap.js')}}">
</script>
<script src="{{asset('src/js/icheck.js')}}">
</script>
<script src="{{asset('src/js/ionrangeslider.js')}}">
</script>
<script src="{{asset('src/js/jqzoom.js')}}">
</script>
<script src="{{asset('src/js/card-payment.js')}}">
</script>
<script src="{{asset('src/js/owl-carousel.js')}}">
</script>
<script src="{{asset('src/js/magnific.js')}}">
</script>
<script src="{{asset('src/js/custom.js')}}">
</script>
<script src="{{asset('src/js/switcher.js')}}">
</script>
</body>
</html>

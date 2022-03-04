<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="title" content="">
  <meta name="author" content="">
  <meta name="copyright" content="">
  <meta name="Classification" content="Business">
  <meta Content='Indonesia' Name='Geo.Placename' />
  <meta Content='Id' Name='Geo.Country' />
  <meta content='en' name='language' />
  <meta name="og:title" content="" />
  <meta name="og:type" content="Media" />
  <meta name="og:url" content="" />
  <meta name="og:image" content="" />
  <meta name="og:site_name" content="" />
  <meta name="og:description" content="" />
  <meta property="twitter:card" content="">
  <meta property="twitter:url" content="">
  <meta property="twitter:title" content="">
  <meta property="twitter:description" content="">
  <meta property="twitter:image" content="">
  <link rel="shortcut icon" href="" type="image/x-icon">
  <link rel="icon" href="" type="image/x-icon">

  <title></title>
  <link rel="icon" href="" type="image/x-icon">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700">
  <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('assets/lib/owl/assets/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/lib/owl/assets/owl.theme.default.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/lib/aos/aos.css')}}">
  <link rel="stylesheet" href="{{asset('assets/jqvmap/jqvmap.css')}}">
</head>

<body>
  <div class="page">
    <header>
      <nav class="navbar navbar-expand-lg navbar-white fixed-top bg-white" id="mainNav">
        <div class="container-fluid">
          <a class="navbar-brand flex-grow-1" href="#"><img src="{{asset('assets/img/logo3.png')}}" class="img-fluid logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="bi" fill="currentColor" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"></path>
            </svg>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ms-auto navbar-ipk mx-auto">
              <li class="nav-item active">
                <a class="nav-link" href="{{url('/')}}">Beranda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}#about">Tentang IPK</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}#nasional">IPK Nasional</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('/')}}#provinsi">IPK Provinsi</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    @yield('content')
    <!--==========================
    Footer
  ============================-->
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 col-md-6 footer-links">
              <h4>Sekretariat Direktorat Jenderal</h4>
              <h4>Direktorat Jenderal Kebudayaan</h4>
              <h4>Kementrian Pendidikan dan Kebudayaan</h4>
            </div>
            <div class="col-lg-4 col-md-6 footer-contact">
              <h4>Ditjen Kebudayaan</h4>
              <p>
                Komplek Kemdikbud, Gedung E Lt.4 <br>
                Jln. Jenderal Sudirman, Senayan, Jakarta 10270<br>
                <strong>Telepon:</strong> (021) 5731063, (021) 5725035<br>
                <strong>Email:</strong> kebudayaan@kemdikbud.go.id<br>
                <strong>Fax:</strong> (021) 5731063, (021) 5725578<br>
              </p>
              <div class="social-links">
                <a href="https://twitter.com/budayasaya" class="twitter"><i class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com/budayasaya" class="facebook"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/budayasaya/" class="instagram"><i class="fa fa-instagram"></i></a>
              </div>
            </div>
            <div class="col-lg-4">
              <a><img src="{{asset('assets/img/logo3.png')}}" alt="" class="img-fluid"></a>
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="copyright">
          &copy; <strong>Ditjen Kebudayaan</strong>.
        </div>
      </div>
    </footer><!-- #footer -->
  </div>
  <script src="{{asset('assets/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/lib/owl/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/lib/wow/wow.js')}}"></script>
  <script src="{{asset('assets/lib/aos/aos.js')}}"></script>
  <script src="{{asset('assets/lib/chart/chart.js')}}"></script>
  @include('scripts.ipk-script')
  @stack('custom-scripts')
</body>

</html>
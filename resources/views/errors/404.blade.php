<!DOCTYPE html>
<html lang="es" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    
    <!-- SEO meta tags -->
    <title>Cosmic Bowling | 404 Error</title>
    <meta name="description" content="Around - Multipurpose Bootstrap HTML Template">
    <meta name="keywords" content="bootstrap, business, corporate, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, saas, multipurpose, product landing, shop, software, ui kit, web studio, landing, light and dark mode, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">

    <!-- Webmanifest + Favicon / App icons -->
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
    <link rel="icon" type="image/png" href="{{asset('frontend/app-icons/icon-32x32.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('app-icons/icon-180x180.png')}}">
        
    <!-- Import Google font (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" id="google-font">

    <!-- Font icons -->
    <link rel="stylesheet" href="{{asset('frontend/icons/around-icons.min.css')}}">

    <!-- Theme styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="{{asset('frontend/css/theme.min.css')}}">

    <!-- Customizer generated styles -->
    <style id="customizer-styles"></style>

    <!-- Page loading styles -->
    <style>
      .page-loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 100%;
        -webkit-transition: all .4s .2s ease-in-out;
        transition: all .4s .2s ease-in-out;
        background-color: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 9999;
      }
      [data-bs-theme="dark"] .page-loading {
        background-color: #121519;
      }
      .page-loading.active {
        opacity: 1;
        visibility: visible;
      }
      .page-loading-inner {
        position: absolute;
        top: 50%;
        left: 0;
        width: 100%;
        text-align: center;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
        -webkit-transition: opacity .2s ease-in-out;
        transition: opacity .2s ease-in-out;
        opacity: 0;
      }
      .page-loading.active > .page-loading-inner {
        opacity: 1;
      }
      .page-loading-inner > span {
        display: block;
        font-family: "Inter", sans-serif;
        font-size: 1rem;
        font-weight: normal;
        color: #6f788b;
      }
      [data-bs-theme="dark"] .page-loading-inner > span {
        color: #fff;
        opacity: .6;
      }
      .page-spinner {
        display: inline-block;
        width: 2.75rem;
        height: 2.75rem;
        margin-bottom: .75rem;
        vertical-align: text-bottom;
        background-color: #d7dde2; 
        border-radius: 50%;
        opacity: 0;
        -webkit-animation: spinner .75s linear infinite;
        animation: spinner .75s linear infinite;
      }
      [data-bs-theme="dark"] .page-spinner {
        background-color: rgba(255,255,255,.25);
      }
      @-webkit-keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }
      @keyframes spinner {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        }
        50% {
          opacity: 1;
          -webkit-transform: none;
          transform: none;
        }
      }
    </style>

    <!-- Page loading scripts -->
    <script>
      (function () {
        window.onload = function () {
          const preloader = document.querySelector('.page-loading')
          preloader.classList.remove('active')
          setTimeout(function () {
            preloader.remove()
          }, 1500)
        }
      })()
    </script>

  </head>


  <!-- Body -->
  <body>

    <!-- Page loading spinner -->
    <div class="page-loading active">
      <div class="page-loading-inner">
        <div class="page-spinner"></div>
        <span>Cargando...</span>
      </div>
    </div>

    <!-- Page content -->
    <main class="page-wrapper">
      <div class="container d-flex flex-column justify-content-center min-vh-100 py-5">
        <lottie-player src="{{asset('frontend/json/animation-404-light.json')}}" class="d-dark-mode-none mt-n5" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
        <lottie-player class="d-none d-dark-mode-block mt-n5" src="{{asset('frontend/json/animation-404-dark.js')}}on" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
        <div class="text-center pt-4 mt-lg-2">
          <h1 class="display-5">Página no encontrada</h1>
          <p class="fs-lg pb-2 pb-md-0 mb-4 mb-md-5">La página que buscas fue movida, eliminada o puede que nunca existiera.</p>
          <a class="btn btn-lg btn-primary" href="{{route('home.index')}}">Regresar a Incio</a>
        </div>
      </div>
    </main>


    <!-- Vendor scripts: JS libraries and plugins -->
    <script src="{{asset('frontend/vendor/%40lottiefiles/lottie-player/dist/lottie-player.js')}}"></script>

    <!-- Bootstrap + Theme scripts -->
    <script src="{{asset('frontend/js/theme.min.js')}}"></script>

  </body>
</html>

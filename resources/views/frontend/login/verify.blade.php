<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO meta tags -->
    <title>ComisBowling | Cuenta Verificada</title>
    <meta name="description" content="Around - Multipurpose Bootstrap HTML Template">
    <meta name="keywords"
        content="bootstrap, business, corporate, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, saas, multipurpose, product landing, shop, software, ui kit, web studio, landing, light and dark mode, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">

    <!-- Webmanifest + Favicon / App icons -->
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.png') }}">


    <!-- Theme switcher (color modes) -->
    <script src="{{ asset('frontend/js/theme-switcher.js') }}"></script>

    <!-- Import Google font (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="{{ asset('frontend/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap') }}" rel="stylesheet"
        id="google-font">

    <!-- Font icons -->
    <link rel="stylesheet" href="{{ asset('frontend/icons/around-icons.min.css') }}">

    <!-- Theme styles + Bootstrap -->
    <link rel="stylesheet" media="screen" href="{{ asset('frontend/css/theme.min.css') }}">

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

        .page-loading.active>.page-loading-inner {
            opacity: 1;
        }

        .page-loading-inner>span {
            display: block;
            font-family: "Inter", sans-serif;
            font-size: 1rem;
            font-weight: normal;
            color: #6f788b;
        }

        [data-bs-theme="dark"] .page-loading-inner>span {
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
            background-color: rgba(255, 255, 255, .25);
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
        (function() {
            window.onload = function() {
                const preloader = document.querySelector('.page-loading')
                preloader.classList.remove('active')
                setTimeout(function() {
                    preloader.remove()
                }, 1500)
            }
        })()
    </script>

    <!-- Body -->

<body>

    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div>
            <span>Cargando...</span>
        </div>
    </div>

    <!-- Page wrapper -->
    <main class="page-wrapper">
        <div class="d-lg-flex position-relative h-100">

            <!-- Logo visible on screens < 992px -->
            <div class="d-flex d-lg-none justify-content-center pt-4 px-3 mx-auto" style="max-width: 420px;">
                <a class="navbar-brand text-dark p-0 m-0" href="index.html">
                    <span class="text-primary flex-shrink-0 me-2">
                        <svg width="35" height="32" viewbox="0 0 36 33" xmlns="http://www.w3.org/2000/svg">
                            <path fill="currentColor"
                                d="M35.6,29c-1.1,3.4-5.4,4.4-7.9,1.9c-2.3-2.2-6.1-3.7-9.4-3.7c-3.1,0-7.5,1.8-10,4.1c-2.2,2-5.8,1.5-7.3-1.1c-1-1.8-1.2-4.1,0-6.2l0.6-1.1l0,0c0.6-0.7,4.4-5.2,12.5-5.7c0.5,1.8,2,3.1,3.9,3.1c2.2,0,4.1-1.9,4.1-4.2s-1.8-4.2-4.1-4.2c-2,0-3.6,1.4-4,3.3H7.7c-0.8,0-1.3-0.9-0.9-1.6l5.6-9.8c2.5-4.5,8.8-4.5,11.3,0L35.1,24C36,25.7,36.1,27.5,35.6,29z">
                            </path>
                        </svg>
                    </span>
                    Cosmic Bowling
                </a>
            </div>

            <!-- Parallax gfx -->
            <div class="w-sm-75 w-lg-100 p-4 overflow-hidden mx-auto mx-lg-0 order-lg-2" style="max-width: 1047px;">
                <div class="p-sm-3 h-100">
                    <div class="position-relative h-100">
                        <div class="position-absolute top-0 end-0 h-100 bg-primary rounded-5 d-none d-lg-block"
                            style="width: 93.9%;"></div>
                        <div class="position-absolute top-0 end-0 h-100 bg-primary rounded-4 d-lg-none"
                            style="width: 93.9%;"></div>
                        <div class="parallax h-100 z-2 overflow-hidden">
                            <div class="parallax-layer d-flex align-items-end mb-n2 mb-lg-0" style="margin-top: 4.4%;"
                                data-depth="0.1">
                                <img src="{{ asset('frontend/img/coming/girl.png') }}" alt="Girl">
                            </div>
                        </div>
                        <div class="parallax position-absolute top-0 start-0 w-100 h-100 z-2">
                            <div class="parallax-layer d-flex align-items-end"
                                style="padding-right: 75.6%; padding-bottom: 70%;" data-depth="-0.1">
                               <img src="{{ url('frontend/logo.png')}}" alt="">
                            </div>
                            <div class="parallax-layer d-flex align-items-end" style="padding: 0 59.35% 70.4% 30.4%;"
                                data-depth="0.2">
                                <svg class="text-white" width="100" height="90" viewbox="0 0 100 90"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M25.8715 89.2559L28.5411 88.5681L25.5817 77.117L38.7756 75.0037L35.4411 62.0913L48.6485 59.9721L45.3139 47.0597L58.5079 44.9464L55.1673 32.0206L68.3747 29.9013L65.0402 16.989L78.2551 14.8502L74.553 0.457076L71.8699 1.15091L74.8352 12.6155L61.6008 14.7467L64.9549 27.6666L51.7339 29.7918L55.082 42.6982L41.8746 44.8175L45.2091 57.7299L32.0017 59.8491L35.3497 72.7555L22.1423 74.8748L25.8715 89.2559Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="parallax-layer d-flex align-items-end"
                                style="padding: 0 11.58% 89.64% 81.28%;" data-depth="-0.15">
                                <svg class="text-warning" width="69" height="55" viewbox="0 0 69 55"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M56.2836 55L68.9438 53.6761L68.704 51.3308L58.6187 52.3774L58.5303 40.9663L47.1702 42.1515L47.0692 30.7279L35.709 31.9131L35.6207 20.4895L24.2479 21.6747L24.1469 10.251L12.7741 11.4363L12.6731 0L0.000184965 1.29872L0.240014 3.64399L10.338 2.61004L10.4389 14.0463L21.8117 12.8611L21.9001 24.2847L33.2729 23.1121L33.3612 34.5232L44.734 33.3379L44.8224 44.7616L56.1952 43.5764L56.2836 55Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="parallax-layer d-flex align-items-end" style="padding: 0 70.94% 54.29% 24.4%;"
                                data-depth="-0.35">
                                <svg class="text-warning" width="45" height="45" viewbox="0 0 45 45"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M22.5089 45C34.9147 45 45 34.9187 45 22.5C45 10.0991 34.9147 0 22.5089 0C10.1031 0 -1.8272e-06 10.0813 -1.8272e-06 22.5C-1.8272e-06 34.9187 10.1031 45 22.5089 45ZM22.5089 3.35449C33.0762 3.35449 41.662 11.9548 41.662 22.5178C41.662 33.0809 33.0583 41.6812 22.5089 41.6812C11.9417 41.6812 3.33795 33.0809 3.33795 22.5178C3.33795 11.9548 11.9417 3.35449 22.5089 3.35449Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="parallax-layer d-flex align-items-end" style="padding: 0 69.6% 92.57% 26.37%;"
                                data-depth="-0.25">
                                <svg class="text-white" width="39" height="38" viewbox="0 0 39 38"
                                    fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M27.6989 38L39 11.0113L11.3011 0L7.10921e-07 26.9886L27.6989 38ZM35.6207 12.4013L26.2724 34.7074L3.37926 25.5987L12.7276 3.2926L35.6207 12.4013Z">
                                    </path>
                                </svg>
                            </div>
                            <div class="parallax-layer d-flex align-items-end"
                                style="padding: 0 17.48% 74.58% 79.94%;" data-depth="0.2">
                                <div class="ratio ratio-1x1 border border-white border-2 rounded-circle"></div>
                            </div>
                            <div class="parallax-layer d-flex align-items-end"
                                style="padding: 0 87.38% 66.96% 11.27%;" data-depth="0.15">
                                <div class="ratio ratio-1x1 bg-white rounded-circle"></div>
                            </div>
                            <div class="parallax-layer d-flex align-items-end"
                                style="padding: 0 46.23% 91.84% 52.43%;" data-depth="0.35">
                                <div class="ratio ratio-1x1 bg-warning rounded-circle"></div>
                            </div>
                            <div class="parallax-layer d-flex align-items-end" style="padding: 0 3.6% 56.17% 94.93%;"
                                data-depth="0.4">
                                <div class="ratio ratio-1x1 bg-warning rounded-circle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Page content -->
            <div class="d-flex flex-column align-items-center w-lg-50 px-3 px-sm-4 px-xl-5 pt-lg-5 order-lg-1">

                <!-- Logo visible on screens > 991px -->
                <div class="w-100 d-none d-lg-block" style="max-width: 420px;">
                    <a class="navbar-brand text-dark p-0 m-0" href="index.html">
                        <span class="text-primary flex-shrink-0 me-2">
                            <svg width="35" height="32" viewbox="0 0 36 33"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill="currentColor"
                                    d="M35.6,29c-1.1,3.4-5.4,4.4-7.9,1.9c-2.3-2.2-6.1-3.7-9.4-3.7c-3.1,0-7.5,1.8-10,4.1c-2.2,2-5.8,1.5-7.3-1.1c-1-1.8-1.2-4.1,0-6.2l0.6-1.1l0,0c0.6-0.7,4.4-5.2,12.5-5.7c0.5,1.8,2,3.1,3.9,3.1c2.2,0,4.1-1.9,4.1-4.2s-1.8-4.2-4.1-4.2c-2,0-3.6,1.4-4,3.3H7.7c-0.8,0-1.3-0.9-0.9-1.6l5.6-9.8c2.5-4.5,8.8-4.5,11.3,0L35.1,24C36,25.7,36.1,27.5,35.6,29z">
                                </path>
                            </svg>
                        </span>
                        Cosmic Bowling
                    </a>
                </div>

                <div class="w-100 text-center text-lg-start mt-auto pt-lg-5 pb-5" style="max-width: 420px;">
                  <h1 class="display-3 mb-4">Correo Verificado Exitosamente</h1>
                  <p class="fs-lg pb-3 mb-4 mb-xl-5">Gracias por verificar tu correo electrónico. Ahora puedes iniciar sesión o explorar nuestro sitio.</p>
              
                  <!-- Botones de Redirección -->
                  <div class="d-flex justify-content-center justify-content-lg-start">
                      <a href="{{route('client.login')}}" class="btn btn-primary mx-2">Iniciar Sesión</a>
                      <a href="{{route('home.index')}}" class="btn btn-secondary mx-2">Ir a la Página Principal</a>
                  </div>
              </div>

                <!-- Social links -->
                <div class="w-100 mt-auto pb-5" style="max-width: 420px;">
                    <div class="d-flex justify-content-center justify-content-lg-start gap-3">
                        <a class="btn btn-icon btn-sm btn-secondary btn-facebook rounded-circle" href="#"
                            aria-label="Facebook">
                            <i class="ai-facebook"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-secondary btn-instagram rounded-circle" href="#"
                            aria-label="Instagram">
                            <i class="ai-instagram"></i>
                        </a>
                        <a class="btn btn-icon btn-sm btn-secondary btn-linkedin rounded-circle" href="#"
                            aria-label="LinkedIn">
                            <i class="ai-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Vendor scripts: JS libraries and plugins -->
    <script src="{{ asset('frontend/vendor/timezz/dist/timezz.js') }}"></script>
    <script src="{{ asset('frontend/vendor/parallax-js/dist/parallax.min.js') }}"></script>

    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('frontend/js/theme.min.js') }}"></script>

</body>

</html>

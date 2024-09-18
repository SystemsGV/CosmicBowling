<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">

    <!-- SEO meta tags -->
    <title>ComisBowling | Cuenta Verificada</title>
    <meta name="description"
        content="¿Buscas un plan de otro planeta? Juega boliche en un ambiente glow, con música moderna y mucha, pero mucha buena vibra">
    <meta name="keywords" content="bowling, perú, bolos, glow, ambiente, cosmicbowling, cosmic, juego de bolos">
    <meta name="author" content="Cosmic Bowling">

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
                <a class="navbar-brand text-dark p-0 m-0" href="{{ url('/') }}">
                    <span class="text-primary flex-shrink-0 me-2">
                        <img src="{{ url('frontend/img/app-icons/logo.svg') }}" width="95" height="92">
                    </span>
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
                                <!-- icon666.com - MILLIONS vector ICONS FREE --><svg id="Capa_1"
                                    enable-background="new 0 0 512 512" viewBox="0 0 512 512"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path
                                            d="m350.939 394.308c26.62-8.659 63.07-20.519 103.953-61.402 93.605-93.605 56.458-218.39-.04-275.732-66.282-67.533-191.324-84.448-275.732-.04-28.422 28.422-40.396 60.884-50.019 86.976-14.75 39.982-22.881 57.704-60.739 58.833l-15.454.456.922 15.423c2.548 42.447 34.244 47.398 51.272 50.112 4.112.653 10.358 1.637 10.886 1.108 0 .021.269 1.326-.508 4.734-.694 3.014-1.398 3.946-1.378 3.967-1.119.663-5.593 1.139-8.576 1.45-24.124 2.558-51.956 10.109-76.991 67.731l-12.129 27.956 35.228-8.877c10.7-2.745 32.98-8.473 37.496-6.484.218.57 4.723 14.916-39.164 80.741l-49.966 70.74 70.766-49.94c65.473-43.638 80.005-39.423 79.746-40.013 2.973 5.397-2.745 27.646-5.49 38.345l-8.866 35.217 27.946-12.119c57.622-25.035 65.173-52.867 67.731-76.991.311-2.983.798-7.489 1.357-8.462 10.724-3.005 6.994-1.937 7.769-2.217.901 2.393 1.668 7.489 2.206 11.031 2.558 17.039 7.375 48.828 50.04 51.345l15.423.922.456-15.454c1.076-36.087 11.351-39.423 41.855-49.356z"
                                            fill="#fabe2c"></path>
                                        <path
                                            d="m150.512 422.047c2.973 5.397-2.745 27.646-5.49 38.345l-8.866 35.217 27.946-12.119c57.622-25.035 65.173-52.867 67.731-76.991.311-2.983.798-7.489 1.357-8.462 10.724-3.005 6.994-1.937 7.769-2.217.901 2.393 1.668 7.489 2.206 11.031 2.558 17.039 7.375 48.828 50.04 51.345l15.423.922.456-15.454c1.077-36.087 11.352-39.423 41.857-49.356 26.62-8.659 63.07-20.519 103.953-61.402 93.605-93.605 56.458-218.39-.04-275.732l-454.854 454.826 70.766-49.94c65.473-43.639 80.005-39.423 79.746-40.013z"
                                            fill="#ff9100"></path>
                                        <g>
                                            <circle cx="317.007" cy="195.02" fill="#66c0ee" r="135"
                                                style="fill: rgb(157, 104, 238);"></circle>
                                            <path
                                                d="m412.466 290.479c52.721-52.721 52.721-138.198 0-190.919l-190.919 190.919c52.721 52.721 138.198 52.721 190.919 0z"
                                                fill="#0095ff" style="fill: rgb(153, 0, 255);"></path>
                                            <path d="m365.646 158.807h30v30h-30z" fill="#38211a"
                                                transform="matrix(.707 -.707 .707 .707 -11.411 320.064)"></path>
                                            <path d="m323.22 116.38h30v30h-30z" fill="#5b362a"
                                                transform="matrix(.707 -.707 .707 .707 6.163 277.638)"></path>
                                            <path
                                                d="m327.613 184.413-10.606-10.606-21.214 21.213 10.607 10.606 10.607 10.607 21.213-21.213z"
                                                fill="#5b362a"></path>
                                            <path d="m307.31 192.823h30v15h-30z" fill="#38211a"
                                                transform="matrix(.707 -.707 .707 .707 -47.247 286.581)"></path>
                                        </g>
                                    </g>
                                </svg>
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
                            <div class="parallax-layer d-flex align-items-end" style="padding: 0 11.58% 89.64% 81.28%;"
                                data-depth="-0.15">
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
                            <img src="{{ url('frontend/img/app-icons/logo.svg') }}" width="95" height="92" alt="">

                        </span>
                    </a>
                </div>

                <div class="w-100 text-center text-lg-start mt-auto pt-lg-5 pb-5" style="max-width: 420px;">
                    <h1 class="display-3 mb-4">Correo Verificado Exitosamente</h1>
                    <p class="fs-lg pb-3 mb-4 mb-xl-5">Gracias por verificar tu correo electrónico. Ahora puedes
                        iniciar sesión o explorar nuestro sitio.</p>

                    <!-- Botones de Redirección -->
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('client.login') }}" class="btn btn-primary mx-2">Iniciar Sesión</a>
                        <a href="{{ route('home.index') }}" class="btn btn-secondary mx-2">Ir a la Página
                            Principal</a>
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

<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO meta tags -->
    <title>ComisBowling | </title>
    <meta name="description" content="Around - Multipurpose Bootstrap HTML Template">
    <meta name="keywords"
        content="bootstrap, business, corporate, coworking space, services, creative agency, dashboard, e-commerce, mobile app showcase, saas, multipurpose, product landing, shop, software, ui kit, web studio, landing, light and dark mode, html5, css3, javascript, gallery, slider, touch, creative">
    <meta name="author" content="Createx Studio">

    <!-- Webmanifest + Favicon / App icons -->
    <link rel="manifest" href="{{ asset('frontend/manifest.json') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/img/app-icons/favicon.png') }}">
    <!-- Theme switcher (color modes) -->
    <script src="{{ asset('frontend/js/theme-switcher.js') }}"></script>

    <!-- Import Google font (Inter) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="{{ asset('frontend/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap') }}" rel="stylesheet"
        id="google-font">

    <!-- Vendor styles -->
    <link rel="stylesheet" media="screen" href="{{ asset('frontend/vendor/aos/dist/aos.css') }}">
    <link rel="stylesheet" media="screen"
        href="{{ asset('frontend/vendor/lightgallery/css/lightgallery-bundle.min.css') }}">

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


    @yield('styles')


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

</head>


<!-- Body -->

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="//www.googletagmanager.com/ns.html?id=GTM-WKV3GT5" height="0" width="0"
            style="display: none; visibility: hidden;" title="Google Tag Manager"></iframe>
    </noscript>


    <!-- Page loading spinner -->
    <div class="page-loading active">
        <div class="page-loading-inner">
            <div class="page-spinner"></div>
            <span>Cargando...</span>
        </div>
    </div>


    <!-- Customizer modal -->
    <div class="modal fade" id="customizer-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Your custom styles</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-3">Grab the generated styles below. Wrap them inside <code>&lt;style&gt;</code> tag
                        and put in the <code>&lt;head&gt;</code> section of your HTML document.</p>
                    <p class="mb-4"><span class="fw-medium">IMPORTANT:</span> In order for these styles to take effect
                        you have to placed them below:<br><code>&lt;link rel=&quot;stylesheet&quot;
                            media=&quot;screen&quot; href=&quot;assets/css/theme.min.css&quot;&gt;</code></p>
                    <div class="bg-secondary overflow-hidden rounded-4">
                        <pre class="text-wrap bg-transparent border-0 text-dark p-4" id="custom-generated-styles"></pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button"
                        data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary w-100 w-sm-auto ms-sm-3" type="button" id="copy-styles-btn">
                        <i class="ai-copy me-2 ms-n1"></i>
                        Copy styles
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customizer toggler -->
    <a class="position-fixed top-50 bg-light text-dark fw-medium border rounded-pill shadow text-decoration-none"
        href="#customizer" data-bs-toggle="offcanvas"
        style="right: -1.75rem; margin-top: -1rem; padding: .25rem .75rem; transform: rotate(-90deg); font-size: calc(var(--ar-body-font-size) * .8125); letter-spacing: .075rem; z-index: 1030;">
        <i class="ai-settings text-primary fs-base me-1 ms-n1"></i>
        Customize
    </a>

    <!-- Customizer offcanvas -->
    <div class="offcanvas offcanvas-end" id="customizer" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1">
        <div class="offcanvas-header border-bottom">
            <h4 class="offcanvas-title">Customize theme</h4>
            <button class="btn-close" type="button" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex align-items-center mb-3">
                <i class="ai-paint-roll text-body-secondary fs-4 me-2"></i>
                <h5 class="mb-0">Colors</h5>
            </div>
            <div class="row row-cols-3 g-3 mb-5" id="theme-colors">
                <div class="col">
                    <div class="text-dark fs-sm fw-medium mb-2">Primary</div>
                    <div class="color-swatch" id="theme-primary"
                        data-color-labels="[&quot;theme-primary&quot;, &quot;primary&quot;, &quot;primary-rgb&quot;]">
                        <label class="ratio ratio-4x3 border rounded-1 cursor-pointer mb-1" for="primary"
                            style="background-color: #448c74;" role="button"></label>
                        <input class="form-control form-control-sm" type="text" value="#448c74">
                        <input class="visually-hidden" type="color" id="primary" value="#448c74">
                    </div>
                </div>
                <div class="col">
                    <div class="text-dark fs-sm fw-medium mb-2">Warning</div>
                    <div class="color-swatch" id="theme-warning"
                        data-color-labels="[&quot;theme-warning&quot;, &quot;warning&quot;, &quot;warning-rgb&quot;]">
                        <label class="ratio ratio-4x3 border rounded-1 cursor-pointer mb-1" for="warning"
                            style="background-color: #edcb50;" role="button"></label>
                        <input class="form-control form-control-sm" type="text" value="#edcb50">
                        <input class="visually-hidden" type="color" id="warning" value="#edcb50">
                    </div>
                </div>
                <div class="col">
                    <div class="text-dark fs-sm fw-medium mb-2">Info</div>
                    <div class="color-swatch" id="theme-info"
                        data-color-labels="[&quot;theme-info&quot;, &quot;info&quot;, &quot;info-rgb&quot;]">
                        <label class="ratio ratio-4x3 border rounded-1 cursor-pointer mb-1" for="info"
                            style="background-color: #3f7fca;" role="button"></label>
                        <input class="form-control form-control-sm" type="text" value="#3f7fca">
                        <input class="visually-hidden" type="color" id="info" value="#3f7fca">
                    </div>
                </div>
                <div class="col">
                    <div class="text-dark fs-sm fw-medium pt-1 mb-2">Success</div>
                    <div class="color-swatch" id="theme-success"
                        data-color-labels="[&quot;theme-success&quot;, &quot;success&quot;, &quot;success-rgb&quot;]">
                        <label class="ratio ratio-4x3 border rounded-1 cursor-pointer mb-1" for="success"
                            style="background-color: #3fca90;" role="button"></label>
                        <input class="form-control form-control-sm" type="text" value="#3fca90">
                        <input class="visually-hidden" type="color" id="success" value="#3fca90">
                    </div>
                </div>
                <div class="col">
                    <div class="text-dark fs-sm fw-medium pt-1 mb-2">Danger</div>
                    <div class="color-swatch" id="theme-danger"
                        data-color-labels="[&quot;theme-danger&quot;, &quot;danger&quot;, &quot;danger-rgb&quot;]">
                        <label class="ratio ratio-4x3 border rounded-1 cursor-pointer mb-1" for="danger"
                            style="background-color: #ed5050;" role="button"></label>
                        <input class="form-control form-control-sm" type="text" value="#ed5050">
                        <input class="visually-hidden" type="color" id="danger" value="#ed5050">
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3"><i class="ai-align-left text-body-secondary fs-4 me-2"></i>
                <h5 class="mb-0">Typography <span class="text-body-secondary fs-sm fw-normal">(1rem = 16px)</span>
                </h5>
            </div>
            <div class="mb-5">
                <div class="mb-3">
                    <label class="text-dark fs-sm fw-medium pt-1 mb-2" for="font-url">Google font URL</label>
                    <input class="form-control" type="url"
                        value="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap"
                        id="font-url">
                </div>
                <div class="mb-3">
                    <label class="text-dark fs-sm fw-medium pt-1 mb-2" for="body-font-family">Font family</label>
                    <input class="form-control" type="text" value="'Inter', sans-serif" id="body-font-family">
                </div>
                <div class="row row-cols-2">
                    <div class="col mb-3">
                        <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="root-font-size">Root font
                            size, rem</label>
                        <select class="form-select" id="root-font-size">
                            <option value=".75rem">.75</option>
                            <option value=".875rem">.875</option>
                            <option value="1rem" selected="">1</option>
                            <option value="1.05rem">1.05</option>
                            <option value="1.1rem">1.1</option>
                            <option value="1.15rem">1.15</option>
                            <option value="1.25rem">1.25</option>
                            <option value="1.375rem">1.375</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="body-font-size">Body font
                            size, rem</label>
                        <select class="form-select" id="body-font-size">
                            <option value=".75rem">.75</option>
                            <option value=".875rem">.875</option>
                            <option value="1rem" selected="">1</option>
                            <option value="1.15rem">1.15</option>
                            <option value="1.25rem">1.25</option>
                            <option value="1.375rem">1.375</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center mt-n2 mb-3"><i
                    class="ai-maximize text-body-secondary fs-5 me-2"></i>
                <h5 class="mb-0">Borders / Rounding</h5>
            </div>
            <div class="mb-3">
                <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-width">Border width,
                    px</label>
                <input class="form-control" type="number" min="0" step="1" value="1"
                    id="border-width">
            </div>
            <div class="mb-3">
                <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-radius">Rounded base,
                    rem</label>
                <input class="form-control" type="number" min="0" step=".05" value="1"
                    id="border-radius">
            </div>
            <div id="theme-border-radiuses">
                <div class="mb-3">
                    <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-radius-sm">
                        Rounded SM<span class="text-body-secondary fw-normal ms-1"> = Rounded base multiplied
                            by</span></label>
                    <input class="form-control" type="number" min="0" step=".05" value=".75"
                        id="border-radius-sm">
                </div>
                <div class="mb-3">
                    <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-radius-lg">
                        Rounded LG<span class="text-body-secondary fw-normal ms-1"> = Rounded base multiplied
                            by</span></label>
                    <input class="form-control" type="number" min="0" step=".05" value="1.125"
                        id="border-radius-lg">
                </div>
                <div class="mb-3">
                    <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-radius-xl">
                        Rounded XL<span class="text-body-secondary fw-normal ms-1"> = Rounded base multiplied
                            by</span></label>
                    <input class="form-control" type="number" min="0" step=".05" value="1.5"
                        id="border-radius-xl">
                </div>
                <div class="mb-3">
                    <label class="d-flex w-100 text-dark fs-sm fw-medium pt-1 mb-2" for="border-radius-xxl">
                        Rounded 2XL<span class="text-body-secondary fw-normal ms-1"> = Rounded base multiplied
                            by</span></label>
                    <input class="form-control" type="number" min="0" step=".05" value="2.25"
                        id="border-radius-xxl">
                </div>
            </div>
        </div>
        <div class="offcanvas-header border-top d-none" id="customizer-btns">
            <button class="btn btn-secondary w-100 me-3" type="button" id="customizer-reset-btn">
                <i class="ai-undo fs-lg me-2 ms-n1"></i>
                Reset
            </button>
            <button class="btn btn-primary w-100" type="button" data-bs-toggle="modal"
                data-bs-target="#customizer-modal">
                <i class="ai-code-curly fs-lg me-2 ms-n1"></i>
                Show styles
            </button>
        </div>
    </div>


    <!-- Page wrapper -->
    <main class="page-wrapper">

        <!-- Navbar. Remove 'fixed-top' class to make the navigation bar scrollable with the page -->
        <header class="navbar navbar-expand-lg fixed-top">
            <div class="container">

                <!-- Navbar brand (Logo) -->
                <a class="navbar-brand pe-sm-3" href="{{ route('home.index') }}">
                    <span class="text-primary flex-shrink-0 me-2">
                        <img src="{{ asset('frontend/img/app-icons/logo.svg') }}" width="95" height="92"
                            alt="Logo Cosmic Bowling">

                    </span>
                    <span class="d-none d-sm-inline"></span>
                </a>
                <!-- Theme switcher -->
                <div class="form-check form-switch mode-switch order-lg-2 me-3 me-lg-4 ms-auto" data-bs-toggle="mode">
                    <input class="form-check-input" type="checkbox" id="theme-mode">
                    <label class="form-check-label" for="theme-mode">
                        <i class="ai-sun fs-lg"></i>
                    </label>
                    <label class="form-check-label" for="theme-mode">
                        <i class="ai-moon fs-lg"></i>
                    </label>
                </div>

                <div id="account-info" class="nav align-items-center order-lg-3 ms-n1 me-3 me-sm-0">
                    @if (Auth::guard('client')->check())
                        @php
                            $client = Auth::guard('client')->user();
                        @endphp
                        <div class="dropdown nav d-block order-lg-2 ms-auto">
                            <a class="nav-link d-flex align-items-center p-0" href="#"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="border rounded-circle" src="{{ asset('frontend/img/avatar/51.jpg') }}"
                                    width="48" alt="{{ $client->names_client }}">
                                <div class="d-none d-sm-block ps-2">
                                    <div class="fs-xs lh-1 opacity-60">Hola,</div>
                                    <div class="fs-sm dropdown-toggle">
                                        {{ explode(' ', trim($client->names_client))[0] }}</div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end my-1">
                                <h6 class="dropdown-header fs-xs fw-medium text-body-secondary text-uppercase pb-1">
                                    Cuenta</h6>
                                <a class="dropdown-item" href="{{ route('client.profile') }}"><i
                                        class="ai-user-check fs-lg opacity-70 me-2"></i>Perfil</a>
                                <div class="dropdown-divider"></div>
                                <button type="button" class="dropdown-item" id="logout-button">
                                    <i class="ai-logout fs-lg opacity-70 me-2"></i>
                                    Cerrar Sesión
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Mostrar el enlace de cuenta cuando no está autenticado -->
                        <a class="nav-link fs-4 p-2 mx-sm-1 d-none d-sm-flex" href="{{ route('client.login') }}"
                            role="button
                            aria-label="Account">
                            <i class="ai-user"></i>
                        </a>
                    @endif
                </div>

                <!-- Mobile menu toggler (Hamburger) -->
                <button class="navbar-toggler ms-sm-3" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar collapse (Main navigation) -->
                <nav class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav navbar-nav-scroll me-auto" style="--ar-scroll-height: 520px;">
                        <li class="nav-item">
                            <a class="nav-link" href="{{url('/')}}">Inicio</a>
                        </li>

                    </ul>
                </nav>
            </div>
        </header>

        @yield('content')

    </main>


    <!-- Footer -->
    <footer class="footer bg-dark position-relative py-5" data-bs-theme="dark">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(255, 255, 255, .03);">
        </div>
        <div class="container position-relative z-2 pb-xl-2 pt-2 pt-sm-3 pt-xl-4 pt-xxl-5">
            <div class="row pb-5 pt-md-3 pt-lg-4 mb-md-3 mb-lg-4">
                <div class="col-md-6 col-xxl-5 pb-3 pb-md-0 mb-2 mb-sm-3 mb-md-0">
                    <div class="h1 pb-3">Support us on Kickstarter and get <span
                            style="background: linear-gradient(90.72deg, #cbfdb1 3.49%, #acbff1 50.67%, #efa7ec 100.79%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">20%
                            discount</span> on headphones</div>
                    <div class="d-flex flex-wrap pb-4 pb-xl-5 mb-md-2 mb-lg-3">
                        <div class="d-flex pe-3 me-3 mb-2">
                            <i class="ai-check-alt text-white fs-4 mt-n1 me-2"></i>
                            <span class="text-body">$4,200 pledget</span>
                        </div>
                        <div class="d-flex pe-3 me-3 mb-2">
                            <i class="ai-check-alt text-white fs-4 mt-n1 me-2"></i>
                            <span class="text-body">45 funded</span>
                        </div>
                        <div class="d-flex mb-2">
                            <i class="ai-check-alt text-white fs-4 mt-n1 me-2"></i>
                            <span class="text-body">12 days to go</span>
                        </div>
                    </div>
                    <a class="btn btn-outline-light" href="#">Support us on Kickstarter</a>
                </div>
                <div class="col-md-5 col-xl-4 offset-md-1 offset-xl-2 offset-xxl-3">
                    <div class="row row-cols-2">
                        <div class="col">
                            <ul class="nav flex-column pb-4 mb-2 pb-md-5 mb-lg-1">
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0" href="#">Features</a>
                                </li>
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0" href="#">Colors</a>
                                </li>
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0" href="#">Product details</a>
                                </li>
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0" href="#">Privacy policy</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                <a class="btn btn-icon btn-sm btn-secondary btn-instagram rounded-circle me-3"
                                    href="#" aria-label="Instagram">
                                    <i class="ai-instagram"></i>
                                </a>
                                <a class="btn btn-icon btn-sm btn-secondary btn-facebook rounded-circle me-3"
                                    href="#" aria-label="Facebook">
                                    <i class="ai-facebook"></i>
                                </a>
                                <a class="btn btn-icon btn-sm btn-secondary btn-youtube rounded-circle" href="#"
                                    aria-label="YouTube">
                                    <i class="ai-youtube"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col">
                            <ul class="nav flex-column">
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0"
                                        href="mailto:email@example.com">email@example.com</a>
                                </li>
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0"
                                        href="tel:+15262200459">+&nbsp;1&nbsp;526&nbsp;220&nbsp;0459</a>
                                </li>
                                <li class="nav-item mt-1">
                                    <a class="nav-link py-1 px-0"
                                        href="tel:+15262200444">+&nbsp;1&nbsp;526&nbsp;220&nbsp;0444</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <p class="nav fs-sm mb-0">
                <span class="text-body-secondary">&copy; All rights reserved. Made by</span>
                <a class="nav-link fw-normal p-0 ms-1" href="https://createx.studio/" target="_blank"
                    rel="noopener">Createx Studio</a>
            </p>
        </div>
    </footer>


    <!-- Back to top button -->
    <a class="btn-scroll-top" href="#top" data-scroll="" aria-label="Scroll back to top">
        <svg viewbox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-miterlimit="10"></circle>
        </svg>
        <i class="ai-arrow-up"></i>
    </a>


    <!-- Vendor scripts: JS libraries and plugins -->
    <script src="{{ asset('frontend/vendor/%40lottiefiles/lottie-player/dist/lottie-player.js') }}"></script>
    <script src="{{ asset('frontend/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/shufflejs/dist/shuffle.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/aos/dist/aos.js') }}"></script>
    <script src="{{ asset('frontend/vendor/lightgallery/lightgallery.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/lightgallery/plugins/video/lg-video.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/cleave.js/dist/cleave.min.js') }}"></script>

    @yield('scripts')

    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('frontend/js/theme.min.js') }}"></script>

    <!-- Customizer -->
    <script src="{{ asset('frontend/js/customizer.min.js') }}"></script>


</body>

</html>

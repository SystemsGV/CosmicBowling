<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="utf-8">

    <!-- Viewport -->
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO meta tags -->
    <title>ComisBowling | Registrate</title>
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

            <!-- Home button -->
            <a class="text-nav btn btn-icon bg-light border rounded-circle position-absolute top-0 end-0 p-0 mt-3 me-3 mt-sm-4 me-sm-4"
                href="{{ route('home.index') }}" data-bs-toggle="tooltip" data-bs-placement="left"
                title="Regresar al Inicio" aria-label="Regresar al Inicio">
                <i class="ai-home"></i>
            </a>

            <!-- Sign up form -->
            <div class="d-flex flex-column align-items-center w-lg-50 h-100 px-3 px-lg-5 pt-5">
                <div class="w-100 mt-auto" style="max-width: 696px;">
                    <h1>¿Sin cuenta? Registrate</h1>
                    <p class="pb-3 mb-3 mb-lg-4">¿Ya tienes una cuenta?&nbsp;&nbsp;<a
                            href="{{ route('client.login') }}">
                            Iniciar sesión aquí!</a></p>
                    <div id="alert-container"></div>
                    <form class="needs-validation" id="form-register" novalidate="">
                        <div class="row row-cols-1 row-cols-sm-3">
                            <div class="col mb-4">
                                <input class="form-control form-control-lg" name="paternal" type="text"
                                    placeholder="Apellido Paterno" required="">
                            </div>
                            <div class="col mb-4">
                                <input class="form-control form-control-lg" name="maternal" type="text"
                                    placeholder="Apellido Materno" required="">
                            </div>
                            <div class="col mb-4">
                                <input class="form-control form-control-lg" name="firstname" type="text"
                                    placeholder="Nombres" required="">
                            </div>
                        </div>
                        <div class="row row-cols-1">
                            <div class="col-md-3 mb-4">
                                <select class="form-select form-select-lg" name="type_doc" id="select-input">
                                    <option value="01">DNI.</option>
                                    <option value="04">CARNET EXT.</option>
                                    <option value="07">PASAPORTE</option>
                                    <option value="00">OTROS</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-4">
                                <input id="number_doc" class="form-control form-control-lg numeric-input"
                                    name="number_doc" type="text" placeholder="Número de Documento" required="">
                                <div class="invalid-tooltip">Ingrese número de documento.</div>

                            </div>
                            <div class="col-md-5 mb-4">
                                <input id="mail_user" class="form-control form-control-lg" name="mail_user"
                                    type="email" placeholder="Correo Electrónico" required="">
                                <div class="invalid-tooltip">Ingrese correo electronico.</div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input class="form-control form-control-lg" name="birthday_user" type="text"
                                    data-format='{"date": true, "delimiter": "/", "datePattern": ["d", "m", "Y"]}'
                                    placeholder="Fec. Nacimiento (Dia/Mes/Año)" id="dateFormat" required="">
                                <div class="invalid-tooltip">Ingrese Fecha de Nacimiento.</div>

                            </div>
                            <div class="col mb-6">
                                <input class="form-control form-control-lg numeric-input" name="phone_user"
                                    type="text" placeholder="Número de Celular" required="">
                                <div class="invalid-tooltip">Ingrese Número de Celular.</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input class="form-control form-control-lg" name="district_user" type="text"
                                    placeholder="Distrito" required="">
                                <div class="invalid-tooltip">Ingrese Distrito.</div>

                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="password-toggle mb-4">
                                <input class="form-control form-control-lg" name="current_password" type="password"
                                    placeholder="Contraseña" required="" minlength="8">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                                <div class="invalid-tooltip">La contraseña debe tener al menos 8 caracteres.</div>

                            </div>
                            <div class="password-toggle mb-4">
                                <input class="form-control form-control-lg" type="password"
                                    placeholder="Confirmar contraseña" required="" minlength="8">
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                            <div class="pb-4">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox" id="invalidCheck01" required>
                                    <label class="form-check-label ms-1" for="invalidCheck01">Acepto los <a
                                            href="#">Términos y condiciones</a></label>
                                </div>
                            </div>
                        </div>
                        <button id="register-button" class="btn btn-lg btn-primary w-100 mb-4"
                            type="submit">Registrarse</button>
                    </form>
                </div>

                <!-- Copyright -->
                <p class="nav w-100 fs-sm pt-5 mt-auto mb-5" style="max-width: 526px;"><span
                        class="text-body-secondary">&copy; Reservados todos los derechos. Hecho por</span><a
                        class="nav-link d-inline-block p-0 ms-1" href="https://createx.studio/" target="_blank"
                        rel="noopener">Cosmic Bowling</a></p>
            </div>


            <!-- Cover image -->
            <div class="w-50 bg-size-cover bg-repeat-0 bg-position-center"
                style="background-image: url(frontend/img/account/cover.jpg);"></div>
        </div>
    </main>


    <!-- Back to top button -->
    <a class="btn-scroll-top" href="#top" data-scroll="" aria-label="Scroll back to top">
        <svg viewbox="0 0 40 40" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="19" fill="none" stroke="currentColor" stroke-width="1.5"
                stroke-miterlimit="10"></circle>
        </svg>
        <i class="ai-arrow-up"></i>
    </a>


    <script src="{{ asset('frontend/vendor/cleave.js/dist/cleave.min.js') }}"></script>

    <!-- Bootstrap + Theme scripts -->
    <script src="{{ asset('frontend/js/theme.min.js') }}"></script>
    <script src="{{ asset('frontend/pages/register.js') }}"></script>

</body>

</html>

@extends('frontend/layouts/app')

@section('content')
    <section class="container pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
        <h2 class="h1 text-center pt-2 pt-sm-3">COMIENZE SU RESERVA DE CARRIL</h2>
        <p class="text-center pb-3 mb-3 mb-lg-4" id="xwyz" data-id={{ $subcategory->id_subcategory }}>
            {{ $subcategory->name_subcategory }}</p>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs flex-nowrap overflow-auto text-nowrap align-content-center w-100 mx-auto pb-3 mb-3 mb-lg-4 fs-5"
            role="tablist" style="max-width: 600px;">
            <li class="nav-item mb-0">
                <a id="tabReservation" class="nav-link active" href="#beginners" data-bs-toggle="tab" role="tab">
                    <i class="ai-calendar-plus me-2"></i> Reserva de Carril
                </a>
            </li>
            <li class="nav-item mb-0">
                <a id="tabBilling" class="nav-link disabled" href="#stretching" data-bs-toggle="tab" role="tab">
                    <i class="ai-card me-2"></i> Facturación
                </a>
            </li>
            <li class="nav-item mb-0">
                <a id="tabPayment" class="nav-link disabled" href="#fly-yoga" data-bs-toggle="tab" role="tab">
                    <i class="ai-wallet me-2"></i> Pago
                </a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content">

            <!-- Beginers -->
            <div class="tab-pane fade show active" id="beginners" role="tabpanel">
                <form class="needs-validation container position-relative z-2 pt-5 pb-lg-5 pb-md-4 pb-2" novalidate="">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="h2">CÓMO FUNCIONA</h1>
                            <div class="alert alert-info d-flex mb-4">
                                <i class="ai-circle-info fs-xl me-2"></i>
                                <p class="mb-0">Disfrute de bolos, comida y cócteles, un lugar garantizado en las pistas y
                                    la experiencia de check-in más rápida.</a></p>
                            </div>

                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                <h4 class=" ms-1">1. Seleccione una Fecha</h4>
                            </h3>

                            <div class="position-relative">
                                <input class="form-control date-picker pe-5  form-control-lg" type="text"
                                    placeholder="Choose date and time"
                                    data-datepicker-options='
                                    {"altInput": true, 
                                    "altFormat": "F j, Y", 
                                    "dateFormat": "Y-m-d", 
                                    "locale": "es"}'
                                    id="c-date">
                                <i class="ai-calendar position-absolute top-50 end-0 translate-middle-y me-3"></i>
                            </div>

                            <div class="alert d-flex alert-secondary text-center mt-3" role="alert">
                                <div class="w-100"><i class="ai-time fs-xl pe-1 me-2"></i> ¿Quieres reservar con más de 8
                                    días de antelación?
                                    <a href="#" class="alert-link text-primary">RESERVAR AHORA ></a>
                                </div>
                            </div>

                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                <h4 class=" ms-1">3. Seleccione una hora</h4>
                            </h3>

                            <div class="container">
                                <div class="row" id="radioContainer">
                                </div>
                            </div>

                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                <h4 class=" ms-1">4. Selecciona cuánto tiempo quieres jugar a los bolos</h4>
                            </h3>

                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-md-6 radio-container d-flex justify-content-center">
                                        <input type="radio" class="btn-check" id="hour1" name="c-hour" value="1"
                                            disabled>
                                        <label for="hour1" class="btn btn-outline-secondary btn-lg btn-custom">
                                            <span id="l-hour1">1 HORA</span>
                                        </label>
                                    </div>
                                    <div class="col-12 col-md-6 radio-container d-flex justify-content-center">
                                        <input type="radio" class="btn-check" id="hour2" name="c-hour" value="2"
                                            disabled>
                                        <label for="hour2" class="btn btn-outline-secondary btn-lg btn-custom">
                                            <span id=l-hour2>2 HORAS</span>
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                <h4 class=" ms-1">5. Seleccionar Integrantes</h4>
                                <span class="text-body-secondary">Añade hasta 5 jugadores por pista. Proporcione un recuento
                                    exacto de
                                    invitados. No podemos garantizar alojamiento para cambios en el tamaño del grupo.
                                </span>
                                <div class="count-input bg-gray rounded-3">
                                    <button class="btn btn-icon btn-lg fs-xl" type="button" data-decrement=""
                                        id="decrement-btn">-</button>
                                    <input class="form-control" type="number" value="1" id="c-guests">
                                    <button class="btn btn-icon btn-lg fs-xl" type="button" data-increment=""
                                        id="increment-btn">+</button>
                                </div>
                            </h3>

                        </div>

                        <!-- Order summary -->
                        <div id="reservationDetailsStep1" class="col-lg-4 offset-lg-1 pt-1">
                            <div class="position-md-sticky top-0 ps-md-4 ps-lg-5 ps-xl-0">
                                <div class="d-none d-md-block" style="padding-top: 90px;"></div>
                                <h2 class="pb-2 pt-md-2 my-4">
                                    Resumen de la Reserva
                                </h2>

                                <!-- Item -->
                                <div class="d-sm-flex align-items-center border-top py-4">
                                    <div class="w-100 pt-1 ps-sm-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <h3 class="h4 mb-2">
                                                    Fecha de Reserva :
                                                </h3>
                                                <div class="d-sm-flex flex-wrap">
                                                    <div class="text-body-secondary  me-3">
                                                        <span class="text-ligth fs-5 fw-light" id="l-date"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top pt-4 mt-2 mb-4">
                                    <div class="input-group input-group-sm border-dashed" style="max-width: 410px;">
                                        <input class="form-control text-uppercase" type="text"
                                            placeholder="Código promocional" id="couponCode" name="couponCode"
                                            value="8YTW3KAQNGHV">
                                        <button class="btn btn-secondary" type="button" id="btnCoupon" disabled>APLICAR
                                            CUPÓN</button>
                                    </div>
                                </div>
                                <ul class="list-unstyled py-3 mb-0">
                                    <li class="d-flex justify-content-between mb-2">
                                        <span><strong id="n-lane"></strong> {{ $subcategory->name_subcategory }}
                                            <strong id='l-hours'></strong></span>
                                        <span class="fw-semibold ms-2" id="lp-lane">S/. 0.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        <span>Descuento Cupón</span>
                                        <span class="fw-semibold ms-2" id="l-discount">- S/. 0.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        <span id="l-guests"></span> <span class="fw-semibold ms-2" id="lp-guests">S/.
                                            0.00</span>
                                    </li>
                                </ul>
                                <div class="d-flex align-items-center justify-content-between border-top fs-xl pt-4">
                                    Total:<span class="fs-3 fw-semibold text-dark ms-2" id="l-total">S/. 0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-none d-lg-block pt-5 mt-n3">
                        <button id="btnNext" class="btn btn-lg btn-primary" type="button">
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">SIGUIENTE: FACTURACIÓN</font>
                            </font>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Stretching -->
            <div class="tab-pane fade" id="stretching" role="tabpanel">
                <form class="needs-validation container position-relative z-2 pt-5 pb-lg-5 pb-md-4 pb-2" novalidate="">
                    <div class="row">
                        <div class="col-lg-7">
                            <h1 class="h2 pb-3">DATOS FACTURACION</h1>
                            <!-- Checkout form fields -->
                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                1.<span class="text-decoration-underline ms-1">Información de Facturación</span>
                            </h3>
                            <div class="row g-4 pb-4 pb-md-5 mb-3 mb-md-1">
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-fn">Apellidos</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Apellidos"
                                        required="" id="c-ln">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-ln">Nombres</label>
                                    <input class="form-control form-control-lg" type="text" placeholder="Nombres"
                                        required="" id="c-fn">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-email">Correo Electrónico</label>
                                    <div class="position-relative"><i
                                            class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                        <input class="form-control form-control-lg ps-5" type="email"
                                            placeholder="Correo Electrónico" required="" id="c-email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-phone">Nº Celular</label>
                                    <div class="position-relative"><i
                                            class="ai-phone fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                        <input class="form-control form-control-lg ps-5" type="tel"
                                            data-format='{"numericOnly": true, "delimiters": ["+51 ", " ", " "], "blocks": [0, 3, 3, 3]}'
                                            placeholder="___ ___ __" required="" name="c-phone" id="c-phone">
                                    </div>
                                </div>
                            </div>
                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">2.<span
                                    class="text-decoration-underline ms-1">Tipo de Documento</span></h3>
                            <div class="row g-4 pb-4 pb-md-5 mb-3 mb-md-1">
                                <div class="d-flex">
                                    <div class="col-sm-6">
                                        <div class="me-3">
                                            <input type="radio" class="btn-check" id="weight1" name="weight"
                                                value="boleta" checked>
                                            <label for="weight1" class="btn btn-outline-secondary px-2">
                                                <span class="mx-1">Boleta Electrónica</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="me-3">
                                        <input type="radio" class="btn-check" id="weight2" name="weight"
                                            value="factura">
                                        <label for="weight2" class="btn btn-outline-secondary px-2">
                                            <span class="mx-1">Factura Electrónica</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="collapse" id="collapseExample">
                                    <div class="card">
                                        <div class="card-header">
                                            <i class="fa fa-university"></i> Ingrese Datos para la facturación
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="mb-3">
                                                        <label for="rsocial" class="form-label">Razón Social</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-user"></i></span>
                                                            <input type="text" class="form-control" id="rsocial"
                                                                name="rsocial" placeholder="Razón Social" required
                                                                minlength="3">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Este campo es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="mb-3">
                                                        <label for="ruc" class="form-label">RUC</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-ticket"></i></span>
                                                            <input type="text" class="form-control" id="ruc"
                                                                name="ruc" placeholder="RUC" required
                                                                pattern="^[0-9]{11}$" maxlength="11">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Por favor ingrese un valor correcto.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="dir" class="form-label">Dirección</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-location-arrow"></i></span>
                                                            <input type="text" class="form-control" id="dir"
                                                                name="dir" placeholder="Dirección" required
                                                                minlength="2">
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Este campo es obligatorio
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Place an order button visible on screens > 991px -->
                            <div class="d-none d-lg-block pt-5 mt-n3">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" id="save-info">
                                    <label class="form-check-label" for="save-info">
                                        <span class="text-body-secondary">Su información personal se utilizará para
                                            procesar su reserva, para respaldar su experiencia en este sitio y para otros
                                            fines descritos en el
                                        </span><a class="fw-medium" href="#" data-bs-toggle="modal"
                                            data-bs-target="#modalScroll">Términos y Condiciones</a>
                                    </label>
                                </div>
                                <button class="btn btn-lg btn-primary btnBilling" type="button">Pago
                                    Reserva</button>
                            </div>
                        </div>

                        <!-- Order summary -->
                        <div id="reservationDetailsStep2" class="col-lg-4 offset-lg-1 pt-1">

                        </div>
                    </div>

                    <!-- Place an order button visible on screens < 992px -->
                    <div class="d-lg-none pb-2 mt-2 mt-lg-0 pt-4 pt-lg-5">
                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" checked="" id="save-info2">
                            <label class="form-check-label" for="save-info2">
                                <span class="text-body-secondary">Your personal information will be used to process your
                                    order, to support
                                    your experience on this site and for other purposes described in the </span><a
                                    class="fw-medium" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalScroll">privacy policy</a>
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary w-100 w-sm-auto btnBilling">Pago
                            Reserva</button>
                    </div>
                </form>
            </div>

            <!-- Fly-yoga -->
            <div class="tab-pane fade" id="fly-yoga" role="tabpanel">
                <div class="row align-items-lg-center">
                    <div class="col-md-6 pb-4 pb-md-0 mb-2 mb-md-0">
                        <h1 class="h2 pb-3">DATOS FACTURACION</h1>

                        <div class="accordion-item d-flex align-items-start border-0">
                            <div class="d-flex align-items-center justify-content-center bg-body-secondary text-dark-emphasis rounded-circle flex-shrink-0"
                                style="width: 2rem; height: 2rem; margin-top: -.125rem">
                                <i class="ci-check fs-base"></i>
                            </div>
                            <div class="w-100 ps-3 ps-md-4">
                                <div class="d-flex align-items-center">
                                    <h2 class="accordion-header h5 mb-0 me-3" id="shippingAddressHeading">
                                        <span class="d-none d-lg-inline">Información de Facturación</span>
                                        <button type="button" class="accordion-button collapsed fs-5 d-lg-none py-1"
                                            data-bs-toggle="collapse" data-bs-target="#shippingAddress"
                                            aria-expanded="false" aria-controls="shippingAddress">
                                            <span class="me-2">Shipping address</span>
                                        </button>
                                    </h2>
                                </div>
                                <div class="accordion-collapse collapse d-lg-block" id="shippingAddress"
                                    aria-labelledby="shippingAddressHeading" data-bs-parent="#checkout">
                                    <ul class="accordion-body list-unstyled p-0 pt-3 pt-md-4 mb-0">
                                        <li id="namesli"></li>
                                        <li id="emailli"></li>
                                        <li id="phoneli"></li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <h1>Formulario de Pago</h1>


                    </div>
                    <!-- Order summary -->
                    <div id="reservationDetailsStep3" class="col-lg-4 offset-lg-1 pt-1">

                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="modal-login" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Iniciar Session</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="pb-3 mb-3 mb-lg-4">
                        ¿Aún no tienes una cuenta?&nbsp;&nbsp;<a href="javascript:void(0)" id="btnRegister">Regístrate
                            aquí!</a></p>

                    <form id="form-login" class="needs-validation" novalidate="">
                        <div class="pb-3 mb-3">
                            <div class="position-relative">
                                <i class="ai-dashboard fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <input id="number_login" name="number_login" class="form-control form-control-lg ps-5"
                                    type="text" placeholder="Número de Documento" required="">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="position-relative">
                                <i
                                    class="ai-lock-closed fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                <div class="password-toggle">
                                    <input id="password_login" name="password_login"
                                        class="form-control form-control-lg ps-5" type="password"
                                        placeholder="Contraseña" required="">
                                    <label class="password-toggle-btn" aria-label="Show/hide password">
                                        <input class="password-toggle-check" type="checkbox"><span
                                            class="password-toggle-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap align-items-center justify-content-between pb-4">
                            <div class="form-check my-1">
                                <input class="form-check-input" type="checkbox" id="keep-signedin">
                                <label class="form-check-label ms-1" for="keep-signedin">Mantenme registrado</label>
                            </div>
                            <a class="fs-sm fw-semibold text-decoration-none my-1" href="account-password-recovery.html">
                                ¿Has olvidado tu contraseña?</a>
                        </div>

                        <button id="login-button" class="btn btn-lg btn-primary w-100 mb-4"
                            type="submit">Ingresar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-register" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrarse</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="pb-3 mb-3 mb-lg-4">Ya tienes una cuenta?&nbsp;&nbsp;<a href="javascript:void(0)"
                            id="btnLogin">Iniciar sesión
                            aquí!</a></p>
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
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalScroll" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-d modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modal title</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body fs-sm">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary w-100 w-sm-auto mb-3 mb-sm-0" type="button"
                        data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary w-100 w-sm-auto ms-sm-3" type="button">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 start-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true"
            data-bs-delay="300">
            <div class="toast-header bg-success text-white">
                <i class="ai-circle-check fs-lg me-2"></i>
                <span class="me-auto">Reservas Cosmic Bowling</span>
                <button type="button" class="btn-close btn-close-white ms-2" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
            <div class="toast-body text-success" id="subjectToast"></div>
        </div>
    </div>
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/vendor/flatpickr/dist/flatpickr.min.css') }}">
    <style>
        .btn-custom {
            padding: 20px;
            font-size: 18px;
            width: 100%;
            text-align: center;
        }

        .radio-container {
            margin-bottom: 15px;
        }

        .btn-custom:hover {
            background-color: var(--bs-primary);
            color: #fff;
        }
    </style>
@endsection()

@section('scripts')
    <script src="{{ asset('frontend/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/flatpickr/lang/es.js') }}"></script>
    <script>
        const calendarItems = @json($hours);
    </script>
    <script src="{{ asset('frontend/js/pages/cart.js') }}"></script>
@endsection

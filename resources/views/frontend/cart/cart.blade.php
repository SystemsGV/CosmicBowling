@extends('frontend/layouts/app')

@section('content')
    <section class="container pt-5 mt-lg-3 mt-xl-4 mt-xxl-5">
        <h2 class="h1 text-center pt-2 pt-sm-3">COMIENZE SU RESERVA DE CARRIL</h2>
        <p class="text-center pb-3 mb-3 mb-lg-4">{{ $subcategory->name_subcategory }}</p>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs flex-nowrap overflow-auto text-nowrap align-content-center w-100 mx-auto pb-3 mb-3 mb-lg-4 fs-5" role="tablist"
        style="max-width: 600px;">
        <li class="nav-item mb-0">
            <a class="nav-link active" href="#beginners" data-bs-toggle="tab" role="tab">
                <i class="ai-calendar-plus me-2"></i>
                Reserva de Carril</a>
        </li>
        <li class="nav-item mb-0">
            <a id="tabBilling" class="nav-link disabled" href="#stretching" data-bs-toggle="tab" role="tab"><i
                    class="ai-card me-2"></i> Facturación</a>
        </li>
        <li class="nav-item mb-0">
            <a id="tabPayment" class="nav-link disabled" href="#fly-yoga" data-bs-toggle="tab" role="tab"><i
                    class="ai-wallet me-2"></i> Pago</a>
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
                                <span class="text-body-secondary">Añade hasta 5 jugadores. Proporcione un recuento exacto de
                                    invitados. No podemos garantizar alojamiento para cambios en el tamaño del grupo.
                                </span>

                                <select class="form-select form-select-lg mt-4" required="" id="c-guests">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}" {{ $i == 5 ? 'selected' : '' }}>
                                            {{ $i }} Integrantes</option>
                                    @endfor
                                </select>
                            </h3>

                        </div>

                        <!-- Order summary -->
                        <div class="col-lg-4 offset-lg-1 pt-1">
                            <div class="position-md-sticky top-0 ps-md-4 ps-lg-5 ps-xl-0">
                                <div class="d-none d-md-block" style="padding-top: 90px;"></div>
                                <h2 class="pb-2 pt-md-2 my-4">
                                    Resumen del pedido
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
                                            placeholder="Código promocional">
                                        <button class="btn btn-secondary" type="button">APLICAR CUPÓN</button>
                                    </div>
                                </div>
                                <ul class="list-unstyled py-3 mb-0">
                                    <li class="d-flex justify-content-between mb-2">
                                        <span id="l-lane"> </span>
                                        <span class="fw-semibold ms-2" id="lp-lane">S/. 0.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        <span id="l-shoe">Alquiler Calzado<strong id="l-guests"></strong></span> <span
                                            class="fw-semibold ms-2" id="lp-guests">S/. 0.00</span>
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
                            <h1 class="h2 pb-3">Checkout</h1>
                            <!-- Checkout form fields -->
                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">
                                1.<span class="text-decoration-underline ms-1">Shipping details</span>
                            </h3>
                            <div class="row g-4 pb-4 pb-md-5 mb-3 mb-md-1">
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-fn">First name</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Your first name" required="" id="c-fn">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-ln">Last name</label>
                                    <input class="form-control form-control-lg" type="text"
                                        placeholder="Your last name" required="" id="c-ln">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-email">Email</label>
                                    <div class="position-relative"><i
                                            class="ai-mail fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                        <input class="form-control form-control-lg ps-5" type="email"
                                            placeholder="Email address" required="" id="c-email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-phone">Phone</label>
                                    <div class="position-relative"><i
                                            class="ai-phone fs-lg position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                                        <input class="form-control form-control-lg ps-5" type="tel"
                                            data-format='{"numericOnly": true, "delimiters": ["+1 ", " ", " "], "blocks": [0, 3, 3, 2]}'
                                            placeholder="+1 ___ ___ __" required="" id="c-phone">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label fs-base" for="c-country">Country</label>
                                    <select class="form-select form-select-lg" required="" id="c-country">
                                        <option value="" selected="" disabled="">Select a country</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="USA">USA</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-city">City</label>
                                    <select class="form-select form-select-lg" required="" id="c-city">
                                        <option value="" selected="" disabled="">Select a city</option>
                                        <option value="Sydney">Sydney</option>
                                        <option value="Brussels">Brussels</option>
                                        <option value="Toronto">Toronto</option>
                                        <option value="Copenhagen">Copenhagen</option>
                                        <option value="New York">New York</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fs-base" for="c-zip">Zip code</label>
                                    <input class="form-control form-control-lg" type="text"
                                        data-format='{"delimiter": "-", "blocks": [3, 4], "uppercase": true}'
                                        placeholder="XXX-XXXX" required="" id="c-zip">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fs-base" for="c-address">Address line</label>
                                    <input class="form-control form-control-lg" type="text" required=""
                                        id="c-address">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fs-base" for="c-notes">Order notes <span
                                            class="text-body-secondary">(optional)</span></label>
                                    <textarea class="form-control form-control-lg" rows="5" id="c-notes"></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="same-address">
                                        <label class="form-check-label text-dark fw-medium" for="same-address">Billing
                                            address same as
                                            delivery</label>
                                    </div>
                                </div>
                            </div>
                            <h3 class="fs-base fw-normal text-body text-uppercase pb-2 pb-sm-3">2.<span
                                    class="text-decoration-underline ms-1">Shipping method</span></h3>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="shipping" id="standard">
                                <label class="form-check-label d-flex justify-content-between" for="standard">
                                    <span>
                                        <span class="d-block fs-base text-dark fw-medium mb-1">Standard Delivery</span>
                                        <span class="text-body">Delivery in 5 - 8 working days</span>
                                    </span>
                                    <span class="fs-base text-dark fw-semibold">$8.00</span>
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="shipping" checked=""
                                    id="express">
                                <label class="form-check-label d-flex justify-content-between" for="express">
                                    <span>
                                        <span class="d-block fs-base text-dark fw-medium mb-1">Express Shipping</span>
                                        <span class="text-body">Delivery in 3 - 5 working days</span>
                                    </span>
                                    <span class="fs-base text-dark fw-semibold">$15.00</span>
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="shipping" id="local">
                                <label class="form-check-label d-flex justify-content-between" for="local">
                                    <span>
                                        <span class="d-block fs-base text-dark fw-medium mb-1">Local Pickup</span>
                                        <span class="text-body">Delivery in 1 - 2 working days</span>
                                    </span>
                                    <span class="fs-base text-dark fw-semibold">Free</span>
                                </label>
                            </div>
                            <h3 class="fs-base fw-normal text-body text-uppercase mt-n4 mt-md-n3 pt-5 pb-2 pb-sm-3">
                                3.<span class="text-decoration-underline ms-1">Payment method</span>
                            </h3>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="payment" checked=""
                                    id="card">
                                <label class="form-check-label" for="card">
                                    <span>
                                        <span class="d-block fs-base text-dark fw-medium mb-1">Credit Card</span>
                                        <span class="text-body">Mastercard, Maestro, American Express, Visa are
                                            accepted</span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="radio" name="payment" id="cash">
                                <label class="form-check-label" for="cash">
                                    <span>
                                        <span class="d-block fs-base text-dark fw-medium mb-1">Cash on Delivery</span>
                                        <span class="text-body">Pay with cash upon the delivery</span>
                                    </span>
                                </label>
                            </div>

                            <!-- Place an order button visible on screens > 991px -->
                            <div class="d-none d-lg-block pt-5 mt-n3">
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" checked="" id="save-info">
                                    <label class="form-check-label" for="save-info">
                                        <span class="text-body-secondary">Your personal information will be used to process
                                            your order, to
                                            support your experience on this site and for other purposes described in the
                                        </span><a class="fw-medium" href="#">privacy policy</a>
                                    </label>
                                </div>
                                <button class="btn btn-lg btn-primary" type="submit">Place an order</button>
                            </div>
                        </div>

                        <!-- Order summary -->
                        <div class="col-lg-5 offset-xl-1">
                            <div class="d-none d-md-block" style="margin-top: -90px;"></div>
                            <div class="position-md-sticky top-0 ps-md-4 ps-lg-5 ps-xl-0">
                                <div class="d-none d-md-block" style="padding-top: 90px;"></div>
                                <h1 class="d-none d-md-inline-block pb-1 mb-2">
                                    Order summary <span class="fs-base fw-normal text-body-secondary">(4 items)</span>
                                </h1>

                                <!-- Item -->
                                <div class="d-sm-flex align-items-center border-top py-4">
                                    <a class="d-inline-block flex-shrink-0 bg-secondary rounded-1 p-sm-2 p-xl-3 mb-2 mb-sm-0"
                                        href="shop-single.html">
                                        <img src="{{ asset('frontend/img/shop/cart/01.png') }}" width="110"
                                            alt="Product">
                                    </a>
                                    <div class="w-100 pt-1 ps-sm-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <h3 class="h5 mb-2">
                                                    <a href="shop-single.html">Candle in concrete bowl</a>
                                                </h3>
                                                <div class="d-sm-flex flex-wrap">
                                                    <div class="text-body-secondary fs-sm me-3">
                                                        Color: <span class="text-dark fw-medium">Gray night</span>
                                                    </div>
                                                    <div class="text-body-secondary fs-sm me-3">
                                                        Weight: <span class="text-dark fw-medium">140g</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-end ms-auto">
                                                <div class="fs-5 mb-2">$11.00</div>
                                                <del class="text-body-secondary ms-auto">$15.00</del>
                                            </div>
                                        </div>
                                        <div class="count-input ms-n3">
                                            <button class="btn btn-icon fs-xl" type="button"
                                                data-decrement="">-</button>
                                            <input class="form-control" type="number" value="2" readonly="">
                                            <button class="btn btn-icon fs-xl" type="button"
                                                data-increment="">+</button>
                                        </div>
                                        <div class="nav justify-content-end mt-n5 mt-sm-n3">
                                            <a class="nav-link fs-xl p-2" href="#" data-bs-toggle="tooltip"
                                                title="Remove" aria-label="Remove">
                                                <i class="ai-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>


                                <!-- Item -->
                                <div class="d-sm-flex align-items-center border-top py-4">
                                    <a class="d-inline-block flex-shrink-0 bg-secondary rounded-1 p-sm-2 p-xl-3 mb-2 mb-sm-0"
                                        href="shop-single.html">
                                        <img src="{{ asset('frontend/img/shop/cart/03.png') }}" width="110"
                                            alt="Product">
                                    </a>
                                    <div class="w-100 pt-1 ps-sm-4">
                                        <div class="d-flex">
                                            <div class="me-3">
                                                <h3 class="h5 mb-2">
                                                    <a href="shop-single.html">Set for a dinner party of 7 items</a>
                                                </h3>
                                            </div>
                                            <div class="text-end ms-auto">
                                                <div class="fs-5 mb-2">$47.00</div>
                                            </div>
                                        </div>
                                        <div class="count-input ms-n3">
                                            <button class="btn btn-icon fs-xl" type="button"
                                                data-decrement="">-</button>
                                            <input class="form-control" type="number" value="1" readonly="">
                                            <button class="btn btn-icon fs-xl" type="button"
                                                data-increment="">+</button>
                                        </div>
                                        <div class="nav justify-content-end mt-n5 mt-sm-n3">
                                            <a class="nav-link fs-xl p-2" href="#" data-bs-toggle="tooltip"
                                                title="Remove" aria-label="Remove">
                                                <i class="ai-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top pt-4 mb-3">
                                    <div class="input-group input-group-sm border-dashed" style="max-width: 310px;">
                                        <input class="form-control text-uppercase" type="text"
                                            placeholder="Your coupon code">
                                        <button class="btn btn-secondary" type="button">Apply coupon</button>
                                    </div>
                                </div>
                                <ul class="list-unstyled py-3 mb-0">
                                    <li class="d-flex justify-content-between mb-2">
                                        Subtotal:<span class="fw-semibold ms-2">$92.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        Taxes:<span class="fw-semibold ms-2">$8.00</span>
                                    </li>
                                    <li class="d-flex justify-content-between mb-2">
                                        Shipping cost:<span class="fw-semibold ms-2">$15.00</span>
                                    </li>
                                </ul>
                                <div class="d-flex align-items-center justify-content-between border-top fs-xl pt-4">
                                    Total:<span class="fs-3 fw-semibold text-dark ms-2">S/ 00.00</span>
                                </div>
                            </div>
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
                                    class="fw-medium" href="#">privacy policy</a>
                            </label>
                        </div>
                        <button class="btn btn-lg btn-primary w-100 w-sm-auto" type="submit">Place an order</button>
                    </div>
                </form>
            </div>

            <!-- Fly-yoga -->
            <div class="tab-pane fade" id="fly-yoga" role="tabpanel">
                <div class="row align-items-lg-center">
                    <div class="col-md-6 pb-4 pb-md-0 mb-2 mb-md-0">
                        <img class="rounded-5" src="{{ asset('frontend/img/landing/yoga-studio/classes/fly-yoga.jpg') }}"
                            alt="Fly-yoga">
                    </div>
                    <div class="col-md-6 col-lg-5 col-xl-4 offset-lg-1">
                        <div class="ps-md-4 ps-lg-0">
                            <h2 class="mb-xl-4">Fly-yoga</h2>
                            <p class="pb-3 mb-3 mb-xl-4">Varius purus dui nunc faucibus mauris iaculis tortor enim cursus
                                quisque eu, vel amet massa suscipit cursus sit mattis quis magnis dignissim dui fames tortor
                                amet quis.</p>
                            <div class="row row-cols-2 g-4 pb-2 pb-xl-0 mb-4 mb-xl-5">
                                <div class="col">
                                    <i class="ai-towel d-block h2 text-primary fw-normal pb-2 mb-1"></i>
                                    <h3 class="h6 mb-2">Changing rooms</h3>
                                    <p class="fs-sm mb-0">Neque, blandit consectetur viverra placerat ante.</p>
                                </div>
                                <div class="col">
                                    <i class="ai-rug d-block h2 text-primary fw-normal pb-2 mb-1"></i>
                                    <h3 class="h6 mb-2">Free rugs</h3>
                                    <p class="fs-sm mb-0">Neque, blandit consectetur viverra placerat ante.</p>
                                </div>
                                <div class="col">
                                    <i class="ai-spa d-block h2 text-primary fw-normal pb-2 mb-1"></i>
                                    <h3 class="h6 mb-2">Spa area</h3>
                                    <p class="fs-sm mb-0">Neque, blandit consectetur viverra placerat ante.</p>
                                </div>
                                <div class="col">
                                    <i class="ai-sofa d-block h2 text-primary fw-normal pb-2 mb-1"></i>
                                    <h3 class="h6 mb-2">Bright halls</h3>
                                    <p class="fs-sm mb-0">Neque, blandit consectetur viverra placerat ante.</p>
                                </div>
                            </div>
                            <a class="btn btn-primary w-100 w-sm-auto" href="#">Try a free lesson</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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

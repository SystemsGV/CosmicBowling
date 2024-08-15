@extends('frontend/layouts/app')

@section('content')
    <!-- Page container -->
    <div class="container py-5 mt-4 mt-lg-5 mb-lg-4 my-xl-5">
        <div class="row pt-sm-2 pt-lg-0">

            <!-- Sidebar (offcanvas on sreens < 992px) -->
            <aside class="col-lg-3 pe-lg-4 pe-xl-5 mt-n3">
                <div class="position-lg-sticky top-0">
                    <div class="d-none d-lg-block" style="padding-top: 105px;"></div>
                    <div class="offcanvas-lg offcanvas-start" id="sidebarAccount">
                        <button class="btn-close position-absolute top-0 end-0 mt-3 me-3 d-lg-none" type="button"
                            data-bs-dismiss="offcanvas" data-bs-target="#sidebarAccount" aria-label="Close"></button>
                        <div class="offcanvas-body">
                            <div class="pb-2 pb-lg-0 mb-4 mb-lg-5">
                                <img class="d-block rounded-circle mb-2" src="{{ asset('frontend/img/avatar/02.jpg') }}"
                                    width="80" alt="Isabella Bocouse">
                                <h3 class="h5 mb-1">Isabella Bocouse</h3>
                                <p class="fs-sm text-body-secondary mb-0">bocouse@example.com</p>
                            </div>
                            <nav class="nav flex-column pb-2 pb-lg-4 mb-3">
                                <h4 class="fs-xs fw-medium text-body-secondary text-uppercase pb-1 mb-2">Account</h4>
                                <a class="nav-link fw-semibold py-2 px-0 active" href="account-overview.html">
                                    <i class="ai-user-check fs-5 opacity-60 me-2"></i>
                                    Perfil
                                </a>
                                <a class="nav-link fw-semibold py-2 px-0 disabled" href="account-settings.html">
                                    <i class="ai-settings fs-5 opacity-60 me-2"></i>
                                    Configuración
                                </a>
                            </nav>
                            <nav class="nav flex-column pb-2 pb-lg-4 mb-1">
                                <h4 class="fs-xs fw-medium text-body-secondary text-uppercase pb-1 mb-2">Dashboard</h4>
                                <a class="nav-link fw-semibold py-2 px-0" href="account-orders.html">
                                    <i class="ai-cart fs-5 opacity-60 me-2"></i>
                                    Reservas
                                </a>

                            </nav>
                            <nav class="nav flex-column">
                                <a class="nav-link fw-semibold py-2 px-0" href="account-signin.html">
                                    <i class="ai-logout fs-5 opacity-60 me-2"></i>
                                    Cerrar Sesión
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </aside>


            <!-- Page content -->
            <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                <h1 class="h2 mb-4">Perfil</h1>

                <!-- Basic info -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-user text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Información básica</h2>
                            <!-- <a class="btn btn-sm btn-secondary ms-auto" href="account-settings.html">
                                    <i class="ai-edit ms-n1 me-2"></i>
                                    Editar Información
                                </a>-->
                        </div>
                        <div class="d-md-flex align-items-center">
                            <div class="d-sm-flex align-items-center">
                                <div class="rounded-circle bg-size-cover bg-position-center flex-shrink-0"
                                    style="width: 80px; height: 80px; background-image: url(frontend/img/avatar/02.jpg);">
                                </div>
                                <div class="pt-3 pt-sm-0 ps-sm-3">
                                    <h3 class="h5 mb-2">{{ $client->names_client }}<i
                                            class="ai-circle-check-filled fs-base text-success ms-2"></i></h3>
                                    <div
                                        class="text-body-secondary fw-medium d-flex flex-wrap flex-sm-nowrap align-iteems-center">
                                        <div class="d-flex align-items-center me-3">
                                            <i class="ai-mail me-1"></i>
                                            {{ $client->email_client }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row py-4">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="border-0 text-body-secondary py-1 px-0">Nº Celular</td>
                                            <td class="border-0 text-dark fw-medium py-1 ps-3">{{ $client->phone_client }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- Orders -->
                <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center mt-sm-n1 pb-4 mb-0 mb-lg-1 mb-xl-3">
                            <i class="ai-cart text-primary lead pe-1 me-2"></i>
                            <h2 class="h4 mb-0">Orders</h2>
                            <a class="btn btn-sm btn-secondary ms-auto" href="account-orders.html">Ver Todo</a>
                        </div>

                        <!-- Orders accordion -->
                        <div class="accordion accordion-alt accordion-orders" id="orders">

                            <!-- Order -->
                            <div class="accordion-item border-top mb-0">
                                <div class="accordion-header">
                                    <a class="accordion-button d-flex fs-4 fw-normal text-decoration-none py-3 collapsed"
                                        href="#orderOne" data-bs-toggle="collapse" aria-expanded="false"
                                        aria-controls="orderOne">
                                        <div class="d-flex justify-content-between w-100" style="max-width: 440px;">
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary">#78A6431D409</div>
                                                <span class="badge bg-info bg-opacity-10 text-info fs-xs">In
                                                    progress</span>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="d-none d-sm-block fs-sm text-body-secondary mb-2">Order date
                                                </div>
                                                <div class="d-sm-none fs-sm text-body-secondary mb-2">Date</div>
                                                <div class="fs-sm fw-medium text-dark">Jan 27, 2023</div>
                                            </div>
                                            <div class="me-3 me-sm-4">
                                                <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                <div class="fs-sm fw-medium text-dark">$16.00</div>
                                            </div>
                                        </div>
                                        <div class="accordion-button-img d-none d-sm-flex ms-auto">
                                            <div class="mx-1">
                                                <img src="assets/img/account/orders/01.png" width="48" alt="Product">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="accordion-collapse collapse" id="orderOne" data-bs-parent="#orders">
                                    <div class="accordion-body">
                                        <div class="table-responsive pt-1">
                                            <table class="table align-middle w-100" style="min-width: 450px;">
                                                <tbody>
                                                    <tr>
                                                        <td class="border-0 py-1 px-0">
                                                            <div class="d-flex align-items-center">
                                                                <a class="d-inline-block flex-shrink-0 bg-secondary rounded-1 p-md-2 p-lg-3"
                                                                    href="shop-single.html">
                                                                    <img src="assets/img/shop/cart/01.png" width="110"
                                                                        alt="Product">
                                                                </a>
                                                                <div class="ps-3 ps-sm-4">
                                                                    <h4 class="h6 mb-2">
                                                                        <a href="shop-single.html">Candle in concrete
                                                                            bowl</a>
                                                                    </h4>
                                                                    <div class="text-body-secondary fs-sm me-3">Color:
                                                                        <span class="text-dark fw-medium">Gray night</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Quantity</div>
                                                            <div class="fs-sm fw-medium text-dark">1</div>
                                                        </td>
                                                        <td class="border-0 py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Price</div>
                                                            <div class="fs-sm fw-medium text-dark">$16</div>
                                                        </td>
                                                        <td class="border-0 text-end py-1 pe-0 ps-3 ps-sm-4">
                                                            <div class="fs-sm text-body-secondary mb-2">Total</div>
                                                            <div class="fs-sm fw-medium text-dark">$16</div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="bg-secondary rounded-1 p-4 my-2">
                                            <div class="row">
                                                <div class="col-sm-5 col-md-3 col-lg-4 mb-3 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Payment:</div>
                                                    <div class="fs-sm">Upon the delivery</div>
                                                    <a class="btn btn-link py-1 px-0 mt-2" href="#">
                                                        <i class="ai-time me-2 ms-n1"></i>
                                                        Order history
                                                    </a>
                                                </div>
                                                <div class="col-sm-7 col-md-5 mb-4 mb-md-0">
                                                    <div class="fs-sm fw-medium text-dark mb-1">Delivery address:</div>
                                                    <div class="fs-sm">401 Magnetic Drive Unit 2,<br>Toronto, Ontario, M3J
                                                        3H9, Canada</div>
                                                </div>
                                                <div class="col-md-4 col-lg-3 text-md-end">
                                                    <button class="btn btn-sm btn-outline-primary w-100 w-md-auto"
                                                        type="button">
                                                        <i class="ai-star me-2 ms-n1"></i>
                                                        Leave a review
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')
@endsection

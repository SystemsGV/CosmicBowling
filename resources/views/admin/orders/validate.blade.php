@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
        </h4>
        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header sticky-element bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Datos de la Reserva</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mx-auto">
                                <!-- 1. Delivery Address -->
                                <h5 class="mb-4">Información Reserva</h5>
                                <div class="row g-4">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="mdi mdi-qrcode fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="code"
                                                    placeholder="Código">
                                                <label for="code">Código</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer" id="searchCode"><i class="mdi mdi-file-search fs-3"></i></span>
                                          </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="mdi mdi-bowling fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="subcategory"
                                                    placeholder="Tipo de Pista">
                                                <label for="subcategory">Pista/Billar</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="mdi mdi-calendar-month-outline fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="date"
                                                    placeholder="Tipo de Pista">
                                                <label for="date">Fecha/Hora Reserva</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="mdi mdi-apps fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="quantity"
                                                    placeholder="Cantidad Pistas/Mesas">
                                                <label for="hours">Cantidad Pistas/Mesas</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="mdi mdi-clock-plus-outline fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="hours"
                                                    placeholder="Cantidad Horas">
                                                <label for="hours">Cantidad Horas</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="mdi mdi-crowd fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="guests"
                                                    placeholder="Cantidad Integrantes">
                                                <label for="guests">Cantidad Integrantes</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i class="mdi mdi-security fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="sure"
                                                    placeholder="Cantidad Integrantes">
                                                <label for="sure">SEGURO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <!-- 2. Delivery Type -->
                                <h5 class="my-4">Información Cliente</h5>
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="mdi mdi-smart-card-outline fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="typeDoc"
                                                    placeholder="Cantidad Integrantes">
                                                <label for="typeDoc">Tipo Documento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="mdi mdi-card-account-details-outline fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="numberDoc"
                                                    placeholder="Cantidad Integrantes">
                                                <label for="numberDoc">Nº Documento</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-group input-group-merge">
                                            <span class="input-group-text"><i
                                                    class="mdi mdi-badge-account fs-3"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="names"
                                                    placeholder="Cantidad Integrantes">
                                                <label for="names">Apellidos y Nombres</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <!-- 3. Apply Promo code -->
                                <h5 class="my-4">Observaciones</h5>
                                <div class="row g-3">
                                    <div class="col-sm-10 col-8">
                                      <textarea id="autosize-demo" rows="3" class="form-control" id="observations"></textarea>

                                    </div>
                                    <div class="col-sm-2 col-4 d-grid">
                                        <button class="btn btn-primary" id="validateCode">Validar</button>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Sticky Actions -->
    </div>

    <!-- Content -->
@endsection()

@section('styles')
@endsection()

@section('scripts')
  <script src="{{ asset('vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('js/pages/validate.js') }}"></script>
@endsection

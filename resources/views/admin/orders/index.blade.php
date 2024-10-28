@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator" id="stadistics">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <p class="mb-2">Reservas</p>
                                    <h4 class="mb-2" id="total"></h4>

                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-ticket mdi-24px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <p class="mb-2">COMPLETADA</p>
                                    <h4 class="mb-2" id="shift1"></h4>

                                </div>
                                <div class="avatar me-lg-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-timer-sand-complete mdi-24px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <p class="mb-2">PENDIENTE CONFIRMACIÓN</p>
                                    <h4 class="mb-2" id="shift2"></h4>
                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-check-circle-outline mdi-24px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <p class="mb-2">Filtra por: </p>
                                    <label class="switch switch-square">
                                        <input type="checkbox" class="switch-input">
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"></span>
                                            <span class="switch-off"></span>
                                        </span>
                                        <span class="switch-label">Fecha de Reserva</span>
                                    </label>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-filter-cog mdi-24px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtro de búsqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                id="flatpickr-range">
                            <label for="flatpickr-range">Rango de Fechas</label>
                        </div>
                    </div>
                    <div class="col-md-3 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-entries table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Codigo</th>
                            <th>Número Reserva</th>
                            <th>Cliente</th>
                            <th>descripción</th>
                            <th>Integrantes</th>
                            <th>Cupon</th>
                            <th>Monto</th>
                            <th>Fecha/Hora Reserva</th>
                            <th>Fecha De Compra</th>
                            <th>Tipo Comprobante</th>
                            <th>Número Documento</th>
                            <th>Razón Social</th>
                            <th>Dirección</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <!-- Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/pages/order.js') }}"></script>
@endsection

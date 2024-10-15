@extends('admin/layouts/layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- Clients List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtrar Busqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-users table">
                         <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Nombres / Apellidos</th>
                            <th>Tipo Documento</th>
                            <th>Número de Documento</th>
                            <th>Email</th>
                            <th>Número Cliente</th>
                            <th>Distrito</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>


    </div>
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('js/pages/clients.js') }}"></script>
@endsection

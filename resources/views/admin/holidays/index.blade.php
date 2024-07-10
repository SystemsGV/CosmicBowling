@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-2">Feriados</h4>

        <p class="mb-4">Each category (Basic, Professional, and Business) includes the four predefined roles shown
            below.</p>


        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-permissions table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="text-center">Feriado</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->


        <!-- Modal -->
        <!-- Add Permission Modal -->
        <div class="modal fade" id="modalHoliday" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="mb-2 pb-1" id="titleModal"></h3>
                            <p>Agregar ayudara a elegir el precio al generar un nuevo horario.</p>
                        </div>
                        <form id="formHoliday" class="row">
                            @csrf
                            <input type="hidden" id="idH" name="idH">
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="nameH" id="nameH" class="form-control"
                                        placeholder="Nombre Feriado" autofocus="">
                                    <label for="nameH">Nombre Feriado</label>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="dateH" name="dateH" class="form-control flatpickr-tim"
                                        placeholder="Fecha Feriado" autofocus="">
                                    <label for="dateH">Fecha Feriado</label>
                                </div>
                            </div>
                            <div class="col-12 text-center demo-vertical-spacing">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Guardar Feriado</button>
                                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="modal"
                                    aria-label="Close">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Permission Modal -->

        <!-- Edit Permission Modal -->
        <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body p-md-0">
                        <div class="text-center mb-4">
                            <h3 class="mb-2 pb-1">Edit Permission</h3>
                            <p>Edit permission as per your requirements.</p>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <h6 class="alert-heading mb-2">Warning</h6>
                            <p class="mb-0">By editing the permission name, you might break the system permissions
                                functionality. Please ensure you're absolutely certain before proceeding.</p>
                        </div>
                        <form id="editPermissionForm" class="row pt-2" onsubmit="return false">
                            <div class="col-sm-9 mb-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="editPermissionName" name="editPermissionName"
                                        class="form-control" placeholder="Permission Name" tabindex="-1">
                                    <label for="editPermissionName">Permission Name</label>
                                </div>
                            </div>
                            <div class="col-sm-3 mb-3">
                                <button type="submit" class="btn btn-primary mt-1 mt-sm-0">Update</button>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="editCorePermission">
                                    <label class="form-check-label" for="editCorePermission">
                                        Set as core permission
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Edit Permission Modal -->

        <!-- /Modal -->
    </div>
    <!-- Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/pages/holidays.js') }}"></script>
@endsection

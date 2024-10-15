@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Lista de Usuarios</h4>
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtro de búsqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4 user_role"></div>  
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="tbl-users table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasUser" aria-labelledby="offcanvasAddUserLabel">
            <div class="offcanvas-header">
                <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Usuario</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                <form class="add-new-user pt-0" id="UserForm">
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" class="form-control" id="add-user-fullname" name="fullname" placeholder="John Doe"
                            name="userFullname" aria-label="John Doe">
                        <label for="add-user-fullname">Nombres</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="add-user-email" name="UserEmail" class="form-control" placeholder="john.doe@example.com"
                            aria-label="john.doe@example.com" name="userEmail">
                        <label for="add-user-email">Email</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <input type="text" id="add-user-company" name="UserName" class="form-control" placeholder="Web Developer"
                            aria-label="jdoe1" name="companyName">
                        <label for="add-user-company">Usuario</label>
                    </div>
                    <div class="form-floating form-floating-outline mb-4">
                        <select id="user-role" name="UserRol" class="form-select">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        <label for="user-role">Roles</label>
                    </div>
                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
                </form>
            </div>
        </div>
    </div>

    </div>
    <!-- / Content -->

    <!-- Content -->
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script src="{{ asset('js/pages/users.js') }}"></script>
@endsection

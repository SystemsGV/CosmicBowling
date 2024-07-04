@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            Cupones
        </h4>

        <!-- Invoice List Widget -->

        <div class="card mb-4">
            <div class="card-widget-separator-wrapper">
                <div class="card-body card-widget-separator">
                    <div class="row gy-4 gy-sm-1">
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-1 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-1">24</h3>
                                    <p class="mb-0">Clients</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-account-outline text-heading mdi-20px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none me-4">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start card-widget-2 border-end pb-3 pb-sm-0">
                                <div>
                                    <h3 class="mb-1">165</h3>
                                    <p class="mb-0">Invoices</p>
                                </div>
                                <div class="avatar  me-lg-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-content-paste text-heading mdi-20px"></i>
                                    </span>
                                </div>
                            </div>
                            <hr class="d-none d-sm-block d-lg-none">
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div
                                class="d-flex justify-content-between align-items-start border-end pb-3 pb-sm-0 card-widget-3">
                                <div>
                                    <h3 class="mb-1">$2.46k</h3>
                                    <p class="mb-0">Paid</p>
                                </div>
                                <div class="avatar me-sm-4">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-currency-usd text-heading mdi-20px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="mb-1">$876</h3>
                                    <p class="mb-0">Unpaid</p>
                                </div>
                                <div class="avatar">
                                    <span class="avatar-initial rounded bg-label-secondary">
                                        <i class="mdi mdi-currency-usd-off text-heading mdi-20px"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice List Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="invoice-list-table table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Disponibles</th>
                            <th>Descuento</th>
                            <th>Cantidad</th>
                            <th class="text-truncate">Fecha Limite</th>
                            <th>Estado</th>
                            <th class="cell-fit">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>

    <!-- / Content -->

    <!-- Modal -->
    <div class="modal fade" id="coupon-modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body py-3 py-md-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2" id="titleModal">Crear Cupón</h3>
                    </div>
                    <form id="coupon-form" class="row g-4">
                        @csrf
                        <input type="hidden" name="idCoupon" id="idCoupon">
                        <div class="col-12 col-md-5">
                            <div class="form-floating form-floating-outline">
                                <select id="typeD" name="typeD" class="form-select select2"
                                    aria-label="Default select example">
                                    <option value="1" selected>Código promocional</option>
                                </select>
                                <label for="typeD">Selecciona tipo de descuento</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-7">
                            <div class="form-floating form-floating-outline">
                                <select id="subcategories" name="subcategories[]" class="select2 form-select"
                                    data-placeholder="Selecciona Subcategorias" multiple data-allow-clear="true">
                                    @foreach ($categories as $category)
                                        <optgroup label="{{ $category->name_category }}">
                                            @foreach ($category->subcategories as $subcategory)
                                                <option value="{{ $subcategory->id_subcategory }}">
                                                    {{ $subcategory->name_subcategory }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <label for="subcategories">Subcategorias</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="code" name="code" placeholder="">
                                    <label for="code">Código de cupón</label>
                                </div>
                                <span class="input-group-text cursor-pointer btn-codeCoupon"><i
                                        class="mdi mdi-sync"></i></span>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i
                                        class="mdi mdi-numeric-9-plus-box-multiple-outline"></i></span>

                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="quantity" name="quantity"
                                        placeholder="">
                                    <label for="quantity">Cantidad Cupones</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <select id="typeC" name="typeC" class="select2 form-select"
                                    data-allow-clear="true">
                                    <option value="percentage">Descuento Porcentual (%)</option>
                                    <option value="fixed">Precio Fijado (S/.)</option>
                                </select>
                                <label for="typeC">Selecciona Tipo Cupón</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text iconC"><i class="mdi mdi-percent"></i></span>

                                <div class="form-floating form-floating-outline">
                                    <input type="text" class="form-control" id="discount" name="discount"
                                        placeholder="" aria-describedby="discount">
                                    <label for="discount">Descuento</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="startDate" name="startDate"
                                    placeholder="Fecha inicio">
                                <label for="eventStartDate">Fecha Inicio</label>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating form-floating-outline">
                                <input type="text" class="form-control" id="endDate" name="endDate"
                                    placeholder="Fecha fin">
                                <label for="eventEndDate">Fecha Fin</label>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="form-floating form-floating-outline">
                                <textarea id="description" name="description" rows="3" class="form-control"></textarea>
                                <label for="description">Descripción</label>

                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Guardar</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/pages/coupon.js') }}"></script>
@endsection

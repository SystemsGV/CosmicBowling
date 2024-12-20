@extends('admin/layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Inventario /</span> Lista de Productos
        </h4>

        <!-- Product List Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Filter</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4 product_category"></div>
                    <div class="col-md-4 product_subcategory"></div>
                    <div class="col-md-4 product_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-products table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>image</th>
                            <th>producto</th>
                            <th>Categoria</th>
                            <th>SubCategoria</th>
                            <th>Precio Lun - Jue</th>
                            <th>Precio FDS </th>
                            <th>Limite</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!-- Add New Products Modal -->
            <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body p-md-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3 class="address-title mb-2 pb-1" id="titleModal"></h3>
                                <p class="address-subtitle" id="messageModal"></p>
                            </div>
                            <form id="productForm" class="row g-4" enctype="multipart/form-data">
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select id="category" name="category" class="select2 form-select"
                                            data-placeholder ="Selecciona Categoria" data-allow-clear="true">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value={{ $category['id'] }}> {{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                        <label for="modalAddressCountry">Categoria</label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <select id="subcategory" name="subcategory" class="select2 form-select"
                                            data-placeholder="Selecciona SubCategoria" data-allow-clear="true">
                                            <option value="">Select</option>
                                        </select>
                                        <label for="modalAddressCountry">Subcategoria</label>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text mdi mdi-parking"></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="product" name="product" class="form-control"
                                                placeholder="Pista Bowling 1">
                                            <label for="modalAddressAddress1">Nombre Producto</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating form-floating-outline">
                                        <input class="form-control" type="file" id="image" name="image">
                                        <label for="formValidationFile">Img Producto</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" data-i18n="Description">Descripcion</label>
                                    <div class="form-control p-0 pt-1">
                                        <div class="comment-editor border-0" id="description">
                                        </div>
                                        <div class="comment-toolbar border-0 rounded">
                                            <div class="d-flex justify-content-end">
                                                <span class="ql-formats me-0">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-list" value="ordered"></button>
                                                    <button class="ql-list" value="bullet"></button>
                                                    <button class="ql-link"></button>
                                                    <button class="ql-image"></button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text mdi mdi-cash-100"></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pricelj" name="pricelj" class="form-control"
                                                placeholder="00.00">
                                            <label for="price">Precio Lun - Jue</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text mdi mdi-cash-100"></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pricefds" name="pricefds" class="form-control"
                                                placeholder="00.00">
                                            <label for="price">Precio Fds</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text mdi mdi-numeric-9-plus-circle"> </span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="stock" name="stock" class="form-control"
                                                placeholder="0">
                                            <label for="stock">Stock</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text mdi mdi-account-group"></span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="limit" name="limit" class="form-control"
                                                placeholder="0">
                                            <label for="limit">Limite Personas</label>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="product_id" name="product_id">
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1 btn-send"></button>
                                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Add New Products Modal -->
        </div>

    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/quill/editor.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('js/pages/product.js') }}"></script>
@endsection

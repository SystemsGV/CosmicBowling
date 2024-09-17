@extends('frontend/layouts/app')

@section('content')
    <section class="container py-5 mt-5 mb-md-3 mb-lg-4 mb-xxl-5">
        <div class="text-center pb-3 pt-lg-2 pt-xl-4 my-1 my-sm-3 my-lg-4">
            <h1 class="display-2">Pago Denegado</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert d-flex alert-danger text-center" role="alert">
                <i class="ai-circle-x fs-xl pe-1 me-2"></i>
                <div>Lo sentimos, su pago no ha podido ser procesado. Por favor, intente nuevamente o póngase en contacto
                    con nuestro servicio de atención al cliente para recibir ayuda.</div>
            </div>
        </div>
        <div class="table-responsive pt-sm-2 pt-lg-3">
            <table class="table text-nowrap">
                <tbody>
                    <tr>
                        <th scope="row" class="border-0 bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="text-body fw-medium">Número de Reserva</span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $purchaseNumber }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td scope="row" class="border-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Nombre y Apellido
                            </span>
                        </td>
                        <td class="border-0 py-3"><span class="text-dark">{{ $names }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Código de Error
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $actionCode }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Motivo
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $errorMessage }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </section>

@endsection()

@section('styles')


@section('scripts')

@endsection

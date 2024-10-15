@extends('frontend/layouts/app')

@section('content')
    <section class="container py-5 mt-5 mb-md-3 mb-lg-4 mb-xxl-5">
        <div class="text-center pb-3 pt-lg-2 pt-xl-4 my-1 my-sm-3 my-lg-4">
            <h1 class="display-2">Información del Pago</h1>
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert d-flex alert-success text-center" role="alert">
                <i class="ai-circle-check-filled fs-xl pe-1 me-2"></i>
                <div>El pago de la reserva se realizó de forma exitosa. En breve le estará llegando un mail con la
                    confirmación de la reserva.</div>
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
                                Nombre y Apellidos
                            </span>
                        </td>
                        <td class="border-0 py-3"><span class="text-dark">{{ $names }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Descripción de la Reserva
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $description }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Cantidad de Integrantes
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 py-3"><span
                                class="text-dark">{{ $guests }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0  bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Fecha y Hora de la Reserva
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $formattedDateTime }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Tarjeta
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0  py-3"><span
                                class="text-dark">{{ $card }}</span></td>
                    </tr>
                    <tr>
                        <th scope="row" class="border-0 bg-secondary rounded-3 rounded-end-0 text-start py-3 ps-4">
                            <span class="d-flex align-items-center text-body fw-medium">
                                Importe Pagado
                            </span>
                        </th>
                        <td class="border-0 rounded-3 rounded-start-0 bg-secondary py-3"><span
                                class="text-dark">{{ $amount }} Soles</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <a href="{{ url('/') }}" class="btn btn-primary mt-4">Regresar al Inicio</a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

    </section>

@endsection()

@section('styles')


@section('scripts')

@endsection

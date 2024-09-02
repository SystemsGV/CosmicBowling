@extends('frontend/layouts/app')

@section('content')
    <section class="container py-5 mt-5 mb-md-3 mb-lg-4 mb-xxl-5">

        <h2> {{ $token }}</h2>
        <h2> {{ $transaction }}</h2>
        <h2> {{ $purchaseNumber }}</h2>
        <h2> {{ $description }}</h2>
        <h2> {{ $quantity }}</h2>

        
    </section>

@endsection()

@section('styles')


@section('scripts')

@endsection

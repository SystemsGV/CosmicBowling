@extends('frontend/layouts/app')

@section('content')

@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/vendor/flatpickr/dist/flatpickr.min.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('frontend/vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('frontend/vendor/flatpickr/lang/es.js') }}"></script>
    <script src="{{ asset('frontend/js/pages/cart.js') }}"></script>
@endsection

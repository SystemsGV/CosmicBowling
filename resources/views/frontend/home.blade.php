@extends('frontend/layouts/app')

@section('content')
    <!-- Hero -->
    <section class="position-relative pt-sm-3 pt-md-5 mb-xl-3 mb-xxl-5">
        <div class="position-absolute top-0 end-0 overflow-hidden mt-n5 mt-md-0">
            <svg class="d-block mt-n5 mt-md-0 me-md-n5 me-xxl-0" width="1207" height="894" viewbox="0 0 1207 894"
                fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: var(--ar-gray-100);">
                <circle cx="639" cy="255" r="639"></circle>
            </svg>

        </div>
        <div class="container pt-5 pb-lg-4 pb-xl-5 mt-5">
            <div class="row pt-xl-4">

                <!-- Sticky image -->
                <div class="col-md-5 col-lg-6 offset-xxl-1 order-md-2 position-relative mb-3 mb-md-0"
                    style="margin-top: -115px;">
                    <div class="d-none d-md-block position-absolute bottom-0 end-0 text-uppercase fw-bold lh-1 pb-5 mb-4 pe-3"
                        style="color: var(--ar-gray-100); font-size: 180px; transform: translate3d(0,0,0);">
                        <div class="d-flex mb-lg-3" style="padding-left: 160px;">
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="150">C
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="200">O
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="250">S
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="300">M
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="350">I
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="400" data-aos-delay="400">C
                            </div>
                        </div>
                        <div class="d-flex">
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="150">B
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="200">O
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="250">W
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="300">L
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="350">I
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="350">N
                            </div>
                            <div data-aos="flip-right" data-aos-duration="700" data-aos-offset="300" data-aos-delay="350">G
                            </div>
                        </div>
                    </div>
                    <div class="position-sticky z-3 top-0" style="padding-top: 115px;">
                        <div class="px-5 px-md-0 ps-xl-5 ms-lg-3">
                            <img src="{{ asset('frontend/img/app-icons/logo.svg') }}" width="695"
                                alt="Descripción del SVG">
                        </div>
                    </div>
                </div>

                <!-- Text -->
                <div
                    class="col-md-7 col-lg-6 col-xxl-5 order-md-1 position-relative z-3 text-center text-md-start pb-sm-3 pb-md-5 pt-4 mb-md-5 mt-2">
                    <h1 class="display-3 text-uppercase mb-sm-4" style="line-height: 1.1">
                        <span class="fw-bold">¡ QUE COMIENCEN</span>
                        <span class="text-primary fw-bold">LAS CHUZAS !</span>
                    </h1>
                    <div class="mx-auto mx-md-0" style="max-width: 400px;">
                        <p class="pb-2 pb-lg-0 mb-4">¿Buscas un plan de otro planeta?</p>
                        <p class="pb-2 pb-lg-0 mb-4">Juega boliche en un ambiente glow, con música moderna
                            y mucha, pero mucha buena vibra.</p>
                        <p class="pb-2 pb-lg-0 mb-4 mb-lg-5">Tenemos más 20 de pistas, mesas de billar, juegos arcade,
                            salón, snacks y bebidas alucinantes.
                        </p>
                        <a class="btn btn-primary" href="#reserva-section">RESERVA AQUÍ</a>
                        <div class="d-none d-xxl-block" style="height: 290px;"></div>
                        <div class="d-none d-md-block d-xxl-none" style="height: 240px;"></div>
                        <div class="d-md-none" style="height: 50px;"></div>
                        <div data-aos="fade-up" data-aos-duration="800" data-aos-offset="250"
                            data-disable-parallax-down="md">
                            <h2 class="h1 pb-sm-2 pb-md-3">
                                Reserva tu evento y marca la diferencia
                            </h2>
                            <p>Somos especialistas en diversión
                                para:</p>
                            <p class="sin-salto">Fiestas de cumpleaños</p>
                            <p class="sin-salto">Eventos corporativos</p>
                            <p>Paseos escolares</p>
                            <a class="btn btn-primary" href=" https://wa.link/igugmb" target="_blank">Quiero
                                Información</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container pt-5 pb-lg-5 pb-md-4 pb-2 my-5" id="reserva-section">
        @foreach ($categories as $category)
            <!-- Blog grid (masonry) -->
            <div class="row align-items-center text-center gy-2 mb-4 pb-1 pb-sm-2 pb-lg-3">
                <div class="col-lg-12">
                    <h1 class="mb-lg-0">{{ $category->name_category }}</h1>
                    <p class="fs-lg text-center pb-3 pb-lg-0">Máximo
                        {{ $category->id_category == 1 ? '5 personas por pista' : '3 personas por mesa' }}</p>
                </div>
            </div>

            <div class="category-section mb-5">
                <div class="masonry-grid mb-2 mb-md-4 pb-lg-3" data-columns="3">
                    @foreach ($category->subcategories as $subcategory)
                        <article class="masonry-grid-item">
                            <div class="card border-0 bg-primary text-center">
                                <a href="{{ url('Carrito/' . $subcategory->formatted_name) }}">
                                    <img class="card-img-top"
                                        src="{{ asset('storage/subcategory/' . $subcategory->img_subcategory) }}"
                                        alt="{{ $subcategory->name_subcategory }}">
                                </a>
                                <div class="card-body pb-4 text-white">
                                    <h3 class="h3 card-title">
                                        <a class="fw-bold text-white"
                                            href="{{ url('Carrito/' . $subcategory->formatted_name) }}">
                                            {{ $subcategory->name_subcategory }}
                                        </a>
                                    </h3>
                                    {!! $subcategory->descr_subcategory !!}
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    </main>
@endsection()

@section('styles')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .sin-salto {
            margin: 1px 0;
        }
    </style>
@endsection()

@section('scripts')
@endsection

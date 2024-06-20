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
                            <img class="d-block mx-auto mx-md-0" src="{{ asset('frontend/images/logo.png') }}"
                                width="465" alt="Headphones">
                        </div>
                    </div>
                </div>

                <!-- Text -->
                <div
                    class="col-md-7 col-lg-6 col-xxl-5 order-md-1 position-relative z-3 text-center text-md-start pb-sm-3 pb-md-5 pt-4 mb-md-5 mt-2">
                    <h1 class="display-3 text-uppercase mb-sm-4">
                        <span class="fw-medium">Choose only </span>
                        <span class="text-info fw-bold">high quality sound</span>
                        <img class="d-none d-xl-inline-block align-middle ms-3"
                            src="{{ asset('frontend/img/landing/product/soundwave.svg') }}" width="200" alt="Sound wave">
                    </h1>
                    <div class="mx-auto mx-md-0" style="max-width: 400px;">
                        <p class="pb-2 pb-lg-0 mb-4 mb-lg-5">Now you can fully hear every detail and experience
                            superior sound with a wide soundstage with deep tight bass that will surprise you.</p>
                        <a class="btn btn-outline-dark" href="#">Support us on Kickstarter</a>
                        <div
                            class="d-flex justify-content-center justify-content-md-between pt-4 pt-sm-5 mt-2 mt-sm-0 mt-lg-4 mt-xl-5 ms-md-n3">
                            <div class="px-3">
                                <div class="h4 mb-1">60-200 Hz</div>
                                <div class="fs-sm">frequency range</div>
                            </div>
                            <div class="px-3">
                                <div class="h4 mb-1">0.75 kg</div>
                                <div class="fs-sm">weight, kg</div>
                            </div>
                            <div class="px-3">
                                <div class="h4 mb-1">60 h</div>
                                <div class="fs-sm">working hours</div>
                            </div>
                        </div>
                        <div class="d-none d-xxl-block" style="height: 290px;"></div>
                        <div class="d-none d-md-block d-xxl-none" style="height: 240px;"></div>
                        <div class="d-md-none" style="height: 50px;"></div>
                        <div data-aos="fade-up" data-aos-duration="800" data-aos-offset="250"
                            data-disable-parallax-down="md">
                            <h2 class="h1 pb-sm-2 pb-md-3">You can take the music anywhere in posuere the music
                            </h2>
                            <p>Turpis nullam netus sed aliquam consectetur at felis consequat tincidunt orci varius
                                arcu urna neque eget maecenas consequat lacus habitasse adipiscing in.</p>
                            <a class="btn btn-link text-dark px-0" href="#">
                                Read more
                                <i class="ai-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container pt-5 pb-lg-5 pb-md-4 pb-2 my-5">
        @foreach ($categories as $category)
            <!-- Blog grid (masonry) -->
            <div class="row align-items-center text-center gy-2 mb-4 pb-1 pb-sm-2 pb-lg-3">
                <div class="col-lg-12">
                    <h1 class="mb-lg-0">{{ $category->name_category }}</h1>
                </div>
            </div>

            <div class="category-section mb-5">
                <div class="masonry-grid mb-2 mb-md-4 pb-lg-3" data-columns="3">
                    @foreach ($category->subcategories as $subcategory)
                        <article class="masonry-grid-item">
                            <div class="card border-0 bg-secondary">
                                <a href="{{ url('Carrito/' . $subcategory->formatted_name) }}">
                                    <img class="card-img-top"
                                        src="{{ asset('storage/subcategory/' . $subcategory->img_subcategory) }}"
                                        alt="{{ $subcategory->name_subcategory }}">
                                </a>
                                <div class="card-body pb-4">
                                    <h3 class="h4 card-title">
                                        <a href="{{ url('Carrito/' . $subcategory->formatted_name) }}">
                                            {{ $subcategory->name_subcategory }}
                                        </a>
                                    </h3>
                                    <p class="card-text">{{ $subcategory->descr_subcategory }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endforeach

        </main>
    @endsection()

    @section('styles')
    @endsection()

    @section('scripts')
    @endsection

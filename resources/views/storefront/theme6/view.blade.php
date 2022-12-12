@extends('storefront.layout.theme6')

@section('page-title')
    {{ __('Home') }}
@endsection

@push('css-page')
@endpush

@section('content')

    <section class="product-section pt-3">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="product-slider">
                        <div class="carousel-container position-relative row ">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                                <div class="carousel-inner">
                                    @foreach ($products_image as $key => $productss)
                                        <div class="carousel-item  {{ $key == 0 ? 'active' : '' }}"
                                            data-slide-number="{{ $key }}">
                                            @if (!empty($products_image[$key]->product_images))
                                                <img src="{{ asset(Storage::url('uploads/product_image/' . $products_image[$key]->product_images)) }}"
                                                    class="d-block w-100" alt="..."
                                                    data-remote="{{ asset(Storage::url('uploads/product_image/' . $products_image[$key]->product_images)) }}"
                                                    data-type="image" data-toggle="lightbox"
                                                    data-gallery="example-gallery">
                                            @else
                                                <img src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                    class="d-block w-100" alt="..."
                                                    data-remote="{{ asset(Storage::url('uploads/product_image/' . $products_image[$key]->product_images)) }}"
                                                    data-type="image" data-toggle="lightbox"
                                                    data-gallery="example-gallery">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Carousel Navigation -->
                            <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <div class="row">
                                            @foreach ($products_image as $key => $productss)
                                                <div id="carousel-selector-{{ $key }}"
                                                    class="thumb col-lg-4 col-sm-4 col-4 px-1 py-2 "
                                                    data-target="#myCarousel" data-slide-to="{{ $key }}">
                                                    @if (!empty($products_image[$key]->product_images))
                                                        <img src="{{ asset(Storage::url('uploads/product_image/' . $products_image[$key]->product_images)) }}"
                                                            class="img-fluid" alt="...">
                                                    @else
                                                        <img src="{{ asset(Storage::url('uploads/product_image/default.jpg')) }}"
                                                            class="img-fluid" alt="...">
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carousel-thumbs" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel-thumbs" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div> <!-- /row -->
                    </div> <!-- /container -->
                </div>

                <div class="col-lg-5 pl-lg-5">
                    @foreach ($product_ratings as $product_key => $product_rating)
                        @if ($product_rating->rating_view == 'on')
                            <div class="pd-rate">
                                <div class="p-rateing d-flex">
                                    <span class="static-rating static-rating-sm d-block">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i
                                                class="star fas fa-star {{ $product_rating->ratting > $i ? 'text-primary' : '' }}"></i>
                                        @endfor
                                    </span>
                                    <p class="mb-0 ml-3"><span class="font-size-12 text-secondary"> {{ $avg_rating }}/5
                                            ({{ $user_count }} {{ __('reviews') }})
                                        </span></p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <p class="font-size-12 mt-3 mb-2 text-secondary">Category: {{ $product_categorie }}</p>
                    <!-- Product title -->
                    <h2 class="product-title font-weight-500 text-secondary mb-0">{{ $products->name }}</h2>
                    {{-- <h2 class="font-weight-400 text-secondary mb-3">with orange petals</h2> --}}
                    <p class="font-size-12 product-detail text-secondary">
                        {!! $products->detail !!}
                    </p>

                    <div class="row">
                        @if ($products->enable_product_variant == 'on')
                            <input type="hidden" id="product_id" value="{{ $products->id }}">
                            <input type="hidden" id="variant_id" value="">
                            <input type="hidden" id="variant_qty" value="">
                            <div class="col-md-5">
                                <p class="mb-0">VARIATION:</p>
                                @foreach ($product_variant_names as $key => $variant)
                                    <div class="dropdown w-100">
                                        <p class="mb-0">{{ $variant->variant_name }}</p>
                                        <select name="product[{{ $key }}]" id="pro_variants_name"
                                            class="btn btn-outline-secondary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-0 w-100 variant-selection  pro_variants_name{{ $key }}">
                                            <option value=""> {{ __('Select') }}</option>
                                            @foreach ($variant->variant_options as $key => $values)
                                                <option value="{{ $values }}">{{ $values }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <button
                                            class="btn btn-outline-secondary d-flex font-size-12 font-weight-400 justify-content-between px-3 rounded-0 w-100"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            1 Cup (10x10cm)
                                            <span>
                                                <svg width="5" height="5" viewBox="0 0 5 5" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2 0.499979C2 0.223848 2.22386 0 2.5 0C2.77614 0 3 0.223848 3 0.499979V3.29296L4.14645 2.14657C4.34171 1.95131 4.65829 1.95131 4.85355 2.14657C5.04882 2.34182 5.04882 2.65839 4.85355 2.85364L2.85355 4.85356C2.75979 4.94732 2.63261 5 2.5 5C2.36739 5 2.24021 4.94732 2.14645 4.85356L0.146447 2.85364C-0.0488156 2.65839 -0.0488156 2.34182 0.146447 2.14657C0.341709 1.95131 0.658292 1.95131 0.853554 2.14657L2 3.29296V0.499979Z"
                                                        fill="#615144" />
                                                </svg>
                                            </span>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-secondary font-size-12" href="#">1 Cup
                                                (10x10cm)</a>
                                            <a class="dropdown-item text-secondary font-size-12" href="#">1 Cup
                                                (10x10cm)</a>
                                            <a class="dropdown-item text-secondary font-size-12" href="#">1 Cup
                                                (10x10cm)</a>
                                        </div> --}}
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="product-price mb-4">
                        <span class="mb-0 p-price text-secondary variation_price">
                            @if ($products->enable_product_variant == 'on')
                                {{ \App\Models\Utility::priceFormat(0) }}
                            @else
                                {{ \App\Models\Utility::priceFormat($products->price) }}
                            @endif
                            {{-- <sub class="bottom-0 text-lg">USD</sub> --}}
                        </span>
                        <span class="mb-0 sub-price ml-4">
                            {{ \App\Models\Utility::priceFormat($products->last_price) }}
                            {{-- <sub class="bottom-0 font-size-12">USD</sub> --}}
                        </span>
                    </div>
                    <a href="#"
                        class="btn btn-block btn-primary font-size-12 py-4 rounded-0 text-underline add_to_cart"
                        data-id="{{ $products->id }}">
                        {{ __('Add to cart') }}
                    </a>
                    <div class="mt-4 d-flex cart-buttons">
                        <p class="mb-0 font-size-12 text-secondary mr-5">CATEGORY: {{ $product_categorie }}</p>
                        <p class="mb-0 font-size-12 text-secondary ">SKU: {{ $products->SKU }}</p>
                    </div>
                    @if (!empty($products->custom_field_1) && !empty($products->custom_value_1))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_1 }} : </span>
                                {{ $products->custom_value_1 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_2) && !empty($products->custom_value_2))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_2 }} : </span>
                                {{ $products->custom_value_2 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_3) && !empty($products->custom_value_3))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_3 }} : </span>
                                {{ $products->custom_value_3 }}</div>
                        </div>
                    @endif
                    @if (!empty($products->custom_field_4) && !empty($products->custom_value_4))
                        <div class="cart-buttons">
                            <div class="mb-0 t-black14"><span class="t-gray">{{ $products->custom_field_4 }} : </span>
                                {{ $products->custom_value_4 }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="image-with-text position-relative mt-5">
        <div class="container py-5 py-md-0">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="col-md-2 col-4 px-0 mb-4">
                    <h4 class="col-lg-10 col-xl-9 font-weight-300 px-0 text-secondary mb-3 ls-1"><span
                            class="font-weight-500">There is only that moment and the incredible certainty that</span>
                        everything under the sun has been written by one hand only.</h4>
                    <p class="font-size-12 col-md-10 col-xl-9 px-0 font-weight-300 text-secondary mb-5 mb-md-3 mb-xl-5">
                        There is only that moment and the incredible certainty that everything under the sun has been
                        written by one hand only.</p>
                    <a href="#" class="btn btn-primary rounded-0 px-5">CHECK OUT OUR TEA</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 px-0 ml-auto position-relative">
            <img src="{{ asset('assets/theme6/img/img01.jpg') }}" class="img-fluid">
        </div>
    </section> --}}


    <!-- Testimonials (v1) -->
    {{-- <section class="slice testimonial-section">
        <div class="container">
            <div class="row testimonial-slider">
                <div class="col-lg-12">
                    <div class="swiper-js-container overflow-hidden">

                        <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                            data-swiper-sm-items="2" data-swiper-xl-items="3">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="swiper-slide p-3">
                                    <div class="border-0 card rounded-0 shadow-none text-center bg-transparent">
                                        <div class="card-body pb-0">
                                            <div class="message position-relative">
                                                <span class="starting">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0 7.61497C0 8.77005 0.855615 9.62567 2.05348 9.62567C3.5508 9.62567 4.96257 8.25668 4.96257 6.75936C4.96257 5.7754 4.32086 5.04813 3.59358 4.83423L6.20321 0H3.93583L0.385027 6.28877C0.171123 6.6738 0 7.14438 0 7.61497ZM7.27273 7.61497C7.27273 8.77005 8.12834 9.62567 9.3262 9.62567C10.8235 9.62567 12.2353 8.25668 12.2353 6.75936C12.2353 5.7754 11.5936 5.04813 10.8663 4.83423L13.4759 0H11.2086L7.65775 6.28877C7.44385 6.6738 7.27273 7.14438 7.27273 7.61497Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                                <p class="font-italic t-dcs text-secondary">There is only that moment
                                                    and the incredible certainty that everything under the sun has been
                                                    written by one hand only.</p>
                                                <span class="closing">
                                                    <svg width="14" height="10" viewBox="0 0 14 10"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M0.507812 7.73216C0.507812 8.88724 1.36343 9.74286 2.56129 9.74286C4.05861 9.74286 5.47038 8.37387 5.47038 6.87654C5.47038 5.89259 4.82867 5.16532 4.1014 4.95141L6.71102 0.117188H4.44364L0.892839 6.40596C0.678936 6.79098 0.507812 7.26157 0.507812 7.73216ZM7.78054 7.73216C7.78054 8.88724 8.63616 9.74286 9.83402 9.74286C11.3313 9.74286 12.7431 8.37387 12.7431 6.87654C12.7431 5.89259 12.1014 5.16532 11.3741 4.95141L13.9837 0.117188H11.7164L8.16557 6.40596C7.95166 6.79098 7.78054 7.26157 7.78054 7.73216Z"
                                                            fill="#615144" />
                                                    </svg>
                                                </span>
                                            </div>

                                            <div>
                                                <img alt="Image placeholder"
                                                    src="{{ asset('assets/theme6/img/logo-brown.png') }}" class="w-25">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination w-100 mt-4 d-flex align-items-center justify-content-center">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}


    <section class="product-details">

        <div class="container">
            <hr class="mb-0 border-secondary">
            <div class="row">
                <div class="border-right border-secondary col-md-6 pr-md-0 order-2 order-md-1">
                    <div class="customer-product-review pr-4 py-4  border-secondary">
                        <div class="review-title mb-2 mt-0">
                            <h5 class="font-weight-400 text-secondary">
                                <span class="r-title">
                                    {{ $avg_rating }}/5
                                </span>
                                <span class="h6 font-weight-500 text-secondary">
                                    ({{ $user_count }} {{ __('reviews') }})
                                </span>
                            </h5>
                        </div>

                        <div class="pd-rate">
                            <div class="p-rateing d-flex">
                                <span class="static-rating static-rating-sm d-block">
                                    @if ($store_setting->enable_rating == 'on')
                                        @for ($i = 1; $i <= 5; $i++)
                                            @php
                                                $icon = 'fa-star';
                                                $color = '';
                                                $newVal1 = $i - 0.5;
                                                if ($avg_rating < $i && $avg_rating >= $newVal1) {
                                                    $icon = 'fa-star-half-alt';
                                                }
                                                if ($avg_rating >= $newVal1) {
                                                    $color = 'text-primary';
                                                }
                                            @endphp
                                            <i class="star fas {{ $icon . ' ' . $color }}"></i>
                                        @endfor
                                    @endif
                                </span>
                                <p class="mb-0 ml-3 font-size-12 text-secondary"> {{ $avg_rating }}/5
                                    ({{ $user_count }} {{ __('reviews') }})</p>
                            </div>

                        </div>
                        <!-- Product title -->
                        @if (!empty($product_rating))
                            <p class="font-italic font-size-12 mb-0 mt-2 product-detail text-secondary">
                                {{ $product_rating->description }}
                            </p>
                            <div class="mt-2">
                                <p class="mb-0 align-items-center d-flex mb-0 text-secondary font-size-12">
                                    <span class="avatar avatar-sm bg-secondary rounded-pill mr-3">
                                    </span>
                                    <b>{{ $product_rating->name }} :</b>
                                    {{ $product_rating->title }}
                                </p>
                            </div>
                        @endif
                    </div>

                </div>

                <div class="col-md-6 pt-4 pl-md-5 order-1 order-md-2">

                    {{-- @if (!empty($products->description))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('DESCRIPTION')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->description !!}
                        </p>
                    @endif

                    @if (!empty($products->specification))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('SPECIFICATION')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->specification !!}
                        </p>
                    @endif

                    @if (!empty($products->detail))
                        <h4 class="font-weight-400 text-secondary mb-4"> {{__('DETAILS')}}</h4>
                        <p class="font-size-12 text-secondary mb-4">
                            {!! $products->detail !!}
                        </p>
                    @endif --}}
                    @if (!empty($products->description))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" href="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne" class="productdesc">
                                        {{ __('DESCRIPTION') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                <div class="card-body">
                                    {!! $products->description !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($products->specification))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingTwo">
                                <h5 class="mb-0">
                                    <a class="collapsed productdesc" data-toggle="collapse" href="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        {{ __('SPECIFICATION') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="card-body">
                                    {!! $products->specification !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if (!empty($products->detail))
                        <div class="card">
                            <div class="card-header" role="tab" id="headingThree">
                                <h5 class="mb-0">
                                    <a class="collapsed productdesc" data-toggle="collapse" href="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        {{ __('DETAILS') }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="card-body">
                                    {!! $products->detail !!}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>


            </div>
            <hr class="border-secondary mt-0">

        </div>

    </section>


    <!-- Products -->
    <section class="bestsellers-section pb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-7 mb-4 pr-title">
                    <h4 class="font-weight-300 mt-4 text-secondary">Related Products</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-lg-12 px-0 swiper-js-container">
                    <div class="swiper-container" data-swiper-items="1" data-swiper-space-between="0"
                        data-swiper-sm-items="2" data-swiper-xl-items="4" data-swiper-slidesOffsetBefore="500">
                        <div class="swiper-wrapper">
                            @foreach ($all_products as $key => $product)
                                @if ($product->id != $products->id)
                                    <div class="col-lg-4 col-sm-6 product-box swiper-slide">
                                        <div class="border-0 card card-product rounded-0">
                                            <div
                                                class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                <span
                                                    class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">Bestseller</span>
                                                {{-- <button type="button" class="bg-transparent border-0 p-0" data-toggle="tooltip"
                                            data-original-title="Wishlist">
                                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.0544 19.4845C13.6446 19.4831 13.2771 19.2318 13.1272 18.8504C12.9773 18.4689 13.0753 18.0346 13.3744 17.7545C17.1344 14.2545 19.5944 10.7545 20.1344 8.03453C20.4667 5.75176 19.3678 3.49828 17.3644 2.35453C15.6444 1.51453 13.6944 2.22453 11.8744 4.35453L9.87444 6.58453C9.50717 6.99874 8.87365 7.0368 8.45944 6.66953C8.04523 6.30226 8.00717 5.66874 8.37444 5.25453L10.3744 3.03453C13.8144 -0.96547 17.0244 -0.0254695 18.2444 0.56453C21.0759 2.09811 22.6251 5.25685 22.1044 8.43453C21.2644 12.6545 17.1044 17.0045 14.7444 19.2245C14.556 19.3959 14.3092 19.4889 14.0544 19.4845ZM11.9143 21.5547C12.2457 21.1129 12.1561 20.4861 11.7143 20.1547C8.31431 17.6047 2.94431 12.2747 2.09431 8.03473C1.8014 6.06461 2.55997 4.08475 4.09431 2.81473C5.16781 1.91299 6.67758 1.74349 7.92431 2.38473C8.42187 2.60712 9.00587 2.39015 9.23754 1.89685C9.4692 1.40354 9.2632 0.815577 8.77431 0.574727C6.84232 -0.385391 4.52741 -0.12731 2.85431 1.23473C0.717456 2.96735 -0.334316 5.7073 0.094313 8.42473C1.09431 13.5847 7.33431 19.4247 10.4743 21.7547C10.9161 22.0861 11.5429 21.9966 11.8743 21.5547H11.9143Z"
                                                    fill="#616161" />
                                            </svg>
                                        </button> --}}
                                                @if (Auth::guard('customers')->check())
                                                    @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                        @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                            <button type="button"
                                                                class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @else
                                                            <button type="button" class="action-item wishlist-icon"
                                                                data-id="{{ $product->id }}" disabled>
                                                                <i class="fas fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button type="button"
                                                            class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <button type="button"
                                                        class="action-item wishlist-icon add_to_wishlist wishlist_{{ $product->id }}"
                                                        data-id="{{ $product->id }}">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                @endif
                                            </div>
                                            <div class="card-image col-6 mx-auto pt-5 pb-4">
                                                <a
                                                    href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                    @if (!empty($product->is_cover) && \Storage::exists('uploads/is_cover_image/' . $product->is_cover))
                                                        <img alt="Image placeholder"
                                                            src="{{ asset(Storage::url('uploads/is_cover_image/' . $product->is_cover)) }}"
                                                            class="img-center img-fluid">
                                                    @else
                                                        <img alt="Image placeholder"
                                                            src="{{ asset(Storage::url('uploads/is_cover_image/default.jpg')) }}"
                                                            class="img-center img-fluid">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="card-body pt-0 text-center">
                                                <h6 class="mb-3">
                                                    {{-- <span class="d-block">
                                                APPLE TEA
                                            </span> --}}
                                                    <a class="t-black13"
                                                        href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}">
                                                        {{ $product->name }}</a>
                                                </h6>
                                                <span class="card-price mb-4">
                                                    @if ($product->enable_product_variant == 'on')
                                                        {{ __('In variant') }}
                                                    @else
                                                        {{ \App\Models\Utility::priceFormat($product->price) }}
                                                    @endif
                                                </span>
                                                {{-- <button type="button"
                                            class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                            {{__('ADD TO CART')}}</button> --}}
                                                @if ($product->enable_product_variant == 'on')
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                        {{ __('Add To Cart') }}

                                                    </a>
                                                @else
                                                    <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                        class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline"
                                                        data-id="{{ $product->id }}">
                                                        {{ __('Add To Cart') }}

                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <!-- Add Arrow -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

        </div>

    </section>
@endsection

@push('script-page')
    <script>
        $(document).on('change', '#pro_variants_name', function() {
            var variants = [];
            $(".variant-selection").each(function(index, element) {
                variants.push(element.value);
            });
            if (variants.length > 0) {

                $.ajax({
                    url: '{{ route('get.products.variant.quantity') }}',
                    data: {
                        "_token": $('meta[name="csrf-token"]').attr('content'),
                        variants: variants.join(' : '),
                        product_id: $('#product_id').val()
                    },

                    success: function(data) {
                        $('.variation_price').html(data.price);
                        $('#variant_id').val(data.variant_id);
                        $('#variant_qty').val(data.quantity);
                    }
                });
            }
        });
    </script>
@endpush

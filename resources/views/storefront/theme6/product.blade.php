@extends('storefront.layout.theme6')
@section('page-title')
    {{ __('Home') }}
@endsection
@push('css-page')
@endpush
@section('content')
{{-- @DD($products['Start shopping']) --}}

    <section class="my-cart-section pt-5 mb-5">
        @if ($products['Start shopping']->count() > 0)
            <div class="container">
                <!-- Shopping cart table -->
                <div class="row align-items-center">
                    <div class="col-md-12 col-lg-2">
                        <h3 class="font-weight-400 m-md-0 text-secondary">Product</h3>
                    </div>
                    <div class="col-md-12 col-lg-10">
                        <div class="nav nav-tabs nav-fill border-0 justify-content-end" id="nav-tab" role="tablist">
                            <div class="product-tab d-flex border border-secondary no-gutters">
                                <ul class="tabs" role="tablist" id="myTab">
                                    @php unset($categories[0]); @endphp
                                    @foreach ($categories as $key => $category)
                                        <li class="{{($category==$categorie_name)?'active':''}} product-tab-main">
                                            <a href="#{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $category) !!}" data-id="{{ $key }}"
                                                class="  tab-a border-0 btn btn-block text-secondary m-0 rounded-0 productTab"
                                                id="electronic-tab" data-toggle="tab" role="tab"
                                                aria-controls="home" aria-selected="false">
                                                {{ __($category) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content theme6 py-3 px-3 px-sm-0 tabs-container " id="nav-tabContent">

                    {{-- @php unset($products['Start shopping']); @endphp --}}
                    @foreach ($products as $key => $items)
                        <div
                        class="tab-content pro-cards {{($key==$categorie_name)?'active show':''}}"
                            id="{!! preg_replace('/[^A-Za-z0-9\-]/', '_', $key) !!}" role="tabpanel" aria-labelledby="shopping-tab">
                            {{-- @foreach ($theme6_product_random as $k => $random) --}}
                            <div class="row">
                                @foreach ($items as $key => $product)

                                        <div class="col-lg-3 col-sm-6 product-box d-flex">
                                            <div class="border-0 bg-white card card-product rounded-0 w-100">
                                                <div
                                                    class="align-items-center border-0 card-header d-flex justify-content-between p-0 pt-4 pr-3">
                                                    <span
                                                        class="badge badge-secondary font-size-12 font-weight-300 ls-1 px-4 py-3 text-uppercase rounded-0">{{ __('Bestseller') }}</span>

                                                    @if (Auth::guard('customers')->check())
                                                        @if (!empty($wishlist) && isset($wishlist[$product->id]['product_id']))
                                                            @if ($wishlist[$product->id]['product_id'] != $product->id)
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                    data-id="{{ $product->id }}">
                                                                    <i class="far fa-heart"></i>
                                                                </button>
                                                            @else
                                                                <button data-toggle="tooltip"
                                                                    data-original-title="Wishlist" type="button"
                                                                    class="bg-transparent border-0 p-0 "
                                                                    data-id="{{ $product->id }}" disabled>
                                                                    <i class="fas fa-heart"></i>
                                                                </button>
                                                            @endif
                                                        @else
                                                            <button data-toggle="tooltip" data-original-title="Wishlist"
                                                                type="button"
                                                                class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                                data-id="{{ $product->id }}">
                                                                <i class="far fa-heart"></i>
                                                            </button>
                                                        @endif
                                                    @else
                                                        <button data-toggle="tooltip" data-original-title="Wishlist"
                                                            type="button"
                                                            class="bg-transparent border-0 p-0  add_to_wishlist wishlist_{{ $product->id }}"
                                                            data-id="{{ $product->id }}">
                                                            <i class="far fa-heart"></i>
                                                        </button>
                                                    @endif
                                                </div>
                                                <div
                                                    class="card-image col-6 mx-auto pt-5 pb-4 d-flex justify-content-center align-items-center">

                                                    <a
                                                    href="{{route('store.product.product_view',[$store->slug,$product->id])}}">
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
                                                    <h6 class="mb-3"><span class="d-block">{{ $product->name }}</span>

                                                    </h6>
                                                    <p class="text-sm">
                                                        <span class="td-gray">{{ __('Category') }}:</span>
                                                        {{ $product->product_category() }}
                                                    </p>
                                                    <span class="card-price mb-4">
                                                        @if ($product->enable_product_variant == 'on')
                                                            {{ __('In variant') }}
                                                        @else
                                                            {{ \App\Models\Utility::priceFormat($product->price) }}
                                                        @endif
                                                    </span>

                                                    @if ($product->enable_product_variant == 'on')
                                                        <a href="{{ route('store.product.product_view', [$store->slug, $product->id]) }}"
                                                            class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline">
                                                            {{ __('ADD TO CART') }}
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)"
                                                            class="border-0 btn btn-block btn-secondary pcart-icon py-4 rounded-0 text-underline add_to_cart"
                                                            data-id="{{ $product->id }}">
                                                            {{ __('ADD TO CART') }}
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
@endsection
@push('script-page')
    <script>
        $(document).ready(function() {
            @if($categorie_name == 'Start shopping')

                $('#Furniture').addClass('active');
                $("#myTab li:eq(0)").addClass('active');
            @endif
            // $("#myTab li a:eq(0)").addClass('active');
        });
        // Tab js
        $('#myTab li').click(function() {
            // alert('hello')
            var $this = $(this);
            var $theTab = $(this).attr('data-tab');
            if ($this.hasClass('active')) {} else {
                $this.closest('.tabs-wrapper').find('ul.tabs li, .tabs-container .tab-content').removeClass(
                    'active');
                $('.tabs-container .tab-content[id="' + $theTab + '"], ul.tabs li[data-tab="' + $theTab + ']')
                    .addClass('active');
            }
            $('ul.tabs li').removeClass('active');
            $(this).addClass('active');
            // $('.product-tab-slider').slick('refresh');
        });

        $(".productTab").click(function(e) {
            e.preventDefault();
            $('.productTab').removeClass('active')

        });
        $(document).on('click', '.qty-plus', function() {
            $(this).prev().val(+$(this).prev().val() + 1);
        });
        $(document).on('click', '.qty-minus', function() {
            if ($(this).next().val() > 0) $(this).next().val(+$(this).next().val() - 1);
        });
        $(document).ready(function() {
            $('.tab-a').click(function() {
                $(".tab-pane").removeClass('tab-active');
                $(".tab-pane[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
                $(".tab-a").removeClass('active-a');
                $(this).parent().find(".tab-a").addClass('active-a');
            });
        });
    </script>
@endpush

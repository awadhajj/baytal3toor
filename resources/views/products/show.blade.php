@extends('layouts.store')

@section('title', $product->name)
@section('meta_description', Str::limit($product->description ?? $product->name . ' - ' . $product->brand, 160))
@section('og_type', 'product')
@section('og_image', $product->image ? asset('storage/' . $product->image) : asset('logo.png'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8 overflow-x-auto whitespace-nowrap">
            <a href="{{ route('home') }}" class="hover:text-primary-600 shrink-0">الرئيسية</a>
            <span class="shrink-0">/</span>
            <a href="{{ route('category.show', $product->category->slug) }}" class="hover:text-primary-600 shrink-0">{{ $product->category->name }}</a>
            <span class="shrink-0">/</span>
            <span class="text-gray-900 truncate">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 lg:gap-12">
            {{-- Product Image --}}
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                         class="w-full rounded-2xl shadow-sm">
                @else
                    <div class="w-full aspect-square bg-gradient-to-br from-primary-100 to-primary-50 rounded-2xl flex items-center justify-center">
                        <span class="text-7xl sm:text-9xl">*</span>
                    </div>
                @endif
            </div>

            {{-- Product Details --}}
            <div>
                @if($product->brand)
                    <span class="text-primary-600 font-medium text-sm sm:text-base">{{ $product->brand }}</span>
                @endif
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-2">{{ $product->name }}</h1>
                <p class="text-gray-500 mt-2 text-sm sm:text-base">{{ $product->volume }}</p>

                <div class="mt-4">
                    <span class="text-2xl sm:text-3xl font-bold text-primary-700">{{ number_format($product->price, 2) }} {{ config('store.currency') }}</span>
                </div>

                @if($product->description)
                    <div class="mt-6">
                        <h3 class="font-semibold text-gray-900 mb-2">الوصف</h3>
                        <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ $product->description }}</p>
                    </div>
                @endif

                <form action="{{ route('cart.add') }}" method="POST" class="mt-6 sm:mt-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex items-center gap-3 sm:gap-4">
                        <div class="flex items-center border border-gray-300 rounded-lg shrink-0">
                            <button type="button" onclick="changeQty(-1)" class="px-3 py-2 text-gray-600 hover:text-gray-900">-</button>
                            <input type="number" name="quantity" id="qty" value="1" min="1"
                                   class="w-12 sm:w-16 text-center border-x border-gray-300 py-2 focus:outline-none text-sm sm:text-base">
                            <button type="button" onclick="changeQty(1)" class="px-3 py-2 text-gray-600 hover:text-gray-900">+</button>
                        </div>
                        <button type="submit"
                                class="flex-1 bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 sm:px-6 rounded-lg transition-colors text-sm sm:text-base">
                            أضف إلى السلة
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Related Products --}}
        @if($relatedProducts->isNotEmpty())
            <section class="mt-12 sm:mt-16">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6">منتجات مشابهة</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3 sm:gap-6">
                    @foreach($relatedProducts as $relProduct)
                        @include('products._card', ['product' => $relProduct])
                    @endforeach
                </div>
            </section>
        @endif
    </div>

    <script>
        function changeQty(delta) {
            const input = document.getElementById('qty');
            const newVal = Math.max(1, parseInt(input.value) + delta);
            input.value = newVal;
        }
    </script>
@endsection

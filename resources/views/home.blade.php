@extends('layouts.store')

@section('title', 'الرئيسية')

@section('content')
    {{-- Hero Banner --}}
    <section class="bg-gradient-to-l from-primary-900 to-primary-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-20 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold mb-4">{{ config('store.name') }}</h1>
            <p class="text-lg sm:text-xl md:text-2xl text-primary-100 mb-6 sm:mb-8">أرقى العطور العربية والعالمية</p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-white text-primary-700 font-bold px-6 sm:px-8 py-3 rounded-lg hover:bg-primary-50 transition-colors text-sm sm:text-base">
                تصفح المنتجات
            </a>
        </div>
    </section>

    {{-- Categories --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6 sm:mb-8 text-center">التصنيفات</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
            @foreach($categories as $category)
                <a href="{{ route('category.show', $category->slug) }}"
                   class="group bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 p-4 sm:p-6 text-center transition-all hover:-translate-y-1">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2 sm:mb-3 rounded-full object-cover">
                    @else
                        <div class="w-12 h-12 sm:w-16 sm:h-16 mx-auto mb-2 sm:mb-3 rounded-full bg-primary-100 flex items-center justify-center text-xl sm:text-2xl">*</div>
                    @endif
                    <h3 class="font-semibold text-gray-900 group-hover:text-primary-600 transition-colors text-sm sm:text-base">{{ $category->name }}</h3>
                    <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $category->products_count }} منتج</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featuredProducts->isNotEmpty())
        <section class="bg-white py-8 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 mb-6 sm:mb-8 text-center">منتجات مميزة</h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                    @foreach($featuredProducts as $product)
                        @include('products._card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $featuredProducts->links() }}
                </div>
            </div>
        </section>
    @endif
@endsection

@extends('layouts.store')

@section('title', $category->name)

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-xs sm:text-sm text-gray-500 mb-6 sm:mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-600">الرئيسية</a>
            <span>/</span>
            <span class="text-gray-900">{{ $category->name }}</span>
        </nav>

        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6 sm:mb-8">{{ $category->name }}</h1>

        @if($products->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach($products as $product)
                    @include('products._card', ['product' => $product])
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <p class="text-gray-500 text-lg">لا توجد منتجات في هذا التصنيف</p>
            </div>
        @endif
    </div>
@endsection

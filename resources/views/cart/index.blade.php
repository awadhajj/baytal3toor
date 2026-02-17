@extends('layouts.store')

@section('title', 'السلة')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6 sm:mb-8">سلة التسوق</h1>

        @if($items->isNotEmpty())
            <div class="space-y-4">
                @foreach($items as $item)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                        <div class="flex gap-3 sm:gap-4">
                            {{-- Image --}}
                            <a href="{{ route('products.show', $item->slug) }}" class="shrink-0">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg object-cover">
                                @else
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg bg-primary-50 flex items-center justify-center text-2xl sm:text-3xl">*</div>
                                @endif
                            </a>

                            {{-- Details --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $item->slug) }}" class="font-semibold text-gray-900 hover:text-primary-600 text-sm sm:text-base block truncate">{{ $item->name }}</a>
                                <p class="text-xs sm:text-sm text-gray-500">{{ $item->volume }}</p>
                                <p class="text-primary-700 font-bold text-sm sm:text-base mt-1">{{ number_format($item->price, 2) }} {{ config('store.currency') }}</p>
                            </div>

                            {{-- Remove (top-right) --}}
                            <form action="{{ route('cart.remove') }}" method="POST" class="shrink-0">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors" title="حذف">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                        {{-- Quantity + Subtotal row --}}
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                <div class="flex items-center border border-gray-300 rounded-lg">
                                    <button type="submit" name="quantity" value="{{ $item->cart_quantity - 1 }}"
                                            class="px-3 py-1.5 text-gray-600 hover:text-gray-900 text-sm">-</button>
                                    <span class="px-3 py-1.5 border-x border-gray-300 text-center min-w-[2.5rem] text-sm">{{ $item->cart_quantity }}</span>
                                    <button type="submit" name="quantity" value="{{ $item->cart_quantity + 1 }}"
                                            class="px-3 py-1.5 text-gray-600 hover:text-gray-900 text-sm">+</button>
                                </div>
                            </form>

                            <div class="text-start">
                                <span class="font-bold text-gray-900 text-sm sm:text-base">{{ number_format($item->subtotal, 2) }} {{ config('store.currency') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Total --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mt-4 flex items-center justify-between">
                <span class="text-lg font-bold text-gray-900">الإجمالي</span>
                <span class="text-xl sm:text-2xl font-bold text-primary-700">{{ number_format($total, 2) }} {{ config('store.currency') }}</span>
            </div>

            <div class="mt-6 flex flex-col sm:flex-row gap-3 sm:gap-4 sm:justify-between">
                <a href="{{ route('products.index') }}"
                   class="text-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium text-sm sm:text-base">
                    متابعة التسوق
                </a>
                <a href="{{ route('checkout.index') }}"
                   class="text-center px-8 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition-colors font-bold text-sm sm:text-base">
                    إتمام الطلب
                </a>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 mx-auto mb-4 rounded-full bg-gray-100 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                </div>
                <p class="text-gray-500 text-lg mb-6">السلة فارغة</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-primary-600 hover:bg-primary-700 text-white font-bold px-8 py-3 rounded-lg transition-colors">
                    تصفح المنتجات
                </a>
            </div>
        @endif
    </div>
@endsection

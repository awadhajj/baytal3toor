<div class="bg-white rounded-xl shadow-sm hover:shadow-md border border-gray-100 overflow-hidden transition-all hover:-translate-y-1 group">
    <a href="{{ route('products.show', $product->slug) }}">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                 class="w-full h-36 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300">
        @else
            <div class="w-full h-36 sm:h-48 bg-gradient-to-br from-primary-100 to-primary-50 flex items-center justify-center">
                <span class="text-4xl sm:text-5xl">*</span>
            </div>
        @endif
    </a>
    <div class="p-3 sm:p-4">
        @if($product->brand)
            <span class="text-xs text-primary-600 font-medium">{{ $product->brand }}</span>
        @endif
        <a href="{{ route('products.show', $product->slug) }}">
            <h3 class="font-semibold text-gray-900 mt-1 group-hover:text-primary-600 transition-colors text-sm sm:text-base leading-tight">{{ $product->name }}</h3>
        </a>
        <p class="text-xs sm:text-sm text-gray-500 mt-1">{{ $product->volume }}</p>
        <div class="flex items-center justify-between mt-2 sm:mt-3 gap-2">
            <span class="text-sm sm:text-lg font-bold text-primary-700">{{ number_format($product->price, 2) }} {{ config('store.currency') }}</span>
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit"
                        class="bg-primary-600 hover:bg-primary-700 text-white p-1.5 sm:p-2 rounded-lg transition-colors shrink-0"
                        title="أضف للسلة">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

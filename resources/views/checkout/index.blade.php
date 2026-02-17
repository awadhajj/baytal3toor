@extends('layouts.store')

@section('title', 'إتمام الطلب')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-6 sm:mb-8">إتمام الطلب</h1>

        {{-- Order Summary (shown first on mobile) --}}
        <div class="lg:hidden mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <h2 class="text-base font-bold text-gray-900 mb-3">ملخص الطلب</h2>
                <div class="space-y-2">
                    @foreach($items as $item)
                        <div class="flex justify-between items-start text-sm">
                            <div class="min-w-0 flex-1">
                                <p class="font-medium text-gray-900 truncate">{{ $item->name }}</p>
                                <p class="text-gray-500 text-xs">{{ $item->volume }} x {{ $item->cart_quantity }}</p>
                            </div>
                            <span class="font-medium text-gray-900 shrink-0 ms-2">{{ number_format($item->subtotal, 2) }} {{ config('store.currency') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-200 mt-3 pt-3 flex justify-between">
                    <span class="font-bold text-gray-900">الإجمالي</span>
                    <span class="font-bold text-primary-700">{{ number_format($total, 2) }} {{ config('store.currency') }}</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Checkout Form --}}
            <div class="lg:col-span-2">
                <form action="{{ route('checkout.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
                    @csrf

                    <h2 class="text-base sm:text-lg font-bold text-gray-900 mb-4 sm:mb-6">معلومات التوصيل</h2>

                    <div class="space-y-4">
                        <div>
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">الاسم الكامل</label>
                            <input type="text" name="customer_name" id="customer_name" value="{{ old('customer_name') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm sm:text-base">
                            @error('customer_name')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">رقم الهاتف</label>
                            <input type="tel" name="customer_phone" id="customer_phone" value="{{ old('customer_phone') }}" required
                                   placeholder="05XXXXXXXX"
                                   class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm sm:text-base">
                            @error('customer_phone')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_city" class="block text-sm font-medium text-gray-700 mb-1">المدينة</label>
                            <input type="text" name="customer_city" id="customer_city" value="{{ old('customer_city') }}" required
                                   class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm sm:text-base">
                            @error('customer_city')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">العنوان بالتفصيل</label>
                            <textarea name="customer_address" id="customer_address" rows="3" required
                                      class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm sm:text-base">{{ old('customer_address') }}</textarea>
                            @error('customer_address')
                                <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">ملاحظات (اختياري)</label>
                            <textarea name="notes" id="notes" rows="2"
                                      placeholder="مثال: تغليف هدية"
                                      class="w-full border border-gray-300 rounded-lg px-3 sm:px-4 py-2.5 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 outline-none text-sm sm:text-base">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full mt-6 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        إرسال الطلب عبر واتساب
                    </button>
                </form>
            </div>

            {{-- Order Summary (desktop sidebar) --}}
            <div class="hidden lg:block">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-20">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">ملخص الطلب</h2>

                    <div class="space-y-3">
                        @foreach($items as $item)
                            <div class="flex justify-between items-start text-sm">
                                <div>
                                    <p class="font-medium text-gray-900">{{ $item->name }}</p>
                                    <p class="text-gray-500">{{ $item->volume }} x {{ $item->cart_quantity }}</p>
                                </div>
                                <span class="font-medium text-gray-900 shrink-0 ms-2">{{ number_format($item->subtotal, 2) }} {{ config('store.currency') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t border-gray-200 mt-4 pt-4 flex justify-between">
                        <span class="text-lg font-bold text-gray-900">الإجمالي</span>
                        <span class="text-lg font-bold text-primary-700">{{ number_format($total, 2) }} {{ config('store.currency') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

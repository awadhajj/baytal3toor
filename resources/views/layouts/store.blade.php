<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('store.name')) - {{ config('store.name') }}</title>
    <meta name="description" content="@yield('meta_description', 'متجر متخصص في بيع أرقى العطور والبخور العربية والعالمية')">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', config('store.name')) - {{ config('store.name') }}">
    <meta property="og:description" content="@yield('meta_description', 'متجر متخصص في بيع أرقى العطور والبخور العربية والعالمية')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('build/assets/og-default.jpg'))">
    <meta property="og:locale" content="ar_SA">
    <meta property="og:site_name" content="{{ config('store.name') }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', config('store.name')) - {{ config('store.name') }}">
    <meta name="twitter:description" content="@yield('meta_description', 'متجر متخصص في بيع أرقى العطور والبخور العربية والعالمية')">
    <meta name="twitter:image" content="@yield('og_image', asset('build/assets/og-default.jpg'))">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans min-h-screen flex flex-col overflow-x-hidden">
    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <span class="text-xl font-bold text-primary-700">{{ config('store.name') }}</span>
                </a>

                {{-- Navigation --}}
                <nav class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">الرئيسية</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-primary-600 font-medium transition-colors">المنتجات</a>
                    @php $navCategories = \App\Models\Category::all(); @endphp
                    <div class="relative group">
                        <button class="text-gray-700 hover:text-primary-600 font-medium transition-colors">التصنيفات</button>
                        <div class="absolute top-full start-0 mt-2 w-48 bg-white rounded-lg shadow-lg border opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                            @foreach($navCategories as $cat)
                                <a href="{{ route('category.show', $cat->slug) }}" class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-700 first:rounded-t-lg last:rounded-b-lg">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </nav>

                {{-- Cart --}}
                @php $cartCount = app(\App\Services\CartService::class)->getCount(); @endphp
                <a href="{{ route('cart.index') }}" class="relative flex items-center gap-1 text-gray-700 hover:text-primary-600 transition-colors shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z" />
                    </svg>
                    <span class="font-medium hidden sm:inline">السلة</span>
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -start-2 bg-primary-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div class="md:hidden border-t">
            <div class="flex items-center justify-around py-2 px-4">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-primary-600 text-sm font-medium">الرئيسية</a>
                <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-primary-600 text-sm font-medium">المنتجات</a>
                <a href="{{ route('cart.index') }}" class="text-gray-600 hover:text-primary-600 text-sm font-medium">السلة</a>
            </div>
        </div>
    </header>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg text-sm">
                {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                {{-- Store Info --}}
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">{{ config('store.name') }}</h3>
                    <p class="text-gray-400 text-sm">متجر متخصص في بيع أرقى العطور والبخور العربية والعالمية.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">الرئيسية</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">المنتجات</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">السلة</a></li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h3 class="text-white text-lg font-bold mb-4">تواصل معنا</h3>
                    <a href="https://wa.me/{{ config('store.whatsapp_number') }}" target="_blank"
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors text-sm">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        واتساب
                    </a>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                <p>&copy; {{ date('Y') }} {{ config('store.name') }}. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>
</body>
</html>

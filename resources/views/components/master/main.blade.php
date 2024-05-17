<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Project</title>

    {{-- STYLE SECTION --}}
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    @yield('styles')
    {{-- .STYLE SECTION --}}

</head>
<body class="bg-gray-700">


{{-- HEADER SECTION --}}
<header class=" text-white ">

        @component('components.master.header')
        @endcomponent
</header>
{{-- .HEADER SECTION --}}


{{-- CONTENT SECTION --}}
<main class="container mx-auto px-4 py-8 ">
    @yield('content')
</main>
{{-- .CONTENT SECTION --}}


{{-- FOOTER SECTION
<footer class="bg-light text-center text-sm text-gray-600 py-4">
    <div class="container mx-auto px-4">
        @component('components.master.footer')
        @endcomponent
    </div>
</footer>--}}
{{-- .FOOTER SECTION --}}


{{-- SCRIPTS SECTION--}}
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
{{-- .SCRIPTS SECTION--}}
</body>
</html>

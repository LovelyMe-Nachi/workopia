<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- vite directive --}}
    @vite('resources/css/app.css')

    {{-- title --}}
    <title>{{ $title ?? 'Workopia | Find/Create Jobs' }}</title>

    {{-- custom css --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    {{-- alpine js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-gray-100">
    <x-header></x-header>

    @if (request()->is('/'))
        <x-hero />
        <x-top-banner />
    @endif

    <main class="container mx-auto px-4 mt-4 sm:px-8 md:px-10 max-[800px]:px-4">
        <!-- Display alert messages -->
        @if (session('success'))
            <x-alert type="success" message="{{ session('success') }}" />
        @endif

        @if (session('error'))
            <x-alert type="error" message="{{ session('error') }}" />
        @endif

        {{ $slot }}
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
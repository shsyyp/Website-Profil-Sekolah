<!DOCTYPE html>
<html class="scroll-smooth" lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Admin Login | SMAN Pintar Riau')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "primary": "#285092",
                    "primary-container": "#3264b7",
                    "primary-fixed": "#ecf3fe",
                    "on-primary-container": "#ecf3fe",
                    "tertiary": "#594f26",
                    "tertiary-fixed": "#ffe16d",
                    "surface": "#fefefe",
                    "surface-container": "#f6f6f6",
                    "surface-container-low": "#fcfcfc",
                    "surface-container-lowest": "#fefefe",
                    "on-surface": "#172f55",
                    "on-surface-variant": "#565656",
                    "outline": "#949494",
                    "outline-variant": "#c5c5c5",
                    // Warna lainnya disederhanakan untuk contoh
                },
                "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Inter"],
                }
            },
        },
    }
    </script>
    <style>
    .material-symbols-outlined {
        font-variation-settings: 'FILL'0, 'wght'400, 'GRAD'0, 'opsz'24;
        vertical-align: middle;
    }

    .bg-pattern {
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 32px 32px;
    }
    </style>
</head>

<body
    class="bg-surface font-body text-on-surface selection:bg-primary-container selection:text-on-primary-container overflow-hidden">

    @yield('content')

    {{-- Script untuk fitur Show/Hide Password --}}
    @stack('scripts')
</body>

</html>

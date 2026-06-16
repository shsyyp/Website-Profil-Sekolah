<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'SMAN Pintar - Excellence in Education')</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                "colors": {
                    "primary": "#285092",
                    "tertiary-fixed-dim": "#e6cb62",
                    "on-primary-container": "#ecf3fe",
                    "surface-variant": "#dddddd",
                    "on-background": "#172f55",
                    "tertiary-container": "#ccb457",
                    "primary-container": "#3264b7",
                    "secondary": "#285092",
                    "surface": "#fefefe",
                    "on-secondary-container": "#285092",
                    "tertiary": "#594f26",
                    "background": "#fefefe",
                    "on-primary": "#fefefe",
                    "outline": "#949494",
                    "tertiary-fixed": "#ffe16d",
                    "on-surface": "#172f55",
                    "surface-container": "#f6f6f6",
                    "surface-container-lowest": "#fefefe",
                    "surface-container-low": "#fcfcfc",
                    "outline-variant": "#c5c5c5",
                    "on-surface-variant": "#565656"
                    // Warna lainnya disesuaikan untuk mempersingkat config
                },
                "fontFamily": {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Inter"],
                    "label": ["Inter"]
                }
            },
        },
    }
    </script>
    <style>
    .glass-nav {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL'0, 'wght'400, 'GRAD'0, 'opsz'24;
    }

    .primary-gradient {
        background: linear-gradient(135deg, #285092 0%, #3264b7 100%);
    }
    </style>
    @stack('styles')
</head>

<body class="bg-surface font-body text-on-surface">

    @include('partials.navbar')

    <main class="pt-20">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.chatbot')

    @stack('scripts')
</body>

</html>

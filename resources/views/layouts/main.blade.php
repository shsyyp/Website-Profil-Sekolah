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
                    "primary": "#00357f",
                    "tertiary-fixed-dim": "#e9c400",
                    "on-primary-container": "#a9c1ff",
                    "surface-variant": "#e2e2eb",
                    "on-background": "#191b22",
                    "tertiary-container": "#c9a900",
                    "primary-container": "#004aad",
                    "secondary": "#4e5e85",
                    "surface": "#faf8ff",
                    "on-secondary-container": "#495980",
                    "tertiary": "#705d00",
                    "background": "#faf8ff",
                    "on-primary": "#ffffff",
                    "outline": "#737784",
                    "tertiary-fixed": "#ffe16d",
                    "on-surface": "#191b22",
                    "surface-container": "#ededf6",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#f3f3fc",
                    "outline-variant": "#c3c6d5",
                    "on-surface-variant": "#434653"
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
        background: linear-gradient(135deg, #00357f 0%, #004aad 100%);
    }
    </style>
</head>

<body class="bg-surface font-body text-on-surface">

    @include('partials.navbar')

    <main class="pt-20">
        @yield('content')
    </main>

    @include('partials.footer')

    @include('partials.chatbot')

</body>

</html>
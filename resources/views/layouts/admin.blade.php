<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Admin Dashboard | SMAN Pintar')</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script id="tailwind-config">
    tailwind.config = {
        darkMode: "class",
        theme: {
            extend: {
                colors: {
                    "primary": "#00357f",
                    "primary-container": "#004aad",
                    "tertiary": "#705d00",
                    "tertiary-container": "#c9a900",
                    "surface": "#faf8ff",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-low": "#f3f3fc",
                    "surface-container": "#ededf6",
                    "surface-container-high": "#e7e7f0",
                    "on-surface": "#191b22",
                    "on-surface-variant": "#434653",
                    "outline": "#737784",
                    "outline-variant": "#c3c6d5",
                    "error": "#ba1a1a",
                    "on-error": "#ffffff",
                    "on-secondary-container": "#495980",
                    // Warna lainnya disederhanakan untuk template
                },
                fontFamily: {
                    "headline": ["Plus Jakarta Sans"],
                    "body": ["Inter"],
                }
            }
        }
    }
    </script>
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    .headline {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .material-symbols-outlined {
        font-variation-settings: 'FILL'0, 'wght'400, 'GRAD'0, 'opsz'24;
    }
    </style>
</head>

<body class="bg-surface text-on-surface">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="ml-64 flex flex-col min-h-screen">

        {{-- Topbar --}}
        @include('partials.topbar')

        <main class="p-8 space-y-8 flex-1">
            @yield('content')
        </main>

    </div>

</body>

</html>
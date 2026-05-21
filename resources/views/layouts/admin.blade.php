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

    #component-editors,
    #about-editors,
    #news-page-editors,
    #pmb-editors,
    #alumni-page-editors {
        width: 100%;
        max-width: none !important;
    }

    #component-editors [data-editor-panel],
    #about-editors [data-about-panel],
    #news-page-editors [data-news-panel],
    #pmb-editors [data-pmb-panel],
    #alumni-page-editors [data-alumni-page-panel] {
        border: 0;
        border-radius: 1rem;
        background: transparent;
        box-shadow: none;
        overflow: visible;
    }

    #component-editors summary,
    #about-editors summary,
    #news-page-editors summary,
    #pmb-editors summary,
    #alumni-page-editors summary {
        cursor: default;
        list-style: none;
        margin-bottom: 1.5rem;
        padding: 0;
    }

    #component-editors summary::-webkit-details-marker,
    #about-editors summary::-webkit-details-marker,
    #news-page-editors summary::-webkit-details-marker,
    #pmb-editors summary::-webkit-details-marker,
    #alumni-page-editors summary::-webkit-details-marker {
        display: none;
    }

    #component-editors summary > div:first-child > span,
    #about-editors summary > div:first-child > span,
    #news-page-editors summary > div:first-child > span,
    #pmb-editors summary > div:first-child > span,
    #alumni-page-editors summary > div:first-child > span {
        display: none;
    }

    #component-editors summary h3,
    #about-editors summary h3,
    #news-page-editors summary h3,
    #pmb-editors summary h3,
    #alumni-page-editors summary h3 {
        color: #00357f;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 2.25rem;
        font-weight: 800;
        line-height: 2.5rem;
        letter-spacing: 0;
    }

    #component-editors summary h3::after,
    #about-editors summary h3::after,
    #news-page-editors summary h3::after,
    #pmb-editors summary h3::after,
    #alumni-page-editors summary h3::after {
        content: none !important;
    }

    #component-editors [data-editor-panel] > div,
    #about-editors [data-about-panel] > div,
    #news-page-editors [data-news-panel] > div,
    #pmb-editors [data-pmb-panel] > div,
    #alumni-page-editors [data-alumni-page-panel] > div {
        border-top: 0;
        border-radius: 1rem;
        background: #ffffff;
        box-shadow: 0 8px 30px rgb(0 0 0 / 0.04);
        padding: 2rem;
    }

    #component-editors label,
    #about-editors label,
    #news-page-editors label,
    #pmb-editors label,
    #alumni-page-editors label {
        display: block;
        margin-bottom: .5rem;
        color: #705d00;
        font-size: .75rem;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: uppercase;
    }

    #component-editors input:not([type="checkbox"]):not([type="radio"]),
    #about-editors input:not([type="checkbox"]):not([type="radio"]),
    #news-page-editors input:not([type="checkbox"]):not([type="radio"]),
    #pmb-editors input:not([type="checkbox"]):not([type="radio"]),
    #alumni-page-editors input:not([type="checkbox"]):not([type="radio"]),
    #component-editors textarea,
    #about-editors textarea,
    #news-page-editors textarea,
    #pmb-editors textarea,
    #alumni-page-editors textarea,
    #component-editors select,
    #about-editors select,
    #news-page-editors select,
    #pmb-editors select,
    #alumni-page-editors select {
        width: 100%;
        border: 0;
        border-radius: .75rem;
        background: #ededf6;
        padding: .75rem 1rem;
        color: #191b22;
        font-size: .875rem;
        font-weight: 500;
    }

    #component-editors input:focus,
    #about-editors input:focus,
    #news-page-editors input:focus,
    #pmb-editors input:focus,
    #alumni-page-editors input:focus,
    #component-editors textarea:focus,
    #about-editors textarea:focus,
    #news-page-editors textarea:focus,
    #pmb-editors textarea:focus,
    #alumni-page-editors textarea:focus,
    #component-editors select:focus,
    #about-editors select:focus,
    #news-page-editors select:focus,
    #pmb-editors select:focus,
    #alumni-page-editors select:focus {
        outline: 0;
        box-shadow: 0 0 0 2px rgb(0 74 173 / 0.2);
    }

    button.bg-primary,
    a.bg-primary,
    button[class*="from-primary"],
    a[class*="from-primary"] {
        color: #ffffff;
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgb(195 198 213 / 0.3);
        border-radius: .75rem;
        background: transparent;
        color: #191b22;
        font-size: .875rem;
        font-weight: 700;
        padding: .75rem 2rem;
        transition: background-color .2s ease, border-color .2s ease, color .2s ease, transform .2s ease;
    }

    .btn-cancel:hover {
        border-color: #ededf6;
        background: #ededf6;
        color: #191b22;
    }

    .btn-cancel:active {
        transform: scale(.98);
    }
    </style>
</head>

<body class="bg-surface text-on-surface">

    {{-- Sidebar --}}
    @include('partials.sidebar')

    <div class="ml-64 flex flex-col min-h-screen">

        {{-- Topbar --}}
        @include('partials.topbar')

        <main class="px-8 pb-8 pt-4 space-y-8 flex-1">
            @yield('content')
        </main>

    </div>

</body>

</html>

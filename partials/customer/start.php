<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="./public/assets/images/favicon_io/favicon.ico" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>King Seafood - Orders APP</title>

    <style>
        ::-webkit-scrollbar {
            display: none;
        }

        html,
        body {
            scrollbar-width: none;

            -ms-overflow-style: none;

        }

        .dt-layout-row:has(.dt-search),
        .dt-layout-row:has(.dt-length),
        .dt-layout-row:has(.dt-paging) {
            display: none !important;
        }


        .menu-item {
            transition: transform 0.2s ease;
        }
    </style>

    <!-- tailwindCSS -->
    <link href="./public/assets/css/style.css" rel="stylesheet">

    <!-- Datatables CSS -->
    <link href="./public/assets/css/datatables.min.css" rel="stylesheet">



    <!-- Alpnejs -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .safe-bottom {
            padding-bottom: env(safe-area-inset-bottom, 12px);
        }
    </style>
</head>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        @yield('title')
    </title>

    @include('layouts.partials.styles')
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
</head>

<body>
    <script src="/assets/js/tabler-theme.min.js?1762283331"></script>
    <div class="page">
        @include('layouts.partials.sidebar')
        @include('layouts.partials.header')

        <div class="page-wrapper">
            @yield('content')

            @include('layouts.partials.footer')
        </div>
    </div>

    @include('layouts.partials.scripts')
</body>

</html>

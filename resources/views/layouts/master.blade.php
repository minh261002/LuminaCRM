<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Bảng điều khiển</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body data-menu-color="dark" data-sidebar="default">
    <div id="app-layout">
        @include('layouts.partials.topbar')
        @include('layouts.partials.sidebar')
        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('layouts.partials.footer')
    </div>

    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>

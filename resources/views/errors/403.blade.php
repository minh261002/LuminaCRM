<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
        403 Forbidden
    </title>
    <link href="/assets/css/tabler.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-socials.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-marketing.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-themes.min.css" rel="stylesheet" />
    <link href="/assets/css/tabler-props.min.css" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
        <div class="container-tight py-4">
            <div class="empty">
                <div class="empty-header">
                    403 Forbidden
                </div>
                <p class="empty-title">
                    Oops… This page is forbidden to access 🙅‍♂️
                </p>
                <p class="empty-subtitle text-secondary">
                    We are sorry but you are not allowed to access this page.
                    Contact the administrator if you think this is a mistake.
                </p>
                <div class="empty-action">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary">
                        <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Take me home
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

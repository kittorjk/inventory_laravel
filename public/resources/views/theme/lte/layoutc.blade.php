<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8">
        <title>@yield('titulo','InventSoft') | Dashboard</title>

        <!-- Site favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/lte/vendors/images/apple-touch-icon.png')}}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/lte/vendors/images/favicon-32x32.png')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/lte/vendors/images/favicon-16x16.png')}}">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/lte/vendors/styles/core.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/lte/vendors/styles/icon-font.min.css')}}">
        @yield('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('assets/lte/vendors/styles/style.css')}}">


        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>

        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-119386393-1');
        </script>
    </head>

    <body>



    <!-- Inicio header -->
    @include("theme/lte/header")
    <!-- Fin header -->

    <!-- Inicio Sidebar left  -->
    @include("theme/lte/leftc-sidebar")
    <!-- Fin Sidebar left -->
    <div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>@yield('header')</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="/dashboard">DashBoard</a></li>
									<li class="breadcrumb-item active" aria-current="page">@yield('header')</li>
								</ol>
							</nav>
                        </div>
                    </div>
                </div>

                <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
                    <!-- CONTENIIDO -->
                    @yield('contenido')
                </div>
            </div>
            <!-- Inicio Footer -->
            @include("theme/lte/footer")
            <!-- Fin Footer -->

        </div>
    </div>

    <!-- js -->
	<script src="{{asset('assets/lte/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('assets/lte/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('assets/lte/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/lte/vendors/scripts/layout-settings.js')}}"></script>

    @yield('sripts')
    </body>
</html>


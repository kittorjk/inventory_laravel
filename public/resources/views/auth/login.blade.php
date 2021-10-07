<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Login</title>

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
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="/">
					<img src="{{asset('assets/lte/vendors/images/deskapp-logo.svg')}}" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="{{ route('register') }}">_</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="{{asset('assets/lte/vendors/images/login-page-img.png')}}" alt="">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-primary">Ingreso Plataforma Web</h2>
						</div>
						<form method="POST" action="{{ route('login') }}">
                        @csrf
						<!-- 	<div class="select-role">
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<label class="btn active">
										<input type="radio" name="options" id="admin">
										<div class="icon"><img src="{{asset('assets/lte/vendors/images/briefcase.svg')}}" class="svg" alt=""></div>
										<span>I'm</span>
										Manager
									</label>
									<label class="btn">
										<input type="radio" name="options" id="user">
										<div class="icon"><img src="vendors/images/person.svg" class="svg" alt=""></div>
										<span>I'm</span>
										Employee
									</label>
								</div>
							</div> -->
							<div class="input-group custom">
                                <!-- <input type="text" class="form-control form-control-lg" placeholder="Email"> -->

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope"></i></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<!-- <input type="password" class="form-control form-control-lg" placeholder="**********"> -->
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="**********">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                <div class="input-group-append custom">
									<span class="input-group-text"><i class="dw dw-padlock1"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
                                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck1"> -->
                                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
										<label >Recordar</label>
									</div>
								</div>
								<div class="col-6">
                                @if (Route::has('password.request'))
                                    <div class="forgot-password"><a href="{{ route('password.request') }}">Olvido Contraseña</a></div>
                                @endif
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">


											<input class="btn btn-primary btn-lg btn-block" type="submit" value="INGRESAR">


									</div>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<!-- js -->
	<script src="{{asset('assets/lte/vendors/scripts/core.js')}}"></script>
    <script src="{{asset('assets/lte/vendors/scripts/script.min.js')}}"></script>
	<script src="{{asset('assets/lte/vendors/scripts/process.js')}}"></script>
    <script src="{{asset('assets/lte/vendors/scripts/layout-settings.js')}}"></script>
</body>
</html>


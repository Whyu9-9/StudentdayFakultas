<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>Student Day &mdash; Login</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/my-login.css') }}">
</head>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-center h-100">
				<div class="card-wrapper">
					<div class="text-center" style="padding: 50px 0px">
						<a href="{{ route('sd.index') }}" style="color: #333; font-weight: 700; font-size: 32px;">Student Day</a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login</h4>
							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="form-group">
									<label for="email">NIM</label>

									<input type="text" class="form-control" name="nim" value="" required autofocus>
									@if($errors->has('nim'))
										<small class="text-danger">{{ $errors->first('nim') }}</small>
									@endif
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
									@if($errors->has('password'))
										<small class="text-danger">{{ $errors->first('password') }}</small>
									@endif
								</div>

								<div class="form-group">
									<label>
										<input type="checkbox" name="remember"> Ingat saya
									</label>
								</div>

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-primary btn-block">
										Masuk
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; SMFT 1963-2020
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('/js/jquery.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('/js/my-login.js') }}"></script>
</body>
</html>
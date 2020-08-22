<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<title>Student Day &mdash; Login Admin</title>
	<link rel="icon" href="{{ asset('/img/favicon.png') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/my-login.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<style>
	body::-webkit-scrollbar {
		width: 0.4em;
	}

	body::-webkit-scrollbar-track {
		box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		background-color:#222222;
	} 

	body::-webkit-scrollbar-thumb {
		background-color:#666666;
		opacity: 0.6;
		border-radius: 10px;
	}
</style>
<body class="my-login-page">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-center h-100">
				<div class="card-wrapper">
					<div class="text-center" style="padding: 50px 0px">
						<a href="{{ route('sd.index') }}" style="color: #333; font-weight: 700; font-size: 32px;">Student Day <script>
                            document.write(new Date().getFullYear());
                        </script></a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Login Admin</h4>
							<form method="POST" action="/admin/login">
								{{ csrf_field() }}
								<div class="form-group">
									<label for="email">Email</label>

									<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password" required data-eye>
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
						Copyright &copy; SMFT 1963-<script>
                            document.write(new Date().getFullYear());
                        </script>
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
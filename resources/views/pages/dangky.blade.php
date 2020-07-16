<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('/login/images/icons/favicon.ico')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('/login/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('/login/css/main.css')}}">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="login/images/img-01.png" alt="IMG">
				</div>
				
				<form class="login100-form validate-form" action="dang-ky" method="post" oninput='confirmpass.setCustomValidity(confirmpass.value != pass.value ? "Mật khẩu xác nhận không trùng khớp" : "")'>
				@csrf
					<span class="login100-form-title">
						Đăng ký
					</span>
					
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="hoten" placeholder="Họ và tên" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

                    <div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="tentaikhoan" placeholder="Tên tài khoản" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					@if ( Session::has('tentaikhoan') )
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>{{ Session::get('tentaikhoan') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
						</div>
                    @endif
                    <div class="wrap-input100 validate-input">
						<input class="input100" type="email" name="email" placeholder="Email" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
					@if ( Session::has('email') )
						<div class="alert alert-danger alert-dismissible" role="alert">
							<strong>{{ Session::get('email') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
						</div>
                    @endif

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="pass" placeholder="Mật khẩu" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="confirmpass" placeholder="Nhập lại mật khẩu" required>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" value="Đăng ký">
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Có tài khoản?
						</span>
						<a class="txt2" href="dangnhap">
							Đăng nhập?
						</a>
					</div>

					<div class="text-center p-t-12">
						<a class="txt2" href="trang-chu">
							Về trang chủ
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>
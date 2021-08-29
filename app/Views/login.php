<!DOCTYPE html>
<html lang="<?php echo ($locale) ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log in</title>
	<base href="<?php echo (base_url()) ?>">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="assets/plugins/flag-icon-css/css/flag-icon.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link href="assets/plugins/pnotify/dist/pnotify.css" rel="stylesheet">
	<link href="assets/plugins/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
	<link href="assets/plugins/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

	<link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
				<a href="<?php echo (base_url('Home')) ?>" class="h1"><b>Login Page</b></a>
			</div>
			<div class="card-body">
				<p class="login-box-msg"><?php echo (lang('Text.SignInInfo', [], $locale)) ?></p>

				<form action="<?php echo (base_url('Home/login_auth')) ?>" method="post">
					<div class="input-group mb-3">
						<input type="username" name="am_username" class="form-control" placeholder="Username" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" name="am_password" class="form-control" placeholder="Password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-8">
							<div class="icheck-primary">
								<input type="checkbox" id="remember" name="keepalive" checked value="1">
								<label for="remember">
									<?php echo (lang('Button.RememberLogin', [], $locale)) ?>
								</label>
							</div>
						</div>
						<!-- /.col -->
						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block"><?php echo (lang('Button.SignIn', [], $locale)) ?></button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<hr>
				<div class="text-center">
					<small>
						<a href="<?php echo (base_url('id/Home')) ?>" class="text-success" title="Language (indonesia)"><i class="flag-icon flag-icon-id mr-2"></i></a>&nbsp;|&nbsp;<a href="<?php echo (base_url('en/Home')) ?>" class="text-success" title="Language (english)"><i class="flag-icon flag-icon-us ml-2"></i></a>
					</small>
				</div>
				<hr>
				<p class="mb-1">
					<a href="forgot-password.html"><?php echo (lang('Button.ForgotPassword', [], $locale)) ?></a>
				</p>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.buttons.js"></script>
	<script src="assets/plugins/pnotify/dist/pnotify.nonblock.js"></script>
	<!-- AdminLTE App -->
	<script src="assets/js/adminlte.min.js"></script>
	<?php if (session()->getFlashdata('ci_login_flash_message') != NULL) : ?>
		<script type="text/javascript">
			jQuery(function($) {
				new PNotify({
					title: ' Uppsss...',
					type: "<?php echo session()->getFlashdata('ci_login_flash_message_type') ?>",
					text: "<?php echo session()->getFlashdata('ci_login_flash_message') ?>",
					nonblock: {
						nonblock: true
					},
					styling: 'bootstrap3',
				});
			})
		</script>
	<?php endif ?>
</body>

</html>
<!DOCTYPE html>
<html lang="<?php echo ($Page->locale) ?>">

<?php echo view($Template->header); ?>

<body class="hold-transition layout-fixed layout-navbar-fixed sidebar-mini">
	<div class="wrapper">
		<!-- Preloader -->
		<?php if (isset($loader) && $loader == 1) : ?>
			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__shake" src="<?php echo (session('image_loader')) ?>" alt="Loader" height="60" width="60">
			</div>
		<?php endif; ?>

		<!-- Navbar -->
		<?php echo view($Template->navbar); ?>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<?php echo view($Template->sidebar); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"><?php echo ($Page->title) ?></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<?php
								$subtitleIndex = 0;
								$subtitleCount = count($Page->subtitle);
								foreach ($Page->subtitle as $key => $value) :
								?>
									<?php if ($subtitleCount == ++$subtitleIndex) : ?>
										<li class="breadcrumb-item active"><?php echo ($key) ?></li>
									<?php else : ?>
										<li class="breadcrumb-item"><a href="<?php echo (base_url($value)) ?>"><?php echo ($key) ?></a></li>
									<?php endif; ?>
								<?php endforeach; ?>
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<?php $this->renderSection('content') ?>
					</div>
					<!-- /.row -->
				</div>
				<!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<?php echo view($Template->footer); ?>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="assets/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
	<!-- AdminLTE -->
	<script src="assets/js/adminlte.js"></script>

	<script src="assets/js/main.js"></script>
	<?php foreach ($Page->scripts as $key => $script) : ?>
		<script src="<?php echo $script ?>"></script>
	<?php endforeach ?>
</body>
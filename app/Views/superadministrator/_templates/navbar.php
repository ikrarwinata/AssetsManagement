<nav class="main-header navbar navbar-expand navbar-white navbar-light text-sm">
	<!-- Left navbar links -->
	<ul class="navbar-nav">
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			<a href="<?php echo (base_url('superadministrator/Dashboard/index')) ?>" class="nav-link">Home</a>
		</li>
	</ul>

	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">
		<!-- Navbar Search -->
		<?php if (isset($perPage)) :
			$classNav = 'search-btn-nav-closed'; ?>
			<?php if ($keyword != NULL) :
				$classNav = 'search-btn-nav'; ?>
				<li class="nav-item search-value-nav">
					<a class="nav-link" href="<?php echo base_url($Page->parent . '/index') ?>" role="button">
						<span class="badge badge-dark badge-btn">
							<?php echo ($keyword) ?>&nbsp;<i class="fas fa-times"></i>
						</span>
					</a>
				</li>
			<?php endif; ?>
			<li class="nav-item <?php echo ($classNav) ?>">
				<a class="nav-link" data-widget="navbar-search" href="#" role="button">
					<i class="fas fa-search"></i>
				</a>
				<div class="navbar-search-block">
					<form class="form-inline" action="<?php echo base_url($Page->parent . '/index') ?>" method="GET">
						<div class="input-group input-group-sm">
							<input class="form-control form-control-navbar" type="search" placeholder="<?php echo (lang('Tooltips.Search', [], $Page->locale)) ?>" aria-label="Search" name="keyword" value="<?php echo $keyword; ?>">
							<div class="input-group-append">
								<button class="btn btn-navbar" type="submit">
									<i class="fas fa-search"></i>
								</button>
								<button class="btn btn-navbar" type="button" data-widget="navbar-search">
									<i class="fas fa-times"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</li>
		<?php endif; ?>

		<!-- Messages Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-comments"></i>
				<span class="badge badge-danger navbar-badge">3</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<a href="#" class="dropdown-item">
					<!-- Message Start -->
					<div class="media">
						<img src="assets/img/avatar.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								Brad Diesel
								<span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">Call me whenever you can...</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
					<!-- Message End -->
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<!-- Message Start -->
					<div class="media">
						<img src="assets/img/avatar2.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								John Pierce
								<span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">I got your message bro</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
					<!-- Message End -->
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<!-- Message Start -->
					<div class="media">
						<img src="assets/img/avatar3.png" alt="User Avatar" class="img-size-50 img-circle mr-3">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								Nora Silvester
								<span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
							</h3>
							<p class="text-sm">The subject goes here</p>
							<p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
						</div>
					</div>
					<!-- Message End -->
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
			</div>
		</li>
		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">15 Notifications</span>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="float-right text-muted text-sm">3 mins</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-users mr-2"></i> 8 friend requests
					<span class="float-right text-muted text-sm">12 hours</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> 3 new reports
					<span class="float-right text-muted text-sm">2 days</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link" data-toggle="dropdown" href="#">
				<i class="flag-icon <?php echo ($Page->locale == 'id' ? 'flag-icon-id' : 'flag-icon-us') ?>"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right p-0">
				<a href="<?php echo (base_url('id/Home/language/' . urlencode(base64_encode($Page->url)))) ?>" class="dropdown-item <?php echo ($Page->locale == 'id' ? 'active' : NULL) ?>">
					<i class="flag-icon flag-icon-id mr-2"></i> Indonesia
				</a>
				<a href="<?php echo (base_url('en/Home/language/' . urlencode(base64_encode($Page->url)))) ?>" class="dropdown-item <?php echo ($Page->locale == 'en' ? 'active' : NULL) ?>">
					<i class="flag-icon flag-icon-us mr-2"></i> English
				</a>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-widget="fullscreen" href="#" role="button" onclick="return false;">
				<i class="fas fa-expand-arrows-alt"></i>
			</a>
		</li>
		<li class="nav-item dropdown user-menu">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
				<img src="<?php echo (session('img')) ?>" class="user-image img-circle elevation-2" alt="User Image">
				<span class="d-none d-md-inline"><?php echo (strCut(session("nick_name"), 25)) ?></span>
			</a>
			<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<!-- User image -->
				<li class="user-header bg-primary">
					<img src="<?php echo (session('img')) ?>" class="img-circle elevation-2" alt="User Image">

					<p>
						<?php echo (strCut(session("full_name"), 28)) ?>
						<small class="text-warning"><?php echo (strtoupper(session("levelCaption"))) ?></small>
					</p>
				</li>
				<!-- Menu Body -->
				<li class="user-body">
					<div class="row">
						<div class="col-4 text-center">
							<a href="<?php echo (base_url('superadministrator/Purchases/history_of/' . urlencode(base64_encode(session('username'))))) ?>"><?php echo (lang('Sidebar.Purchases', [], $Page->locale)) ?></a>
						</div>
						<div class="col-4 text-center">
							<a href="<?php echo (base_url('superadministrator/Sales/history_of/' . urlencode(base64_encode(session('username'))))) ?>"><?php echo (lang('Sidebar.Sales', [], $Page->locale)) ?></a>
						</div>
						<div class="col-4 text-center">
							<a href="<?php echo (base_url('superadministrator/Master/history_of/' . urlencode(base64_encode(session('username'))))) ?>"><?php echo (lang('Sidebar.History', [], $Page->locale)) ?></a>
						</div>
					</div>
					<!-- /.row -->
				</li>
				<!-- Menu Footer-->
				<li class="user-footer">
					<a href="<?php echo (base_url('superadministrator/Users_account/profile/' . urlencode(base64_encode(session('username'))))) ?>" class="btn btn-default btn-flat"><?php echo (lang('Sidebar.Profile', [], $Page->locale)) ?></a>
					<a href="<?php echo (base_url('Home/logout')) ?>" class="btn btn-default btn-flat float-right"><?php echo (lang('Sidebar.SignOut', [], $Page->locale)) ?></a>
				</li>
			</ul>
		</li>
	</ul>
</nav>
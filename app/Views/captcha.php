<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Point Of Sale :: Login Page</title>
  <base href="<?php echo (base_url()) ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition lockscreen">
  <!-- Automatic element centering -->
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a href="<?php echo (base_url('Home/login')) ?>">Login
        <b><?php echo (session("nama_perusahaan")) ?></b></a>
    </div>
    <!-- User name -->
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

      <!-- lockscreen credentials (contains the form) -->
      <form class="lockscreen-credentials" action="<?php echo (base_url('Home/reCaptcha')) ?>" method="POST" style="margin-left: 8px;">
        <div class="input-group">
          <img src="<?php echo (base_url('Home/captchaImage')) ?>" alt="captchaImage">
          <span style="right: 8px; bottom: 0px; z-index: 1;position: absolute; opacity: .5;"><a href="<?php echo (base_url('Home/reCaptcha')) ?>" class="btn btn-sm btn-primary" title="<?php echo (lang('Button.reCaptcha', [], $locale)) ?>"><i class="fa fa-retweet text-primary"></i></a></span>
        </div>
        <div class="input-group">
          <small class="text-primary" style="font-size: 11px;"><?php echo (lang('Text.DescriptCaptcha', [], $locale)) ?></small>
        </div>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Input Captcha" name="captcha" required minlength="4" maxlength="7" autofocus autocomplete="off">
          <div class="input-group-append">
            <button type="submit" class="btn">
              <i class="fas fa-check text-muted"></i>
            </button>
          </div>
        </div>
      </form>
      <!-- /.lockscreen credentials -->
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
      <?php echo (lang('Text.Captcha', [], $locale)) ?>
    </div>
    <?php echo view('_templates/footer'); ?>
  </div>
  <!-- /.center -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
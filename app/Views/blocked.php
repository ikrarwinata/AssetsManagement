<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Point Of Sale :: Internet Blocked</title>
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
    <div class="alert text-center mb-1 mt-0 text-danger" role="alert">
      <small>
        <?php
        $H = timeLog(session("blockTime") + session("blockTimeout"), "%H");
        $i = timeLog(session("blockTime") + session("blockTimeout"), "%i");
        $s = timeLog(session("blockTime") + session("blockTimeout"), "%s");
        echo (lang('Text.IpBlocked', ['H' => $H, 'i' => $i, 's' => $s], $locale)) ?>
      </small>
    </div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">

      <!-- lockscreen credentials (contains the form) -->
      <!-- /.lockscreen credentials -->
    </div>
    <!-- /.lockscreen-item -->
    <?php echo view('_templates/footer'); ?>
  </div>
  <!-- /.center -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
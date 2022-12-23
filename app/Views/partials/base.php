<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Ogani Template">
  <meta name="keywords" content="Ogani, unica, creative, html">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="<?= base_url() ?>/icon.png" type="image/png">
  <title><?= $title ?> - Mike Store</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

  <!-- Css Styles -->
  <link rel="stylesheet" href=<?= base_url("modules/css/bootstrap.min.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/font-awesome.min.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/css/elegant-icons.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/nice-select.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/jquery-ui.min.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/owl.carousel.min.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/slicknav.min.css") ?> type="text/css">
  <link rel="stylesheet" href=<?= base_url("modules/css/style.css") ?> type="text/css">
</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Navbar -->
  <?= $this->include("partials/navbar") ?>

  <!-- Header -->
  <?= $this->include("partials/header") ?>

  <!-- Content -->
  <?= $this->renderSection("content") ?>

  <!-- Footer -->
  <?= $this->include("partials/footer") ?>

  <!-- Js Plugins -->
  <script src=<?= base_url("modules/js/jquery-3.3.1.min.js") ?>></script>
  <script src=<?= base_url("modules/js/bootstrap.min.js") ?>></script>
  <script src=<?= base_url("modules/js/jquery.nice-select.min.js") ?>></script>
  <script src=<?= base_url("modules/js/jquery-ui.min.js") ?>></script>
  <script src=<?= base_url("modules/js/jquery.slicknav.js") ?>></script>
  <script src=<?= base_url("modules/js/mixitup.min.js") ?>></script>
  <script src=<?= base_url("modules/js/owl.carousel.min.js") ?>></script>
  <script src=<?= base_url("modules/js/main.js") ?>></script>

</body>

</html>
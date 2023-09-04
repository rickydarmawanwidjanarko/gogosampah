<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="<?= base_url() ?>/logo/logo.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url() ?>/template/login/fonts/icomoon/style.css">

  <link rel="stylesheet" href="<?= base_url() ?>/template/login/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/login/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="<?= base_url() ?>/template/login/css/style.css">

  <title><?= $title ?> | <?= $subtitle ?></title>
</head>

<body>



  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="<?= base_url() ?>/logo/BG gogogreen.png" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
                <h3>Silahkan Login <strong></strong></h3>
                <p class="mb-4">Pastikan <b style="color: #38d39f;">Username</b> dan <b style="color: #38d39f;">Password</b> telah sesuai.</p>
              </div>
              <?php
              $errors = session()->getFlashdata('errors');
              if (!empty($errors)) { ?>
                <div class="alert alert-danger alert-dismissible">
                  <ul>
                    <?php foreach ($errors as $key => $value) { ?>
                      <li><?= esc($value) ?></li>
                    <?php } ?>
                  </ul>
                </div>
              <?php } ?>
              <?php
              if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-danger alert-dismissible">';
                echo session()->getFlashdata('pesan');
                echo '</div>';
              }
              ?>
              <?php echo form_open('Auth/cek_login_nasabah') ?>
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username_nasabah" value="<?= old('username_nasabah') ?>" class="form-control">
                <p class="text-danger"><?= $validation->hasError('username_nasabah') ? $validation->getError('username_nasabah') : '' ?></p>
              </div>
              <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" name="password_nasabah" value="<?= old('password_nasabah') ?>" class="form-control">
                <p class="text-danger"><?= $validation->hasError('password_nasabah') ? $validation->getError('password_nasabah') : '' ?></p>
              </div>
              <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
              </form>
              <? echo form_close() ?>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>


  <script src="<?= base_url() ?>/template/login/js/jquery-3.3.1.min.js"></script>
  <script src="<?= base_url() ?>/template/login/js/popper.min.js"></script>
  <script src="<?= base_url() ?>/template/login/js/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>/template/login/js/main.js"></script>

  <!-- jQuery -->
  <script src="<?= base_url() ?>/template/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/template/dist/js/adminlte.min.js"></script>

  <script>
    window.setTimeout(function() {
      $('.alert').fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3000);
  </script>
</body>

</html>
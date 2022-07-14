<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul; ?></title>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
  <script type="text/javascript" src="<?= base_url('assets/sweetalert/dist/sweetalert2.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/sweetalert/dist/sweetalert2.css'); ?>" type="text/css">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <h1 class="text-center">Pendaftaran</h1>
        <form action="#" id="form_pendaftaran">
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Pengguna</label>
            <input type="text" name="nama_user" class="form-control" placeholder="Masukkan Nama Pengguna">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukkan Username">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label class="control-label">Level Pengguna</label>
            <select name="level_pengguna" class="form-control">
              <option value="" class="text-muted">--Pilih Level Pengguna--</option>
              <option value="Admin">Admin</option>
              <option value="Mahasiswa">Mahasiswa</option>
            </select>
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
            <span class="help-block"></span>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Ketik Ulang Password</label>
            <input type="password" name="password_ulang" class="form-control" placeholder="Masukkan Password">
            <span class="help-block"></span>
          </div>
          <button type="button" class="btn btn-danger form-control" id="btnSave" onclick="daftar()">Daftar</button>
        </form>
        <a class="btn btn-link center-block" href="<?= base_url(); ?>login">Kembali</a>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <script src="<?= base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>
  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("input").change(function() {
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
      });
    });

    function daftar() {
      $.ajax({
        url: "<?php echo site_url('pendaftaran/simpan_pendaftaran') ?>",
        type: "POST",
        data: $('#form_pendaftaran').serialize(),
        dataType: "JSON",
        success: function(data) {

          if (data.status) {
            window.location = "<?= base_url('login'); ?>";
          } else {
            for (var i = 0; i < data.inputerror.length; i++) {
              $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
              $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
            }
          }
          $('#btnSave').text('Daftar');
          $('#btnSave').attr('disabled', false);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert('data error, Error Login');
          $('#btnSave').text('Daftar');
          $('#btnSave').attr('disabled', false);
        }
      });
    }
  </script>
</body>

</html>
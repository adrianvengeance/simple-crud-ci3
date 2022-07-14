<div class="row">
  <div class="col-md-2">
    <div id="gambar_tampil"></div>
  </div>
  <div class="col-md-8">
    <h3 class="text-center">Profile Mahasiswa</h3>
    <form action="#" class="form-horizontal" id="form_profile">
      <div class="form-group">
        <label class="col-sm-3 control-label">Nama Mahasiswa</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="nama_user" placeholder="Nama Mahasiswa" value="<?= $mahasiswa->nama_user; ?>">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Username</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="username" placeholder="Username" value="<?= $mahasiswa->username; ?>">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label"></label>
        <div class="col-sm-9">
          <input type="file" name="userfile" accept="image/*"><small>Support: jpg|png|jpeg|bmp [200px x 250px]</small>
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="button" class="btn btn-success" id="btnSave" onclick="update_profil()">Update</button>
          <a class="btn btn-danger pull-right" href="<?= base_url(); ?>mahasiswa" type="button">Kembali</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-2"></div>
</div>
<hr>
<div class="row">
  <div class="col-md-2"></div>
  <div class="col-md-8">
    <h3 class="text-center">Ganti Password</h3>
    <form action="#" class="form-horizontal" id="form_password">
      <div class="form-group">
        <label class="col-sm-3 control-label">Password Lama</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password" placeholder="Password Lama">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Password Baru</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password_baru" placeholder="Password Baru">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Ulangi Password Baru</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" name="password_baru_lagi" placeholder="Ulangi Password Baru">
          <span class="help-block"></span>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="button" class="btn btn-success" id="btnSave" onclick="reset_password()">Update</button>
          <a class="btn btn-danger pull-right" href="<?= base_url(); ?>mahasiswa" type="button">Kembali</a>
        </div>
      </div>
    </form>
  </div>
  <div class="col-md-2"></div>
</div>
<div id="flashdata" data-flashdata="<?= $this->session->flashdata('profil') ?>"></div>

<script src="<?= base_url(); ?>assets/js/jquery-1.12.4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("input").change(function() {
      $(this).parent().parent().removeClass('has-error');
      $(this).next().empty();
    })
    tampilkan_gambar()
  })

  function update_profil() {
    // $.ajax({
    //   url: "<?= site_url('mahasiswa/update_profil'); ?>",
    //   type: "POST",
    //   data: $('#form_profile').serialize(),
    //   dataType: "JSON",
    //   success: function(data) {
    //     if (data.status) {
    //       window.location = "<?= base_url('mahasiswa/profil'); ?>";
    //     } else {
    //       for (var i = 0; i < data.inputerror.length; i++) {
    //         $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
    //         $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
    //       }
    //     }
    //   },
    //   error: function(jqXHR, textStatus, errorThrown) {
    //     alert('data error, Error Login');
    //   }
    // });

    var data = new FormData($('#form_profile')[0])
    $.ajax({
      url: "<?= site_url('mahasiswa/update_profil') ?>",
      type: "POST",
      data: data,
      mimeType: "multipart/form-data",
      contentType: false,
      cache: false,
      processData: false,
      dataType: "JSON",
      success: function(data) {
        if (data.status) {
          tampilkan_gambar()
          Swal.fire({
            position: 'top-middle',
            icon: 'success',
            title: 'Profil berhasil diupdate',
            showConfirmButton: false,
            timer: 2000
          })
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
          }
        }
        $('#btnSave').text('Update');
        $('btnSave').attr('disabled', false);
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / Update data');
        $('btnSave').text('Update');
        $('btnSave').attr('disabled', false);
      }
    })
  }

  function tampilkan_gambar() {
    $('#gambar_tampil').load('<?= base_url('mahasiswa/ajax_gambar'); ?>')
  }

  function reset_password() {
    $.ajax({
      url: "<?= site_url('mahasiswa/update_password'); ?>",
      type: "POST",
      data: $('#form_password').serialize(),
      dataType: "JSON",
      success: function(data) {
        if (data.status) {
          window.location = "<?= base_url('mahasiswa/profil'); ?>";
        } else {
          for (var i = 0; i < data.inputerror.length; i++) {
            $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error');
            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
          }
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('data error, Error Login');
      }
    });
  }
</script>

<script>
  var flashdata = $('#flashdata').data('flashdata');
  if (flashdata) {
    swal.fire("Berhasil", flashdata, "success")
  };
</script>
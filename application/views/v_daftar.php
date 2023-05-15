<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPMI UPR | Daftar</title>
  <?php $pengaturan = $this->m_data->get_data('pengaturan')->row(); ?>
  <link href="<?php echo base_url().'/gambar/website/'.$pengaturan->logo; ?>" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/dist/css/adminlte.min.css">
</head>
<body class="dark-mode hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url(); ?>" class="h1"><b>SPMI</b>UPR</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form action="<?php echo base_url().'login/daftar_aksi' ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Full name" name="nama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('nama'); ?>
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="usernama">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('username'); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('email'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('password'); ?>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Retype password" name="passconf">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('passconf'); ?>
        <div class="form-group">
            <label>Fakultas</label>
            <select class="form-control" name="fakultas" id="fakultas">
              <option value="">- Pilih Fakultas</option>
              <?php foreach($fakultas as $k){ ?>
                <option <?php if(set_value('fakultas') == $k->fakultas_id){echo "selected='selected'";} ?> value="<?php echo $k->fakultas_id ?>"><?php echo $k->fakultas_nama; ?></option>
              <?php } ?>
            </select>
            <?php echo form_error('fakultas'); ?>
          </div>
          <div class="form-group">
            <label>Program Studi</label>
            <select class="form-control" name="prodi" id="prodi">
              <option value="">- Pilih Prodi -</option>
            </select>
            <?php echo form_error('prodi'); ?>
          </div>
        <div class="row">
          <div class="col-8">
            <a href="<?php echo base_url(). 'login'; ?>" class="text-center">I already have a membership</a>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="<?php echo base_url() ?>adm/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url() ?>adm/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>adm/dist/js/adminlte.min.js"></script>

<script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });

    $("#fakultas").change(function(){

// variabel dari nilai combo box kendaraan
var fakultas_id = $("#fakultas").val();

// Menggunakan ajax untuk mengirim dan dan menerima data dari server
    $.ajax({
        url : "<?php echo base_url();?>/login/get_prodi",
        method : "POST",
        data : {fakultas_id:fakultas_id},
        async : false,
        dataType : 'json',
        success: function(data){
            var html = '';
            var i;

            for(i=0; i<data.length; i++){
                html += '<option value='+data[i].prodi_id+'>'+data[i].prodi_nama+'</option>';
            }
            $('#prodi').html(html);

        }
    });
    });
  </script>

</body>
</html>
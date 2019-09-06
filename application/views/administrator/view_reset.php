<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta name="author" content="phpmu.com">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/asset/admin/plugins/iCheck/square/blue.css">
    <script type="text/javascript">
      function nospaces(t){
          if(t.value.match(/\s/g)){
              alert('Maaf, Password Tidak Boleh Menggunakan Spasi,..');
              t.value=t.value.replace(/\s/g,'');
          }
      }
    </script>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Reset</b> Password</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Silahkan isi form dibawah ini</p>
        <?php 
            if ($this->input->post('id_session')!=''){
            echo "<div class='alert alert-warning'><center>$title</center></div>";
          }
            echo form_open($this->uri->segment(1).'/reset_password'); 
        ?>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name='a' placeholder="Input Password Baru" onkeyup="nospaces(this)" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name='b' placeholder="Ulangi sekali lagi" onkeyup="nospaces(this)" required>
            <input type="hidden" name='id_session' value='<?php echo $this->session->id_session; ?>'>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <button name='submit' type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
              <a href='<?php echo base_url().$this->uri->segment(1); ?>/index' class="btn btn-default btn-block btn-flat">Kembali Login?</a>
            </div><!-- /.col -->
          </div>
        </form>
        <hr>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>/asset/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>/asset/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>/asset/admin/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
        
  </body>
</html>

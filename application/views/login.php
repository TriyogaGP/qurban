<?php date_default_timezone_set("Asia/Jakarta"); $tahun = date("Y");?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url('assets/')?>images/DP.png" type="image/ico" />

    <title><?=constant('TITLE')?></title>

    <!-- Bootstrap -->
    <link href="<?= base_url('assets/')?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url('assets/')?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url('assets/')?>vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url('assets/')?>vendors/animate.css/animate.min.css" rel="stylesheet">
    <!-- PNotify -->
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?= base_url('assets/')?>build/css/custom.min.css" rel="stylesheet">
    <style type="text/css">
      .field-icon {
        float: right;
        margin-right: 10px;
        margin-top: -42px;
        position: relative;
        z-index: 2;
      }
    </style>
  </head>

  <body class="login">
    coba ajaa
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="<?=base_url('auth')?>" method="POST" enctype="multipart/form-data">
              <?php if($this->session->flashdata('error')){ ?>
                <div class="flash-data" data-dataflash="<?= $this->session->flashdata('error');?>" data-validasi="error"></div>
              <?php }else if($this->session->flashdata('info')){ ?>
                <div class="flash-data" data-dataflash="<?= $this->session->flashdata('info');?>" data-validasi="info"></div>
              <?php $this->session->sess_destroy(); } ?>
              <h1>Panel Dashboard</h1>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email" required="" />
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Kata Sandi" required=""/>
                  <span toggle="#inputPassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <button class="btn btn-default submit">Masuk</button>
                  <a class="reset_pass" href="#">Lupa Kata Sandi?</a>
                </div>
              </div>
              <div class="clearfix"></div>
              <div class="separator">
                <div class="clearfix"></div>
                <div class="form-group">
                  <div class="col-md-12">
                    <img src="<?=base_url('assets/')?>images/DP.png" width="50%"><br><br>
                    <p>©<?= $tahun?> All Rights Reserved. <?=constant('TITLE')?></p>
                  </div>
                </div>
              </div>
            </form>
          </section>
        </div>

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form>
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Submit</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                  <p>©<?= $tahun?> All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
  <script src="<?= base_url('assets/')?>jquery-1.11.1.min.js"></script>
  <!-- PNotify -->
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.js"></script>
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.buttons.js"></script>
  <script src="<?= base_url('assets/')?>vendors/pnotify/dist/pnotify.nonblock.js"></script>
  <script type="text/javascript">
    function myFunction() {
        var x = document.getElementById("inputPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    let flashData = $('.flash-data').data('dataflash');
    let validasi = $('.flash-data').data('validasi');
    console.log(flashData);
    console.log(validasi);
    if(flashData){
      new PNotify({
        title: 'Pemberitahuan !!!',
        text: flashData,
        type: validasi,
        delay: 3000,
        styling: 'bootstrap3'
      });
    }
  </script>
</html>
  
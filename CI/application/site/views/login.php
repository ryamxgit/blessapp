<!DOCTYPE html>
<html lang="en-us" id="lock-page">
  <head>
    <meta charset="utf-8">
    <title> Administrador Producto Protegido</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    
        <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">

    <!-- SmartAdmin Styles : Please note (smartadmin-production.css) was created using LESS variables -->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-production.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/smartadmin-skins.css'); ?>">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('assets/css/lockscreen.css'); ?>">



    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon">

  </head>
  
  <body>

  <div id="main" role="main">

      <!-- MAIN CONTENT -->

      <!-- <form class="lockscreen animated flipInY" action="index.html"> -->
      <?php echo form_open("dashboard/login" , array('class' => 'lockscreen animated flipInY smart-form client-form', 'id' => 'login-form'));?>
        <div class="logo">
          <h1 class="semi-bold"> Ingreso Administración</h1>
        </div>
        <div>
          
          <div>
           <fieldset>
                  
                  <section>
                    <label class="label">E-mail</label>
                    <label class="input"> <i class="icon-append fa fa-user"></i>
                      <!-- <input type="email" name="email"> -->
                       <?php echo form_input($identity);?>
                      <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Por Favor ingrese Email</b></label>
                  </section>

                  <section>
                    <label class="label">Password</label>
                    <label class="input"> <i class="icon-append fa fa-lock"></i>
                      <!-- <input type="password" name="password"> -->
                      <?php echo form_input($password);?>
                      <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Ingrese su password</b> </label>
                  </section>
                </fieldset>
                <?php echo $message;?>
                <footer>
                  <button type="submit" class="btn btn-primary">
                    Ingresar
                  </button>
                </footer>
          </div>

        </div>
        <p class="font-xs margin-top-5">
          Copyright GQTech 2014.

        </p>
      </form>

    </div>

<!-- BOOTSTRAP JS -->
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js'); ?>"></script>
<!-- JQUERY VALIDATE -->
    <script src="<?php echo base_url('assets/js/plugin/jquery-validate/jquery.validate.min.js'); ?>"></script>
  <!-- JQUERY MASKED INPUT -->
    <script src="<?php echo base_url('assets/js/plugin/masked-input/jquery.maskedinput.min.js'); ?>"></script>
<!-- MAIN APP JS FILE -->
    <script src="<?php echo base_url('assets/js/app.js'); ?>"></script>
    <script type="text/javascript">
      runAllForms();

      $(function() {
        // Validation
        $("#login-form").validate({
          // Rules for form validation
          rules : {
            identity : {
              required : true,
              identity : true
            },
            password : {
              required : true,
              minlength : 3,
              maxlength : 20
            }
          },

          // Messages for form validation
          messages : {
            identity : {
              required : 'Por favor ingrese su email',
              identity : 'Por favor ingrese un email valido'
            },
            password : {
              required : 'Por favor ingrese su password'
            }
          },

          // Do not change code below
          errorPlacement : function(error, element) {
            error.insertAfter(element.parent());
          }
        });
      });
    </script>

  </body>
</html>

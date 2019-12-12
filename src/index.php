<!--
+======================={PROJECT - PRESENTATION}======================+
|                                                                     |
|Project Name    : THE DTS BANK                                       |
|Categorie       : Dynamic Website                                    |
|FrameWorks      : MDBootstrap                                        |
|Author          : OrbitTurner                                        |
|Official Name   : Mohamed GUEYE                                      |
|Version         : v.1.2                                              |
|Created         : 03-Mars-2019                                       |
|Last update     : 25-Juin-2019                                       |
|Partie          : LANDING INDEX                                      | 
|LANGAGE UTILISE : ANGLAIS - FRANCAIS                                 |
+=====================================================================+
 -->
<?php
  session_start();
  if ($_SESSION!=null) {
	require_once 'routes/dir.php';
	header('location:'.getProjectRoot().'home');
  }
  include 'header.php';
  if (isset($_GET['connexion']) && $_GET['connexion']==0){
    echo "Login ou mot de passe incorrect !";
  }
?>
<!--===============================================================================================-->	
<link rel="icon" type="<?=getProjectPath();?>login/image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?=getProjectPath();?>login/css/main.css">
<!--===============================================================================================-->
<!-- ===================================================== -->

<div class="limiter">
		<div class="container-login100" style="background-image: url('<?=getProjectPath();?>login/images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action='<?=getProjectPath();?>controller/userController.php' method="post" id="formConnect">
					<span class="login100-form-logo">		
						<!-- <i class="zmdi zmdi-landscape"></i> -->
						<img src="<?=getProjectPath();?>login/images/logon3.gif" width="100%" height="100%" alt="logon-logo" style="border-radius: 50%">
					</span>		

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="email" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pwd" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="connexion" type="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Forgot Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>	
  
	

	<div id="dropDownSelect1"></	
		div>
	
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?=getProjectPath();?>login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?=getProjectPath();?>login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="<?=getProjectPath();?>login/js/main.js"></script>
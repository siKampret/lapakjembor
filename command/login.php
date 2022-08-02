<?php
session_start();
	$koneksi = new mysqli ("localhost","root","","lapakdjemboer");
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Login Lapak</title>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<link href="assets/css/stylelogin.css" rel="stylesheet" type="text/css" media="all" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<!-- -->
<script>var __links = document.querySelectorAll('a');function __linkClick(e) { parent.window.postMessage(this.href, '*');} ;for (var i = 0, l = __links.length; i < l; i++) {if ( __links[i].getAttribute('data-t') == '_blank' ) { __links[i].addEventListener('click', __linkClick, false);}}</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>$(document).ready(function(c) {
	$('.alert-close').on('click', function(c){
		$('.message').fadeOut('slow', function(c){
	  		$('.message').remove();
		});
	});	  
});
</script>
</head>
<body>
<!-- contact-form -->	
<div class="message warning">
<div class="inset">
	<div class="login-head">
		<h1>Login Form</h1>
		 <div class="alert-close"> </div> 			
	</div>
		<form method="post">
			<li>
				<input type="text" class="text" value="Username" name="username" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Username';}"><a href="#" class=" icon user"></a>
			</li>
				<div class="clear"> </div>
			<li>
				<input type="password" value="Password" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}"> <a href="#" class="icon lock"></a>
			</li>
			<div class="clear"> </div>
			<div class="submit">
				<input type="submit" onclick="myFunction()" name="login" value="Sign in" >
				<h4><a href="#">Lost your Password ?</a></h4>
						  <div class="clear">  </div>	
			</div>
		</form>
		<?php
			if (isset($_POST['login']))
			{
				$ambil = $koneksi -> query ("SELECT * FROM admin WHERE username = '$_POST[username]' AND password = '$_POST[password]' ");
				$yangcocok = $ambil -> num_rows;
				if ($yangcocok == 1)
				{
					$_SESSION['admin'] = $ambil -> fetch_assoc();
					echo "<div class = 'alert alert-info'>Login Sukses</div>";
					echo "<meta http-equiv='refresh' content='1;url=index.php?page=dashboard'>";
				}
				else
				{
					echo "<div class='alert alert-danger'>Login Gagal</div>";
					echo "<meta http-equiv='refresh' content='1;url=login.php'>";
				}
			}
		?>
		</div>					
	</div>
	</div>
	<div class="clear"> </div>
<!--- footer --->
<div class="footer">
	
</div>
</body>
</html>
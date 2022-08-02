<?php
session_start();

include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Pelanggan</title>
	<link rel="stylesheet" type="text/css" href="style/css/bootstrap.css">
</head>
<body>

<!-- menu.php -->
<?php include 'menu.php'; ?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-tittle">Login Pelanggan</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="text" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control">
							</div>
							<button class="btn btn-primary" name="login">Login</button>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
	// jika ada tombol login (tombol login ditekan)
	if (isset($_POST["login"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		// lakukan query mengecek akun di tabel pelanggan di database
		$ambil = $koneksi->query("SELECT * FROM pelanggan 
			WHERE email_pelanggan = '$email' AND password_pelanggan = '$password' ");

		// menghitung akun yang terambil
		$akunyangcocok = $ambil->num_rows;

		// jika 1 akun yang cocok, maka akan diloginkan
		if ($akunyangcocok==1)
		{
			// anda sudah login
			// medapatkan akun dalam bentuk array
			$akun = $ambil->fetch_assoc();
			// simpan di session pelanggan
			$_SESSION["pelanggan"] = $akun;

			echo "<script>alert('anda sukses login');</script>";

			// jika sudah belanja
			if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])) 
			{
				echo "<script>location='checkout.php';</script>";

			}
			echo "<script>location='index.php';</script>";
		}
		else
		{
			// anda gagal login
			echo "<script>alert('anda gagal login, periksa kembali akun anda !');</script>";
			echo "<script>location='login.php';</script>";
		}

	}

	?>
</body>
</html>
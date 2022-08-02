<?php
session_start();
    $koneksi = new mysqli("localhost","root","","lapakdjemboer");



    if (!isset($_SESSION['admin']))
    {
        echo "<script>alert('Anda harus login !');</script>";
        echo "<script>location='login.php';</script>";
        header('location:login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Lapak Djemboer</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />

   <script src="assets/js/jquery-1.10.2.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Lapak admin</a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><a href="index.php?page=logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                    <img src="assets/img/find_user.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a class="active-menu"  href="#"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="index.php?page=dashboard"><i class="fa fa-dashboard"></i>Home</a>
                    </li>
                    <li>
                        <a href="index.php?page=kategori"><i class="fa fa-bars"></i>Kategori</a>
                    </li>
                    <li>
                        <a href="index.php?page=produk"><i class="fa fa-shopping-cart" ></i>Produk</a>
                    </li>
                    <li>
                        <a href="index.php?page=pembelian"><i class="fa fa-shopping-cart"></i>Pembelian</a>
                    </li>
                    <li>
                        <a href="index.php?page=pelanggan"><i class="fa fa-user"></i>Pelanggan</a>
                    </li>
                    <li>
                        <a href="index.php?page=laporan_pembelian"><i class="fa fa-file"></i>Laporan</a>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                    if (isset($_GET['page']))
                    {
                        if ($_GET['page']=='dashboard')
                        {
                            include 'page/dashboard/dashboard.php';
                        }
                        elseif ($_GET['page']=='produk') 
                        {
                            include 'page/produk/produk.php';
                        }
                        elseif ($_GET['page']=='tambahproduk')
                        {
                            include 'page/produk/tambahdata.php';
                        }
                        elseif ($_GET['page']=='ubahproduk')
                        {
                            include 'page/produk/ubahproduk.php';
                        }
                        elseif ($_GET['page']=='hapusproduk')
                        {
                            include 'page/produk/hapusproduk.php';
                        }
                        elseif ($_GET['page']=='detail_produk')
                        {
                            include 'page/detail_produk/detailproduk.php';
                        }
                        elseif ($_GET['page']=='hapusfotoproduk')
                        {
                            include 'page/detail_produk/hapusfotoproduk.php';
                        }
                        elseif ($_GET['page']=='kategori') 
                        {
                            include 'page/kategori/kategori.php';
                        }
                        elseif ($_GET['page']=='tambah_kategori')
                        {
                            include 'page/kategori/tambah_kategori.php';
                        }
                        elseif ($_GET['page']=='pembelian')
                        {
                            include 'page/pembelian/pembelian.php';
                        }
                        elseif ($_GET['page']=='pelanggan')
                        {
                            include 'page/pelanggan/pelanggan.php';
                        }
                        elseif ($_GET['page']=='detail')
                        {
                            include 'page/detail/detail.php';
                        }
                        elseif ($_GET['page']=='pembayaran')
                        {
                            include 'page/pembayaran/pembayaran.php';
                        }
                        elseif ($_GET['page']=='laporan_pembelian') 
                        {
                            include 'page/laporan/laporan.php';
                        }
                        elseif ($_GET['page']=='logout')
                        {
                            include 'logout.php';
                        }
                    }
                ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>

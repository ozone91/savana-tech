<?PHP
	require ('../config/hotel.conn.php');
	require_once ('../library/function.cracked.php');
	require_once ('../library/function.convert.date.php');
	require_once ('../library/function.number.php');
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	//unset($_SESSION['xcd']);
	//unset($_SESSION['spr']);
	//unset($_SESSION['tmr']);
	//UNCRACKED SPEC
		//INFORMASI CLIENT DESTINATION
			$menu 				= crackedSpec($_GET['spec'],0);
			$tujuanPerjalanan	= crackedSpec($_GET['spec'],1);
			$tglBerangkat 		= crackedSpec($_GET['spec'],2);
			$jumlahOrang	 	= crackedSpec($_GET['spec'],3);
			$kodeKategory 		= crackedSpec($_GET['spec'],4);
			$kulId		 		= crackedSpec($_GET['spec'],5);
			
			//AMBIL INFORMASI CAR
			$qryWisata 		= $conn->query("SELECT a.hotel_id,a.kode_kategory,a.hotel_nama,a.hotel_address,a.hotel_img,a.hotel_avg,b.prov_nama,c.kota_nama FROM m_hotel a INNER JOIN m_prov b ON a.prov_id = b.prov_id INNER JOIN m_kota c ON a.kota_id = c.kota_id WHERE a.kode_kategory = '".$kodeKategory."' AND a.hotel_id = '".$kulId."'");
			$strWisata 		= $qryWisata->fetch(PDO::FETCH_ASSOC);
			
			$strWiskulId	= $strWisata['hotel_id'];
			$kodeKategori	= $strWisata['kode_kategory'];
			$strWiskulNama	= $strWisata['hotel_nama'];
			$strWiskulImg	= $strWisata['hotel_img'];
			$strWiskulHarga	= $strWisata['hotel_avg'];
			
			//CONVERSI WAKTU BERANGKAT
			$hariKeberangkatan		= dayChoice($tglBerangkat);
			$tglBerangakatFormat 	= convertDate($tglBerangkat);
			
			
			if(isset($_SESSION['bks']) && $_SESSION['bks'] != ''){
				$noKursi = $_SESSION['bks'];
			}else{
				//ACAK NOMOR------------------------------------------------------
				$noKursi = acak(6);
				//----------------------------------------------------------------
			}
			
			if(isset($_SESSION['cmj']) && $_SESSION['cmj'] != ''){
				$sudahAdaNo = $_SESSION['cmj'];
			}else{
				$sudahAdaNo = '0';
			}
?>
<!DOCTYPE html>
<html>
  <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Walanja - Online Booking</title>
	<!-- STYLESHEETS --><!--[if lt IE 9]><script src="js/flot/excanvas.min.js"></script><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script><![endif]-->
	<link rel="stylesheet" type="text/css" href="../booking/css/cloud-admin.css" >
	<link rel="stylesheet" type="text/css"  href="../booking/css/themes/default.css" id="skin-switcher" >
	<link rel="stylesheet" type="text/css"  href="../booking/css/responsive.css" >
	<link rel="stylesheet" type="text/css"  href="../booking/css/tes.css" >
	<!-- GRITTER -->
	<link rel="stylesheet" type="text/css" href="../booking/js/gritter/css/jquery.gritter.css" />
	
	<link href="../booking/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- DATE RANGE PICKER -->
	<link rel="stylesheet" type="text/css" href="../booking/js/bootstrap-daterangepicker/daterangepicker-bs3.css" />
	<!-- SELECT2 -->
	<link rel="stylesheet" type="text/css" href="../booking/js/select2/select2.min.css" />
	<!-- UNIFORM -->
	<link rel="stylesheet" type="text/css" href="../booking/js/uniform/css/uniform.default.min.css" />
	<!-- WIZARD -->
	<link rel="stylesheet" type="text/css" href="../booking/js/bootstrap-wizard/wizard.css" />
	<link rel="stylesheet" type="text/css" href="../booking/js/timepicker/bootstrap-timepicker.min.css" />
	<!-- FONTS -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="../plugins/countdown/jquery.countdown.css">
	<style type="text/css">
		#defaultCountdown { width: 100%; height: auto; }
	</style>
</head>
  <body id="top" class="thebg" >
    <!-- FOOTER -->
		<section id="header" class="clearfix paymentGreyContainer">
			<div class="container">
				<div id="column-header" class="row-fluid">
					<img src="../images/logo.png" />
				</div>
			  </div>
		</section>
		<!--/FOOTER -->
	<br>
	<!-- CONTENT -->
	<div class="container">
		<div class="container pagecontainer offset-0">	

			<!-- SLIDER -->
			<div class="col-md-8 details-slider">
			
				<div id="c-carousel">
				<div id="wrapper">
				<div id="inner">
					<!-- SAMPLE -->
						<div class="row">
							<div class="col-md-12">
								<!-- BOX -->
								<div class="box" id="formWizard">
									<div class="box-title">
										<h4>Formulir Pemesanan Restoran - <span class="stepHeader">Tahap 1 dari 6</h4>
									</div>
									<div class="box-body form">
										<form id="wizForm" action="#" class="form-horizontal" method="POST">
										<div class="wizard-form">
										   <div class="wizard-content">
											  <ul class="nav nav-pills nav-justified steps">
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#account" class="wiz-step">
													<span class="step-number">1</span>
													<span class="step-name"><i class="fa fa-check"></i> Isi Data Pribadi </span>   
													</a>
												 </li>
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#bookmeja" class="wiz-step">
													<span class="step-number">2</span>
													<span class="step-name"><i class="fa fa-check"></i> Pesan Meja </span>   
													</a>
												 </li>
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#bookmakan" class="wiz-step">
													<span class="step-number">3</span>
													<span class="step-name"><i class="fa fa-check"></i> Pesan Makanan </span>   
													</a>
												 </li>
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#payment" class="wiz-step">
													<span class="step-number">4</span>
													<span class="step-name"><i class="fa fa-check"></i> Informasi Pembayaran</span>   
													</a>
												 </li>
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#genvoucher" class="wiz-step">
													<span class="step-number">5</span>
													<span class="step-name"><i class="fa fa-check"></i> Gunakan Voucher</span>   
													</a>
												 </li>
												 <li>
													<a href="javascript:;" data-toggle="tab" data-target="#confirm" class="wiz-step">
													<span class="step-number">6</span>
													<span class="step-name"><i class="fa fa-check"></i> Selesai </span>   
													</a> 
												 </li>
											  </ul>
											  <div id="bar" class="progress progress-striped progress-sm active" role="progressbar">
												 <div class="progress-bar progress-bar-warning"></div>
											  </div>
											  <div class="tab-content">
												 <div class="alert alert-danger display-none">
													<a class="close" aria-hidden="true" href="#" data-dismiss="alert">×</a>
													Formulir Anda memiliki kesalahan. Silakan memperbaikinya untuk melanjutkan.
												 </div>
												 
												 
												 <div id="logguest">
												  <form id="formcekguest" action="#" method="POST">
													<h4 class="block">Sudah Punya Akun?</h4>
													<div class="form-group">
													   <label class="control-label col-md-3">Email<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="text" class="form-control" name="emailcek" placeholder="Masukan Email"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Kata Sandi<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="password" class="form-control" name="passwordcek" placeholder="Masukan Sandi"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="wizard-buttons">
													  <div class="row">
														 <div class="col-md-12">
															<div class="col-md-offset-3 col-md-9">
															   <a href="javascript:;" id="ceklog" class="btn btn-primary">
																Masuk <i class="fa fa-lock"></i>
															   </a>                          
															</div>
														 </div>
													  </div>
												   </div>
												   </form>
													</div>
												 <!--// TAB SATU -->
												 <div class="tab-pane" id="account">
													<h4>Buat Akun</h4>
													<div class="form-group">
													   <label class="control-label col-md-3">Email<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="text" class="form-control" name="email" placeholder="Please provide email address"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Kata Sandi<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="password" class="form-control" name="password" placeholder="Please provide password"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Nama<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="text" class="form-control" name="name" placeholder="Please provide your name"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Jenis Kelamin<span class="required">*</span></label>
													   <div class="col-md-4">
															 <label class="radio">
																<input type="radio" name="gender" value="M" data-title="Male" class="uniform" checked="checked" />
															 Laki-Laki
															 </label>
															 <label class="radio">
																<input type="radio" name="gender" value="F" data-title="Female" class="uniform"/>
															 Perempuan
															 </label>														  
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Lokasi<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="text" class="form-control" name="location" placeholder="Please provide home address"/>
														  <span class="error-span"></span>
													   </div>
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">Negara</label>
													   <div class="col-md-4">
														  <select name="country" id="country_select" class="col-md-12 full-width-fix">
															 <option value=""></option>
															 <?PHP
																$qrycountry 	= "SELECT * FROM m_country";
																$stmtcountry 	= $conn->prepare( $qrycountry );
																$stmtcountry->execute();		 
																while ($rowcountry = $stmtcountry->fetch(PDO::FETCH_ASSOC)){
																extract($rowcountry);
															 ?>
															 <option value="<?PHP echo $count_kode?>"><?PHP echo $count_name?></option>
															 <?PHP
																}
															 ?>
														  </select>
													   </div>													
													</div>
													<div class="form-group">
													   <label class="control-label col-md-3">No. Telepon<span class="required">*</span></label>
													   <div class="col-md-4">
														  <input type="text" class="form-control" name="phone" placeholder="Please provide phone number"/>
														  <span class="error-span"></span>
													   </div><br><br><br><br>
													  
													</div>
												 </div>
												 
												 <!--// TAB DUA -->
												 <div class="tab-pane" id="bookmeja">
													
													<h4>Ketentuan</h4>
													<div class="form-group">
													<div class="col-md-12">
														<p>1. Pilih salah satu meja yang akan anda pesan</p>
														<p>2. kursi <b style="color: blue">Warna Biru</b> Masih Kosong</p>
														<p>3. kursi <b style="color: red">Warna Merah</b> Terisi</p>
														<p>4. Tidak di kenakan biaya untuk pemesanan meja</p>
													</div>
													</div>
													<div class="form-group">
													<div class="col-md-12">	
													   <div id="view-meja"></div>
													</div>
													</div>
												 </div>
												 
												  <!--// TAB TIGA -->
												 <div class="tab-pane" id="bookmakan">
													<h4>Pilihan Menu Makanan & Minuman</h4>

													<p>Pilihan Aneka Masakan</p>
													<div class="form-group">
													<div class="col-md-12">
													<?PHP
														$qryMenuMasakan	= "SELECT * FROM m_menu_masakan WHERE hotel_id = '".$strWiskulId."'";
														$stmtMenuMasakan= $conn->prepare( $qryMenuMasakan );
														$stmtMenuMasakan->execute();		 
														while ($rowMenuMasakan = $stmtMenuMasakan->fetch(PDO::FETCH_ASSOC)){
														extract($rowMenuMasakan);
													?>
														<div class="col-lg-3" id="<?PHP echo $menu_masakan_id?>" style="margin-left: auto;margin-right: auto;border: 1px solid grey;cursor: pointer;border-radius: 10px;background-color: cornsilk;">
															<p style="margin-left: 29px;margin-right: auto;font-family: Freestyle Script;font-size: 25px;"><?PHP echo $menu_masakan_nama?></p>
															
															<img style="border-radius: 10px;margin-left: 28px;margin-right: auto;width: 100px;height: 100px" src="../images/menu_masakan/<?PHP echo $menu_image?>"/>
															<p style="margin-left: 36px;margin-right: auto;font-family: Freestyle Script;font-size: 20px;">Rp. <?PHP echo number_format($menu_harga,2,",",".");?></p>
														</div>
													<?PHP
														}
													?>
													</div>
													</div>
												 </div>
												 
												 <!--// TAB EMPAT -->
												 <div class="tab-pane" id="payment">
													<h3 class="block">Pembayaran</h3>
													 <p class="alert alert-block alert-warning fade in"><i class="fa fa-exclamation-circle"></i><i> Silahkan selesaikan pembayaran anda</i> untuk menghindari pembatalan oleh pihak kami.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pembayaran dapat dilakukan ke rekening yang sudah tertera dibawah :</p>
														<div class="jumbotron">
														<div class="row">
															<!--<div class="col-md-6">
																<p><img src="images/bank_icon/bca.png" /><img src="images/bank_icon/mandiri.png" /></p>	
															</div> -->
														</div> 
														<div class="row">
															<!--<div class="col-md-6">
																<p>Rek Bank Mandiri Cabang Pasteur <br>No. 132.001.099.7022 <br>a.n. PT. Citra Jelajah Informatika</p>
																<p>Rek BCA Cabang Dago <br>No. 777.054.0300 <br>a.n. PT. Citra Jelajah Informatika</p>
															</div>-->
														</div>
														<div><img src="../booking/css/banner_right.png" alt="banner_left" style="width:100%;height:100%">
														</div>
														</div>												
												 </div>
												 
												 <!--// TAB EMPAT -->
												 <div class="tab-pane" id="genvoucher">
													<h4>Penggunaan Voucher</h4>
														<div class="form-group">
															<div class="col-md-12">
															<div class="clearfix paymentGreyContainer" style="background-color: #d9534f">
																<label class="control-label col-md-4" style="color: white">Gunakan Kode Voucher Anda Disini :</label>
																<div class="form-group">
																<div class="col-md-4">
																<input type="text" class="form-control" name="voc_code" placeholder="Masukan Kode Voucher"/>
																</div>
																<div class="col-md-3">
																  <a class="btn btn-info" id="cekvoc">Gunakan Voucher</a>
																</div>
																</div>
															</div>
															</div>
														</div>
														<h4>Ketentuan Penggunaan Voucher</h4>
														<div class="form-group">
															<div class="col-md-12">
																<table width="100%">
																	<tr>
																		<td width="3%" align="center">1.</td>
																		<td>Total Pembayaran yang tertera di samping kanan halaman adalah total pembayaran sebelum di potong discount.</td>
																	</tr>
																	<tr>
																		<td width="3%" align="center">2.</td>
																		<td>Perhatikan total pembayaran setelah voucher di gunakan.</td>
																	</tr>
																	<tr>
																		<td width="3%" align="center">3.</td>
																		<td>voucher hanya berlaku untuk 1x pemakaian.</td>
																	</tr>
																	<tr>
																		<td width="3%" align="center">4.</td>
																		<td>hubungi customer service kami di 022-9291-4001 atau kirim email ke sales@walanja.co.id jika voucher tidak bisa di gunakan</td>
																	</tr>
																</table>
															</div>
														</div>
												 </div>
												 
												 <!--// TAB LIMA -->
												 <div class="tab-pane" id="confirm">
													<h3 class="block">Pemberitahuan</h3>
													<div class="well">
														<p>Kami akan mengirimkan anda email untuk informasi lebih lanjut mengenai konfirmasi pembayaran, kirim email ke <b>sales@walanja.co.id</b>  atau hubungi customer service kami di (<b>022-9291-4001</b>) apabila email belum juga anda terima.</p>
														<p><i>We will send you email for more information about confirmation of payment, send an email to <b>sales@walanja.co.id</b> or contact our customer service at (<b>022-9291-4001</b>) if you have not received the email.</i></p><br>
														<p>Kami akan segera memproses order Anda apabila:</p>
														<p>&nbsp;&nbsp;1. Pembayaran telah kami terima</p>
														<p>&nbsp;&nbsp;2. Konfirmasi Pembayaran Bank Transfer telah dilakukan melalui website paling lambat 20 MENIT terhitung setelah anda menyelesaikan pengisian formulir pemesanan dan menyetujui peraturan yang berlaku di walanja.co.id.</p>
														<p>&nbsp;&nbsp;3. pilih check box di bawah ini untuk persetujuan pemesanan, apabila telah di setujui itu artinya anda telah mengerti dan menyetujui dengan peraturan yang berlaku di walanja.co.id.</p><br>
														
														<p><i>We will process your order when:</i></p>
														<p>&nbsp;&nbsp;<i>1. Your payment is received.</i></p>
														<p>&nbsp;&nbsp;<i>2. Bank Transfer Payment Confirmation has been done through the website later than 20 MINUTE starting after reservation is made.</i></p>
														<p>&nbsp;&nbsp;<i>3. Choose the check box below for the booking approval, if it has been to be approved, that means that you have come to understand and agree with the rules the applicable in walanja.co.id.</i></p><br>
														<div>
															<input type="checkbox" name="app" id="app" value="1"/> <b>ya, saya setuju. (<i>i agree</i>)</b>
														</div>
													</div>
												 </div>
											  </div>
										   </div>
										   <div class="wizard-buttons">
											  <div class="row">
												 <div class="col-md-12">
													<div class="col-md-offset-3 col-md-9">
													   <a href="javascript:;" class="btn btn-default prevBtn">
														<i class="fa fa-arrow-circle-left"></i> Back 
													   </a>
													   <a href="javascript:;" class="btn btn-primary nextBtn">
														Lanjutkan <i class="fa fa-arrow-circle-right"></i>
													   </a>
													   <a href="javascript:;" class="btn btn-success submitBtn">
														Selesai <i class="fa fa-arrow-circle-right"></i>
													   </a>                            
													</div>
												 </div>
											  </div>
										   </div>
										   <div class="alert alert-success display-none">
													Pemesanan Berhasil
												 </div>
										   <div id="loading">
												<img src="../images/load.gif"/>
										   </div>
										</div>
									 </form>
									</div>
								</div>
								<!-- /BOX -->
							</div>
						</div>
						<!-- /SAMPLE -->
				</div>
				
					
		</div>
		</div> <!-- /c-carousel -->
			</div>
			<!-- END OF SLIDER -->			
			<br>
			<!-- RIGHT INFO -->
			<div class="row">
			<div class="col-md-4">
				<div class="row">
				<div class="color-light pattern">
				<div class="clearfix paymentGreyContainer" align="center">
				 <span class="label label-danger arrow-out arrow-out-right">Perhatian !</span>
				 <br><br><p><b>Waktu yang Tersisa Untuk anda menyelesaikan pengisian formulir pemesanan</b></p>
				 <center><h3><b><div id="defaultCountdown"></div></b></h3></center>
				</div>
				</div>
				</div>
				<h3>Rincian Pemesanan Restoran</h3>
				<div class="row">
				<div class="color-light pattern">
				<div class="clearfix paymentGreyContainer" style="background-color: rgb(255, 207, 119)">
				 <h3><b style="font-family: Freestyle Script;font-size: 50px;"><?PHP echo $strWiskulNama?></b></h3>
				</div>
				<div class="clearfix paymentGreyContainer">
					<table width="100%">
						<tr>
							<td colspan="3" align="center" style="background-color: #70AFC4;color: white"><h4><b style="font-family: Edwardian Script ITC;font-size: 35px;">Informasi Pengunjung</b></h4></td>
						</tr>
						<tr>
							<td><h4><b>Jml Orang</b></h4></td>
							<td colspan="2"><h4><b>: <?PHP echo $jumlahOrang?></b></h4></td>
						</tr>
						<tr>
							<td><h4><b>Tgl Kunjungan</b></h4></td>
							<td colspan="2"><h4><b>: <?PHP echo $hariKeberangkatan?>, <?PHP echo $tglBerangakatFormat?></b></h4></td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td colspan="3" align="center" style="background-color: #70AFC4;color: white"><h4><b style="font-family: Edwardian Script ITC;font-size: 35px;">Nomor Meja</b></h4></td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td colspan="3" align="center" ><span class="badge badge-red"><h3><b style="font-family: Freestyle Script;font-size: 25px;" id="noMeja"><?PHP echo $sudahAdaNo;?></b></h3></span></td>
						</tr>
					</table>
					<table width="100%">
						<tr>
							<td colspan="3" align="center" style="background-color: #70AFC4;color: white"><h4><b style="font-family: Edwardian Script ITC;font-size: 35px;">Makanan Pesanan</b></h4></td>
						</tr>
					</table>
					<table width="100%" id="view-mount"></table>
					<table width="100%" id="loadvoc" style="display: none"></table>
				</div>
				<div class="clearfix paymentGreyContainer">
					<p><span class="label label-warning arrow-out arrow-out-right">Perhatian !</span><br><br>Periksa Kembali Pemesanan Anda apakah sudah sesuai, apabila ada kesalahan dalam pemesanan ulangi kembali tahap pemesanan</p>
				</div>
					<div><!--<img src="booking/css/banner_left.png" alt="banner_left" style="width:100%;height:100%">-->
					</div>
				</div>
				</div>
			</div>	
			</div>
			<!-- END OF RIGHT INFO -->
		</div>
	</div>
	
	
	<!--/PAGE -->
	<!-- JAVASCRIPTS -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- JQUERY -->
	<script src="../booking/js/jquery/jquery-2.0.3.min.js"></script>
	<!-- JQUERY UI-->
	<script src="../booking/js/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.min.js"></script>
	<!-- BOOTSTRAP -->
	<script src="../booking/bootstrap-dist/js/bootstrap.min.js"></script>
	
		
	<!-- DATE RANGE PICKER -->
	<script src="../booking/js/bootstrap-daterangepicker/moment.min.js"></script>
	
	<script src="../booking/js/bootstrap-daterangepicker/daterangepicker.min.js"></script>
	<!-- SLIMSCROLL -->
	<script type="text/javascript" src="../booking/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.min.js"></script>
	<script type="text/javascript" src="../booking/js/jQuery-slimScroll-1.3.0/slimScrollHorizontal.min.js"></script>
	<!-- BLOCK UI -->
	<script type="text/javascript" src="../booking/js/jQuery-BlockUI/jquery.blockUI.min.js"></script>
	<!-- SELECT2 -->
	<script type="text/javascript" src="../booking/js/select2/select2.min.js"></script>
	<!-- UNIFORM -->
	<script type="text/javascript" src="../booking/js/uniform/jquery.uniform.min.js"></script>
	<!-- WIZARD -->
	<script src="../booking/js/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
	<!-- WIZARD -->
	<script src="../booking/js/jquery-validate/jquery.validate.min.js"></script>
	<script src="../booking/js/jquery-validate/additional-methods.min.js"></script>
	<!-- GRITTER -->
	<script type="text/javascript" src="../booking/js/gritter/js/jquery.gritter.min.js"></script>
	<!-- BOOTBOX -->
	<script type="text/javascript" src="../booking/js/bootbox/bootbox.min.js"></script>
	<script type="text/javascript" src="../booking/js/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- COOKIE -->
	<script type="text/javascript" src="../booking/js/jQuery-Cookie/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="../plugins/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="../plugins/countdown/jquery.countdown.js"></script>
	<!-- CUSTOM SCRIPT -->
	<script src="../booking/js/script.js"></script>
	<script type="text/javascript">
	
	
	
	function closeWindow() {
		window.location.href='//walanja.co.id';
	}
	
	$(function () {
		$('#defaultCountdown').countdown({until: 1800});
	});
	//TIMER CLOSE FORM
	var myVarCloseForm=setInterval(function(){loadCloseForm()},1800000);
		function loadCloseForm() {
			closeWindow();
		}
		
			$(document).ready(function(){
				$('#ceklog').bind("click", function () {
					var emailcek 	= $('input:text[name=emailcek]').val();
					var passwordcek = $('input:password[name=passwordcek]').val();
						$.ajax({
								url: '../getguest.php',
								type: 'GET',
								data: 'emailcek='+emailcek+'&passwordcek='+passwordcek,
								cache: false,
								success: function(rescek) {
									//alert(rescek);
									$('#account').html(rescek);
								}
							});
				});
				$('#cekvoc').bind("click", function () {
					var wiskulId	= '<?PHP echo $kulId?>';
					var vocode 		= $('input:text[name=voc_code]').val();
					$('#loadvoc').html('<img src="../images/loadvoc.gif" />').show();
					var myVarloadvoc=setInterval(function(){loadingvoc()},2000);
					function loadingvoc() {
					$.ajax({
								url: 'loadpesanan.php',
								type: 'GET',
								data: 'wiskulId=' + wiskulId + '&vocode=' + vocode,
								cache: false,
								success: function(resvoc) {
									//alert(resvoc);
									$('#view-mount').html(resvoc);
									$('#loadvoc').html('<img src="../images/loadvoc.gif" />').hide();
									var myVarwarvoc = setInterval(function(){closewarvoc()},4000);
									function closewarvoc() {
										$('#warvoc').hide('fast');
										clearTimeout(myVarwarvoc);
									}
								}
							});
							clearTimeout(myVarloadvoc);
					}
				});
			});
	
	
	var myVarwar=setInterval(function(){closewar()},4000);
				function closewar() {
					$('#warning').hide('fast');
				}
		var FormWizard = function () {
    return {
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }
			/*-----------------------------------------------------------------------------------*/
			/*	Show country list in Uniform style
			/*-----------------------------------------------------------------------------------*/
            $("#country_select").select2({
                placeholder: "Select your country"
            });
			$("#bank").select2({
                placeholder: "Select your bank"
            });

            var wizform = $('#wizForm');
			var alert_success = $('.alert-success', wizform);
            var alert_error = $('.alert-danger', wizform);
            var alert_info = $('.alert-info', wizform);
            
			/*-----------------------------------------------------------------------------------*/
			/*	Validate the form elements
			/*-----------------------------------------------------------------------------------*/
            wizform.validate({
                doNotHideMessage: true,
				errorClass: 'error-span',
                errorElement: 'span',
                rules: {
                    /* Create Account */
					email: {
                        required: true,
                        email: true
                    },
                    password: {
                        minlength: 3,
                        required: true
                    },
                    name: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    location: {
                        required: true
                    },
					rent_jam_ambil: {
                        required: true
                    },
                    country: {
                        required: true
                    },
					phone: {
                        required: true
                    },
					bank: {
                        required: true
                    }
					/* image: {
                        required: true
                    },
					                 
                    account_number: {
						required: true,
                        minlength: 16,
                        maxlength: 16
                    }, 
                    card_cvc: {
						required: true,
                        digits: true,
                        minlength: 3,
                        maxlength: 3
                    },
                    card_expirydate: {
                        required: true
                    },
					 card_holder_name: {
                        required: true
                    }
					*/
                },

                invalidHandler: function (event, validator) { 
                    alert_success.hide();
                    alert_error.show();
                },

                highlight: function (element) { 
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); 
                },

                unhighlight: function (element) { 
                    $(element)
                        .closest('.form-group').removeClass('has-error'); 
                },

                success: function (label) {
                    if (label.attr("for") == "gender") { 
                        label.closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); 
                    } else { 
                        label.addClass('valid') 
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); 
                    }
                }
            });

            /*-----------------------------------------------------------------------------------*/
			/*	Initialize Bootstrap Wizard
			/*-----------------------------------------------------------------------------------*/
            $('#formWizard').bootstrapWizard({
                'nextSelector': '.nextBtn',
                'previousSelector': '.prevBtn',
                onNext: function (tab, navigation, index) {
                    alert_success.hide();
                    alert_error.hide();
                    if (wizform.valid() == false) {
                        return false;
                    }
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    $('.stepHeader', $('#formWizard')).text('Tahap ' + (index + 1) + ' dari ' + total);
                    jQuery('li', $('#formWizard')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }
                    if (current == 1) {
                        $('#formWizard').find('.prevBtn').hide();
                       
                    } else {
                        $('#formWizard').find('.prevBtn').show();
						$('#logguest').hide();
                    }
					if (current == 2) {
						$('#formWizard').find('.prevBtn').hide();
                    }
					if (current == 3) {
						$('#formWizard').find('.prevBtn').hide();
					}
					if (current == 4) {
						$('#formWizard').find('.prevBtn').hide();
					}
					if (current == 5) {
						$('#formWizard').find('.prevBtn').hide();
					}
					if (current == 6) {
						$('#formWizard').find('.prevBtn').hide();
					}
                    if (current >= total) {
                        $('#formWizard').find('.nextBtn').hide();
                        $('#formWizard').find('.submitBtn').hide();
						
						$('#app').change(
							function () {
								if ($('#app').is(':checked')) {
									$('#formWizard').find('.submitBtn').show();
								}  
								else {
									$('#formWizard').find('.submitBtn').hide();
								}
						});
						
                    } else {
                        $('#formWizard').find('.nextBtn').show();
                        $('#formWizard').find('.submitBtn').hide();
                    }
                },
                onPrevious: function (tab, navigation, index) {
                    alert_success.hide();
                    alert_error.hide();
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    $('.stepHeader', $('#formWizard')).text('Tahap ' + (index + 1) + ' dari ' + total);
                    jQuery('li', $('#formWizard')).removeClass("done");
                    var li_list = navigation.find('li');
                    for (var i = 0; i < index; i++) {
                        jQuery(li_list[i]).addClass("done");
                    }
                    if (current == 1) {
                        $('#formWizard').find('.prevBtn').hide();
						$('#logguest').show();
                    } else {
                        $('#formWizard').find('.prevBtn').show();
                    }
                    if (current >= total) {
                        $('#formWizard').find('.nextBtn').hide();
                        $('#formWizard').find('.submitBtn').show();
                    } else {
                        $('#formWizard').find('.nextBtn').show();
                        $('#formWizard').find('.submitBtn').hide();
                    }
                },
				onTabClick: function (tab, navigation, index) {
                    bootbox.alert('silahkan melengkapi pengisian');
                    return false;
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#formWizard').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
				
				
            });
			function confirm(){	
						var notif = 'Notification!';
						var pesan = 'Meja Berhasil Dipesan';
						$.gritter.add({
							title: notif,
							text: pesan
						});

						return false;
				}
			function clearInput(){
				$("#wizForm :input").each( function(){
				   $(this).val(''); 
				});
			}
			
			function loadListMeja(){
				var wiskulId 	= '<?PHP echo $kulId?>';
				var noBooking	= '<?PHP echo $noKursi ?>';
				$.ajax({
					url: 'loadmeja.php',
					type: 'GET',
					data: 'wiskulId=' + wiskulId + '&noBooking=' +noBooking,
					cache: false,
					success: function(resMeja) {
						$('#view-meja').html(resMeja);	
					}
				});
			}
			
			function loadPesanan(){
				var wiskulId 	= '<?PHP echo $kulId?>';
				$.ajax({
					url: 'loadpesanan.php',
					type: 'GET',
					data: 'wiskulId=' + wiskulId,
					cache: false,
					success: function(resPesanMakan) {
						$('#view-mount').html(resPesanMakan);	
					}
				});
			}
			
			$('#view-mount').html(loadPesanan);
			
			var myVarCloseForm = setInterval(function(){$('#view-meja').html(loadListMeja);},1000);
			
			$('#formWizard .col-md-3').bind("click", function (event) {
				var mejaId		= $(this).attr('id');
				var wiskulId	= '<?PHP echo $kulId ?>';
				var noBooking	= '<?PHP echo $noKursi ?>';
				if(mejaId > 0){
					$.ajax({
						url: 'postmeja.php',
						type: 'POST',
						data: 'wiskulId=' + wiskulId +'&mejaId=' + mejaId + '&noBooking=' +noBooking,
						cache: false,
						success: function(resKursi) {
								loadListMeja();
								if(resKursi > 2){
									$('#noMeja').html(resKursi);
								}else if(resKursi == 2){
									alert('Maaf Pemesanan tidak bisa di lakukan berulang kali!!!');
								}else if(resKursi == 1){
								alert('Maaf Meja Baru saja dipesan!!!');
								}
						}
					});
				}
				
			});
			
			$('#formWizard .col-lg-3').bind("click", function (event) {
				var menuId		= $(this).attr('id');
				var wiskulId	= '<?PHP echo $kulId ?>';
				//alert(menuId);
				
				if(menuId > 0){
					$.ajax({
						url: 'postpesanan.php',
						type: 'POST',
						data: 'wiskulId=' + wiskulId +'&menuId=' + menuId,
						cache: false,
						success: function(resPesan) {
								$('#view-mount').html(loadPesanan);
						}
					});
				}
				
			});
			
            $('#formWizard').find('.prevBtn').hide();
            $('#loading').hide();
            $('#formWizard .submitBtn').bind("click", function (event) {
				var url 				= "proseswiskul.php";
				var spec				= "<?PHP echo $_GET['spec']?>";
				var totprice			= $('input:hidden[name=totprice]').val();
				var email 				= $('input:text[name=email]').val();
				var password 			= $('input:password[name=password]').val();
				var name 				= $('input:text[name=name]').val();
				var gender 				= $('input:radio[name=gender]:checked').val();
				var location 			= $('input:text[name=location]').val();
				var country 			= $('select[name=country]').val();
				var phone 				= $('input:text[name=phone]').val();
				//alert(totprice);
				
				$('.wizard-buttons').hide();
				$.post(url, {
						spec: spec,
						totprice: totprice,
						email: email, 
						password: password, 
						name: name, 
						gender: gender, 
						location: location, 
						country: country, 
						phone: phone
					} ,function() {
						$('#loading').show();
						var myVarload=setInterval(function(){load()},2000);
						function load() {
							alert_success.show();
							clearTimeout(myVarload);
						}
						var myVar=setInterval(function(){closeform()},4000);
						function closeform() {
							closeWindow();
						}
					});
					
			}).hide();
        }
    };
}();

	
	</script>
	<script>
		jQuery(document).ready(function() {		
			App.setPage("wizards_validations");  //Set current page
			App.init(); //Initialise plugins and elements
			FormWizard.init();
		});
	</script>
	<!-- /JAVASCRIPTS -->
  </body>
</html>
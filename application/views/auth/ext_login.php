
<!DOCTYPE html>
<html>
	<head>

		<!-- Basic -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">	

		<title>Authorization</title>	

		<meta name="keywords" content="HTML5 Template" />
		<meta name="description" content="Porto - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Favicon -->
		<link rel="shortcut icon" href="<?= base_url() ?>assets/internal/dist/img/logo-gym3.png" type="image/png" />
		<link rel="apple-touch-icon" href="<?= base_url() ?>assets/eksternal/img/apple-touch-icon.png">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800%7CShadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/animate/animate.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/simple-line-icons/css/simple-line-icons.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/owl.carousel/assets/owl.carousel.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/owl.carousel/assets/owl.theme.default.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/magnific-popup/magnific-popup.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/bootstrap-star-rating/css/star-rating.min.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.css">

		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/theme.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/theme-elements.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/theme-blog.css">
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/theme-shop.css">

		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/skins/default.css"> 
		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/css/custom.css">
		<script src="<?= base_url() ?>assets/eksternal/vendor/modernizr/modernizr.min.js"></script>

		<link rel="stylesheet" href="<?= base_url() ?>assets/eksternal/vendor/toastr/build/toastr.min.css">

	</head>
	<body>
		<div class="body">
			<header id="header" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyStartAt': 135, 'stickySetTop': '-135px', 'stickyChangeLogo': true}">
				<div class="header-body border-color-primary border-bottom-0 box-shadow-none" data-sticky-header-style="{'minResolution': 0}" data-sticky-header-style-active="{'background-color': '#f7f7f7'}" data-sticky-header-style-deactive="{'background-color': '#FFF'}">
					
					<div class="header-container container">
						<div class="header-row py-2">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="<?= base_url() ?>">
											<img alt="Porto" width="150" height="70" src="<?= base_url() ?>assets/eksternal/img/gym_5.png">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<ul class="header-extra-info d-flex align-items-center mr-3">
										<li class="d-none d-sm-inline-flex">
											<div class="header-extra-info-text">
												<label>EMAIL KAMI</label>
												<strong><a href="mailto:duta.gym@gmail.com"> duta.gym@gmail.com</a></strong>
											</div>
										</li>
										<li>
											<div class="header-extra-info-text">
												<label>TELEPON KAMI</label>
												<strong><a href="tel:021-123123">021-123123</a></strong>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>

			<div role="main" class="main shop py-5">

				<div class="container">
					<div class="row">
						<div class="col">
							<div class="featured-boxes">
								<div class="row">
									<div class="col-md-12">
										<div class="row" id="login_row">
											<div class="col-md-6">
												<div id="login_container">
													<div class="box-content">
														<h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Belum punya akun? <button type="button" class="btn btn-md btn-info btn_register">Register</button></h4>
														<form id="form_login">
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Username</label>
																	<input type="text" id="login_username" name="username" class="form-control form-control-lg">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<a class="float-right text-info" style="cursor: pointer" id="btn_password">(Lupa password?)</a>
																	<label class="font-weight-bold text-dark text-2">Password</label>
																	<input type="password" id="login_password" name="password" class="form-control form-control-lg">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-lg-6">
																	<div class="custom-control custom-checkbox">
																		<input type="checkbox" class="custom-control-input" id="login_show_pass">
																		<label class="custom-control-label text-2" for="login_show_pass">Show Password</label>
																	</div>
																</div>
																<div class="form-group col-lg-6">
																	<input type="submit" value="Login" class="btn btn-primary float-right">
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<img src="<?= base_url() ?>assets/eksternal/img/gym_4.svg" class="img-fluid" alt="">
											</div>
										</div>
									</div>
									<div class="col-md-12" id="register_row" style="display: none">
										<div class="row">
											<div class="col-md-6">
												<img src="<?= base_url() ?>assets/eksternal/img/gym_3.svg" class="img-fluid" alt="">
											</div>
											<div class="col-md-6">
												<div id="register_container">
													<div class="box-content">
														<h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Sudah punya akun? <button class="btn btn-info btn-md btn_login">Login</button></h4>
														<form id="form_register">
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Nama Lengkap</label>
																	<input type="text" id="register_nama_lengkap" name="nama_lengkap" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Jenis Kelamin</label>
																	<select id="register_jenis_kelamin" name="jenis_kelamin" class="form-control">
																		<option value="">-</option>
																		<option value="L">Laki-laki</option>
																		<option value="P">Perempuan</option>
																	</select>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Tgl Lahir</label>
																	<input type="date" id="register_tgl_lahir" name="tgl_lahir" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Alamat</label>
																	<textarea id="register_alamat" name="alamat" class="form-control"></textarea>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Telepon</label>
																	<input type="number" id="register_telepon" name="telepon" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Email</label>
																	<input type="email" id="register_email" name="email" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col">
																	<label class="font-weight-bold text-dark text-2">Username</label>
																	<input type="text" id="register_username" name="username" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-lg-6">
																	<label class="font-weight-bold text-dark text-2">Password</label>
																	<input type="password" id="register_password" name="password" class="form-control">
																</div>
																<div class="form-group col-lg-6">
																	<label class="font-weight-bold text-dark text-2">Re-enter Password</label>
																	<input type="password" id="register_retype" name="retype" class="form-control">
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-lg-9">

																</div>
																<div class="form-group col-lg-3">
																	<input type="submit" value="Register" class="btn btn-primary float-right">
																</div>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

				</div>

				<form id="form_password">
					<div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title" id="defaultModalLabel">Lupa Password</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label for="">Email</label>
										<input type="email" class="form-control" name="email">
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
									<button type="submit" class="btn btn-info" >Kirim</button>
								</div>
							</div>
						</div>
					</div>
				</form>

			</div>

			

			<footer id="footer">
				<div class="container">
					<div class="footer-ribbon">
						<span>Hello World</span>
					</div>
					<div class="row py-5 my-4">
						<div class="col-md-6 col-lg-3 mb-4 mb-md-0">
							<div class="contact-details">
								<h5 class="text-3 mb-3">HUBUNGI KAMI</h5>
								<ul class="list list-icons list-icons-lg">
									<li class="mb-1"><i class="far fa-dot-circle text-color-primary"></i><p class="m-0">234 Street Name, City Name</p></li>
									<li class="mb-1"><i class="fab fa-whatsapp text-color-primary"></i><p class="m-0"><a href="tel:8001234567">(021) 123123</a></p></li>
									<li class="mb-1"><i class="far fa-envelope text-color-primary"></i><p class="m-0"><a href="mailto:duta.gym@gmail.com">duta.gym@gmail.com</a></p></li>
								</ul>
							</div>
						</div>
						<div class="col-md-6 col-lg-2">
							<h5 class="text-3 mb-3">FOLLOW KAMI</h5>
							<ul class="social-icons">
								<li class="social-icons-facebook"><a href="http://www.facebook.com/" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
								<li class="social-icons-twitter"><a href="http://www.twitter.com/" target="_blank" title="Twitter"><i class="fab fa-twitter"></i></a></li>
								<li class="social-icons-linkedin"><a href="http://www.linkedin.com/" target="_blank" title="Linkedin"><i class="fab fa-linkedin-in"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container py-2">
						<div class="row py-4">
							<div class="col-lg-1 d-flex align-items-center justify-content-center justify-content-lg-start mb-2 mb-lg-0">
								<a href="#/home" class="logo pr-0 pr-lg-3">
									<img alt="Porto Website Template" src="<?= base_url() ?>assets/eksternal/img/gym_5.png" class="opacity-5" height="33">
								</a>
							</div>
							<div class="col-lg-7 d-flex align-items-center justify-content-center justify-content-lg-start mb-4 mb-lg-0">
								<p>© Made with <i class="fas fa-heart text-danger"></i> by Vicky Kurnia.</p>
							</div>
						</div>
					</div>
				</div>
			</footer>
		</div>

		<!-- Vendor -->
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery/jquery.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.appear/jquery.appear.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.easing/jquery.easing.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.cookie/jquery.cookie.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/popper/umd/popper.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/common/common.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.validation/jquery.validate.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.gmap/jquery.gmap.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/jquery.lazyload/jquery.lazyload.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/isotope/jquery.isotope.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/owl.carousel/owl.carousel.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/vide/jquery.vide.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/vivus/vivus.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/bootstrap-star-rating/js/star-rating.min.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.js"></script>
		
		<script src="<?= base_url() ?>assets/eksternal/js/theme.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/js/views/view.shop.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/js/custom.js"></script>
		<script src="<?= base_url() ?>assets/eksternal/js/theme.init.js"></script>

		<script src="<?= base_url() ?>assets/internal/dist/js/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/eksternal/vendor/toastr/build/toastr.min.js"></script>

		<script src="<?= base_url() ?>src/additional.js"></script>
        <script src="<?= base_url() ?>src/customer/app.js"></script>
		<script>
			$(function(){
                authController.init()
            })
		</script>
	</body>
</html>

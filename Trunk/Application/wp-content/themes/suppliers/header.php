<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="CMSS, Medical Services, Central Medical Services Society">
	<meta name="description"
		content="Central Medical Services Society (CMSS) has been established with the approval of Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug procurement and distribution system of Department of Health & Family Welfare (DoHFW), Ministry of Health and Family Welfare, Government of India and to eliminate existing deficiencies.">

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli%7CRubik:400,400i,500,700">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet"
		href="<?php echo get_template_directory_uri(); ?>/assets/plugins/owlcarousel/owl.carousel.min.css">
	<link rel="stylesheet"
		href="<?php echo get_template_directory_uri(); ?>/assets/plugins/magnific-popup/magnific-popup.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/custom.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/animate.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/dataTables.bootstrap.min.css">
	<?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>
	<div id="search" class="fade">
		<a href="#" class="close-btn" id="close-search" aria-label="close button">
			<em class="fa fa-times"></em>
		</a>
		<?php get_search_form(); ?>
	</div>
	<!-- Header Begin -->
	<header class="header fixed-top">
		<!-- Header Style One Begin -->
		<div class="fixed-top header-main style--one">
			<div class="container-fluid extrapadding">
				<div class="row align-items-center top-header-section" id="top-header">
					<div class="col-lg-4 col-sm-4 col-4">
						<img alt="GOVERNMENT OF INDIA"
							src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/goi_logo.png"
							class="indgov" />
						<ul class="leftaccessibility top-header">
							<li class="gov-india">
								<span class="responsive_minis_hi"><a target="_blank" href="http://india.gov.in/hi/"
										title="भारत सरकार ( बाहरी वेबसाइट जो एक नई विंडो में खुलती है)">भारत
										सरकार</a></span>
								<span class="li_eng responsive_minis_eng"><a target="_blank" href="http://india.gov.in"
										title="GOVERNMENT OF INDIA, External Link that opens in a new window">GOVERNMENT
										OF INDIA</a></span>
							</li>
						</ul>
					</div>
					<div class="col-lg-8 col-sm-8 col-8 text-right accessibility ">
						<ul class="top-header">
							<li><!-- Accessible Skip to Main Content Link -->
								<a class="skip-link" href="#main-content">
									<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icons/skipcontent.png"
										alt="Skip to Main Content" />
								</a>
							</li>
							<li class="blackBtnBox"><a href="javascript:void(0);" class="colorBox high-contrast dark"
									id="blackBtn" title="High contrast dark">A</a></li>
							<li class="whiteBtnBox"><a href="javascript:void(0);" class="colorBox high-contrast light"
									id="whiteBtn" title="Normal Contrast" style="display: none;">A</a></li>
							<li>
								<div class="size_content_box">
									<a href="javascript:void(0);" class="decreaseFont" id="btn-decrease"
										title="Decrease font size" onclick="set_font_size('decrease')">-A</a>
									<a href="javascript:void(0);" class="resetFont" id="btn-orig"
										title="Reset font size" onclick="set_font_size('')">A</a>
									<a href="javascript:void(0);" class="increaseFont" id="btn-increase"
										title="Increase font size">+A</a>
								</div>
							</li>
							<li><a title="Screen Reader Access" href="screen-reader-access"> <img
										src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/screen-reader.png"
										alt="Screen Reader Access" /></a></li>

							<li><a href="sitemap" aria-label="Sitemap"><i class="fa fa-sitemap"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="header-links align-items-center">
					<div class="col-lg-4 col-md-5 col-sm-6 col-xs-6 cmss-logo">
						<!-- Logo Begin -->
						<div class="logo">
							<a href="<?php bloginfo('url'); ?>" aria-label="Go to CMSS homepage">
								<img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png"
									data-rjs="2" alt="">
							</a>
						</div>
						<!-- Logo End -->
					</div>

					<div class="col-lg-8 col-md-7 col-sm-6 col-xs-6 cmss-logo">
						<!-- Main Menu Begin -->
						<div class="main-menu d-flex align-items-center justify-content-end">
							<div class="mainnav">
								<nav>
									<ul>
										<li><a href="<?php bloginfo('url'); ?>" aria-label="Home"><span><i
														class="fa fa-home"></i></span></a></li>
										<li>
											<a href="javascript:void(0)" class="submenu"><span>About Us</span></a>
											<div class="mega-menu-container">
												<div class="mega-menu">
													<div class="wrapper">
														<h3>About Us</h3>
														<p>Central Medical Services Society (CMSS) has been established
															with the approval of Cabinet on 24.08.2011 as a Central
															Procurement Agency (CPA) to streamline drug procurement and
															distribution system of Department of Health & Family Welfare
															(DoHFW), Ministry of Health and Family Welfare, Government
															of India and to eliminate existing deficiencies.</p>
														<?php wp_nav_menu(array('theme_location' => 'primary', 'container' => false)); ?>
													</div>
												</div>
											</div>
										</li>
										<li><a href="<?php bloginfo('url'); ?>/what-we-offer"><span>What We
													Offer</span></a></li>
										<li><a
												href="<?php bloginfo('url'); ?>/allachievements"><span>Achievements</span></a>
										</li>
										<li><a href="<?php bloginfo('url'); ?>/tenders"><span>Tenders</span></a></li>
										<li><a href="<?php bloginfo('url'); ?>/recruitment_cmss/Index/institute_index/ins/RECINS001"
												target="_blank"><span>Careers</span></a></li>
										<li><a href="<?php bloginfo('url'); ?>/contact-us"><span>Contact Us</span></a>
										</li>
									</ul>
								</nav>
							</div>
							<span class="search-block"><a href="#search" aria-label="Open search"> <em
										class="fa fa-search"></em> </a></span>
							<!-- Offcanvas Holder Trigger -->
							<span class="offcanvas-trigger text-right  d-lg-block">
								<span></span>
								<span></span>
								<span></span>
							</span>
							<!-- Offcanvas Trigger End -->
						</div>
						<!-- Main Menu ENd -->
					</div>
				</div>
			</div>
		</div>
		<!-- Header Style One End -->
	</header>
	<!-- Header End -->

	<!-- Offcanvas Begin -->
	<div class="offcanvas-overlay fixed-top w-100 h-100"></div>
	<div class="offcanvas-wrapper bg-black fixed-top h-100">
		<!-- Offcanvas Close Button Begin -->
		<div class="offcanvas-close position-absolute">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/close.svg" class="svg" alt="Close">
		</div>
		<!-- Offcanvas Close Button End -->

		<!-- Offcanvas Content Begin -->
		<div class="offcanvas-content">
			<!-- About Widget Begin -->
			<div class="widget widget_about">
				<div class="widget-logo">
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" data-rjs="2" alt="LOGO">
				</div>
			</div>
			<div class="colaps-menu hamburger-container">
				<ul class="sidemenuitem">
					<li><a href="javascript:void(0)">Main wings of CMSS</a>
						<div class="mega-menu-container st-menu">
							<div class="mega-menu">
								<div class="wrapper">
									<h3>Main wings of CMSS</h3>
									<p>Central Medical Services Society (CMSS) has been established with the approval of
										Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug
										procurement and distribution system of Department of Health & Family Welfare
										(DoHFW), Ministry of Health and Family Welfare, Government of India and to
										eliminate existing deficiencies.</p>
									<?php wp_nav_menu(array('theme_location' => 'cmsswings', 'container' => false)); ?>
								</div>
							</div>
						</div>
					</li>
					<li><a href="e-audshadhi">E-aushadhi/24X7 IT System</a></li>
					<li><a href="https://gov.silicontechlab.com/cmss_new/recruitment_cmss/Index/institute_index/ins/RECINS001"
							target="_blank">Careers</a></li>
					<li><a href="esteemed-suppliers">Esteemed Suppliers</a></li>
					<li><a href="javascript:void(0)">Gallery</a>
						<div class="mega-menu-container st-menu">
							<div class="mega-menu">
								<div class="wrapper">
									<h3>Gallery</h3>
									<p>Central Medical Services Society (CMSS) has been established with the approval of
										Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug
										procurement and distribution system of Department of Health & Family Welfare
										(DoHFW), Ministry of Health and Family Welfare, Government of India and to
										eliminate existing deficiencies.</p>
									<?php wp_nav_menu(array('theme_location' => 'gallerymenu', 'container' => false)); ?>
								</div>
							</div>
						</div>
					</li>
					<li><a href="cmss-in-media">CMSS in Media</a></li>
					<li><a href="blacklisted-firms">Blacklisted Firms</a></li>
					<li><a href="right-to-information">RTI</a></li>
					<li><a href="feedback">Feedback</a></li>
					<li><a href="https://www.cmss.gov.in/grievance/">Grievance</a></li>
				</ul>
			</div>
		</div>
		<!-- Offcanvas Content End -->
	</div>
	<!-- Offcanvas End -->
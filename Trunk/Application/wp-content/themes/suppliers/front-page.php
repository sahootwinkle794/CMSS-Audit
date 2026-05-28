<?php
/**
 * Template Name: Home Page Template
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
<!--<div class="curtain-wrapper">
<input type="checkbox" checked>
<div class="curtain left">
	<h1>Ent</h1>
</div>
<div class="curtain right">
	 <h1>er</h1>
</div>
</div>-->

<!-- Slider Begin -->
<section class="banner section-pattern"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/slider-pattern.png">

	<div class="banner-slider-wrapper text-center">

		<!-- Optional Pause/Play Button -->
		<button id="slider-toggle" class="btnn">⏸ Pause</button>

		<div class="banner-slider owl-carousel dots-horizontal d-flex align-items-center justify-content-center"
			data-owl-animate-in="fadeIn" data-owl-animate-out="fadeOut" data-owl-autoplay="true"
			data-owl-autoplay-timeout="5000" data-owl-dots="false" data-owl-nav="true" data-owl-loop="true"
			data-owl-autoplay-hover-pause="true">

			<?php
			$args = array(
				'post_type' => 'banner',
				'posts_per_page' => -1,
				'post_status' => 'publish'
			);
			$loop = new WP_Query($args);

			if ($loop->have_posts()):
				while ($loop->have_posts()):
					$loop->the_post();
					if (have_rows('slider_items')):
						while (have_rows('slider_items')):
							the_row();
							$image = get_sub_field('upload_banner');
							$title = get_sub_field('title');
							$caption = get_sub_field('caption');
							$bannerlink = get_sub_field('link');
							?>
							<div class="single-banner-slider">
								<div class="row align-items-center">
									<div class="col-lg-12">
										<div class="banner-image mt-50 mt-lg-0 text-center text-lg-right">
											<img src="<?php echo esc_url($image); ?>" data-rjs="2"
												alt="<?php echo esc_attr($title); ?>">
										</div>
										<div class="banner-content">
											<h1><?php echo esc_html($title); ?></h1>
											<p><?php echo esc_html($caption); ?></p>
											<?php if ($bannerlink) { ?>
												<a class="linkBtn" href="<?php echo esc_url($bannerlink); ?>">KNOW MORE<span></span></a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
							<?php
						endwhile;
					endif;
				endwhile;
			endif;
			wp_reset_query();
			?>
		</div>
	</div>

</section>

<div class="sec01">
	<div class="scroll-txt">Scroll to explore <span></span></div>
</div>

<!-- Glance -->
<section class="pt-80 pb-60 section-pattern sec-ataglance"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/glance_bg.png"
	id="main-content">
	<div class="container-fluid extrapadding">
		<div class="row glance-row justify-content-center">
			<div class="col-lg-6 col-md-6 wow fadeInDown" data-wow-delay="0.5s">
				<div class="cmss-section-title">
					<!-- This code changed by trupti for removing mark up error -->
					 <h2></h2>
					<h3>CMSS at a Glance</h3>
				</div>
				<div class="glance-body">Central Medical Services Society (CMSS) has been established with the approval
					of Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug procurement and
					distribution system of Department of Health & Family Welfare (DoHFW), Ministry of Health and Family
					Welfare, Government of India and to eliminate existing deficiencies...</div>

				<div class="row justify-content-center">
					<div class="col-lg-4 col-md-4">
						<div class="glanc-block">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/factory.png"
								alt="Established" />
							<span>2012</span>
							<!-- This code changed by trupti for removing mark up error -->
							<h3>Established</h3>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="glanc-block">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/storage.png"
								alt="storage Capacity(Sq.ft.) as of now" />
							<span>22,198,5</span>
							<!-- This code changed by trupti for removing mark up error -->
							<h3>storage Capacity(Sq.ft.) as of now</h3>
						</div>
					</div>
					<div class="col-lg-4 col-md-4">
						<div class="glanc-block">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/locations.png"
								alt="National Presence" />
							<span>18 Locations</span>
							<!-- This code changed by trupti for removing mark up error -->
							<h3>National Presence</h3>
						</div>
					</div>
				</div>
				<!-- Added by trupti -->
				<a class="linkBtn" href="cmss-at-a-glance">Read more about CMSS<span></span></a>
			</div>
			<div class="col-lg-6 col-md-6 wow fadeInRight" data-wow-offset="300">
				<div class="video-wrapper">
					<div class="video-container" id="video-container">
						<!-- id renamed by video2 for removing the markup error - by trupti -->
						<video id="video2" loop controls
							poster="<?php echo get_template_directory_uri(); ?>/assets/img/videoposter.png">

							<source src="<?php echo get_template_directory_uri(); ?>/assets/img/intro-cmss-360.mp4"
								type="video/mp4">
							<track
								src="<?php echo get_template_directory_uri(); ?>/assets/captions/intro-cmss-360-en.vtt"
								kind="captions" srclang="en" label="English" default>
						</video>

						<div class="play-button-wrapper">
							<div title="Play video" class="play-gif" id="circle-play-b">
								<span></span>
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80">
									<path d="M40 0a40 40 0 1040 40A40 40 0 0040 0zM26 61.56V18.44L64 40z" />
								</svg>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<!-- Feature Begin -->
<section class="pt-80 pb-60 section-pattern sec-vission">
	<div class="fluid-container extrapadding">
		<div class="row justify-content-center">
			<?php
			$ovmargs = array(
				'post_type' => 'post',
				'posts_per_page' => 3,
				'order' => 'ASC',
				'post_status' => 'publish'
			);
			$ovmloop = new WP_Query($ovmargs);
			if ($ovmloop->have_posts()):
				while ($ovmloop->have_posts()):
					$ovmloop->the_post();
					?>
					<div class="col-lg-4 col-md-6 wow fadeInUp">
						<!-- Single Feature Begin -->
						<div class="single-feature">

							<div class="mov-title">
								<h3><?php the_title(); ?></h3>
							</div>
							<!-- Feature Content Begin -->
							<div class="content">

								<p><?php echo wp_trim_words(get_the_content(), 40, '...'); ?></p>
								<!-- Button added by trupti -->
								<a class="linkBtn" href="<?php the_permalink(); ?>">Learn More<span></span></a>
							</div>
							<!-- Feature Content End -->
						</div>
						<!-- Single Feature End -->
					</div>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>
		</div>
	</div>
</section>

<!-- Leadership -->
<section class="pt-80 pb-80 section-pattern sec-management"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/bg_leadership.jpg">
	<div class="fluid-container extrapadding">
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-6 wow fadeInUp">
				<div class="cmss-section-title">
					<h3>Leadership</h3>
				</div>
				<div class="row justify-content-center">
					<?php
					$args = array(
						'post_type' => 'whoiswho',
						'post_status' => 'publish',
						'posts_per_page' => -1,
						'orderby' => 'title', // or 'menu_order' if you want manual sorting
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => 'whoiswho-category',
								'field' => 'slug',
								'terms' => 'leadership',
							),
						),
					);

					$rowcount = 1;
					$slug = 'leadership'; // you can set this manually if needed
					
					$loop_news = new WP_Query($args);

					if ($loop_news->have_posts()):
						while ($loop_news->have_posts()):
							$loop_news->the_post();

							if (have_rows('who_is_who_items')):
								while (have_rows('who_is_who_items')):
									the_row();
									$name = get_sub_field('name');
									$designation = get_sub_field('designation');
									$member_image = get_sub_field('upload_photo');
									?>
									<div class="col-lg-4 col-md-6">
										<div class="mgmt-block">
											<img src="<?php echo esc_url($member_image); ?>" alt="<?php echo esc_attr($name); ?>" />
											<h3></h3>
											<h4><?php echo esc_html($name); ?></h4>
											<span><?php echo esc_html($designation); ?></span>
										</div>
									</div>
								<?php endwhile;
							endif;

						endwhile;
					else:
						echo '<p>' . __('Sorry, no members matched your criteria.', 'textdomain') . '</p>';
					endif;

					wp_reset_postdata();
					?>

				</div>
				<!-- added by trupti -->
				<a class="linkBtn" href="governing-body">View Governing Body Details<span></span></a>
			</div>
			<div class="col-lg-6 col-md-6 dgceo-block wow fadeInDown">
				<div class="cmss-section-title">
					<h3>DG & CEO Message</h3>
				</div>
				<div class="msg-block">
					<p>Central Medical Services Society (CMSS), created as Central Procurement Agency of MoHFW with
						approval of the Cabinet in 2011, is a young and thriving organization. With Procurement having
						commenced in 2015-16, CMSS serves 8 National level Disease Control Programmes and also handholds
						State Govts. in procurement related matters where they struggles or face issues.</p>
					<p>CMSS has flourished exponentially in all spheres i.e. procurement volumes, stocks handled,
						dispatched volumes and payment volumes to suppliers. CMSS has treaded very cautiously but with a
						clear vision to bring IT environment in all above activities –PO issuance, stock receipt,
						dispatch, quality checks and release of payments –everything is on 24*7 IT platform. The system
						has stabilized quite well and many steps have been taken to bring in more transparency in all
						activities.
						<!-- added by trupti  -->
						<a href="dg-ceo-message" class="ceomsg">Read DG & CEO Full Message</a>
					</p>
				<h4>Sh. Vijay Nehra</h4>
					<span>DG&CEO </span>
					<img src="<?php echo get_template_directory_uri(); ?>/assets/img/inkpot.png" alt="Inkpot" />
				</div>
			</div>
		</div>
	</div>
</section>

<!-- PROGRESS -->
<section class="section-pattern sec-success"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/success_bg.jpg">
	<div id="call-out" class="container-fluid no-padding call-out">
		<div class="fluid-container extrapadding">
			<div class="call-out-content row">
				<div class="col-md-7 col-sm-6 col-xs-12 wow fadeInLeft">
					<div class="text-parallax">
						<img src="wp-content/uploads/2024/02/12_new.png" alt="Progress" />
					</div>
					<h4 class="experience-info wow fadeInRight"
						style="visibility: visible; animation-name: fadeInRight;"><span>Years of successful
							work</span><br> in the market</h4>
							<!-- button added by trupti -->
					<div class="btn-progress"><a class="linkBtn" href="cmss-progress">View CMSS Progress Details<span></span></a>
					</div>
				</div>

				<div class="col-md-5 col-sm-6 col-xs-12 wow fadeInRight">

					<div class="carousel milestonebox success-work">
						<?php
						$workargs = array(
							'post_type' => 'progress',
							'posts_per_page' => 9,
							'order' => 'ASC',
							'post_status' => 'publish'
						);
						$workloop = new WP_Query($workargs);
						if ($workloop->have_posts()):
							while ($workloop->have_posts()):
								$workloop->the_post();
								?>
								<div class="carousel__item">
									<div class="carousel__item-body">
										<p class="title"><?php the_field('year_and_date'); ?></p>
										<p><?php the_title(); ?></p>
									</div>
								</div>
								<?php
							endwhile;
						endif;
						wp_reset_query();
						?>
					</div>

					<button id="toggleMotion" class="pause-btn">⏸ Pause</button>

				</div>
			</div>
		</div>
	</div>
</section>

<!-- What We Offer -->
<section class="pt-60 pb-120 section-pattern"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/offer_bg.jpg">
	<div class="fluid-container extrapadding">
		<div class="row">
			<div class="col-12">
				<!-- Section Title Begin -->
				<div class="section-title text-center">
					<h2>What We Offer</h2>
				</div>
				<!-- button Added by trupti -->
				<div class="col-12 text-center mb-3">
					<button id="offer-slider-toggle" class="btnn" aria-label="Pause What We Offer Slider">
						⏸ Pause
					</button>
				</div>
				<!-- Section Title End -->
			</div>
		</div>
		<div class="blog-slider owl-carousel custom-owl dots-horizontal justify-content-center wow fadeInLeft what-we-offer-section"
			data-wow-delay="0.4s" data-owl-items="5" data-owl-margin="30" data-owl-dots="true"
			data-owl-responsive='{"0": {"items": "1"},"600": {"items": "2"},"800": {"items": "3"},"992": {"items": "5"}}'>

			<?php
			$args = array(
				'post_type' => 'weoffer',
				'posts_per_page' => 12,
				'post_status' => 'publish'
			);
			$loop = new WP_Query($args);
			if ($loop->have_posts()):
				while ($loop->have_posts()):
					$loop->the_post();
					$suppliers_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					?>
					<div class="padding-5">
						<div class="offer-block">
							<img src="<?php echo $suppliers_img_url; ?>" alt="<?php the_title(); ?>" />
							<h3></h3>
							<h4><?php echo get_field('short_form'); ?></h4>
							<p><?php the_title(); ?></p>
							<!-- added by trupti -- button name-->
							<a href="<?php the_permalink(); ?>" class="more-details">View Service Details</a>
						</div>
					</div>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>
		</div>
	</div>
</section>

<!-- Achievements -->
<section class="pt-60 pb-120 section-pattern sec-achievement"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/achievement_bg_2.jpg">
	<div class="fluid-container extrapadding">
		<div class="row">
			<div class="col-12">
				<!-- Section Title Begin -->
				<div class="section-title text-center">
					<h2>Achievements</h2>
					<p>Powered by over 160 Dealers trust us with their sweet love.</p>
				</div>
				<!-- Button Added by trupti -->
				<div class="col-12 text-center mb-3">
					<button id="achievement-slider-toggle" class="btnn" aria-label="Pause Achievements Slider">
						⏸ Pause
					</button>
				</div>
				<!-- Section Title End -->
			</div>
		</div>
		<div class="row owl-carousel custom-owl dots-horizontal justify-content-center wow fadeInRight achievement"
			data-wow-delay="0.1s" data-owl-items="5" data-owl-margin="30"
			data-owl-responsive='{"0": {"items": "1"},"600": {"items": "2"},"800": {"items": "3"},"992": {"items": "4"}}'>
			<?php
			$args = array(
				'post_type' => 'achievements',
				'posts_per_page' => 5,
				'post_status' => 'publish'
			);
			$loop = new WP_Query($args);
			if ($loop->have_posts()):
				while ($loop->have_posts()):
					$loop->the_post();
					$achievement_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
					$procurementcount = get_field('count');
					?>
					<div class="owl-card">
						<div class="block-featured">
							<img src="<?php echo $achievement_img_url; ?>" alt="<?php the_title(); ?>" />
							

							<h3><?php the_title(); ?></h3>
							<!-- Button name added by trupti -->
							<?php if ($procurementcount) { ?><a href="<?php the_permalink(); ?>"><span
										class="blink_me"><?php echo $procurementcount; ?></span></a><?php } else { ?><a
									href="<?php the_permalink(); ?>" class="morebtn">View Achievement Details</a><?php } ?>
						</div>
					</div>
					<?php
				endwhile;
			endif;
			wp_reset_query();
			?>
		</div>
	</div>
</section>

<!-- Our Warehouses -->
<section class="section-pattern sec-warehouse"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/warehouse_bg.png">
	<div class="warehouse_map">
		<div class="fluid-container extrapadding">

			<div class="row carousel slide" id="myCarousel" data-interval="false">
				<!-- Service -->
				<div class="col-md-6 col-sm-12 col-xs-12 wow fadeInLeft">
					<section id="objects" class="objects section">
						<div class="container">
							<div class="section-content">
								<div class="objects">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/map-warehouse.png"
										alt="Warehouse Map" class="img-responsive" />
									<?php
									$wargs = array(
										'post_type' => 'warehouse',
										'post_status' => 'publish',
										'posts_per_page' => '-1',
										'orderby' => 'title',
										'order' => 'ASC',
									);
									$loop_w = new WP_Query($wargs);
									if ($loop_w->have_posts()):
										$postin = 1;
										$warehouse_count = 1;
										$slidecount = 0;
										while ($loop_w->have_posts()):
											$loop_w->the_post();
											?>
											<a href="#" id="warehouse_<?php echo $warehouse_count; ?>" data-target="#myCarousel"
												data-slide-to="<?php echo $slidecount; ?>">
												<div class="object-label wow fadeInUp"
													style="left: <?php echo the_field('style_left'); ?>; top: <?php echo the_field('style_top'); ?>;">
													<div class="object-info <?php if ($postin == 1) {
														echo 'in';
													} ?>">
														<h3 class="object-title"><?php the_title(); ?></h3>
														<div class="object-content">
															<?php the_field('address'); ?>
														</div>
													</div>
												</div>
											</a>
											<?php $postin++;
											$warehouse_count++;
											$slidecount++;
										endwhile; ?>
									<?php endif;
									wp_reset_query(); ?>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-md-6 col-sm-12 col-xs-12 carousel-inner">
					<div id="nothing" class="main-warehouse">
						<div class="section-title text-center">
							<h2>Our Warehouses</h2>
						</div>
						<div class="achievements-desc">

							<p>Our warehouses have an extensive nationwide presence. We store the drugs at our
								warehouses deploying perfect Stacking Methods with Racks, Pallets and Electric Stackers.
								Air-conditioned space has been created at the warehouses where storage of specific
								temperature sensitive drugs is done, also HVAC has been installed.</p>
							<p>Operations at the Warehouses are IT Enabled to provide 24x7 real-time visibility and
								monitoring facility and ensure definite scheduling and efficient collection and dispatch
								of consignments, in tandem with suppliers.</p>
							<p>We have sufficient & efficient manpower positioned at the warehouses.</p>
						</div>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight">
								<div class="boxreport1">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/warehouse.png"
										alt="Warehouses" />
									<h3>18</h3>
									<p><a href="#" target="_blank" rel="noopener">Total No. of Warehouses</a></p>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight">
								<div class="boxreport2">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/aream.png"
										alt="Area" />
									<h3>22,198,5</h3>
									<p><a href="#" target="_blank" rel="noopener">Total Area Covered (Sq. m)</a></p>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight">
								<div class="boxreport1">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/img/area.png"
										alt="Area" />
									<h3>92,198,5</h3>
									<p><a href="#" target="_blank" rel="noopener">Total Area Covered (Sq. ft)</a></p>
								</div>
							</div>
						</div>
					</div>
					<?php
					$wargs = array(
						'post_type' => 'warehouse',
						'post_status' => 'publish',
						'posts_per_page' => '-1',
						'orderby' => 'title',
						'order' => 'ASC',
					);
					$loop_w = new WP_Query($wargs);
					if ($loop_w->have_posts()):
						$post_count = 1;
						$temphide = 1;
						while ($loop_w->have_posts()):
							$loop_w->the_post();
							?>
							<div class="carousel-item <?php if ($post_count == 1) {
								echo 'active';
							} ?> <?php if ($temphide == 1) {
								  echo 'temphide';
							  } ?>" id="<?php the_title(); ?>">
								<div class="section-title text-center">
									<h2><?php the_title(); ?></h2>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="contact">Contact Details</div>
										<ul class="manager-details">
											<?php
											if (have_rows('warehouse_manager')):
												while (have_rows('warehouse_manager')):
													the_row();
													$cname = get_sub_field('manager_name');
													$cphone_number = get_sub_field('phone');
													$cdesignation = get_sub_field('designation');
													?>
													<li>
														<span><?php echo $cname; ?> </span>
														<span><?php echo get_sub_field('designation'); ?> </span>
														<span><i class="fa fa-phone" aria-hidden="true"></i>
															<?php echo $cphone_number; ?></span>
													</li>

													<?php
													$post_count++;
													$temphide++;
												endwhile;
											endif;
											?>
										</ul>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="contact">Address</div>
										<div class="warehouse-address"><?php the_field('address'); ?></div>
										<div class="email-box"><img
												src="<?php echo get_template_directory_uri(); ?>/assets/img/email.png"
												alt="Icon" /> <span><?php the_field('email'); ?></span></div>

									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="location-map">
											<a href="<?php the_field('location_map'); ?>" target="_blank"><img
													src="<?php echo get_template_directory_uri(); ?>/assets/img/google-maps.png"
													alt="Map" /> View on Map</a>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="boxreport">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/img/warehouse.png"
												alt="Warehouses" />
											<h3>1</h3>
											<p><a href="#" target="_blank" rel="noopener">Total No. of Warehouses</a></p>
										</div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="boxreport">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/img/aream.png"
												alt="Total Area Covered" />
											<h3><?php the_field('area_sqm'); ?></h3>
											<p><a href="#" target="_blank" rel="noopener">Total Area Covered (Sq. m)</a></p>
										</div>
									</div>
									<div class="col-md-4 col-sm-4 col-xs-12">
										<div class="boxreport">
											<img src="<?php echo get_template_directory_uri(); ?>/assets/img/area.png"
												alt="Total Area Covered" />
											<h3><?php the_field('area_sft'); ?></h3>
											<p><a href="#" target="_blank" rel="noopener">Total Area Covered (Sq. ft)</a></p>
										</div>
									</div>
								</div>
								<div class="warehouse-details"><a class="warehouse-btn" href="<?php the_permalink(); ?>">View
										Details<span></span></a></div>
							</div>
						<?php endwhile; ?>
					<?php endif;
					wp_reset_query(); ?>
				</div>

			</div>
		</div>
	</div>

</section>

<!-- Latest Updates -->
<section class="pt-60 pb-60 section-pattern sec-latestupdated">
	<div id="service-section" class="container-fluid service-section">
		<!-- Container -->
		<div class="fluid-container extrapadding">
			<!-- Row -->
			<div class="row">
				<div class="col-12">
					<div class="section-title text-center">
						<h2>Latest Updates</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Service -->
				<div class="col-md-12 col-sm-12 col-xs-12 service">
					<div class="row">

						<div class="col-md-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.2s">
							<div class="service-block">
								<div class="service-block-content">
									<h3>Tenders</h3>
								</div>
								<div class="notice-board">

									<div class="news-container">
										<ul id="news-scroll" class="news-content">
											<?php
											$current_date = date('Ymd');

											$tender_args = array(
												'post_type' => 'tendernotices',
												'posts_per_page' => -1,
												'post_status' => 'publish',
												'order' => 'DESC',
												'meta_query' => array(
													array(
														'key' => 'bid_submission_date',
														'value' => $current_date,
														'compare' => '>',
													),
												),
											);

											$loop = new WP_Query($tender_args);

											if ($loop->have_posts()):
												while ($loop->have_posts()):
													$loop->the_post();
													?>
													<li class="news-item">
														<?php
														if (have_rows('tender_document')):
															while (have_rows('tender_document')):
																the_row();
																$doctitle = get_sub_field('title_of_the_document');
																$docfile = get_sub_field('upload_document');

																$size_display = '';
																if ($docfile) {
																	$attachment_id = attachment_url_to_postid($docfile);
																	$file_path = get_attached_file($attachment_id);

																	if ($file_path && file_exists($file_path)) {
																		$file_size = filesize($file_path);
																		$size_in_kb = round($file_size / 1024, 2);
																		$size_display = ($size_in_kb > 1024)
																			? round($size_in_kb / 1024, 2) . ' MB'
																			: $size_in_kb . ' KB';
																	}
																}
																?>
																<a href="<?php echo esc_url($docfile); ?>" target="_blank"
																	class="tenderdocs">
																	<?php echo esc_html(get_the_title()); ?>
																	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/new.gif"
																		alt="New" />
																	<br />
																	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf_icon.png"
																		style="width: 25px;" title="Download PDF" />
																	<?php if (!empty($size_display)): ?>
																		<span
																			class="pdf-size">(<?php echo esc_html($size_display); ?>)</span>
																	<?php endif; ?>

																</a>
															<?php endwhile;
														endif;
														?>
													</li>
													<?php
												endwhile;
											else:
												?>
												<!-- here the li tag added by trupti to resolve mark up error -->
												<li><span>No active tender notices available.</span></li>
												<?php
											endif;
											wp_reset_postdata();
											?>
										</ul>
									</div>

									<div class="controls">
										<div class="linkkk">
											<!-- Added by trupti -->
											<a class="linkBtn" href="tenders/">View All Tender Notices<span></span></a>
										</div>
										<div class="news-controls">
											<button id="news-play" class="active" aria-label="Play news"><i
													class="fa fa-play" aria-hidden="true"></i></button>
											<button id="news-pause" aria-label="Pause news"><i class="fa fa-pause"
													aria-hidden="true"></i></button>
										</div>
									</div>

								</div>

							</div>
						</div>

						<div class="col-md-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.3s">
							<div class="service-block">
								<div class="service-block-content">
									<h3>News & Announcement</h3>
								</div>

								<div class="notice-board">

									<div class="news-container">
										<ul id="newsupdates" class="news-content">
											<?php
											$current_date = date('Ymd');
											$tender_args = array(
												'post_type' => 'newsupdates',
												'posts_per_page' => -1,
												'post_status' => 'publish',
												'order' => 'DESC',
												'meta_query' => array(
													array(
														'key' => 'expire_date',
														'value' => $current_date,
														'compare' => '>'
													)
												)
											);

											$loop = new WP_Query($tender_args);
											if ($loop->have_posts()) {
												while ($loop->have_posts()) {
													$loop->the_post();

													$publisheddate = get_the_date();
													$newDate = date("Ymd", strtotime($publisheddate . "+7 day"));

													$upload_pdf = get_field('upload_pdf');
													$link = get_field('link');
													?>
													<li class="news-item">
														<?php
														if ($upload_pdf) {
															$size_display = '';
															$attachment_id = attachment_url_to_postid($upload_pdf);
															$file_path = get_attached_file($attachment_id);
															if ($file_path && file_exists($file_path)) {
																$file_size = filesize($file_path);
																$size_in_kb = round($file_size / 1024, 2);
																if ($size_in_kb > 1024) {
																	$size_display = round($size_in_kb / 1024, 2) . ' MB';
																} else {
																	$size_display = $size_in_kb . ' KB';
																}
															}
															?>
															<a href="<?php echo esc_url($upload_pdf); ?>" target="_blank">
																<?php echo wp_trim_words(get_the_title(), 11, '...'); ?>

																<?php if ($current_date <= $newDate): ?>
																	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/new.gif"
																		alt="New">
																<?php endif; ?>
																<br />
																<img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf_icon.png"
																	title="PDF" style="width: 25px;" />
																<?php if (!empty($size_display)): ?>
																	<span
																		class="pdf-size">(<?php echo esc_html($size_display); ?>)</span>
																<?php endif; ?>
															</a>
														<?php } ?>

														<?php
														if ($link) { ?>
															<a href="<?php echo esc_url($link); ?>" target="_blank">
																<?php echo wp_trim_words(get_the_title(), 11, '...'); ?>
																<?php if ($current_date <= $newDate): ?>
																	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/new.gif"
																		alt="New">
																<?php endif; ?>
																<br />
																<img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png"
																	title="Link" />

															</a>
														<?php } ?>
													</li>
													<?php
												}
											}
											wp_reset_postdata();
											?>
										</ul>
									</div>

									<div class="controls">
										<div class="linkkk">
											<!-- Button name added by trupti -->
											<a class="linkBtn" href="news-and-announcement">View All News and Announcements<span></span></a>
										</div>
										<div class="news-controls">
											<button id="news-play2" class="active" aria-label="Play news"><i
													class="fa fa-play" aria-hidden="true"></i></button>
											<button id="news-pause2" aria-label="Pause news"><i class="fa fa-pause"
													aria-hidden="true"></i></button>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="col-md-4 col-sm-12 col-xs-12 wow fadeInUp" data-wow-delay="0.4s">
							<div class="service-block">
								<div class="service-block-content">
									<h3>Press Release</h3>
								</div>
								<div class="notice-board">

									<div class="news-container">
										<ul id="events" class="news-content">
											<?php
											$current_date = date('Ymd');
											$tender_args = array(
												'post_type' => 'events',
												'posts_per_page' => -1,
												'post_status' => 'publish',
											);

											$loop = new WP_Query($tender_args);

											if ($loop->have_posts()) {
												while ($loop->have_posts()) {
													$loop->the_post();

													$publisheddate = get_the_date();
													$newDate = date("Ymd", strtotime($publisheddate . " +7 days"));

													$upload_pdf = get_field('upload_pdf');
													$link = get_field('link');
													?>
													<li class="news-item">
														<?php
														if ($upload_pdf) {
															$size_display = '';
															$attachment_id = attachment_url_to_postid($upload_pdf);
															$file_path = get_attached_file($attachment_id);
															if ($file_path && file_exists($file_path)) {
																$file_size = filesize($file_path);
																$file_kb = round($file_size / 1024, 2);
																$size_display = ($file_kb > 1024)
																	? round($file_kb / 1024, 2) . ' MB'
																	: $file_kb . ' KB';
															}
															?>
															<a href="<?php echo esc_url($upload_pdf); ?>" target="_blank">
																<?php echo wp_trim_words(get_the_title(), 13, '...'); ?>
																<img src="<?php echo get_template_directory_uri(); ?>/images/pdf_icon.png"
																	title="PDF" style="width: 18px;" />
																<?php if (!empty($size_display)): ?>
																	<span
																		class="pdf-size">(<?php echo esc_html($size_display); ?>)</span>
																<?php endif; ?>
																<?php if ($current_date <= $newDate): ?>
																	<img src="<?php echo get_template_directory_uri(); ?>/images/new.gif"
																		alt="New">
																<?php endif; ?>
															</a>
														<?php } ?>

														<?php
														if ($link) { ?>
															<a href="<?php echo esc_url($link); ?>" target="_blank">
																<?php echo wp_trim_words(get_the_title(), 13, '...'); ?>
																<img src="<?php echo get_template_directory_uri(); ?>/assets/img/link.png"
																	title="Link" />
																<?php if ($current_date <= $newDate): ?>
																	<img src="<?php echo get_template_directory_uri(); ?>/images/new.gif"
																		alt="New">
																<?php endif; ?>
															</a>
														<?php } ?>

														<?php
														if (!$upload_pdf && !$link) { ?>
															<a href="#"><?php the_title(); ?></a>
														<?php } ?>
													</li>
													<?php
												}
											}
											wp_reset_postdata();
											?>
										</ul>
									</div>

									<div class="controls">
										<div class="linkkk">
											<!--Button Name Added by trupti -->
											<a class="linkBtn" href="press-release/">View All Press Releases<span></span></a>
										</div>
										<div class="news-controls">
											<button id="news-play3" class="active" aria-label="Play news"><i
													class="fa fa-play" aria-hidden="true"></i></button>
											<button id="news-pause3" aria-label="Pause news"><i class="fa fa-pause"
													aria-hidden="true"></i></button>
										</div>
									</div>

								</div>

							</div>
						</div>

					</div>
				</div><!-- Service /- -->
			</div>
		</div><!-- Container /- -->
	</div><!-- Service Section /- -->
</section>

<!-- Our Stakeholders -->
<section class="section-pattern section-stakeholder"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/stake_bg.jpg">
	<div id="counter-section" class="container-fluid counter-section">
		<!-- Container -->
		<div class="fluid-container extrapadding">
			<div class="row">
				<div class="col-md-6 col-sm-6 no-padding">
					<!-- Happy Customer -->
					<div class="happy-customer">
						<div class="cmss-section-title">
							<h3>Our Stakeholders</h3>
						</div>

						<p>Powered by over <span>160</span> Dealers trust us with their sweet love.</p>

					</div><!-- Happy Customer /- -->
					<a class="linkBtn" href="contact-us">Contact CMSS<span></span></a>
				</div>
				<div class="col-md-6 col-sm-6 no-padding">
					<!-- Counter App -->
					<div class="counter-app">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="statistics-box">
									<i class="statistics-icon"><img alt="statistics-icon"
											src="<?php echo get_template_directory_uri(); ?>/assets/img/we_serve.png"></i>
									<div class="statistics-content">
										<span data-statistics_percent="08" id="statistics_count-1">08</span>
										<p>Programs We Serve</p>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="statistics-box">
									<i class="statistics-icon"><img alt="statistics-icon"
											src="<?php echo get_template_directory_uri(); ?>/assets/img/esteemed_suppliers.png"></i>
									<div class="statistics-content">
										<span data-statistics_percent="18" id="statistics_count-2">18</span>
										<p>Warehouse</p>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="statistics-box">
									<i class="statistics-icon"><img alt="statistics-icon"
											src="<?php echo get_template_directory_uri(); ?>/assets/img/lab_network.png"></i>
									<div class="statistics-content">
										<span data-statistics_percent="26" id="statistics_count-3">26</span>
										<p>Our Top Of the Line Network</p>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-6">
								<div class="statistics-box">
									<i class="statistics-icon"><img alt="statistics-icon"
											src="<?php echo get_template_directory_uri(); ?>/assets/img/syring.png"></i>
									<div class="statistics-content">
										<span data-statistics_percent="273" id="statistics_count-4">273</span>
										<p>E-aushadhi Items</p>
									</div>
								</div>
							</div>
						</div>
					</div><!-- Counter App /- -->
				</div>
			</div><!-- Container /- -->
		</div><!-- Container /- -->
	</div><!-- Counter Section /- -->
</section>

<!-- Gallery -->
<section class="sectio-6">
	<div class="container-fluid extrapadding">
		<div class="row">
			<div class="col-md-6 sectio-6-left">
				<h2 class="heading blue-b">Video Gallery</h2>
				<div class="home-demo w-100">
					<video class="w-100" id="video" loop controls
						poster="<?php echo get_template_directory_uri(); ?>/assets/img/videoposter.png">
						<source src="<?php echo get_template_directory_uri(); ?>/assets/img/intro-cmss-360.mp4"
							type="video/mp4">
						<track src="<?php echo get_template_directory_uri(); ?>/assets/captions/intro-cmss-360-en.vtt"
							kind="captions" srclang="en" label="English" default>
					</video>
					<!--<div class="owl-carousel owl-theme">
						<div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=hrsZWzTi2tM"></a></div>
						<div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=aL_FHZ75-XQ"></a></div>
						<div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=hrsZWzTi2tM"></a></div>
						<div class="item-video" data-merge="1"><a class="owl-video" href="https://www.youtube.com/watch?v=aL_FHZ75-XQ"></a></div>
					</div>-->
				</div>
			</div>
			<div class="col-md-6">
				<h2 class="heading blue-b">Photo Gallery</h2>
				<div class="gallery-box">
					<div class="row">
						<?php
						$args = array(
							'post_type' => 'galleries',
							'posts_per_page' => 1,
							'post_status' => 'publish'
						);
						$loop = new WP_Query($args);
						$count = 1;
						if ($loop->have_posts()) {
							while ($loop->have_posts()):
								$loop->the_post();
								$gallery_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
								?>
								<div class="col-md-12">
									<div class="homegallery-box">
										<div class="gimage">
											<a href="<?php the_permalink(); ?>" title="<?php echo $title; ?>">
												<img src="<?php echo $gallery_img_url; ?>" alt="<?php the_title(); ?>" />
											</a>
										</div>
										<div class="gallery-title"><?php the_title(); ?></div>
									</div>
								</div>
								<?php $count++;
							endwhile;
						}
						?>
					</div>
					<a class="linkBtn" href="photo-gallery/">VIEW ALL<span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Esteemed Suppliers -->
<section class="pt-60 pb-120 section-pattern sec-suppliers">
	<div class="fluid-container extrapadding">
		<div class="row">
			<div class="col-12">
				<!-- Section Title Begin -->
				<div class="section-title text-center">
					<h2>Our Esteemed Suppliers</h2>
					<p>A huge list of our onboarded esteemed suppliers</p>
				</div>
				<!-- Button added by trupti -->
				<div class="slider-control text-center mb-3">
					<button id="suppliers-toggle" class="btnn" aria-label="Pause Suppliers Slider">
						⏸ Pause
					</button>
				</div>
				<!-- Section Title End -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Blog Slider Begin -->
				<div class="blog-slider owl-carousel custom-owl dots-horizontal our-esteemed" data-owl-items="6"
					data-owl-margin="30" data-owl-dots="true"
					data-owl-responsive='{"0": {"items": "1"},"600": {"items": "2"},"700": {"items": "3"},"800": {"items": "4"},"992": {"items": "5"},"1200": {"items": "6"}}'>
					<?php
					$args = array(
						'post_type' => 'suppliers',
						'posts_per_page' => -1,
						'post_status' => 'publish'
					);
					$loop = new WP_Query($args);
					if ($loop->have_posts()) {
						while ($loop->have_posts()):
							$loop->the_post();
							$suppliers_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
							?>
							<div class="single-blog-item position-relative">
								<div class="blog-content">
									<img src="<?php echo $suppliers_img_url; ?>" alt="Suppliers" />
								</div>

							</div>
							<?php
						endwhile;
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Dashboard -->
<section class="pt-60 pb-120 section-pattern dashboard-sec"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/section-pattern/dashboard_bg.jpg">
	<div class="fluid-container extrapadding">
		<div class="row">
			<div class="col-12">
				<!-- Section Title Begin -->
				<div class="section-title text-center">
					<h2>Dashboard</h2>
					<p>Solution for managing receipt, Issue, Quality Control and Inventory of drugs, vaccines and other
						health sector goods that are supplied to States and Union Territories under various central
						disease control programmes.</p>
				</div>
				<!-- Button added by trupti -->
				<div class="slider-control text-center mb-3">
					<button id="dashboard-toggle" class="btnn" aria-label="Pause Dashboard Slider">
					⏸ Pause 
					</button>
				</div>
				<!-- Section Title End -->
			</div>
		</div>
		<div class="row">

			<div class="col-12">
				<!-- Blog Slider Begin -->
				<div class="blog-slider owl-carousel custom-owl dots-horizontal section-dashboard" data-owl-items="5"
					data-owl-margin="30" data-owl-dots="true"
					data-owl-responsive='{"0": {"items": "1"},"600": {"items": "2"},"800": {"items": "3"},"992": {"items": "5"}}'>
					<!-- Single Blog Item Begin -->
					<?php
					$args = array(
						'post_type' => 'dashboard',
						'posts_per_page' => -1,
						'post_status' => 'publish'
					);
					$loop = new WP_Query($args);
					if ($loop->have_posts()) {
						while ($loop->have_posts()):
							$loop->the_post();
							$dashboard_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
							$link = get_field('link');
							?>
							<div class="single-dashboard-item position-relative">
								<div class="dashboard-featured">
									<img src="<?php echo $dashboard_image; ?>" alt="<?php the_title(); ?>" />
									<h3></h3>
									<h4><?php the_title(); ?></h4>
									<a href="<?php echo $link; ?>" class="more-view" target="_blank">Click Here</a>
								</div>
							</div>
							<?php
						endwhile;
					}
					wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Brand Slider Begin -->
<section class="pt-60 pb-60">
	<div class="fluid-container extrapadding">
		<div class="row">
			<div class="col-12">
				<!-- Partners -->
				<div class="brand-logo owl-carousel" data-owl-items="6" data-owl-autoplay="false"
					data-owl-responsive='{"0": {"items": "2"},"575":{"items": "3"},"768": {"items": "4"},"992": {"items": "7"}}'>

					<?php
					$args = array(
						'post_type' => 'footerlogo',
						'posts_per_page' => -1,
						'post_status' => 'publish'
					);
					$loop = new WP_Query($args);
					if ($loop->have_posts()) {
						while ($loop->have_posts()):
							$loop->the_post();
							$upload_image = get_field('upload_image');
							$link = get_field('link');
							?>
							<!-- Single Partner -->
							<a href="<?php echo $link; ?>" class="single-brand-logo">
								<img src="<?php echo $upload_image; ?>" data-rjs="2" alt="<?php the_title(); ?>">
							</a>
							<!-- End Single Partner -->
							<?php
						endwhile;
					}
					wp_reset_query();
					?>

				</div>
				<!-- End of Partners -->
			</div>
		</div>
	</div>
</section>


<?php
get_footer();

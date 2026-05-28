<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?>

<footer class="footer-main container-fluid no-padding">
	<!-- Container -->
	<div class="container">
		<!-- Contact Detail -->
		<div class="contact-details">
			<div class="row">
				<div class="col-md-4 col-sm-4 address-box detail-box">
					<i><img src="<?php echo get_template_directory_uri(); ?>/assets/img/ftr-location.png"
							alt="Loactaion" /></i>
					<h4>Contact Us</h4>
					<p>Central Medical Services Society (CMSS) (Autonomous Body under MoHFW, GoI)2nd Floor, Vishwa Yuvak
						Kendra, Teen Murti Marg, Opp. Police Station, Chanakyapuri, New Delhi-110021 Tel: 011-21410850
					</p>
				</div>
				<div class="col-md-4 col-sm-4 phone-box detail-box">
					<i><img src="<?php echo get_template_directory_uri(); ?>/assets/img/ftr-phone.png"
							alt="Phone" /></i>
					<h4>Call Us</h4>
					<p>Phone No: 011-21410905/6</p>
				</div>
				<div class="col-md-4 col-sm-4 mail-box detail-box">
					<i><img src="<?php echo get_template_directory_uri(); ?>/assets/img/ftr-email.png"
							alt="Email" /></i>
					<h4>Office Hours</h4>
					<p>Monday - Friday</p>
					<p>9:00 AM - 5:30 PM (IST)</p>
				</div>
			</div>
		</diV><!-- Contact Detail /- -->

		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-about">
					<div class="footerlogo">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="Logo"
							class="footer-logo" />
					</div>
					<div class="footer-txt">Central Medical Services Society (CMSS) has been established with the
						approval of Cabinet on 24.08.2011 as a Central Procurement Agency (CPA) to streamline drug
						procurement and distribution system...</div>
				</aside>
				<!-- 				<aside class="widget-newsletter">
					<div class="social">
						
						<ul>
							<li><a href="javascript:void(0);" title="Facebook"><i class="fa fa-facebook"></i></a></li>	
							<li><a href="javascript:void(0);" title="Twitter"><i class="fa fa-twitter"></i></a></li>
							<li><a href="javascript:void(0);" title="Google+"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</aside>	 -->
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-links">
					<h3 class="widget-title">Quick Links</h3>
					<?php if (has_nav_menu('footerusefull')):
						wp_nav_menu(
							array(
								'theme_location' => 'footerusefull',
								'items_wrap' => '<ul>%3$s</ul>',
								'container' => ''
							)
						);
					endif;
					?>
				</aside>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12">
				<aside class="widget widget-newsletter">
					<h3 class="widget-title">Location Map</h3>
					<p><iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.8753688705187!2d77.19553656464345!3d28.60351548242924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3856ac51127%3A0x254ae1e32715bf07!2sVishwa+Yuvak+Kendra!5e0!3m2!1sen!2sin!4v1565155586363!5m2!1sen!2sin"
							width="350" height="200" style="border:0" allowfullscreen=""></iframe></p>

				</aside>
			</div>
		</div>
	</div>
	<div class="footer-implinks">
		<?php
		if (has_nav_menu('footerimp')):
			wp_nav_menu(
				array(
					'theme_location' => 'footerimp',
					'items_wrap' => '<ul>%3$s</ul>',
					'container' => ''
				)
			);
		endif;
		?>
	</div>
	<div class="no-padding bottom-footer">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-12 col-xs-12">
					<p>Website Content Managed by Central Medical Services Society. Website is designed, developed and
						hosted by National Informatics Centre( NIC )</p>
					<p>&copy; <?php echo date('Y'); ?> Central Medical Services Society. All Rights Reserved.</p>

				</div>
				<div class="col-md-3 col-sm-12 col-xs-12">
					<p><strong>Last Updated on :</strong> <?php site_last_modified('j F Y'); ?></p>
					<p>
						<?php
						include 'ip_counter.php';               // Include the visitor counter
						echo "<b>Visitors</b> - " . get_unique_visits();  // Display the count
						?>
					</p>


				</div>
			</div>
		</div>
	</div>
</footer>

<!-- Back to Top Begin -->
<a href="#" class="back-to-top position-fixed">
	<div class="back-toop-tooltip"><span>Back To Top</span></div>
	<div class="top-arrow"></div>
	<div class="top-line"></div>
</a>
<!-- Back to Top End -->
<?php wp_footer(); ?>
<!-- ======= jQuery Library ======= -->
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js"></script>
<!-- News Ticker JavaScript -->


<script>
	function createNewsTicker(containerId, playId, pauseId, speed = 0.5) {
		const newsContent = document.getElementById(containerId);
		const playButton = document.getElementById(playId);
		const pauseButton = document.getElementById(pauseId);

		let isScrolling = true;
		let currentPosition = 0;
		let animationFrameId;

		// Duplicate content for seamless scroll
		const originalItems = Array.from(newsContent.children);
		originalItems.forEach(item => {
			newsContent.appendChild(item.cloneNode(true));
		});

		function animate() {
			if (!isScrolling) return;
			currentPosition -= speed;
			if (Math.abs(currentPosition) >= newsContent.scrollHeight / 2) {
				currentPosition = 0;
			}
			newsContent.style.transform = `translateY(${currentPosition}px)`;
			animationFrameId = requestAnimationFrame(animate);
		}

		function stop() {
			cancelAnimationFrame(animationFrameId);
		}

		playButton.addEventListener("click", () => {
			isScrolling = true;
			animate();
			playButton.classList.add("active");
			pauseButton.classList.remove("active");
		});

		pauseButton.addEventListener("click", () => {
			isScrolling = false;
			stop();
			pauseButton.classList.add("active");
			playButton.classList.remove("active");
		});

		newsContent.addEventListener("mouseover", stop);
		newsContent.addEventListener("mouseout", () => isScrolling && animate());

		animate(); // start
	}

	// Example usage:
	createNewsTicker("news-scroll", "news-play", "news-pause");
	createNewsTicker("newsupdates", "news-play2", "news-pause2");
	createNewsTicker("events", "news-play3", "news-pause3");
</script>

<script>
	$(document).ready(function () {
		var table = $('#datatable').DataTable();

		// Add aria-label and placeholder for accessibility
		$('div.dataTables_filter input[type="search"]').attr({
			'aria-label': 'Search the data table',
			'placeholder': 'Search table...'
		});
	});

</script>


<!-- News Ticker JavaScript End -->

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/menu.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/waypoints/jquery.waypoints.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/waypoints/jquery.counterup.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.appear.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/owlcarousel/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/isotope/isotope.pkgd.min.js"></script>
<script
	src="<?php echo get_template_directory_uri(); ?>/assets/plugins/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.animateNumber.min.js"></script>

<script src="<?php echo get_template_directory_uri(); ?>/assets/js/main.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/custom.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/font-size.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/switcher.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/wow.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/dataTables.bootstrap.min.js"></script>
<script>
	jQuery(document).ready(function () {
		jQuery('#datatable').DataTable();
		jQuery(function () {
			jQuery('#Agartala').css('display', 'none');
			jQuery('.object-label').on('click', function () {
				jQuery('#nothing').addClass('dashboard');
				jQuery('#Agartala').removeAttr('style');

			});
		});
		var changeClass = function (name) {
			$('#search, #nav ul').removeAttr('class').addClass(name);
		}
	});
	var wow = new WOW({
		offset: 0,
		mobile: true
	}
	);
	wow.init();
	jQuery(document).ready(function () {
		const video = document.getElementById("video");
		const circlePlayButton = document.getElementById("circle-play-b");

		function togglePlay() {
			if (video.paused || video.ended) {
				video.play();
			} else {
				video.pause();
			}
		}

		circlePlayButton.addEventListener("click", togglePlay);
		video.addEventListener("playing", function () {
			circlePlayButton.style.opacity = 0;
		});
		video.addEventListener("pause", function () {
			circlePlayButton.style.opacity = 1;
		});
	});

	$(document).ready(function () {
		var isPaused = false;
		var owl = $(".owl-carousel");

		// Initialize your existing carousel
		owl.owlCarousel({
			items: 1,
			merge: true,
			loop: true,
			margin: 10,
			video: true,
			lazyLoad: true,
			center: true,
			autoplay: true, // make sure autoplay is on
			autoplayTimeout: 3000,
			responsive: {
				320: { items: 1 },
				560: { items: 1 },
				992: { items: 1 }
			}
		});

		// Button toggle logic
		$("#toggleMotion").on("click", function () {
			isPaused = !isPaused;
			$(this).toggleClass("active");
			$(this).text(isPaused ? "▶ Play" : "⏸ Pause");

			if (isPaused) {
				$("body").addClass("paused");
				owl.trigger("stop.owl.autoplay");
			} else {
				$("body").removeClass("paused");
				owl.trigger("play.owl.autoplay", [3000]);
			}
		});
	});
	// Button added by trupti pause and play
		$("#toggleMotion_1").on("click", function () {
			isPaused = !isPaused;
			$(this).toggleClass("active");
			$(this).text(isPaused ? "▶ Play" : "⏸ Pause");

			if (isPaused) {
				$("body").addClass("paused");
				owl.trigger("stop.owl.autoplay");
			} else {
				$("body").removeClass("paused");
				owl.trigger("play.owl.autoplay", [3000]);
			}
		});
	

</script>
<script>
	jQuery(document).ready(function () {
		jQuery('.curtain-wrapper, #text').click(function () {
			jQuery(this).toggleClass('highlight');
		});
	});
</script>
<script>
 document.addEventListener('DOMContentLoaded', function() {
  // Select all menu items that have submenus
  const menuParents = document.querySelectorAll('.menu-item-has-children');

  menuParents.forEach(function(parent) {
    const link = parent.querySelector('a');

    link.addEventListener('click', function(e) {
      // Prevent following the link immediately
      e.preventDefault();
      e.stopPropagation();

      // Close any other open submenus
      menuParents.forEach(function(item) {
        if (item !== parent) {
          item.classList.remove('submenu-open');
        }
      });

      // Toggle this one
      parent.classList.toggle('submenu-open');
    });
  });

  // Close all submenus when clicking outside
  document.addEventListener('click', function() {
    menuParents.forEach(function(parent) {
      parent.classList.remove('submenu-open');
    });
  });
});

</script>
</body>

</html>
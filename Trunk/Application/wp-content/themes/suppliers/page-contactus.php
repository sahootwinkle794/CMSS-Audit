<?php
/**
 * Template Name: Contact US Template
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>
<!-- Page Title Begin -->
    <section class="page-title-bg pt-80 pb-60" data-bg-img="<?php do_shortcode('[WP_HEADER_IMAGES]'); ?>">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php echo get_the_title(); ?></h2>
                        <ul class="list-inline">
                            <li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container">
	<section id="primary" class="content-area pt-40">		
		<div id="main" class="site-main">
		 <div class="page-innertitle"><?php echo get_the_title(); ?></div>
		 <?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'page' );

			endwhile; // End of the loop.
		?>
		          
           
			
		</div>
	</section>
	<!-- Contact Info Begin -->
    <section class="pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <!-- Contact Info Begin -->
                    <div class="contact-info">
                        <h3>Contact Info</h3>
                        <div class="row">
                            <!-- Single Contact Info -->
                            <div class="col-sm-6 col-lg-12 single-contact-info media align-items-center">
                                <div class="image">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/Office-Location-icon.png" class="svg" alt="Location">
                                </div>
                                <div class="media-body">
                                    <h4>Office Location</h4>
                                    <p>Central Medical Services Society (CMSS) (Autonomous Body under MoHFW, GoI)2nd Floor, Vishwa Yuvak Kendra, Teen Murti Marg, Opp. Police Station, Chanakyapuri, New Delhi-110021</p>
                                </div>
                            </div>
                            <!-- End Single Contact Info -->

                            <!-- Single Contact Info -->
                            <div class="col-sm-6 col-lg-12 single-contact-info media align-items-center">
                                <div class="image">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/Business-Phone-icon.png" class="svg" alt="Phone">
                                </div>
                                <div class="media-body">
                                    <h4>Contact Details</h4>
                                    <p>011-21410905/6</p>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-12 single-contact-info media align-items-center">
                                <div class="image">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/Office-Hours-icon.png" class="svg" alt="Office Hours">
                                </div>
                                <div class="media-body">
                                    <h4>Office Hours</h4>
                                    <p>Monday - Friday <br>
                                    9:00 AM - 5:30 PM (IST)
                                    </p>
                                </div>
                            </div>
                            <!-- End Single Contact Info -->
                        </div>
                    </div>
					<div class="contact-info">
						<h3>Web Information Manager</h3>
						<div class="row">
							<div class="col-sm-6 col-lg-12 single-contact-info media align-items-center">
                                <div class="image">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/profile.png" class="svg" alt="Profile Image">
                                </div>
                                <div class="media-body"> 
									<p>cmsswebinfo[at]gmail[dot]com</p> 
                                </div>
                            </div>
                        </div>
					</div>
					<div class="contact-info">
						<h3>Internal Complaint Committee</h3>
						<div class="row">
							<div class="col-sm-6 col-lg-12 single-contact-info media align-items-center">
                                <div class="image">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/icons/profile.png" class="svg" alt="Profile Image">
                                </div>
                                <div class="media-body">  
									<p>icc[dot]sh[at]cmss[dot]gov[dot]in</p> 
                                </div>
                            </div>
                        </div>
					</div>
                    <!-- Contact Info End -->
                </div>

                <div class="col-lg-7">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.8753688705187!2d77.19553656464345!3d28.60351548242924!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce3856ac51127%3A0x254ae1e32715bf07!2sVishwa+Yuvak+Kendra!5e0!3m2!1sen!2sin!4v1565155586363!5m2!1sen!2sin" width="600" height="450"  style="border:0" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Info End -->
</div>
<?php get_footer(); ?>
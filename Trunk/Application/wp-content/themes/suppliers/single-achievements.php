<?php
/**
 * Template Name: Single Achievements Template 
 * Template Post Type: post, achievements
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
    <section class="page-title-bg pt-80 pb-60" data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/inner-banner.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title text-center">
                        <h2><?php echo get_the_title(); ?></h2>
                        <ul class="list-inline">
                            <li><a href="<?php bloginfo( 'url' ); ?>">Home</a></li>
                            <li><a href="<?php bloginfo( 'url' ); ?>/allachievements">Achievements</a></li>
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<section id="primary" class="content-area">
		<div class="container">
			<div class="back-btn"><a href="<?php bloginfo( 'url' ); ?>/allachievements"><i class="fa fa-angle-double-left"></i> Back</a></div>
			<div id="main" class="site-main">
			<div class="page-innertitle"><?php echo get_the_title(); ?></div>
			<div class="row pt-20 pb-60">
				<div class="col-md-12 col-lg-12 col-xs-12">
				<?php
					/* Start the Loop */
					$count = 1;
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content/content', 'page' );
					endwhile; // End of the loop.
				?>
				</div>
			</div>
			</div><!-- #main -->
		</div>
	</section><!-- #primary -->
<?php
get_footer();
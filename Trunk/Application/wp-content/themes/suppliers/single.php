<?php
/**
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
<section id="primary" class="content-area pt-60 pb-60">
	<div class="container">
		<main id="main" class="site-main">
			<div class="page-innertitle"><?php echo get_the_title(); ?></div>
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content/content', 'single' );

				

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div>
</section><!-- #primary -->
<?php
get_footer();
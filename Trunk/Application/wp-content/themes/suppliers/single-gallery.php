<?php
/**
 * Template Name: Single Gallery Template 
 * Template Post Type: post, galleries
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
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="primary" class="content-area  pt-60 pb-60">
	<div class="container">
		<div id="main" class="site-main">
		<div class="page-innertitle"><?php echo get_the_title(); ?></div>
		<div class="row">
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
					<?php 				
						if( have_rows('gallery_items') ): 
							while( have_rows('gallery_items') ): the_row(); 
								$image = get_sub_field('upload_image');
								$title = get_sub_field('image_title');
					?>
					<div class="col-md-3 col-sm-3 col-xs-6" style="padding-right:0px;">
						<div class="gimage">
							<a class="photopopup" href="<?php echo $image; ?>" title="<?php echo $title; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" /></a>
						</div>
					</div>
					<?php $count++; endwhile; endif; 
						
					?>	
			<div class="col-md-12 col-lg-12 col-xs-12 text-center">
				<a class="linkBtn-black" href="https://www.cmss.gov.in/photo-gallery/">VIEW ALL<span></span></a>
			</div>
		</div>
		</div><!-- #main -->
	</div>
</section><!-- #primary -->
<?php
get_footer();
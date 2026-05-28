<?php
/**
 * Template Name: Photo Gallery Template
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
<div class="container">
	<section id="primary" class="content-area pb-60">		
		<div id="main" class="site-main">
			<div class="pt-60 pb-40">
			<div class="page-innertitle"><?php echo get_the_title(); ?></div>
			<?php

				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content/content', 'page' );

				endwhile; // End of the loop.
			?>
			</div>       
            <div class="page-gallerybox">
			<div class="row">
					<?php 
						$args = array(
							'post_type' => 'galleries',
							'posts_per_page' => -1,
							'post_status' => 'publish'
						);
						$loop = new WP_Query($args);
						$count=1;
						if($loop->have_posts()) {
							while($loop->have_posts()) : $loop->the_post();				
							$gallery_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');	
					?>
					<div class="col-md-4 col-sm-4 col-xs-6" style="padding-right:0px;">
						<div class="gallery-inner-item">
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
			</div>
		</div>
	</section>
</div>
<?php get_footer(); ?>
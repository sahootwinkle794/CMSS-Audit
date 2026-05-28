<?php
/**
 * Template Name: Single Weoffer Template 
 * Template Post Type: post, weoffer
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
                            <li><a href="what-we-offer">What we offer</a></li>
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="primary" class="content-area">
	<div class="container">
		<div class="back-btn"><a href="what-we-offer"><i class="fa fa-angle-double-left"></i> Back</a></div>
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
			<?php 
				if( have_rows('items') ): 
					while( have_rows('items') ): the_row(); 
						$itemsname = get_sub_field('name_of_the_item');					
			?>
				<div class="col-lg-6 col-md-6 padding-5 wow fadeInUp" data-wow-delay="0.<?php echo $count;?>s">
					<div class="offer-items">
						<h4><?php echo $itemsname; ?></h4>
					</div>
				</div>
			<?php  
				$count++; endwhile; endif;
			?>			
		</div>
		</div><!-- #main -->
	</div>
</section><!-- #primary -->
<?php
get_footer();
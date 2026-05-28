<?php
/**
 * Template Name: What We Offer Template
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
						<li><a href="<?php bloginfo('url'); ?>">Home</a></li>
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
				<div class="page-tagline"><?php echo get_field('tag_line'); ?></div>
				<?php

				/* Start the Loop */
				while (have_posts()):
					the_post();

					get_template_part('template-parts/content/content', 'page');

				endwhile; // End of the loop.
				?>
			</div>
			<div class="member-content">
				<div class="category-content" <?php $countrow = $term->count;
				if ($countrow <= 5) {
					echo "style='min-height: 405px;'";
				} else {
					echo "style='min-height: 780px;'";
				} ?>>
					<div class="row">
						<?php
						$args = array(
							'post_type' => 'weoffer',
							'post_status' => 'publish',
							'posts_per_page' => '-1',
							'orderby' => $cat_id,
							'order' => 'ASC'
						);
						$rowcount = 1;
						$slug = $term->slug;
						$loop_news = new WP_Query($args);
						if ($loop_news->have_posts()):
							while ($loop_news->have_posts()):
								$loop_news->the_post();
								$suppliers_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
								?>
								<div class="col-lg-2 col-md-2 padding-5">
									<div class="whatoffer-block">
										<img src="<?php echo $suppliers_img_url; ?>" alt="Logo Image" />
										<h3></h3>
										<h4><?php echo get_field('short_form'); ?></h4>
										<p><?php the_title(); ?></p>
										<a href="<?php the_permalink(); ?>" class="more-details">More Details</a>
									</div>
								</div>
							<?php endwhile; ?>
						<?php else: ?>
							<p><?php _e('Sorry, No Offer Matched Your Criteria.'); ?></p>
						<?php endif;
						wp_reset_query(); ?>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>
<?php get_footer(); ?>
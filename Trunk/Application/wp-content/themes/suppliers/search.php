<?php
/**
 * Template for displaying search results pages (page title search only)
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 */

get_header('inner');
?>

<!-- Page Title Begin -->
<section class="page-title-bg pt-80 pb-60"
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/inner-banner.jpg">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="page-title text-center">
					<h2><?php _e('Search results for:', 'twentynineteen'); ?> <?php echo get_search_query(); ?></h2>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="primary" class="ftco-section content-area pb-60 pt-60">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 ftco-animate">
				<main id="main" class="site-main">
					<div class="entry-content">

						<?php if ( have_posts() ) : ?>
							<?php while ( have_posts() ) : the_post(); ?>
								<article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?>>
									<header class="cos-header">
										<h2 class="entry-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h2>
									</header>
								</article>
							<?php endwhile; ?>

						<?php else : ?>
							<p><?php _e('No pages found matching your search.', 'twentynineteen'); ?></p>
						<?php endif; ?>

					</div><!-- .entry-content -->
				</main><!-- #main -->
			</div>
		</div>
	</div>
</section><!-- #primary -->

<?php
get_footer();

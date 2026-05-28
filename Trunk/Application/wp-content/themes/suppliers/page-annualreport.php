<?php
/**
 * Template Name: Annual Report Template
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
<section class="page-title-bg pt-80 pb-60"
	data-bg-img="https://www.cmss.gov.in/wp-content/uploads/2021/12/inner-banner.jpg">
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
	<section id="primary" class="content-area pt-60 pb-60">
		<div id="main" class="site-main">
			<div class="page-innertitle"><?php echo get_the_title(); ?></div>
			<?php

			/* Start the Loop */
			while (have_posts()):
				the_post();

				get_template_part('template-parts/content/content', 'page');

			endwhile; // End of the loop.
			?>

			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="datatable">
					<thead>
						<tr>
							<th style="width:15%;">S. No.</th>
							<th style="width:60%;">Annual Report Year</th>
							<th style="width:25%;">Download</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$args = array(
							'post_type' => 'annual_report', 
							'posts_per_page' => -1,
							'post_status' => 'publish',
							'order' => 'DESC',
						);

						$loop = new WP_Query($args);
						$count = 1;

						if ($loop->have_posts()):
							while ($loop->have_posts()):
								$loop->the_post();
								$year = get_field('year');
								$file = get_field('upload_file');
								$link = get_field('upload_link');
								$download_url = $file ? $file : $link;
								$formatted_size = '';
								if ($file) {
									$attachment_id = attachment_url_to_postid($file);
									if ($attachment_id) {
										$file_path = get_attached_file($attachment_id);
										if ($file_path && file_exists($file_path)) {
											$file_size = filesize($file_path);
											$formatted_size = size_format($file_size);
										}
									}
								}
								?>
								<tr>
									<td><?php echo esc_html($count++); ?></td>
									<td><?php echo esc_html($year); ?></td>
									<td>
										<?php if ($download_url): ?>
											<a href="<?php echo esc_url($download_url); ?>" target="_blank" class="tenderdocs">
												<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/pdf_icon.png'); ?>"
													style="width:30px;" alt="PDF" title="Download PDF">
												<?php echo ' (' . esc_html($formatted_size) . ')'; ?>
											</a>
										<?php else: ?>
											<span style="color:#999;">No file available</span>
										<?php endif; ?>
									</td>
								</tr>
								<?php
							endwhile;
							wp_reset_postdata();
						else:
							?>
							<tr>
								<td colspan="3" style="text-align:center;">No Annual Reports Found</td>
							</tr>
						<?php endif; ?>
					</tbody>
				</table>
			</div>



		</div>

	</section>
</div>
<?php get_footer(); ?>
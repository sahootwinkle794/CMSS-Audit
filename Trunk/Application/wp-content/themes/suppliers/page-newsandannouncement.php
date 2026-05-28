<?php
/**
 * Template Name: News and Announcement Template
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
<section class="page-title-bg pt-80 pb-60" data-bg-img="../wp-content/uploads/2021/12/inner-banner.jpg">
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

			<div class="row justify-content-between ">
				<div class="col-md-6">
					<div class="page-innertitle">
						<?php echo get_the_title(); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tenderheading">
						<a class="linkBtn" href="news-and-announcement-archive">Archive<span></span></a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="datatable">
						<thead>
							<tr>
								<th style="width:15%;">S. No.</th>
								<th style="width:70%;">Title</th>
								<th style="width:15%;">Download</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$current_date = date('Ymd');
							$args = array(
								'post_type' => 'newsupdates',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'order' => 'DESC',
								'meta_query' => array(
									array(
										'key' => 'expire_date',
										'value' => $current_date,
										'compare' => '>='
									)
								),
							);

							$loop = new WP_Query($args);
							$count = 1;

							if ($loop->have_posts()):
								while ($loop->have_posts()):
									$loop->the_post();
									$file_url = get_field('upload_pdf');

									$formatted_size = 'N/A';
									if ($file_url) {
										$attachment_id = attachment_url_to_postid($file_url);
										$file_path = get_attached_file($attachment_id);

										if ($file_path && file_exists($file_path)) {
											$file_size = filesize($file_path);
											$formatted_size = format_file_size($file_size);
										}
									}
									?>
									<tr>
										<td><?php echo esc_html($count++); ?></td>
										<td><?php the_title(); ?></td>
										<td>
											<?php if ($file_url): ?>
												<a href="<?php echo esc_url($file_url); ?>" target="_blank" class="tenderdocs">
													<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/pdf_icon.png'); ?>"
														style="width:30px;" alt="PDF" title="Download PDF" />
													(<?php echo esc_html($formatted_size); ?>)
												</a>
											<?php else: ?>
												<span>No file available</span>
											<?php endif; ?>
										</td>
									</tr>
									<?php
								endwhile;
								wp_reset_postdata();
							else:
								?>
								<tr>
									<td colspan="3" style="text-align:center;">No current updates available.</td>
								</tr>
							<?php endif; ?>
						</tbody>
					</table>
				</div>
			</div>

			<?php
			while (have_posts()):
				the_post();
				get_template_part('template-parts/content/content', 'page');

			endwhile;
			?>


		</div>

	</section>
</div>
<?php get_footer(); ?>
<?php
/**
 * Template Name: Archived Firms Template
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
	data-bg-img="<?php echo get_template_directory_uri(); ?>/assets/img/inner-banner.jpg">
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


<section id="primary" class="content-area pt-60 pb-60">
	<main id="main" class="site-main">
		<div class="container">

			<div class="row justify-content-between ">
				<div class="col-md-12">
					<div class="page-innertitle">
						<?php echo get_the_title(); ?>
					</div>
				</div>
			</div>

			<div class="row ">
				<div class="table-responsive">
					<table class="table table-bordered table-striped p-0" id="datatable">
						<thead>
							<tr>
								<th style="width: 5%;">Sl. No.</th>
								<th style="width: 15%;">Name of Firm</th>
								<th style="width: 30%;">Firm Address</th>
								<th style="width: 5%;">Blacklisted From</th>
								<th style="width: 5%;">Blacklisted Upto</th>
								<th style="width: 5%;">Download</th>
								<th style="width: 35%;">Reason For Blacklisting</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$current_date = date('Ymd');
							$firm_args = array(
								'post_type' => 'blacklisted',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'meta_query' => array(
									array(
										'key' => 'blacklisted_upto',
										'value' => $current_date,
										'compare' => '<'
									)
								),
							);

							$loop = new WP_Query($firm_args);
							$count = 1;

							if ($loop->have_posts()):
								while ($loop->have_posts()):
									$loop->the_post();
									$file = get_field('download');
									$post_id = get_the_ID();
									?>
									<tr>
										<td><?php echo esc_html($count++); ?></td>
										<td><?php the_title(); ?></td>
										<td><?php the_field('firm_address'); ?></td>
										<td><?php the_field('blacklisted_from'); ?></td>
										<td><?php the_field('blacklisted_upto'); ?></td>
										<td>
											<?php if ($file): ?>
												<?php
												$file_path = str_replace(site_url('/'), ABSPATH, $file);
												if (file_exists($file_path)) {
													$file_size = filesize($file_path);
													$file_size_kb = round($file_size / 1024, 2);
													$file_size_text = ($file_size_kb > 1024)
														? round($file_size_kb / 1024, 2) . ' MB'
														: $file_size_kb . ' KB';
												} else {
													$file_size_text = 'Unknown size';
												}
												?>
												<a href="<?php echo esc_url($file); ?>" target="_blank">
													<img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/pdf_icon.png"
														style="width:30px" alt="pdf" />
												</a>
												<br><small style="font-size: 12px; color: #0a3b95;">(<?php echo esc_html($file_size_text); ?>)</small>
											<?php else: ?>
												<p>PDF not available</p>
											<?php endif; ?>
										</td>
										<td>
											<?php echo esc_html(wp_trim_words(get_field('reason_for_blacklisting'), 30, '...')); ?>
											<button type="button" class="modal_black" data-toggle="modal"
												data-target="#modal-<?php echo $post_id; ?>">
												Read More
											</button>

											<!-- Dynamic Modal -->
											<div class="modal fade" id="modal-<?php echo $post_id; ?>" tabindex="-1"
												role="dialog" aria-labelledby="modalLabel-<?php echo $post_id; ?>"
												aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="modalLabel-<?php echo $post_id; ?>">
																<?php the_title(); ?>
															</h5>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body text-justify">
															<div class="scroll">
																<?php the_field('reason_for_blacklisting'); ?>
															</div>
														</div>
													</div>
												</div>
											</div>
										</td>
									</tr>
									<?php
								endwhile;
								wp_reset_postdata();
							endif;
							?>
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
	</main>
</section>

<?php get_footer(); ?>
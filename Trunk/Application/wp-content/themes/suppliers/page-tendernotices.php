<?php
/**
 * Template Name: Tender&Notices Template
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

<section id="primary" class="content-area pt-60 pb-60">
	<div id="main" class="site-main">
		<div class="container">

			<div class="row justify-content-between ">
				<div class="col-md-6">
					<div class="page-innertitle">
						<?php echo get_the_title(); ?>
					</div>
				</div>
				<div class="col-md-6">
					<div class="tenderheading">
						<a class="linkBtn" href="tender-archive">Archive<span></span></a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="table-responsive">
					<table class="table table-bordered table-striped" id="datatable">
						<thead>
							<tr>
								<th style="width:5%;">S. No.</th>
								<th style="width:10%;"> Tender Ref No.</th>
								<th style="width:38%;"> Title</th>
								<th style="width:10%;"> Published Date</th>
								<th style="width:12%;"> Last Date of Submission</th>
								<th style="width:15%;"> Tender Document</th>
								<th style="width:15%;"> Corrigendum/ Addendum</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$current_date = date('Ymd');
							$tender_args = array(
								'post_type' => 'tender&notices',
								'posts_per_page' => -1,
								'post_status' => 'publish',
								'order' => 'DESC',
								'meta_query' => array(
									array(
										'key' => 'bid_submission_date',
										'value' => $current_date,
										'compare' => '>='
									)
								),
							);
							$loop = new WP_Query($tender_args);
							$count = 1;
							if ($loop->have_posts()) {
								while ($loop->have_posts()):
									$loop->the_post();
									$pre_bid_minutes = get_field('pre_bid_minutes'); ?>
									<tr>
										<td><?php echo $count++; ?></td>
										<td><?php the_field('tender_no'); ?></td>
										<td><?php the_title(); ?></td>
										<td><?php the_field('bid_start_date'); ?></td>
										<td><?php the_field('bid_submission_date'); ?></td>
										<td style="text-align:center">
											<?php
											if (have_rows('tender_document')):
												while (have_rows('tender_document')):
													the_row();
													$doctitle = get_sub_field('title_of_the_document');
													$docfile = get_sub_field('upload_document');

													$file_url = get_sub_field('upload_document');
													$attachment_id = attachment_url_to_postid($file_url);
													$file_path = get_attached_file($attachment_id);
													$file_size = filesize($file_path);
													$formatted_size = format_file_size($file_size);
													?>

													<a href="<?php echo $docfile; ?>" target="_blank" class="tenderdocs">
														<?php// if ($doctitle) {
														  // echo $doctitle;
													  // } else {
														 //  echo "Tender";
													  // } ?>
														<img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf_icon.png"
															style="width: 30px;" alt="PDF" title="Download PDF" />
														<br />
														(<?php echo $formatted_size; ?> )
													</a>
												<?php endwhile; endif; ?>
										</td>
										<td style="text-align:center">
											<?php
											if (have_rows('corrigendum_addendum')):
												while (have_rows('corrigendum_addendum')):
													the_row();
													$corrigendum_title = get_sub_field('title_of_the_corrigendum');
													$corrigendum_file = get_sub_field('upload_corrigendum');

													$file_url = get_sub_field('upload_corrigendum');
													$attachment_id = attachment_url_to_postid($file_url);
													$file_path = get_attached_file($attachment_id);
													$file_size = filesize($file_path);
													$formatted_size = format_file_size($file_size);
													?>
													<a href="<?php echo $corrigendum_file; ?>" target="_blank" class="tenderdocs">
														<?php //if ($corrigendum_title) {
														//	echo $corrigendum_title;
														//} else {
														//	echo "Corrigendum";
														//} ?>
														<img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf_icon.png"
															style="width: 30px;" alt="PDF" title="Download PDF" />
														<br />
														(<?php echo $formatted_size; ?> )
													</a>
												<?php endwhile; endif; ?>
										</td>
									</tr>
									<?php
								endwhile;
							}
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
	</div>
</section>

<?php get_footer(); ?>
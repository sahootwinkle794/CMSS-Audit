<?php
/**
 * Template Name: Single Warehouse Template 
 * Template Post Type: post, warehouse
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
                            <li><a href="warehouses">Warehouses</a></li>
                            <li><?php echo get_the_title(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<section id="primary" class="content-area">
	<div class="container">
		<div class="back-btn"><a href="warehouses"><i class="fa fa-angle-double-left"></i> Back</a></div>
		<div id="main" class="site-main">
		<div class="page-innertitle"><?php echo get_the_title(); ?></div>
		<div class="row pb-60">
			<div class="col-md-8 col-lg-9 col-xs-12">
			<?php
				/* Start the Loop */
				$count = 1;
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'page' );
				endwhile; // End of the loop.
			?>
			
			<div class="contact">Contact Details</div>
				<ul class="wmanager-details">
						<?php 
							if( have_rows('warehouse_manager') ): 
								while( have_rows('warehouse_manager') ): the_row(); 
									$cname = get_sub_field('manager_name');					
									$cphone_number = get_sub_field('phone');					
									$cdesignation = get_sub_field('designation');					
						?>
						<li>
							<span><?php echo $cname; ?> </span>
							<span><?php echo get_sub_field('designation'); ?> </span>
							<span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $cphone_number; ?></span>
						</li>
						
						<?php  
							endwhile; endif;
						?>
						<?php 
							if( have_rows('contact_details') ): 
								while( have_rows('contact_details') ): the_row(); 
									$sname = get_sub_field('name');					
									$sphone_number = get_sub_field('phone_number');					
									$sdesignation = get_sub_field('designation');					
						?>
						<li>
							<span><?php echo $sname; ?> </span>
							<span><?php echo $sdesignation; ?> </span>
							<span><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $sphone_number; ?></span>
						</li>						
						<?php  
							endwhile; endif;
						?>	
				</ul>
			<div class="contact">States/UT's to which supplying</div>
			<ul class="wmanager-details"><li><?php the_field('statesuts_to_which_supplying'); ?></li></ul>
			<div class="contact">Location Map</div>
			<div class="location-map">
				<a href="<?php the_field('location_map'); ?>" target="_blank"><img src="<?php echo get_template_directory_uri();?>/assets/img/google-maps.png" alt="MAP"/> View on Map</a>
			</div>
			<div class="contact">Gallery</div>
			</div>
			<div class="col-md-4 col-lg-3 col-xs-12 col-sm-6">
						<aside class="service-sidebar">
                            <div class="author-wrap">
                                <div class="author-img">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/warehouse_1.png" alt="Image 1">
                                </div>
                                <div class="author-info">                                   
                                    <span>Warehouse Address</span>
									<h3><?php the_field('address') ?></h3>
                                </div>
                            </div>	
							<div class="author-wrap">
                                <div class="author-img">
                                    <img src="<?php echo get_template_directory_uri();?>/assets/img/envelope.png" alt="Image 2">
                                </div>
                                <div class="author-info">                                   
                                    <span>Email Us</span>
									<h3><?php the_field('email'); ?></h3>
                                </div>
                            </div>									
							<div class="related-post mb-30">
                                <h3 class="sidebar-title">Other Warehouse</h3>
                                <ul>
                                    <?php 
										$currentID = get_the_ID();
										$args = array( 
											'post_type'=> 'warehouse', 
											'posts_per_page' => 10,
											'post_status' => 'publish',
											'post__not_in' => array($currentID),
											'orderby'   => 'rand'
											
										);
										$loop_news = new WP_Query($args); $count = 1;
										while ( $loop_news->have_posts() ) : $loop_news->the_post(); 
										
									?>
									<li class="related-post-items">
                                        
                                        <div class="course_title">
                                            <a href="<?php the_permalink(); ?>" title=""><?php the_title(); ?></a>
                                            
                                        </div>
                                    </li>
									<?php endwhile; ?>
                                </ul>
                            </div>                            
                        </aside>
					</div>
		</div>
		</div><!-- #main -->
	</div>
</section><!-- #primary -->
<?php
get_footer();
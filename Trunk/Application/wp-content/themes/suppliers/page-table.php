<?php
/**
 * Template Name: Table Template
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
                            <th style="width:10%;">Sl.No</th>
                            <th style="width:50%;">Title</th>
                            <th style="width:20%;">Published Date</th>
                            <th style="width:20%;">Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (have_rows('cmss_table')):
                            $i = 1;
                            while (have_rows('cmss_table')):
                                the_row();
                                $title = get_sub_field('title');
                                $date = get_sub_field('published_date');
                                $file = get_sub_field('download'); // File field (URL or array)
                        
                                // Handle file data if it's an ACF file field (array)
                                if (is_array($file)) {
                                    $file_url = $file['url'];
                                    $file_title = $file['title'];
                                    $attachment_id = $file['ID'];
                                } else {
                                    $file_url = $file;
                                    $file_title = 'Download';
                                    $attachment_id = attachment_url_to_postid($file_url);
                                }

                                if ($attachment_id) {
                                    $file_path = get_attached_file($attachment_id);
                                    if (file_exists($file_path)) {
                                        $file_size = filesize($file_path);
                                        $formatted_size = size_format($file_size, 2); 
                                    } else {
                                        $formatted_size = 'N/A';
                                    }
                                } else {
                                    $formatted_size = 'N/A';
                                }
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo esc_html($title); ?></td>
                                    <td><?php echo esc_html($date); ?></td>
                                    <td>
                                        <?php if ($file_url): ?>
                                            <a href="<?php echo esc_url($file_url); ?>" target="_blank" class="tenderdocs">
                                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/pdf_icon.png"
                                                    style="width: 30px;" alt="PDF" title="Download PDF" />
                                                (<?php echo esc_html($formatted_size); ?>)
                                            </a>
                                        <?php else: ?>
                                            <span>No file available</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endwhile;
                        endif; ?>
                    </tbody>
                </table>
            </div>


        </div>
    </section>
</div>
<?php get_footer(); ?>
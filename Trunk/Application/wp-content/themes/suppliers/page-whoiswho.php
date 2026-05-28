<?php
/**
 * Template Name: Who is Who Template
 */

get_header();
?>

<!-- Page Title Begin -->
<section class="page-title-bg pt-80 pb-60" data-bg-img="<?php echo do_shortcode('[WP_HEADER_IMAGES]'); ?>">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title text-center">
                    <h2><?php the_title(); ?></h2>
                    <ul class="list-inline">
                        <li><a href="<?php bloginfo('url'); ?>">Home</a></li>
                        <li><?php the_title(); ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container">
<section id="primary" class="content-area pt-60 pb-60">
<div id="main" class="site-main">

<div class="page-innertitle"><?php the_title(); ?></div>

<?php
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content', 'page');
endwhile;
?>

<?php
$terms = get_terms(array(
    'taxonomy'   => 'whoiswhos-category',
    'hide_empty' => true,
    'orderby'    => 'term_id',
    'order'      => 'ASC',
));

if (!empty($terms) && !is_wp_error($terms)) :
foreach ($terms as $term) :
?>

<div class="member-content">
<div class="category-content">

<?php
$args = array(
    'post_type'      => 'whoiswhos',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'date',   // ✅ publish date
    'order'          => 'DESC',   // ✅ latest first
    'tax_query'      => array(
        array(
            'taxonomy' => 'whoiswhos-category',
            'field'    => 'slug',
            'terms'    => $term->slug,
        ),
    ),
);

$query = new WP_Query($args);

if ($query->have_posts()) :
?>

<div class="whoiswho-title">
    <h4><?php echo esc_html($term->name); ?></h4>
</div>

<?php
while ($query->have_posts()) :
    $query->the_post();

    $designation  = get_field('designation');
    $member_image = get_field('upload_photo');
    $email_id     = get_field('email_id');
    $phone        = get_field('phone');
    $extension    = get_field('extension');
?>

<ul class="whoiswho-item wow fadeInUp" data-wow-duration="1s" data-wow-offset="100">
    <li class="item-block" style="width:12%;">
        <?php if ($member_image) : ?>
            <img src="<?php echo esc_url($member_image); ?>" alt="<?php the_title(); ?>">
        <?php else : ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/no-image.jpg" alt="<?php the_title(); ?>">
        <?php endif; ?>
    </li>

    <li class="item-block" style="width:22%;">
        <h4><?php the_title(); ?></h4>
        <span><?php echo esc_html($designation); ?></span>
    </li>

    <li class="item-block" style="width:30%;">
        <i class="fa fa-envelope"></i> <?php echo esc_html($email_id); ?>
    </li>

    <li class="item-block" style="width:23%;">
        <i class="fa fa-phone"></i> <?php echo esc_html($phone); ?>
        <span>Extension: <?php echo esc_html($extension); ?></span>
    </li>
</ul>

<?php endwhile; ?>

<?php else : ?>
<p>No members found.</p>
<?php endif; wp_reset_postdata(); ?>

</div>
</div>

<?php endforeach; endif; ?>

</div>
</section>
</div>

<?php get_footer(); ?>

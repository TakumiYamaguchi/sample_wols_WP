<?php
/*
Template Name:Horizontal scroll page
*/
__('Horizontal scroll page', 'tcd-horizon');
?>
<?php
get_header();
$options = get_design_plus_option();
?>
<div class="menu_img__inner">
    <?php
    $array = array(
        'post_type' => 'drink_menu',
    );
    $drink_menu = new WP_Query($array);
    ?>
    <?php if ($drink_menu->have_posts()) : ?>
    <?php while ($drink_menu->have_posts()) : $drink_menu->the_post(); ?>
    <img class="drink_menu" src="<?php the_field('drink_img'); ?>" alt="bar wols">
    <?php endwhile; ?>
    <?php endif;
    wp_reset_postdata(); ?>

</div>
<!-- END #wide_contents -->
<?php get_footer(); ?>
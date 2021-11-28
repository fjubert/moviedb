<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); 
?>
    <div class="container-fluid">   

        <?php get_template_part('template-parts/upcoming-movies'); ?>

        <?php get_template_part('template-parts/popular-actors'); ?>

    </div>
<?php
get_footer();

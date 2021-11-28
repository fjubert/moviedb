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

if(is_singular('movie')) {
    get_template_part('template-parts/movie-template'); 
} 

if (is_singular('actor')) {
    get_template_part('template-parts/actor-template'); 
}


get_footer();
<?php while ( have_posts() ) : the_post(); ?>
    <div class="container py-5 px-3">
        <?php get_template_part('template-parts/actors/actors-main'); ?>
    </div>
<?php endwhile; ?>
<?php
    if( have_rows('production_companies') ): ?>
        <section class="container py-5 px-3">
            <h2 class="text-center mb-4">Production Companies</h3>
            <div class="grid-container">
                <?php 
                while( have_rows('production_companies') ) : the_row(); 
                    $logo = get_sub_field('logo');
                    $name = get_sub_field('name');
                ?>
                <div class="px-4 py-4">
                    <img src="<?php echo $logo; ?>" alt="<?php echo $name; ?>">
                </div>
                <?php endwhile; ?>
            </div>
        </section>
<?php endif;
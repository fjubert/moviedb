<?php
    if( have_rows('alternative_titles') ): ?>
        <div class="alternative-titles">
            <h3>Alternative Titles</h3>
            <ul>
                <?php 
                while( have_rows('alternative_titles') ) : the_row(); 
                    $lang = get_sub_field('lang');
                    $title = get_sub_field('title');
                ?>
                    <li>
                        <b><?php echo $lang; ?></b> | <?php echo $title; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div>
<?php endif;
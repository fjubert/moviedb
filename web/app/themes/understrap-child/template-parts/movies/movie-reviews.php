<section class="py-5 px-3 bg-light">
    <div class="container">
        <h2 class="text-center mb-4">Reviews</h2>
        <?php if( have_rows('reviews') ): ?>
            <div class="row">
                <?php while( have_rows('reviews') ) : the_row(); 
                    $author = get_sub_field('author');
                    $rating = get_sub_field('rating');
                    $content = get_sub_field('content');
                    ?>
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5><?php echo $author; ?></h5>
                                    </div>
                                    <div class="col">
                                        <?php if($rating) { ?>
                                            <h5 class="m-0 text-right"><span class="badge px-2 py-1 rounded-pill bg-warning text-dark">
                                                ⭑ <?php echo $rating; ?>
                                            </span></h5>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?php echo $content; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;?>
    </div>
</section>
    


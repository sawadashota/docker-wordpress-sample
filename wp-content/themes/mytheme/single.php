<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <section id="posts">
        <?php while (have_posts()) : the_post(); ?>
            <section>
                <h1>
                    <?php the_title(); ?>
                </h1>
                <?php if (has_post_thumbnail()): ?>
                    <div class="thumbnail">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                <time><?php the_date(); ?><?php the_time(); ?></time>
                <section><?php the_tags(); ?></section>
                <section><?php the_category(); ?></section>
                <?php the_content(); ?>
            </section>
        <?php endwhile; ?>
    </section>
<?php endif; ?>

<?php get_footer(); ?>

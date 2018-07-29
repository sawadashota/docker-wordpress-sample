<?php get_header(); ?>
<?php if (have_posts()) : ?>
    <section id="posts">
        <h1>投稿</h1>
        <?php while (have_posts()) : the_post(); ?>
            <section>
                <h1>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h1>
                <?php if (has_post_thumbnail()): ?>
                    <div class="thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                <?php endif; ?>
                <time><?php the_date(); ?><?php the_time(); ?></time>
                <section><?php the_tags(); ?></section>
                <section><?php the_category(); ?></section>
                <?php the_excerpt(); ?>
            </section>
        <?php endwhile; ?>
    </section>
<?php else: ?>
    <p>表示する記事がありません</p>
<?php endif; ?>

<?php news_posts();
if (have_posts()) : ?>
    <section id="posts">
        <h1>News</h1>
        <?php while (have_posts()) : the_post(); ?>
            <section>
                <h1>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h1>
                <?php if (has_post_thumbnail()): ?>
                    <div class="thumbnail">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </div>
                <?php endif; ?>
                <time><?php the_date(); ?><?php the_time(); ?></time>
                <section><?php the_tags(); ?></section>
                <section><?php the_category(); ?></section>
                <?php the_excerpt(); ?>
            </section>
        <?php endwhile; ?>
        <?php pagination(); ?>
    </section>
<?php else: ?>
    <p>表示する記事がありません</p>
<?php endif; ?>
<?php get_footer(); ?>

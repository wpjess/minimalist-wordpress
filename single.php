<?php get_header(); ?>

<div class="site-content">
    <main class="content-area">
        <?php while ( have_posts() ) : ?>
            <?php the_post(); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                    
                    <div class="entry-meta">
                        <time class="entry-date" datetime="<?php echo get_the_date( 'c' ); ?>">
                            <?php echo get_the_date(); ?>
                        </time>
                        <span class="meta-separator"> • </span>
                        <span class="entry-author">
                            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                <?php the_author(); ?>
                            </a>
                        </span>
                        <?php
                        $categories = get_the_category();
                        if ( ! empty( $categories ) ) :
                        ?>
                            <span class="meta-separator"> • </span>
                            <span class="entry-categories">
                                <?php
                                foreach ( $categories as $category ) {
                                    echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
                                    if ( $category !== end( $categories ) ) {
                                        echo ', ';
                                    }
                                }
                                ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anthropic-minimal' ),
                        'after'  => '</div>',
                    ) );
                    ?>
                </div>

                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                ?>
                    <footer class="entry-footer">
                        <div class="entry-tags">
                            <span class="tags-label"><?php esc_html_e( 'Tagged:', 'anthropic-minimal' ); ?></span>
                            <?php
                            foreach ( $tags as $tag ) {
                                echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-link">' . esc_html( $tag->name ) . '</a>';
                                if ( $tag !== end( $tags ) ) {
                                    echo ', ';
                                }
                            }
                            ?>
                        </div>
                    </footer>
                <?php endif; ?>
            </article>

            <nav class="navigation post-navigation">
                <div class="nav-links">
                    <div class="nav-previous">
                        <?php
                        previous_post_link( '%link', '&larr; %title' );
                        ?>
                    </div>
                    <div class="nav-next">
                        <?php
                        next_post_link( '%link', '%title &rarr;' );
                        ?>
                    </div>
                </div>
            </nav>

            <?php
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>

        <?php endwhile; ?>
    </main>
</div>

<?php get_footer(); ?>
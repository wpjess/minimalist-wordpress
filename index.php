<?php get_header(); ?>

<div class="site-content">
    <main class="content-area">
        <?php if ( have_posts() ) : ?>
            
            <?php if ( is_home() && ! is_front_page() ) : ?>
                <header class="page-header">
                    <h1 class="page-title"><?php single_post_title(); ?></h1>
                </header>
            <?php endif; ?>

            <?php while ( have_posts() ) : ?>
                <?php the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    
                    <div class="entry-summary-content">
                        <header class="entry-header">
                            <h2 class="entry-title">
                                <a href="<?php the_permalink(); ?>" rel="bookmark">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="entry-thumbnail">
                            <a href="<?php the_permalink(); ?>" rel="bookmark">
                                <?php the_post_thumbnail( 'full', array( 'class' => 'featured-image' ) ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                            
                            <div class="entry-meta">
                                <span class="entry-author">
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                                       Writen By: <?php the_author(); ?>
                                    </a>
                                </span>
                            </div>
                        </header>

                        <div class="entry-summary">
                            <?php
                            if ( has_excerpt() ) {
                                the_excerpt();
                            } else {
                                echo wp_trim_words( get_the_content(), 30, '...' );
                            }
                            ?>
                        </div>
                    </div>
                </article>
                
            <?php endwhile; ?>

            <nav class="navigation pagination">
                <div class="nav-links">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '&larr; Previous',
                        'next_text' => 'Next &rarr;',
                        'type'      => 'plain',
                    ) );
                    ?>
                </div>
            </nav>

        <?php else : ?>

            <section class="no-results not-found">
                <header class="page-header">
                    <h1 class="page-title"><?php esc_html_e( 'Nothing here', 'anthropic-minimal' ); ?></h1>
                </header>

                <div class="page-content">
                    <?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
                        <p>
                            <?php
                            printf(
                                wp_kses(
                                    __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'anthropic-minimal' ),
                                    array( 'a' => array( 'href' => array() ) )
                                ),
                                esc_url( admin_url( 'post-new.php' ) )
                            );
                            ?>
                        </p>
                    <?php elseif ( is_search() ) : ?>
                        <p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'anthropic-minimal' ); ?></p>
                        <?php get_search_form(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'anthropic-minimal' ); ?></p>
                        <?php get_search_form(); ?>
                    <?php endif; ?>
                </div>
            </section>

        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
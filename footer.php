    <footer id="colophon" class="site-footer">
        <div class="footer-container">
            <div class="site-info">
                <?php
                printf(
                    '&copy; %1$s %2$s',
                    date( 'Y' ),
                    '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>'
                );
                ?>
                <span class="meta-separator"> • </span>
                <?php
                printf(
                    esc_html__( 'Powered by %s', 'anthropic-minimal' ),
                    '<a href="https://wordpress.org/">WordPress</a>'
                );
                ?>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
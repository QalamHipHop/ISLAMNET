    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="site-info">
                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'islamnet' ) ); ?>">
                    <?php
                    /* translators: %s: CMS name, i.e. WordPress. */
                    printf( esc_html__( 'Proudly powered by %s', 'islamnet' ), 'WordPress' );
                    ?>
                </a>
                <span class="sep"> | </span>
                <?php
                /* translators: 1: Theme name, 2: Theme author. */
                printf( esc_html__( 'Theme: %1$s by %2$s.', 'islamnet' ), 'IslamNET', '<a href="https://github.com/QalamHipHop">QalamHipHop</a>' );
                ?>
            </div>
        </div>
    </footer>

    <?php if ( wp_is_mobile() ) : ?>
    <nav class="mobile-bottom-nav">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="mobile-bottom-nav-item active">
            <i class="dashicons dashicons-admin-home"></i>
            <span><?php esc_html_e( 'Home', 'islamnet' ); ?></span>
        </a>
        <a href="#" class="mobile-bottom-nav-item">
            <i class="dashicons dashicons-groups"></i>
            <span><?php esc_html_e( 'Community', 'islamnet' ); ?></span>
        </a>
        <a href="#" class="mobile-bottom-nav-item">
            <i class="dashicons dashicons-welcome-learn-more"></i>
            <span><?php esc_html_e( 'Learn', 'islamnet' ); ?></span>
        </a>
        <a href="#" class="mobile-bottom-nav-item">
            <i class="dashicons dashicons-admin-users"></i>
            <span><?php esc_html_e( 'Profile', 'islamnet' ); ?></span>
        </a>
    </nav>
    <?php endif; ?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>

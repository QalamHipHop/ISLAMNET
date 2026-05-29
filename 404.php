<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package IslamNET
 */

get_header();
?>

<main id="primary" class="site-main">
    <section class="error-404 not-found container">
        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'islamnet' ); ?></h1>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'islamnet' ); ?></p>
            <?php get_search_form(); ?>
        </div><!-- .page-content -->
    </section><!-- .error-404 -->
</main>

<?php
get_footer();

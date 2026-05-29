<?php
/**
 * The template for displaying archive pages
 *
 * @package IslamNET
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content/entry', get_post_type() );
            endwhile;

            the_posts_navigation();
        else :
            get_template_part( 'template-parts/content/entry', 'none' );
        endif;
        ?>
    </div>
</main>

<?php
get_footer();

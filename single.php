<?php
/**
 * The template for displaying all single posts
 *
 * @package IslamNET
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container site-content-wrapper">
        <div class="content-area">
            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content/entry', get_post_type() );
                the_post_navigation();
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
            endwhile;
            ?>
        </div>
        <?php get_sidebar(); ?>
    </div>
</main>

<?php
get_footer();

<?php
/**
 * Template Name: Posts Archive Template
 *
 * Description: Displays an archive of posts, ordered by date.
 *
 * @package Tatva
 * @since Tatva 1.0
 */

get_header(); ?>

<div id="maincontentcontainer">

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">

                    <div class="main-content">
			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'postarchives' ); ?>
				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

			<?php endif; // end have_posts() check ?>
                        
                    </div> <!-- /.main-content -->

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->
</div> <!-- /#maincontentcontainer -->
<?php get_footer(); ?>

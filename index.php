<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Tatva
 * @since Tatva 1.0
 */

get_header(); ?>

<?php 

// check if WP is using Front Page

if (is_front_page()) { ?>
  
        <div id="bannercontainer">
		
            <div class="banner row">

                    <?php 
                    // Count how many banner sidebars are active so we can work out how many containers we need
		
                    $bannerSidebars = 0;
		
                    for ( $x=1; $x<=2; $x++ ) {
		
                        if ( is_active_sidebar( 'home-featured' . $x ) ) {
			
                            $bannerSidebars++;
			
                            }
			
                       }

				// If there's one or more one active sidebars, create a row and add them
				if ( $bannerSidebars > 0 ) { ?>
					<?php
					// Work out the container class name based on the number of active banner sidebars
					$containerClass = "grid_" . 12 / $bannerSidebars . "_of_12";

					// Display the active banner sidebars
					for ( $x=1; $x<=2; $x++ ) {
						if ( is_active_sidebar( 'home-featured'. $x ) ) { ?>
							<div class="col <?php echo $containerClass?>">
								<div class="widget-area" role="complementary">
									<?php dynamic_sidebar( 'home-featured'. $x ); ?>
								</div> <!-- /.widget-area -->
							</div> <!-- /.col.<?php echo $containerClass?> -->
						<?php }
					} ?>

				<?php } ?>
			
		</div> <!-- /.banner.row -->
                
	</div> <!-- /#bannercontainer -->
        
	<?php 
        
            // display front page widgets
            get_sidebar( 'front' );  

            // Call template file to display featured products on front page
            // This has been done in parts for better code organization. 
            get_template_part('content','eddfront'); 

            // Display featured posts on front page
            get_template_part('content','frontposts');
        
        ?>
        

<?php } //end front page check ?>
                                                        
                                                  

<div id="maincontentcontainer">

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">

                    <div class="main-content">
                        
			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); // Include the Post-Format-specific template for the content ?>
				<?php endwhile; ?>

				<?php tatva_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

			<?php endif; // end have_posts() check ?>

                    </div>  <!-- /.main-content -->
                    
		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

</div> <!-- /#maincontentcontainer -->

<?php get_footer(); ?>

<?php
/**
 * 
 *
 * Description: Displays a full-width front page. The front page template provides an optional
 * banner section that allows for highlighting a key message. It can contain up to 2 widget areas,
 * in one or two columns. These widget areas are dynamic so if only one widget is used, it will be
 * displayed in one column. If two are used, then they will be displayed over 2 columns.
 * There are also four front page only widgets displayed just beneath the main content. Like the
 * banner widgets, they will be displayed in anywhere from one to four columns, depending on
 * how many widgets are active.
 *
 * @package Tatva
 * @since Tatva 1.0
 */

get_header(); ?>
        
        <div id="bannercontainer">
		<div class="banner row">
			<?php if ( is_front_page() ) {
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

				<?php }
			} ?>
		</div> <!-- /.banner.row -->
	</div> <!-- /#bannercontainer -->
        
	<?php get_sidebar( 'front' ); ?>
        
        <?php 
        // check if EDD is active
        
        if ( class_exists( 'Easy_Digital_Downloads' ) ) { ?>
	<div id="maincontentcontainer">
        
	<div id="primary" class="site-content row" role="main">
		<div class="col grid_12_of_12">
                    
                    <?php
			if ( get_theme_mod( 'tatva_edd_front_featured_products' ) ){
                            $per_page = intval( get_theme_mod( 'tatva_edd_store_front_count' ) );
                            $product_args = array(
                                    'post_type' => 'download',
                                    'posts_per_page' => $per_page,
                            );
                            $products = new WP_Query($product_args);
                            ?>
                            <?php if ($products->have_posts()) : $i = 1; ?>
                                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                                            <div class="col grid_4_of_12 home-product<?php if($i % 3 == 1) { echo ' last'; } ?>">
                                                    <a href="<?php the_permalink(); ?>">
                                                            <h3 class="home-product-title"><?php the_title(); ?></h3>
                                                    </a>
                                                    <div class="product-image">
                                                            <a href="<?php the_permalink(); ?>">
                                                                    <?php the_post_thumbnail('product-image-thumb'); ?>
                                                            </a>
                                                        <div class="home-product-info">
                                                            <?php if(function_exists('edd_price')) { ?>
                                                                    <div class="product-buttons">
                                                                            <?php if(!edd_has_variable_prices(get_the_ID())) { ?>
                                                                                    <?php // echo edd_get_purchase_link(get_the_ID(), 'Add to Cart', 'button'); ?>
                                                                            <?php } ?>
                                                                            <a href="<?php the_permalink(); ?>" class="product-details-link" title="WordPress theme">View Details</a>
                                                                    </div><!--end .product-buttons-->
                                                            <?php } ?>
                                                        </div> <!--end .home-product-info -->
                                                    </div> <!--end .product-image -->
                                            </div><!--end .product-->
                                            <?php $i+=1; ?>
                                    <?php endwhile; ?>
                            <?php else : ?>

                                    <h2 class="center">Not Found</h2>
                                    <p class="center">Sorry, but you are looking for something that isn't here.</p>
                                    <?php get_search_form(); ?>

                            <?php endif; ?>
                        <?php } ?>
                                    
                                    <p class="tatva-store-button"><a class="cta-button" href="<?php echo esc_url( get_theme_mod( 'tatva_edd_store_link_url' ) ); ?>"><?php echo get_theme_mod( 'tatva_edd_store_link_text' ); ?></a></p>
                                    
		</div> <!-- /.col.grid_12_of_12 -->
                
	</div><!-- /#primary.site-content.row -->
        
        </div><!-- /#maincontentcontainer -->
        
        <?php } // end EDD Check  ?> 
        
        <?php 
        // Start a new query for displaying featured posts on Front Page
                
        if(get_theme_mod('tatva_front_featured_posts_check')) {
                $featured_count = intval( get_theme_mod( 'tatva_front_featured_posts_count' ) );
                $var = get_theme_mod('tatva_front_featured_posts_cat');
                
                // if no category is selected then return 0 
                $featured_cat_id = max((int)$var, 0);
                
                $featured_post_args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $featured_count,
                        'cat' => $featured_cat_id,
                        'post__not_in' => get_option( 'sticky_posts' ),
                );
                $featuredposts = new WP_Query($featured_post_args);
                ?>
        <div id="front-featured-posts">
                <div id="featured-posts-container" class="row">
                    <div id="featured-posts" class="col grid_12_of_12" >
                        <?php if ($featuredposts->have_posts()) : $i = 1; ?>
                                <?php while ($featuredposts->have_posts()) : $featuredposts->the_post(); ?>
                                        <div class="col grid_4_of_12 home-featured-post<?php if($i % 3 == 1) { echo ' last'; } ?>">
                                                <a href="<?php the_permalink(); ?>">
                                                        <h3 class="home-featured-post-title"><?php the_title(); ?></h3>
                                                </a>
                                                <div class="featured-post-content">
                                                        <a href="<?php the_permalink(); ?>">
                                                                <?php the_post_thumbnail('post_feature_thumb'); ?>
                                                        </a>
                                                        <?php the_excerpt(); ?>
                                                </div> <!--end .featured-post-content -->
                                        </div><!--end .home-featured-post-->
                                        <?php $i+=1; ?>
                                <?php endwhile; ?>
                        <?php else : ?>

                                <h2 class="center">Not Found</h2>
                                <p class="center">Sorry, but you are looking for something that isn't here.</p>
                                <?php get_search_form(); ?>

                        <?php endif; ?>

                     </div> <!-- /#featured-posts -->
                </div> <!-- /#featured-posts-container -->
        </div> <!-- /#front-featured-posts -->
        <?php } ?>

<?php get_footer(); ?>
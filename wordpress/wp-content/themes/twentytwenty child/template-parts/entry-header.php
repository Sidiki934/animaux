<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

$entry_header_classes = '';

if ( is_singular() ) {
	$entry_header_classes .= ' header-footer-group';
}

?>

<header class="entry-header has-text-align-center<?php echo esc_attr( $entry_header_classes ); ?>">

	<div class="entry-header-inner section-inner medium">

		<?php
			/**
			 * Allow child themes and plugins to filter the display of the categories in the entry header.
			 *
			 * @since Twenty Twenty 1.0
			 *
			 * @param bool   Whether to show the categories in header, Default true.
			 */
		$show_categories = apply_filters( 'twentytwenty_show_categories_in_entry_header', true );

		if ( true === $show_categories && has_category() ) {
			?>

			<div class="entry-categories">
				<span class="screen-reader-text"><?php _e( 'Categories', 'twentytwenty' ); ?></span>
				<div class="entry-categories-inner">
					<?php the_category( ' ' ); ?>
				</div><!-- .entry-categories-inner -->
			</div><!-- .entry-categories -->

			<?php
		}

		if ( is_singular() ) {
      // the_title( '<h1 class="entry-title">', '</h1>' );?>
      <h1 class="entry-title">
        <?php echo get_post_meta($post->ID, "nom", true);?>
      </h1>
      <?php 
    } else {
      //the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
      ?>
     <h2 class="entry-title heading-size-1">

        <a href="<?php echo '?p='. $post->ID;?>">
        
          <?php echo get_post_meta($post->ID, "nom", true);?>
        </a>
      </h2>
      <div>
        Propriétaire : <?php echo get_the_author(); ?>
    </div>
    <?php the_terms($post->ID, 'generique', 'Générique : ' ); ?>
    <div>
    	Mail :
    <?php echo get_post_meta($post->ID,  "mail", true);?>	
</div>
	<div>
    	Phone :
    <?php echo get_post_meta($post->ID,  "phone", true);?>	
</div>
      <?php 
    }

		// Default to displaying the post meta.
		//twentytwenty_the_post_meta( get_the_ID(), 'single-top' );
		?>
		
	</div><!-- .entry-header-inner -->

</header><!-- .entry-header -->

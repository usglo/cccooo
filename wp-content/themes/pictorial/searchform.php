<?php
/**
 * The template for displaying search forms in pictorial
 *
 * @package pictorial
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'pictorial' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search - Type & Hit Enter &hellip;', 'placeholder', 'pictorial' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'pictorial' ); ?>">
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'pictorial' ); ?>">
</form>

<?php


/*Store Post Views Count*/
function count_post_views() {
	if (is_single()) {
		global $post;
		$post_id = $post->ID;
		$count = 1;
		$post_view_count = get_post_meta($post_id, 'views_count', true);
		if ($post_view_count) {
			$count = $post_view_count + 1;
		}

		update_post_meta($post_id, 'views_count', $count);
	}
}

add_action('wp_head', 'count_post_views');
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/*Add custom column on post listing table*/
add_filter('manage_post_posts_columns', function ( $columns ) 
{
	if( is_array( $columns ) && ! isset( $columns['post_views'] ) )
	    $columns['post_views'] = __( 'Post Views' );     
	return $columns;
} );

/*Display views count under the custom columns*/
add_action( 'manage_post_posts_custom_column', function ( $column_name, $post_id ) 
{
    if ( $column_name == 'post_views') {
    	$post_view_count = get_post_meta($post_id, 'views_count', true);
    	$count = $post_view_count ? $post_view_count : 0;
        echo $count;
    }

}, 10, 2 );
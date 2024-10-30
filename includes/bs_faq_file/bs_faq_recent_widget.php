<?php 
/**
* 	widget
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_recent_widget
{
	
	public function __construct()
	{
		add_action( 'widgets_init', array($this,'bs_faq__create_widgets') );
	}
	function bs_faq__create_widgets() {
         register_widget( 'bs_recent_faq' );
}

}
new Bs_faq_recent_widget();



class Bs_recent_faq extends WP_Widget {

	function __construct () {
	    parent::__construct( 'bs_recent_faq', 'BS Recent FAQs',
	   array( 'description' =>'Displays list of Recent FAQ' ) );
	}
	
	function form( $instance ) {

		$render_widget = ( !empty( $instance['render_widget'] ) ?
		$instance['render_widget'] : 'true' );
		$bs_recent_faq = ( !empty( $instance['bs_recent_faq'] ) ? 
		$instance['bs_recent_faq'] : 5 );
		$widget_title = ( !empty( $instance['widget_title'] ) ?
		esc_attr( $instance['widget_title'] ) :'BS Recent FAQs' );
	?>
	<!-- Display fields to specify title and item count -->
		<p>
			<label for="<?php echo
				$this->get_field_id( 'render_widget' ); ?>">
					<?php echo 'Display Widget'; ?>
					<select id="<?php echo $this->get_field_id( 'render_widget' ); ?>"
					name="<?php echo
					$this->get_field_name( 'render_widget' ); ?>">
					<option value="true"
					<?php selected( $render_widget, 'true' ); ?>> Yes</option>
					<option value="false"
					<?php selected( $render_widget, 'false' ); ?>> No</option>
					</select>
			</label>
		</p>
		<p>
		
			<label for="<?php echo
			$this->get_field_id( 'widget_title' ); ?>">
				<?php echo 'Widget Title:'; ?>
				<input type="text" id="<?php echo $this->get_field_id( 'widget_title' );?>"
				name="<?php	echo $this->get_field_name( 'widget_title' ); ?>"
				value="<?php echo $widget_title; ?>" />
			</label>
		
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'bs_recent_faq' ); ?>">
			<?php echo 'Number of reviews to display:'; ?>
				<input type="text" id="<?php echo $this->get_field_id( 'bs_recent_faq' ); ?>"
					name="<?php echo $this->get_field_name( 'bs_recent_faq' ); ?>"
					value="<?php echo $bs_recent_faq; ?>" />
			</label>
		</p>
<?php }

function update( $new_instance, $instance ) {

	if ( is_numeric ( $new_instance['bs_recent_faq'] ) ) {
	    $instance['bs_recent_faq'] = intval( $new_instance['bs_recent_faq'] );
	} else {
	   $instance['bs_recent_faq'] = $instance['bs_recent_faq'];
	}
	   $instance['widget_title'] = sanitize_text_field( $new_instance['widget_title'] );
	   $instance['render_widget'] = sanitize_text_field( $new_instance['render_widget'] );
	  return $instance;
}

function widget( $args, $instance ) {
	if ( 'true' == $instance['render_widget'] ) {
		extract( $args );
		// Retrieve widget configuration options
		$bs_recent_faq =( !empty( $instance['bs_recent_faq'] ) ?
		$instance['bs_recent_faq'] : 5 );
		$widget_title = ( !empty( $instance['widget_title'] ) ?
		esc_attr( $instance['widget_title'] )
		:'BS FAQ Reviews' );
		// Preparation of query string to retrieve book reviews
		$query_array = array( 'post_type' => 'bs_faq',
		'post_status' => 'publish',
		'posts_per_page' =>
		$bs_recent_faq );
		// Execution of post query
		$rs_review_query = new WP_Query();
		$rs_review_query->query( $query_array );
		// Display widget title
		echo $before_widget . $before_title;
		echo apply_filters( 'widget_title', $widget_title );
		echo $after_title;
		// Check if any posts were returned by query
		if ( $rs_review_query->have_posts() ) {
		// Display posts in unordered list layout
		echo '<ul>';
		// Cycle through all items retrieved
		while ( $rs_review_query->have_posts() ) {
		$rs_review_query->the_post();
		echo '<li><a href="' . get_permalink() . '">';
		echo get_the_title( get_the_ID() ) . '</a></
		li>';
		}
		echo '</ul>';
		}
		wp_reset_query();
		echo $after_widget;
	}
}
}
?>
<?php 
/**
* 	display name meta box
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_display_name_metabox
{
	
	public function __construct()
	{
		add_action('admin_init', array($this,'bs_faq_admin_init') );
		add_action('save_post', array($this,'bs_faq_review_fields'),10,2);
	}
function bs_faq_admin_init() {

add_meta_box( 'bs_faq_metabox','Display Name',array($this,'bs_faq_display_name_meta_box'),'bs_faq', 'normal', 'high' );

}
function bs_faq_display_name_meta_box( $bs_faq ){
$display_name =esc_html( get_post_meta( $bs_faq->ID,'display_name', true ) );

?>
	<table>
		<tr>
		   <td style="width: 100%">Display Name</td>
		   <td><input type="text" size="80" name="display_name"
				value="<?php echo $display_name; ?>" /></td>
		</tr>
		
	
	</table>
<?php }


function bs_faq_review_fields( $bs_faq_id, $bs_faq_review ) {

	if ( 'bs_faq' == $bs_faq_review->post_type ) {

	if ( isset( $_POST['display_name'] ) ) {
		  update_post_meta( $bs_faq_id, 'display_name',
	      sanitize_text_field($_POST['display_name'] ) );
	}
	
  }
}

}

new Bs_faq_display_name_metabox();

?>
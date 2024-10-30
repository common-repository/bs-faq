<?php 
/**
* 	display custom post type with meta box
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Display_bs_faq_post_type
{
	
	public function __construct()
	{
		add_filter( 'template_include', array($this,'bs_faq_template_include'),1);
	}
function bs_faq_template_include( $template_path ) {
//echo 'clled'; die;
	if ( 'bs_faq' == get_post_type() ) {
		if ( is_single() ) {

			if ( $theme_file = locate_template( array( 'single-bs_faq.php' ) ) ) {
			  $template_path = $theme_file;
			} else {
			  add_filter( 'the_content',array($this,'display_single_bs_faq'),20 );
			}
		}
	}
return $template_path;
}

function display_single_bs_faq( $content ) {
	if ( !empty( get_the_ID() ) ) {	
	
	$content = '';
	
	$hideDate = (array)get_option('bs_faq_register_setting');
	$hideDateValue = $hideDate['hide_date'];	
	//$content .= '<strong>Date: </strong>';
	if(!$hideDateValue):
	$content .= the_time('d F Y').'<br>'; 
	endif;
	
	 $hideName = (array)get_option('bs_faq_register_setting');
	 $hideNameValue = $hideName['hide_name'];
	if(!$hideNameValue):
	$content .= '<strong>Name: </strong>';
	$content .= esc_html( get_post_meta( get_the_ID(),'display_name',true ) );
	endif;
	
	
	$hideCategory = (array)get_option('bs_faq_register_setting');
	$hideCategoryValue = $hideCategory['hide_category'];	
	if(!$hideCategoryValue):
	
		$faq_type = wp_get_post_terms( get_the_ID(),'bs_faq_type' );
		$content .= '<br /><strong>Category: </strong>';

			if ( $faq_type) 
			{
				$first_entry = true;
				for ( $i = 0; $i < count( $faq_type ); $i++ ) {
					if ( !$first_entry ) {
							$content .= ', ';
						}
					$content .= $faq_type[$i]->name;
					$first_entry = false;
					}
			} 
	
	else {
		$content .= 'None Assigned';
	}
	
	endif;	
	
	
	$hideTags = (array)get_option('bs_faq_register_setting');
	$hideTagsValue = $hideTags['hide_tags'];
	
	if(!$hideTagsValue):
	
		$faq_tag = wp_get_post_terms( get_the_ID(),'bs_faq_tag' );
		$content .= '<br /><strong>Tags: </strong>';

	if ( $faq_tag) {
		$first_entry = true;
		for ( $i = 0; $i < count( $faq_tag ); $i++ ) {
			if ( !$first_entry ) {
				$content .= ', ';
			}
			$content .= $faq_tag[$i]->name;
			$first_entry = false;
		}
	} 
	else {
		$content .= 'None Assigned';
	}
	
	endif;	
	
	
	$content .= '<br /><br />';
	$content .= get_the_content( get_the_ID() );
	$content .= '</div>';
	return $content;
	}
}
}
new Display_bs_faq_post_type();

?>
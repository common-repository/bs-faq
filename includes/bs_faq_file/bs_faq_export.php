<?php

/**
* 	export FAQ
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_export
{
	
	public function __construct()
	{		
		add_action( 'restrict_manage_posts', array($this,'add_export_button' ));	
		add_action( 'init', array($this,'export_bs_faq' ));		
	}	
	
	
function add_export_button() {
	$screen = get_current_screen();

   if ( 'bs_faq' == $screen->post_type )  {

        ?>

		<input type="submit" name="export_all_posts" id="export_all_posts" class="button button-primary" value="Export FAQs">	
		<script type="text/javascript">			
			jQuery(function($) {
				$('#export_all_posts').insertAfter('#post-query-submit');				
			});
		</script>
		<?php
    }
}



function export_bs_faq() {
	if(isset($_GET['export_all_posts'])) {
		$arg = array(
				'post_type' => 'bs_faq',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);

		global $post;
		$arr_post = get_posts($arg);
		if ($arr_post) {

			header('Content-type: text/csv');
			header('Content-Disposition: attachment; filename="bs_faq_data.csv"');
			header('Pragma: no-cache');
			header('Expires: 0');

			$file = fopen('php://output', 'w');	
						
			fputcsv($file, array('Question', 'Answer', 'URL', 'Display Name', 'Category', 'Tags'));
			foreach ($arr_post as $post) {				
				$display_name = esc_html( get_post_meta( get_the_ID(),'display_name',true ) );				
				
			$faq_category = wp_get_post_terms( get_the_ID(),'bs_faq_type' );
					if ( $faq_category) 
							{	
								$category = '';
								$first_entry = true;
								for ( $i = 0; $i < count( $faq_category ); $i++ ) {
									if ( !$first_entry ) {
											$category .= ', ';
										}
									$category .= $faq_category[$i]->name;
									$first_entry = false;
									}
							} 

					else {						
							$category = 'Category Not Assign';
						} 


				$faq_tag = wp_get_post_terms( get_the_ID(),'bs_faq_tag' );
					if ( $faq_tag) {
						$tags = '';
						$first_entry = true;
						for ( $i = 0; $i < count( $faq_tag ); $i++ ) {
							if ( !$first_entry ) {
								$tags .= ', ';
							}
							$tags .= $faq_tag[$i]->name;
							$first_entry = false;
						}
					}

					else {						
							$tags = 'Tag Not Assign';
						}  
				
				
				
				{
				setup_postdata($post);
				fputcsv($file, array(get_the_title(), get_the_content(), get_the_permalink(), $display_name, $category, $tags));
			
			}
			
			}
			exit();
		}
	}
  }
}

new Bs_faq_export();

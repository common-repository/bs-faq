<?php 
/**
* 	import data
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_import_data
{
	
	public function __construct()
	{
		//add_action('init', array($this,'register_bs_faq_custom_post_type') );
		add_action('admin_menu', array($this,'bs_faq_import'));
		add_action( 'admin_post_import_ch8bt_bug', array($this,'import_ch8bt_bug' ));
	}
	

function bs_faq_import() {
	add_submenu_page('edit.php?post_type=bs_faq', 
	__('FAQ Import','bs_faq_plugin'), 
	__('Import','bs_faq_plugin'),
	'manage_options',	'bsfaqimport',
	array($this,'bs_faq_data_import'));
}

function bs_faq_data_import(){
?>

<!-- Form to upload new bugs in csv format -->
<form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data">
	<input type="hidden" name="action" value="import_ch8bt_bug" />
	<!-- Adding security through hidden referrer field -->
	<?php wp_nonce_field( 'ch8bt_import' ); ?>
	<h3>Import FAQ</h3> <hr>
	<div class="import_data">
		Import FAQ from CSV File
		<input name="import_bugs_file" type="file" />
	</div> <hr>
	<input type="submit" value="Import" class="button-primary"/>
</form>

<?php }

		function import_ch8bt_bug() {
	// Check that user has proper security level
		if ( !current_user_can( 'manage_options' ) ) {
			wp_die( 'Not allowed' );
			}
		// Check if nonce field is present
		check_admin_referer( 'ch8bt_import' );
		// Check if file has been uploaded
			if( array_key_exists( 'import_bugs_file', $_FILES ) ) {
			// If file exists, open it in read mode
			$handle = fopen( $_FILES['import_bugs_file']['tmp_name'], 'r'
			);
			// If file is successfully open, extract a row of data
			// based on comma separator, and store in $data array
			if ( $handle ) {
				while ( FALSE !== ( $data = fgetcsv( $handle, 5000, ',' ) ) )
				{
					$row += 1;

					// If row count is ok and row is not header row
					// Create array and insert in database
					if ( $row != 1 ) {
						$ins_data = array(
							'post_title' => $data[0],
							'post_content'	=>$data[1],
							'meta_input'	=>
								array('display_name'	=> $data[3],
									),
									
							'tax_input'	=>
								array(								
								'bs_faq_tag'	=> $data[5],
									),
									
							'post_type'		=>'bs_faq',
							'post_status'	=> 'publish'							

						 );
						//global $wpdb;
						$insert_result = wp_insert_post( $ins_data );
						}
				}
				}
		}
		// Redirect the page to the user submission form
		wp_redirect( add_query_arg( 'post_type', 'bs_faq',
		admin_url( 'edit.php' ) ) );
		exit;
}
}
new Bs_faq_import_data();
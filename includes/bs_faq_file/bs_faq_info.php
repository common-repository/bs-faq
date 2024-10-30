<?php

/**
* 	Info Sub Button
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_info_button
{
	
	public function __construct()
	{
		add_action('admin_menu', array($this,'bs_faq_plugin_info'));
		
	}

function bs_faq_plugin_info() {
	add_submenu_page('edit.php?post_type=bs_faq', 
	__('BS FAQ Info','bs_faq_plugin'), 
	__('Info','bs_faq_plugin'),
	'manage_options',
	'bsfaqinfo',
	array($this,'bs_faq_info_page'));
}


function bs_faq_info_page(){
?>
<h1> BS FAQs Plugins Info </h1>
<hr>
<h2> Reminder </h2>
<p> To display FAQs, place the <b> [bs-faqs-list] </b> shortcode on a page or post </p>
<p> To display FAQs for a specific category, place the <b> [bs-faqs category='Enter Your Category Here'] </b> shortcode on a page (<i>Place Your Category Name into Single Quotes</i>) </p> 
<hr>
<h4> <i> Those Shortcode buttons are visible in the Visual Editor and Text editor </i> </h4>
<h5><i> (If you not found shortcode buttons then check the settings menu and enable 'Show Editor Helper' )</i></h5>
<hr><hr> <hr>


<h3> You Can Use BS FAQ as a widget </h3>


<?php }
}

new Bs_faq_info_button();
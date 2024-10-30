<?php


/**
* 	Settings Options
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faq_settings
{
	
	public function __construct()
	{
		
		add_action('admin_init', array($this,'faq_settings_option'));		
		add_action('admin_menu', array($this,'bs_faq_plugin_settings'));
		
	}


function faq_settings_option(){
	

// general option section

		add_settings_section('general_section','General Option', array($this,'general_section_callback'),'bsfaqsettings');

		add_settings_field('show_editor_helper','Show Editor Helper', array($this,'show_editor_helper_func'),'bsfaqsettings','general_section');
		register_setting('general_section','bs_faq_register_setting');
		
		//add_settings_field('turn_on_comment','Turn On Comment', array($this,'turn_on_comment_func'),'bsfaqsettings','general_section');
		//register_setting('general_section','bs_faq_register_setting');


// Display Section

		add_settings_section('display_section','Display Section', array($this,'display_section_callback'),'bsfaqsettings');

		add_settings_field('hide_category','Hide Category', array($this,'hide_category_func'),'bsfaqsettings','display_section');
		register_setting('display_section','bs_faq_register_setting');


		add_settings_field('hide_tags','Hide Tags', array($this,'hide_tags_func'),'bsfaqsettings','display_section');
		register_setting('display_section','bs_faq_register_setting');
		
		add_settings_field('hide_date','Hide Post Date', array($this,'hide_date_func'),'bsfaqsettings','display_section');
		register_setting('display_section','bs_faq_register_setting');
		
		add_settings_field('hide_name','Hide Name', array($this,'hide_name_func'),'bsfaqsettings','display_section');
		register_setting('display_section','bs_faq_register_setting');




// styling section

		add_settings_section('style_section','Style Section', array($this,'style_section_callback'),'bsfaqsettings');

		add_settings_field('question_title_color','Question Title Color', array($this,'question_title_color_func'),'bsfaqsettings','style_section');
		register_setting('style_section','bs_faq_register_setting');

		add_settings_field('question_title_back_color','Question Title Background Color', array($this,'question_title_back_color_func'),'bsfaqsettings','style_section');
		register_setting('style_section','bs_faq_register_setting');

		add_settings_field('question_ans_color','Question Answer Color', array($this,'question_ans_color_func'),'bsfaqsettings','style_section');
		register_setting('style_section','bs_faq_register_setting');

		add_settings_field('question_ans_back_color','Question Answer Background Color', array($this,'question_ans_back_color_func'),'bsfaqsettings','style_section');
		register_setting('style_section','bs_faq_register_setting');
		
		
	
	// Functionality section

		add_settings_section('functionality_section','Functionality Section', array($this,'functionality_section_callback'),'bsfaqsettings');

		
		add_settings_field('accordion_style','FAQ Accordion', array($this,'accordion_style_func'),'bsfaqsettings','functionality_section');
		register_setting('functionality_section','bs_faq_register_setting');

		
		add_settings_field('faq_toggle','FAQ Toggle', array($this,'faq_toggle_func'),'bsfaqsettings','functionality_section');
		register_setting('functionality_section','bs_faq_register_setting');

		add_settings_field('numberOf_faq','Number Of FAQs', array($this,'numberOf_faq_func'),'bsfaqsettings','functionality_section');
		register_setting('functionality_section','bs_faq_register_setting');


	}
	


// Display Sections Function Start

function display_section_callback(){
	echo "Your can change your display option from here". "<hr>";
}

function hide_category_func(){

		$hideCategory = (array)get_option('bs_faq_register_setting');
		$hideCategoryValue = $hideCategory['hide_category'];
		
		echo '<input type="checkbox" name="bs_faq_register_setting[hide_category]" value="1".'.checked(1,$hideCategoryValue,false).'';

	}

function hide_tags_func(){

		$hideTags = (array)get_option('bs_faq_register_setting');
		$hideTagsValue = $hideTags['hide_tags'];
		
		echo '<input type="checkbox" name="bs_faq_register_setting[hide_tags]" value="1".'.checked(1,$hideTagsValue,false).'';

	}
	
function hide_date_func(){

		$hideDate = (array)get_option('bs_faq_register_setting');
		$hideDateValue = $hideDate['hide_date'];
		
		echo '<input type="checkbox" name="bs_faq_register_setting[hide_date]" value="1".'.checked(1,$hideDateValue,false).'';

	}
	
function hide_name_func(){

		$hideName = (array)get_option('bs_faq_register_setting');
		$hideNameValue = $hideName['hide_name'];
		
		echo '<input type="checkbox" name="bs_faq_register_setting[hide_name]" value="1".'.checked(1,$hideNameValue,false).'';

	}


// Display Sections Function End


// General Options Function Start

function general_section_callback(){
	echo "Your can change your general option settings from here". "<hr>";
}

function show_editor_helper_func(){

		$showEditorHelper = (array)get_option('bs_faq_register_setting');
		$showEditorHelperValue = $showEditorHelper['show_editor_helper'];
		
		echo '<input type="checkbox" name="bs_faq_register_setting[show_editor_helper]" value="1".'.checked(1,$showEditorHelperValue,false).'';
		//echo '<br> <br>'.'<i>'.'Editor Helper Button Only Visible in Text Editor'.'</i>';
		
	}
	
function turn_on_comment_func(){

		$turnOnComment = (array)get_option('bs_faq_register_setting');
		$turnOnCommentValue = $turnOnComment['turn_on_comment'];

		echo '<input type="checkbox" name="bs_faq_register_setting[turn_on_comment]" value="1".'.checked(1,$turnOnCommentValue,false).'';
	}


// Display Sections Function End


//Style Sections Function Start

function style_section_callback(){
	echo "You Can change the Style from this section";
}

function question_title_color_func(){

		$questionTitleColor = (array)get_option('bs_faq_register_setting');
		$questionTitleColorValue = $questionTitleColor['question_title_color'];

		echo '<input type="color" name="bs_faq_register_setting[question_title_color]" value="'.$questionTitleColorValue.'">';

		echo $questionTitleColorValue;
	}

function question_title_back_color_func(){

		$questionTitleBackColor = (array)get_option('bs_faq_register_setting');
		$questionTitleColorBackValue = $questionTitleBackColor['question_title_back_color'];

		echo '<input type="color" name="bs_faq_register_setting[question_title_back_color]" value="'.$questionTitleColorBackValue.'">';

		echo $questionTitleColorBackValue;
	}

function question_ans_color_func(){

		$questionAnsColor = (array)get_option('bs_faq_register_setting');
		$questionAnsColorValue = $questionAnsColor['question_ans_color'];

		echo '<input type="color" name="bs_faq_register_setting[question_ans_color]" value="'.$questionAnsColorValue.'">';

		echo $questionAnsColorValue;
	}

function question_ans_back_color_func(){

		$questionAnsBackColor = (array)get_option('bs_faq_register_setting');
		$questionAnsBackColorValue = $questionAnsBackColor['question_ans_back_color'];

		echo '<input type="color" name="bs_faq_register_setting[question_ans_back_color]" value="'.$questionAnsBackColorValue.'">';

		echo $questionAnsBackColorValue;
	}
	
function accordion_style_func(){

		$accordionStyle = (array)get_option('bs_faq_register_setting');
		$accordionStyleValue = $accordionStyle ['accordion_style'];

		echo '<input type="checkbox" name="bs_faq_register_setting[accordion_style]" value="1".'.checked(1,$accordionStyleValue ,false).'';
		 
		 echo '<br><br>'.'<i>'.'(Only one FAQ is open at a time, requires FAQ Toggle)'.'</i>';
	}


// Style Sections Function End

// functionality_section start




//functionality section end

function functionality_section_callback(){
	echo "Your can change FAQ functionality from here" . "<hr>";
}



function faq_toggle_func(){
		$faqToggle = (array)get_option('bs_faq_register_setting');
		$faqToggleValue = $faqToggle ['faq_toggle'];

		echo '<input type="checkbox" name="bs_faq_register_setting[faq_toggle]" value="1".'.checked(1,$faqToggleValue ,false).'>';
		echo '<br>'.'<i>'.'Should the FAQs hide/open when they are clicked ?'.'</i>';
		
	}
	
function numberOf_faq_func(){
		$numberOfFaq = (array)get_option('bs_faq_register_setting');
		$numberOfFaqValue = $numberOfFaq ['numberOf_faq'];

		echo '<input type="number" name="bs_faq_register_setting[numberOf_faq]" value="'.$numberOfFaqValue.'">';
		echo '<br>'.'<i>'.'How Many FAQs Shows at a Time ?'.'</i>';
		
	}




/* Settings Menu add from here */

function bs_faq_plugin_settings() {
	add_submenu_page('edit.php?post_type=bs_faq', 
	__('BS FAQ Settings','bs_faq_plugin'), 
	__('Settings','bs_faq_plugin'),
	'manage_options',
	'bsfaqsettings',
	array($this,'bs_faq_settings_page'));
}



function bs_faq_settings_page(){
?> 
<h1> BS FAQ Settings </h1> <hr><hr>

<?php settings_errors(); ?>
	<form action="options.php" method="POST">
			<?php
			do_settings_sections('bsfaqsettings');			
			settings_fields('general_section');
			settings_fields('display_section');	
			settings_fields('style_section');
			settings_fields('functionality_section');
			submit_button();
			?>
	</form>
		

<?php }


}

new Bs_faq_settings();
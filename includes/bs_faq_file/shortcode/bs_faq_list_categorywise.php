<?php 
/**
* 	Add Shortcode categorywise
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bs_faqs_shortcode_categorywise
{
	
	public function __construct()
	{
		add_shortcode( 'bs-faqs', array($this,'bs_faq_list_cateogrywise'),1);	

		$showEditorHelper = (array)get_option('bs_faq_register_setting');
		$showEditorHelperValue = $showEditorHelper['show_editor_helper'];
		if($showEditorHelperValue):
		add_action('admin_print_footer_scripts', array($this,'bs_faq_shortcode_button_script_cw'));
		endif;	
	}
	
	function bs_faq_list_cateogrywise($atts) { 
	
	include 'bs_faq_settings_value.php';
	
		
	if ($faqToggleValue) { ?>
	
	<div>	
	<?php 
	extract( shortcode_atts( array('category' => 'bsfaq'), $atts ) );

	if ( !empty( $category ) ) {					
				
								
					$args = array(
							'tax_query' => array(
								array(
									'taxonomy' => 'bs_faq_type',
									'field' => 'name',
									'terms' => $category,
								)
							)
						);
						

	
	
	
	$query_params = array( 
	'post_type' => 'bs_faq',
	'post_status' => 'publish',
	'posts_per_page' => $numberOfFaqValue,
	'tax_query' => $args);

	$page_num = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );

	if ( $page_num != 1 ) 
		{
			$query_params['paged'] = $page_num;
	} 
	$faq_query = new WP_Query;
	$faq_query->query( $query_params );		?>			  
	
	<?php while($faq_query->have_posts()) : $faq_query->the_post(); ?>
	
	
	
	 <?php $id = get_the_ID(); ?>
	 
					 
				 <?php
				 // category
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
						
					 // Display Name	
					$display_name = esc_html( get_post_meta( get_the_ID(),'display_name',true ) );
					
					
					 // Tags
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
						
					?>
				 
				 
				 
    <div class="tab">
      <input id="<?php echo $id ?>" type="<?php if(!$accordionStyleValue){echo "checkbox";} else {echo "radio";} ?>" name="tabs">
      <label for="<?php echo $id ?>" style="border-radius: 5px; background-color: <?php echo $questionTitleColorBackValue; ?> ; color: <?php echo $questionTitleColorValue; ?>"><?php the_title(); ?></label>
      <div class="tab-content" style="border-radius: 5px; margin-bottom: 5px; color: <?php echo $questionAnsColorValue; ?>; background-color: <?php echo $questionAnsBackColorValue;  ?>">
       
		<div style="padding-left: 4px; padding-right: 4px; ">
			<?php if(!$hideNameValue): ?> <small style="padding: 2px;"> Posted By: <i><?php echo $display_name; ?></i> |</small><?php endif; ?>
			<?php if(!$hideDateValue): ?> <small style="padding: 2px;"> Date: <i><?php the_time('d F Y'); ?></i> |</small><?php endif; ?>
			<?php if(!$hideCategoryValue): ?> <small style="padding: 2px;"> Category: <i><?php echo $category; ?></i> |</small> <?php endif; ?>
			<?php if(!$hideTagsValue): ?> <small style="padding: 2px;"> Tags: <i><?php echo $tags; ?></i> </small> <?php endif; ?>
			<?php if($turnOnCommentValue): ?><small> <?php comments_template(); ?> </small><?php endif; ?>
		</div>
		
		 <p ><?php the_content(); ?>
		 
		 </p>		
      </div>	  
    </div>	
	
	<?php endwhile; ?>
	
	<?php 
if ( $faq_query->max_num_pages > 1 ) 
			{
			
			?> 
				<div class="nav-previous">				
				<?php $output = get_next_posts_link ('<span>&larr;</span>'.' Older FAQs', $faq_query->max_num_pages ); ?>				
				</div>
				
				<div class="nav-next">				
				<?php $output .= '<span style="margin-left: 20px;">' . get_previous_posts_link('Newer FAQs '.'<span>&rarr;</span>', $faq_query->max_num_pages ); ?>
				</div> 				
				<?php
			}
	?>	
	
  </div>
	<?php }
wp_reset_postdata();
return $output; ?>

<?php } 


// not toggle value part start



if (!$faqToggleValue) { ?>
	
	<div>	
	<?php 
	extract( shortcode_atts( array('category' => 'bsfaq'), $atts ) );

	if ( !empty( $category ) ) {					
				
								
					$args = array(
							'tax_query' => array(
								array(
									'taxonomy' => 'bs_faq_type',
									'field' => 'name',
									'terms' => $category,
								)
							)
						);
						

	
	
	
	$query_params = array( 
	'post_type' => 'bs_faq',
	'post_status' => 'publish',
	'posts_per_page' => $numberOfFaqValue,
	'tax_query' => $args);

	$page_num = ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 );

	if ( $page_num != 1 ) 
		{
			$query_params['paged'] = $page_num;
	} 
	$faq_query = new WP_Query;
	$faq_query->query( $query_params );		?>			  
	
	<?php while($faq_query->have_posts()) : $faq_query->the_post(); ?>
	
	
	
	 <?php $id = get_the_ID(); ?>
	 
					 
				 <?php
				 // category
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
						
					 // Display Name	
					$display_name = esc_html( get_post_meta( get_the_ID(),'display_name',true ) );
					
					
					 // Tags
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
						
					?>
				 
				 
				 
    <div class="tab">
      <input id="" type="<?php if(!$accordionStyleValue){echo "checkbox";} else {echo "radio";} ?>" name="tabs">
      <a href="<?php the_permalink(); ?>"><span id="qTitle" style="border-radius: 5px; background-color: <?php echo $questionTitleColorBackValue; ?> ; color: <?php echo $questionTitleColorValue; ?>"><?php the_title(); ?></span></a>
      <div class="tab-content" style="border-radius: 5px; margin-bottom: 5px; color: <?php echo $questionAnsColorValue; ?>; background-color: <?php echo $questionAnsBackColorValue;  ?>"></div>	  
    </div>	
	
	<?php endwhile; ?>
	
	<?php 
if ( $faq_query->max_num_pages > 1 ) 
			{
			
			?> 
				<div class="nav-previous">				
				<?php $output = get_next_posts_link ('<span>&larr;</span>'.' Older FAQs', $faq_query->max_num_pages ); ?>				
				</div>
				
				<div class="nav-next">				
				<?php $output .= '<span style="margin-left: 20px;">' . get_previous_posts_link('Newer FAQs '.'<span>&rarr;</span>', $faq_query->max_num_pages ); ?>
				</div> 				
				<?php
			}
	?>	
	
  </div>
	<?php }
wp_reset_postdata();
return $output; ?>

<?php } 



}

function bs_faq_shortcode_button_script_cw() 
{
    if(wp_script_is("quicktags"))
    {
        ?>
            <script type="text/javascript">
                
                

                QTags.addButton( 
                    "code_shortcodee", 
                    "BS FAQ Category Wise", 
                    callback
                );

                function callback()
                {
                    
                    QTags.insertContent("[bs-faqs category='Enter Your Category Here']");
                }
            </script>
        <?php
    }
}


}
new Bs_faqs_shortcode_categorywise();
?>
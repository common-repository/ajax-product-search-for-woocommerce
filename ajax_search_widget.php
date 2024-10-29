<?php

class Phoeniixx_ajax_pro_search_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'Phoeniixx_ajax_pro_search_Widget',
            __( 'Phoeniixx Ajax Product Search' ),
            array(
                'classname'   => 'Phoeniixx_ajax_pro_search_Widget',
                'description' => __( 'Phoeniixx Ajax Product Search.' )
                )
        );
       
        //load_plugin_textdomain( 'tutsplustextdomain', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
         
        extract( $args );
		
		$title = (isset($instance['title']))?$instance['title']:'';
         
        $title      = apply_filters( 'widget_title', $title);
        //$message    = $instance['message'];
         
		//print_r($args);
		
        echo $before_widget;
         
        if ( $title ) {
            echo $before_title . $title . $after_title;
        }
                             
        //echo $message;
		
		?>
			<div class="ajaxsearchform-container">
			
				<form role="search" method="get" id="ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
				
					<div>
					
						<label class="reader-text" for="pro_search_input"><?php echo get_option('phoe_s_search_inp_label') ?></label>

						<input type="search"
							   value="<?php echo get_search_query() ?>"
							   name="s"
							   id="pro_search_input"
							   class="pro_search_input"
							   placeholder="<?php echo get_option('phoe_s_search_field_placeholder') ?>"
							   data-min-chars="<?php echo get_option('phoe_s_min_num_of_char'); ?>" autocomplete="off" />

						<input type="submit" id="searchsubmit" value="<?php echo get_option('phoe_s_search_sub_label') ?>" />
						
						<input type="hidden" name="post_type" value="product" />
						
					</div>
					
				</form>
				
				<div class="ajax_search_results" style="display:none">
				
				</div>
				
			</div>
			
		<?php
	
        echo $after_widget;
         
    }
 
  
    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        //$instance['message'] = strip_tags( $new_instance['message'] );
         
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) {    
     
		$title = isset($instance['title'])?esc_attr($instance['title']):'';
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php
	}
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'Phoeniixx_ajax_pro_search_Widget' );
});
?>
<?php
// =============================== Pictorial Recent Posts widget ======================================
class Pictorial_RecentPostWidgetAlt extends WP_Widget {
    /** constructor */

	function Pictorial_RecentPostWidgetAlt() {
		$widget_ops = array(
		  'classname' => 'widget_pictorial_recent_posts_alt', 
		  'description' => __('Pictorial - Alternative Recent Posts (Circle Thumbs - large). To be used in conjunction with the Showcase Sidebar to build a custom post layout on the home/index page.','pictorial') );
		$this->WP_Widget(
		  'pictorial-recent-posts-alt', __('Pictorial - Alternative Recent Posts','pictorial'), $widget_ops);
	}


  /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('Pictorial Alternative Recent Posts','pictorial') : $instance['title']);
		$category = apply_filters('widget_category', $instance['category']);
		$showpost = apply_filters('widget_showpost', $instance['showpost']);
		$disabletitle = apply_filters('widget_disabletitle', isset($instance['disabletitle']));
		$disabledate = apply_filters('widget_disabledate', isset($instance['disabledate']));
		$disableexcerpt = apply_filters('widget_disabledate', isset($instance['disableexcerpt']));
		$squarethumbs = apply_filters('widget_squarethumbs', isset($instance['squarethumbs']));
		$disablethumb = apply_filters('widget_disablethumb', isset($instance['disablethumb']));
		$disablereadmore = apply_filters('widget_disablereadmore', isset($instance['disablereadmore']));
		$instance['category'] = esc_attr(isset($instance['category'])? $instance['category'] : "");
		global $wp_query;
        ?>
              <?php echo $before_widget; ?>
                  <?php if($disabletitle!="true") {?>
				  <div class="center-float">
				  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?></div>
                  <?php } ?>      
								<?php  if (have_posts()) : ?>
                                
                                <ul class="pictorial-recent-post-widget-alt">
									<?php $querycat = get_cat_name($category);?>
                                    <?php 
                                        if($showpost==""){$showpost=1;}
										$temp = $wp_query;
										$wp_query= null;
										$wp_query = new WP_Query();
										$wp_query->query("showposts=".$showpost."&category_name=" . $querycat);
										global $post;
                                    ?>
                                    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                                    <li>
																				
										<?php if($disablethumb!="true") {?>
                                        <a href="<?php the_permalink(); ?>">
										<?php
                                        $custom = get_post_custom($post->ID);
                                        $cf_thumb = (isset($custom["pictorial_thumb"][0]))? $custom["pictorial_thumb"][0] : "";
                                        
										if($squarethumbs!="true") {
                                        if($cf_thumb!=""){
                                            $thumb = '<img src='. $cf_thumb .' alt="" width="200" height="90" class="img-circle"/>';
                                        }elseif(has_post_thumbnail($post->ID) ){
                                            $thumb = get_the_post_thumbnail($post->ID, 'thumb-widget', array('class' => 'img-circle'));
                                        }else{
                                            $thumb ="";
                                        }
										} else { 
										
										if($cf_thumb!=""){
                                            $thumb = '<img src='. $cf_thumb .' alt="" width="200" height="90" class=""/>';
                                        }elseif(has_post_thumbnail($post->ID) ){
                                            $thumb = get_the_post_thumbnail($post->ID, 'thumb-widget', array('class' => ''));
                                        }else{
                                            $thumb ="";
                                        }
										} 
										
                                        echo  $thumb;
                                        ?>
										</a>
										<?php } ?>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h3>
                                        <?php if($disabledate!="true") {?>
                                        <span class="smalldate"><?php  the_time('M d, Y') ?></span>
										<?php } ?>
										<?php if($disableexcerpt!="true") {?>
										<p><?php echo pictorial_showcase_excerpt(); ?></p>
										<?php } ?>
										<?php if($disablereadmore!="true") {?>
										<p class="showcase-read-more button"><a href="<?php the_permalink(); ?>">Read More >></a></p>
										<?php } ?>
										<span class="clear"></span>
                                    </li>
                                    <?php endwhile; ?>
                                </ul>
                                
                                <?php $wp_query = null; $wp_query = $temp; wp_reset_postdata();?>
                                
								<?php endif; ?>

								
								
              <?php echo $after_widget; ?>
			 
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
		$instance['title'] = (isset($instance['title']))? $instance['title'] : "";
		$instance['category'] = (isset($instance['category']))? $instance['category'] : "";
		$instance['showpost'] = (isset($instance['showpost']))? $instance['showpost'] : "";
		$instance['disabletitle'] = (isset($instance['disabletitle']))? $instance['disabletitle'] : "";
		$instance['disabledate'] = (isset($instance['disabledate']))? $instance['disabledate'] : "";
		$instance['disableexcerpt'] = (isset($instance['disableexcerpt']))? $instance['disableexcerpt'] : "";
		$instance['squarethumbs'] = (isset($instance['squarethumbs']))? $instance['squarethumbs'] : "";
		$instance['disablethumb'] = (isset($instance['disablethumb']))? $instance['disablethumb'] : "";
		$instance['disablereadmore'] = (isset($instance['disablereadmore']))? $instance['disablereadmore'] : "";
					
        $title = esc_attr($instance['title']);
		$category = esc_attr($instance['category']);
		$showpost = esc_attr($instance['showpost']);
		$disabletitle = esc_attr($instance['disabletitle']);
		$disabledate = esc_attr($instance['disabledate']);
		$disableexcerpt = esc_attr($instance['disableexcerpt']);
		$squarethumbs = esc_attr($instance['squarethumbs']);
		$disablethumb = esc_attr($instance['disablethumb']);
		$disablereadmore = esc_attr($instance['disablereadmore']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'pictorial'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
            <p><label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Select A Category:', 'pictorial'); ?><br />
			<?php 
			$args = array(
			'selected'         => $category,
			'echo'             => 1,
			'name'             =>$this->get_field_name('category')
			);
			wp_dropdown_categories( $args );
			?>
			</label></p>
			
            <p><label for="<?php echo $this->get_field_id('showpost'); ?>"><?php _e('Number of Post to show:', 'pictorial'); ?> <input class="widefat" id="<?php echo $this->get_field_id('showpost'); ?>" name="<?php echo $this->get_field_name('showpost'); ?>" type="text" value="<?php echo $showpost; ?>" /></label></p>
            
			<p><label for="<?php echo $this->get_field_id('disabletitle'); ?>"><?php _e('Hide Widegt Title:', 'pictorial'); ?> 
			
			<?php if($instance['disabletitle']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disabletitle'); ?>" id="<?php echo $this->get_field_id('disabletitle'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
            
			<p><label for="<?php echo $this->get_field_id('squarethumbs'); ?>"><?php _e('Square Thumbnails?:', 'pictorial'); ?> 
			
			<?php if($instance['squarethumbs']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('squarethumbs'); ?>" id="<?php echo $this->get_field_id('squarethumbs'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
            
            
            <p><label for="<?php echo $this->get_field_id('disablethumb'); ?>"><?php _e('Hide Thumbnails:', 'pictorial'); ?> 
			
			<?php if($instance['disablethumb']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disablethumb'); ?>" id="<?php echo $this->get_field_id('disablethumb'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
                            
            <p><label for="<?php echo $this->get_field_id('disabledate'); ?>"><?php _e('Hide Post Date:', 'pictorial'); ?> 
			
			<?php if($instance['disabledate']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disabledate'); ?>" id="<?php echo $this->get_field_id('disabledate'); ?>" value="true" <?php echo $checked; ?> />			</label></p>              
            
			<p><label for="<?php echo $this->get_field_id('disableexcerpt'); ?>"><?php _e('Hide the Excerpt:', 'pictorial'); ?>
			
			<?php if($instance['disableexcerpt']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disableexcerpt'); ?>" id="<?php echo $this->get_field_id('disableexcerpt'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
		
		    <p><label for="<?php echo $this->get_field_id('disablereadmore'); ?>"><?php _e('Hide Readmore Button :', 'pictorial'); ?>
			
			<?php if($instance['disablereadmore']){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                            <input type="checkbox" name="<?php echo $this->get_field_name('disablereadmore'); ?>" id="<?php echo $this->get_field_id('disablereadmore'); ?>" value="true" <?php echo $checked; ?> />			</label></p>
		
		<?php 
    }

} // class  Widget
?>
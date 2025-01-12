<?php
/**
 * Custom Widget for displaying specific post formats
 *
 * Displays posts from Aside, Quote, Video, Audio, Image, Gallery, and Link formats.
 *
 * @link http://codex.wordpress.org/Widgets_API#Developing_Widgets
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

class VCP_Recent_Widget extends WP_Widget {

	

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'vcp_recent_widget', // Base ID
			__('VCP Recent Post', 'text_domain'), // Name
			array( 'description' => __( 'Muestra las últimas entradas y su thumbnail asociado', 'text_domain' ), ) // Args
		);
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
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		

		function get_excerpt_by_id($post_id){
			$the_post = get_post($post_id); //Gets post ID
			$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
			$excerpt_length = 20; //Sets excerpt length by word count
			$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
			$words = explode(' ', $the_excerpt, $excerpt_length + 1);
			if(count($words) > $excerpt_length) :
			array_pop($words);
			array_push($words, '…');
			$the_excerpt = implode(' ', $words);
			endif;
			$the_excerpt = '<p style="line-height:1em">' . $the_excerpt . '</p>';
			return $the_excerpt;
		}
		

		$recent_posts = wp_get_recent_posts(array('numberposts' => '3', 'post_status' => 'publish'));
		foreach( $recent_posts as $recent ){
		
			?>
			<div class="last-articles d-flex">
				<div class="flex-shrink-0">
				<a class="pull-left" href="<?php echo get_permalink($recent["ID"]) ?>">
					<div class="img-thumbnail rounded float-start">
						<?php echo get_the_post_thumbnail($recent["ID"], array(75, 75)); ?>
					</div>
				</a>
				</div>
				<div class="flex-grow-1 ms-3">
					<h4 class="media-heading">
						<?php echo '<a href="' . get_permalink($recent["ID"]) . '" title="' . esc_attr($recent["post_title"]) . '" >' . $recent["post_title"] . '</a>' ?>
					</h4>

					<?php echo get_excerpt_by_id($recent["ID"]); ?>
				</div>
			</div>

			


			<?php


		}


		echo $args['after_widget'];
	}



	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
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
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}


	

	

} // class Foo_Widget
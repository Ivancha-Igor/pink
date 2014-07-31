<?php


function theme_name_scripts() {
	wp_enqueue_style( 'pink', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );



register_nav_menus(array(
  'header_menu' => 'Header Menu'
  ));
  

add_theme_support( 'post-thumbnails' ); 
  
function pink_widgets_init() {

	// Area 1, located at the content.
	register_sidebar( array(
	'name' =>__('Content Widget Area', 'pink'),
	'description' => __( 'The content widget area', 'pink' ),
	'before_title' => '<h3>',
    	'after_title'  => '</h3>',

	) );	
	
	// Area 2, located at the footer.
	register_sidebar( array(
	'name' =>__('Footer Widget Area', 'pink'),
	'description' => __( 'The footer widget area', 'pink' ),
	'before_title' => '<h5>',
    	'after_title'  => '</h5>',
	) );	
}


add_action( 'widgets_init', 'pink_widgets_init'  );



class Services_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'services_widget', // Base ID
			__('Services Widget', 'pink'), // Name
			array( 'description' => __( 'All Services', 'pink' ), ) // Args
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
		
		
		
		
		// The Loop
		$args_loop = array( 'post_type' => 'services', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args_loop ); ?>
		<ul class="services">
		<?php
		while ( $loop->have_posts() ) : $loop->the_post();
		?>
			<li><a href="#"><?php the_post_thumbnail(); ?><span><?php the_title(); ?></span></a></li>
			
  			
  		<?php
		endwhile; ?>
		</ul>
		<?php
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
			$title = __( 'New title', 'pink' );
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

// Register and load the widget
function services_load_widget() {
    register_widget( 'Services_Widget' );
}
add_action( 'widgets_init', 'services_load_widget' );




function create_post_type() { // создаем новый тип записи
	register_post_type( 'services', // указываем названия типа
	array( 
	'labels' => array( 
	'name' => __( 'Services' ), // даем названия разделу для панели управления
	'singular_name' => __( 'Service' ), // даем названия одной записи
	'menu_name' => ('Services')
	), 
	'public' => true, 
	'menu_position' => 5, // указываем место в левой баковой панели
	'rewrite' => array('slug' => 'services'), // указываем slug для ссылок например: mysite/reviews/
	'supports' => array('title', 'editor', 'thumbnail', 'revisions'), // тут мы активируем поддержку миниатюр
	'has_archive' => true 
	) ); 
} 

add_action( 'init', 'create_post_type' ); // инициируем добавления типа



function pink_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
	$wp_customize->add_setting( 'background_image' , array(
	'transport'   => 'refresh',
	) );
	$wp_customize->add_section( 'pink_background' , array(
    	'title'      => __( 'Background', 'pink' ),
    	'priority'   => 30,
   	) );
   	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'background', array(
	'label'        => __( 'Background', 'pink' ),
	'section'    => 'pink_background',
	'settings'   => 'background_image',
   	) ) );
   	
   	$wp_customize->add_setting( 'facebook' , array(
	'transport'   => 'refresh',
	) );
	$wp_customize->add_section( 'pink_social' , array(
    	'title'      => __( 'Social', 'pink' ),
    	'priority'   => 50,
   	) );
   	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
	'label'        => __( 'Facebook', 'pink' ),
	'section'    => 'pink_social',
	'settings'   => 'facebook',
   	) ) );
   	
   	$wp_customize->add_setting( 'twitter' , array(
	'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
	'label'        => __( 'Twitter', 'pink' ),
	'section'    => 'pink_social',
	'settings'   => 'twitter',
   	) ) );
   	
   	$wp_customize->add_setting( 'skype' , array(
	'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skype', array(
	'label'        => __( 'Skype', 'pink' ),
	'section'    => 'pink_social',
	'settings'   => 'skype',
   	) ) );
   	
   	$wp_customize->add_setting( 'google' , array(
	'transport'   => 'refresh',
	) );
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google', array(
	'label'        => __( 'Google', 'pink' ),
	'section'    => 'pink_social',
	'settings'   => 'google',
   	) ) );
}


add_action( 'customize_register', 'pink_customize_register' );

function pink_customize_css() {
    	?>
	  <style type="text/css">
             body { background:url(<?php echo get_theme_mod('background_image'); ?>)no-repeat; background-size: 100%; }
         </style>
    	<?php	
}

add_action( 'wp_head', 'pink_customize_css');
?>

<?php
// Creating the widget
class last_video_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'last_video_widget',

            // Widget name will appear in UI
            __('Last video Widget', 'itstar'),

            // Widget description
            array( 'description' => __( 'Display Last Products', 'itstar' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = $instance['number'];
        $term = get_term($instance['cat'],'video_cat');

        //var_dump($instance);
        $videos = get_posts(array(
                'post_type' => 'video',
                'posts_per_page' => $number,
                'video_cat'         => $term->slug,
            )
        );
//        var_dump($term);
        $category_link = get_category_link( $term->term_id );

        $content = '<ul class="widget-list">';
        foreach($videos as $video) : setup_postdata( $video );
//          $url = get_the_permalink($video->ID);
            $url = get_post_meta($video->ID,'_itstar_video_link')[0];
            $thumb = get_the_post_thumbnail($video->ID,'video-thumb');
            $name = $video->post_title;
            $content .='<li><a href="'.$url.'"><div>'.$thumb.'</div><div><span>'.$name.'</span></div></a></li>';
        endforeach;
        $content .= '</ul>';
        $content .='<a class="more-video" href="'.$category_link.'">';
        $content .= __("more videos","itstar").'<i class="fa fa-angle-double-left" aria-hidden="true"></i></a>';






        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        echo $content;
        // This is where you run the code and display the output
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Video', 'itstar' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = 5;
        }
        if ( isset( $instance[ 'cat' ] ) ) {
            $cat = $instance[ 'cat' ];
        }else {
            $cat ="";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'video Numbers :','itstar' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'video Category :','itstar' ); ?></label>
            <?php wp_dropdown_categories(array(
                'name'               => $this->get_field_name( 'cat' ),
                'id'                 => $this->get_field_id( 'cat' ),
                'class'              => 'widefat',
                'taxonomy'           => 'video_cat',
                'echo'               => '1',
                'selected'          =>esc_attr( $cat ),
            )); ?>


        </p>

        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
        //var_dump($instance);
        return $instance;
    }
} // Class wpb_widget ends here

class last_posts_by_cat_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'last_posts_by_cat_widget',

            // Widget name will appear in UI
            __('Last Posts By Category Widget', 'itstar'),

            // Widget description
            array( 'description' => __( 'Display Last Posts in Category', 'itstar' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $number = $instance['number'];
        $cat = get_category($instance['cat']);


        $posts = get_posts(array(
                'post_type' => 'post',
                'posts_per_page' => $number,
                'category'         => $cat->term_id,
            )
        );


        $content = '<ul class="widget-list">';
        foreach($posts as $post) : setup_postdata( $post );
            $url = get_the_permalink($post->ID);
            $thumb = get_the_post_thumbnail($post->ID,'product-thumb');
            $name = $post->post_title;
            $content .='<li><a href="'.$url.'">'.$thumb.'<span>'.$name.'</span></a><li>';
        endforeach;
        $content .= '</ul>';





        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        echo $content;
        // This is where you run the code and display the output
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = __( 'Last Posts', 'itstar' );
        }
        if ( isset( $instance[ 'number' ] ) ) {
            $number = $instance[ 'number' ];
        }else {
            $number = 5;
        }
        if ( isset( $instance[ 'cat' ] ) ) {
            $cat = $instance[ 'cat' ];
        }else {
            $cat = "";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Post Numbers :','itstar' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Post Category :','itstar' ); ?></label>
            <?php wp_dropdown_categories(array(
                'name'               => $this->get_field_name( 'cat' ),
                'id'                 => $this->get_field_id( 'cat' ),
                'class'              => 'widefat',
                'taxonomy'           => 'category',
                'echo'               => '1',
                'selected'           => esc_attr($cat ),
            )); ?>
        </p>
        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['number'] = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
        $instance['cat'] = ( ! empty( $new_instance['cat'] ) ) ? strip_tags( $new_instance['cat'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
class simple_button_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
            'simple_button_widget',

            // Widget name will appear in UI
            __('Simple Button Widget', 'itstar'),

            // Widget description
            array( 'description' => __( 'make simple button', 'itstar' ), )
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        global $wp_query;

        $title = apply_filters( 'widget_title', $instance['title'] );
        $text = $instance['text'];
        $link = $instance['link'];

        $content = '<a class="advance-search-button" href='.$link.'>'.$text.'</a>';

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
        echo $content;
        // This is where you run the code and display the output
        echo $args['after_widget'];
    }

    // Widget Backend
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }else {
            $title = '';
        }
        if ( isset( $instance[ 'text' ] ) ) {
            $text = $instance[ 'text' ];
        }else {
            $text = __("Advance Search Button","itstar");
        }
        if ( isset( $instance[ 'link' ] ) ) {
            $link = $instance[ 'link' ];
        }else {
            $link = "";
        }
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'text' ); ?>"><?php _e( 'Button Title :','itstar' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo esc_attr( $text ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'link' ); ?>"><?php _e( 'Button Link :','itstar' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'link' ); ?>" name="<?php echo $this->get_field_name( 'link' ); ?>" type="text" value="<?php echo esc_attr( $number ); ?>" />
        </p>

        <?php
    }

    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( ! empty( $new_instance['text'] ) ) ? strip_tags( $new_instance['text'] ) : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
        return $instance;
    }
} // Class wpb_widget ends here
?>
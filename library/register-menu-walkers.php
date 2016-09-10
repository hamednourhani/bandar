<?php

//-----------Menu Walker------------------------

class Itstar_walker_nav_menu extends Walker_Nav_Menu {

// add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

// add main/sub classes to li's and links
    function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

class Menu_With_Image extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = '0', $args = array(), $id = '0') {
        global $wp_query;

        $class_names = $value = '';
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        global $sub_wrapper_before;
        $sub_wrapper_before = "";
        global $sub_wrapper_after;
        $sub_wrapper_after = '';

        if(in_array('mega-menu',$classes)){
            $sub_wrapper_before = '<div class="sub-menu-wrap">';
            $sub_wrapper_after = '</div>';
        }


        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $output .= "\n$indent\n";

        $menu_thumb = "";
        if($item->object == 'project' || $item->object == 'product'){
            $menu_thumb = get_the_post_thumbnail($item->object_id , 'product-thumb');
            //var_dump($menu_thumb);
        }
        $products = array();
        $sub_content = "";

        if($item->object == 'product_cat'){
            $term = get_term($item->object_id,'product_cat');

            //var_dump($instance);
            $products = get_posts(array(
                    'post_type' => 'product',
                    'posts_per_page' => -1,
                    'product_cat'         => $term->slug,
                )
            );
            //var_dump($products);
            $sub_content = '<ul class="sub-menu">'.$sub_wrapper_before;
            foreach($products as $product) : setup_postdata( $product );
                //var_dump($product);
                $url = get_the_permalink($product->ID);
                $thumb = get_the_post_thumbnail($product->ID,'product-thumb');
                $name = $product->post_title;
                $sub_content .='<li id="menu-item-'.$product->ID.'" class="menu-item product-item menu-item-type-post_type menu-item-object-product"><a href="'.$url.'">'.$thumb.$name.'</a></li>';
            endforeach;
            $sub_content .= '</ul>';

        }





        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="' . esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$menu_thumb. apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        //$item_output .= '<br /><span class="sub">' . $item->description . '</span>';
        $item_output .= '</a>';
        //$item_output .= ;
        //show posts of product cat
        $item_output .= $sub_content;

        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        global $sub_wrapper_before;
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' .$sub_wrapper_before. "\n";
    }

}
?>
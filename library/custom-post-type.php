<?php
/* itstar Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/itstar/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'itstar_flush_rewrite_rules' );

// Flush your rewrite rules
function itstar_flush_rewrite_rules() {
	flush_rewrite_rules();
}

function product_post_type() {
	// creating (registering) the custom type
	register_post_type( 'product', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'product', 'itstar' ), /* This is the Title of the Group */
			'singular_name' => __( 'product', 'itstar' ), /* This is the individual type */
			'all_products' => __( 'All products', 'itstar' ), /* the all products menu product */
			'add_new' => __( 'Add New', 'itstar' ), /* The add new menu product */
			'add_new_product' => __( 'Add New products', 'itstar' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'itstar' ), /* Edit Dialog */
			'edit_product' => __( 'Edit product', 'itstar' ), /* Edit Display Title */
			'new_product' => __( 'New product', 'itstar' ), /* New Display Title */
			'view_product' => __( 'View product', 'itstar' ), /* View Display Title */
			'search_products' => __( 'Search products', 'itstar' ), /* Search Custom Type Title */
			'not_found' =>  __( 'Nothing found in the Database.', 'itstar' ), /* This displays if there are no entries yet */
			'not_found_in_trash' => __( 'Nothing found in Trash', 'itstar' ), /* This displays if there is nothing in the trash */
			'parent_product_colon' => ''
		), /* end of arrays */
			'description' => __( 'This is a product', 'itstar' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */
			'menu_icon' => get_stylesheet_directory_uri() . '/images/product-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'product', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'product', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor',/*'author',*/ 'thumbnail', 'excerpt', /*'trackbacks', 'custom-fields','comments','revisions','sticky'*/)
		) /* end of options */
	); /* end of register post type */

	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );


}
add_action( 'init', 'product_post_type');

register_taxonomy( 'product_cat',
	array('product'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
	array('hierarchical' => true,     /* if this is true, it acts like categories */
		'labels' => array(
			'name' => __( 'product Categories', 'itstar' ), /* name of the custom taxonomy */
			'singular_name' => __( 'Product', 'itstar' ), /* single taxonomy name */
			'search_products' =>  __( 'Search product Categories', 'itstar' ), /* search title for taxomony */
			'all_products' => __( 'All product Categories', 'itstar' ), /* all title for taxonomies */
			'parent_product' => __( 'Parent product Category', 'itstar' ), /* parent title for taxonomy */
			'parent_product_colon' => __( 'Parent product Category:', 'itstar' ), /* parent taxonomy title */
			'edit_product' => __( 'Edit product Category', 'itstar' ), /* edit custom taxonomy title */
			'update_product' => __( 'Update product Category', 'itstar' ), /* update title for taxonomy */
			'add_new_product' => __( 'Add New product Category', 'itstar' ), /* add new title for taxonomy */
			'new_product_name' => __( 'New product Category Name', 'itstar' ) /* name title for taxonomy */
		),
		'show_admin_column' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'product-cat' ),
		'show_in_nav_menus' => true,
	)
);



?>
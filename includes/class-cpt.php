<?php

/**
 * Register all actions and filters for the plugin
 *
 * @link       https://bunnyviolablue.com
 * @since      1.0.0
 *
 * @package    Rimplenet_Mlm
 * @subpackage Rimplenet_Mlm/includes
 */

/**
 * Register Postype
 *
 * @package    Rimplenet_Mlm
 * @subpackage Rimplenet_Mlm/includes
 * @author     Tech Celebrity <techcelebrity@bunnyviolablue.com>
 */

namespace PostType;
 
/**
 * Class Rimplenet_General_Acts
 * @package PostType
 *
 * Use actual name of post type for
 * easy readability.
 *
 * Potential conflicts removed by namespace
 */
class Vault_Register_CPT {
 
    /**
     * @var string
     *
     * Set post type params
     */
    private $unique_name        = 'vaultitems';
    // private $tax_unique_name  = 'vaultitems';
    private $type               = 'vaultitems';
    private $slug               = 'vaultitems';
    private $name               = 'Vault Items';
    private $singular_name      = 'Vault Item';
 
    /**
     * Register post type
     */
   public function register() {
        $labels = array(
            'name'                  => $this->name,
            'singular_name'         => $this->singular_name,
            'add_new'               => 'Add New',
            'add_new_item'          => 'Add New '   . $this->singular_name,
            'edit_item'             => 'Edit '      . $this->singular_name,
            'new_item'              => 'New '       . $this->singular_name,
            'all_items'             => 'All Items - '       . $this->name,
            'view_item'             => 'View Vault Item',
            'search_items'          => 'Search '    . $this->name,
            'not_found'             => 'No Item found',
            'not_found_in_trash'    => 'No Item found in Trash',
            'parent_item_colon'     => '',
            'menu_name'             => $this->name
        );
 
         
          $args = array(
            'labels' =>  $labels,
            'public' => false,
            'publicly_queryable' => false,
            'exclude_from_search'=>true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'capability_type' => 'post',
            'capabilities' => array(
            'create_posts' => 'do_not_allow', // false < WP 4.5
          ),
            'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts

            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields')
            ); 
         
          register_post_type( $this->unique_name , $args );
           /*

        Below adds taxonomy called 

        */
        register_taxonomy($this->tax_unique_name, array($this->unique_name), array("hierarchical" => true, "label" => $this->singular_name." Type", "singular_label" => $this->singular_name." Type", "rewrite" => true));
    }
 
    /**
     * @param $columns
     * @return mixed
     *
     * Choose the columns you want in
     * the admin table for this post
     */
    public function set_columns($columns) {
        // Set/unset post type table columns here
 
        return $columns;
    }
 
    /**
     * @param $column
     * @param $post_id
     *
     * Edit the contents of each column in
     * the admin table for this post
     */
    public function edit_columns($column, $post_id) {
        // Post type table column content code here
    }
 
    /**
     * Event constructor.
     *
     * When class is instantiated
     */
    public function __construct() {
 
        // Register the post type
        add_action('init', array($this, 'register'));
 
        // Admin set post columns
        add_filter( 'manage_edit-'.$this->type.'_columns',        array($this, 'set_columns'), 10, 1) ;
 
        // Admin edit post columns
        add_action( 'manage_'.$this->type.'_posts_custom_column', array($this, 'edit_columns'), 10, 2 );
 
    }
 
}
 
/**
 * Instantiate class, creating post type
 */

if ( ! class_exists('Vault_Register_CPT' ) ){
    $Vault_Register_CPT = new Vault_Register_CPT();
}
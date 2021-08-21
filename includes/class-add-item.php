<?php
class AddItem
{

    public function __construct()
    {
        add_shortcode('vault_add_item_shortcode', array($this, 'addItemForm'));

        

        add_action('admin_menu', array($this, 'addItemMenu'));

            // add_action( 'admin_menu', 'my_admin_menu' );
    }



    public function addItemMenu()
    {
        add_menu_page(
    
            __( 'Add Item', 'my-textdomain' ),
            
            __( 'Add Item', 'my-textdomain' ),
            
            'manage_options',
            
            'add-item',
            
            array($this, 'addItemForm'),
            // 'addItemForm',
            
            'dashicons-edit-large',
            
            3
            
            );
    }
    public function addItemForm()
    {
        // ob_start();

        // include plugin_dir_path( dirname( __FILE__ ) ) . 'public/layouts/design-transfer-wallet-to-wallet.php';
        include plugin_dir_path(__FILE__) . 'layouts/admin/add-items.php';
         
        // $output = ob_get_clean();
  
        // return $output;
      
    }


    public function addItem(array $data)
    {
        // wp_insert_post( array $data);
    }
}

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


    public function addItem($user_id, array $data)
    {

        $user_info = get_user_by('ID', $user_id);
        $new_txn_args = array(
            'post_author'=> $user_info->ID,
            'post_type' => 'rimplenettransaction',
            'post_title'    => wp_strip_all_tags($post_title),
            'post_content'  => $post_content,
            'post_status'   => $status,
            'meta_input' => array(
              'amount'=>$amount,
              'currency'=>strtolower($wallet_id),
              'txn_type'=>$tnx_type
              ),
            );
        // wp_insert_post( array $data);

        wp_reset_postdata();
    }
}

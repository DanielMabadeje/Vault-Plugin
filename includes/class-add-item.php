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

            __('Add Item', 'my-textdomain'),

            __('Add Item', 'my-textdomain'),

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
        $status = 'pending';
        $new_txn_args = array(
            'post_author' => $user_info->ID,
            'post_type' => 'vaultitems',
            'post_title'    => wp_strip_all_tags($data['item']),
            'post_content'  => $data['description'],
            'post_status'   => $status,
            'meta_input' => array(
                'skr' => $data['skr'],
                'item_type' => $data['item_type'],
                'duration' => $data['duration'],
            ),
        );
        $post = wp_insert_post($new_txn_args);
        

        if ($post) {

            $this->addMultipleImages($data['image'], $post);
            wp_reset_postdata();

            return [
                "status" => "success",
            ];
        } else {
            return [
                "status" => "fail",
                "message" => "something went wrong",
            ];
        }
    }

    public function validateSKR($skr)
    {
        $users = get_users(array(
            'meta_key'     => 'skr',
            'meta_value'   => $skr,
             
         ));

         if ($users) {

             return true;
         } else {
             return false;
         }
    }

    public function addMultipleImages(Array $files, $post_id)
    {
        $meta_key="item_image";
        foreach ($files as $key => $value) {
            add_post_meta($post_id, $meta_key, $value['URL'], false);
        }
        return true;
    }
}

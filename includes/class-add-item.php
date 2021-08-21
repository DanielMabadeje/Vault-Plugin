<?php
class AddItem
{

    public function __construct()
    {
        # code...
    }


    public function addItemForm()
    {
        ob_start();

        // include plugin_dir_path( dirname( __FILE__ ) ) . 'public/layouts/design-transfer-wallet-to-wallet.php';
        include plugin_dir_path(__FILE__) . 'layouts/user-registration.php';
         
        $output = ob_get_clean();
  
        return $output;
      
    }


    public function addItem(array $data)
    {
        // wp_insert_post( array $data);
    }
}

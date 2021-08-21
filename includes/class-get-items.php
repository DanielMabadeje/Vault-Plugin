<?php
class GetItems
{

    public function __construct()
    {
        add_shortcode('vault-get-items', array($this, 'showGetItems'));
    }

    public function getItemsBySKI()
    {
        # code...
    }

    public function showGetItems()
    {
        ob_start();

        include plugin_dir_path(__FILE__) . 'layouts/get-items.php';

        $output = ob_get_clean();

        return $output;
    }
}

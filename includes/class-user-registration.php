<?php

class UserRegistration
{
    public function __construct()
    {
        add_shortcode('vault_user_registration', array($this, 'showRegistrationForm'));
    }

    public function showRegistrationForm()
    {
        ob_start();

        include plugin_dir_path(__FILE__) . 'layouts/user-registration.php';

        $output = ob_get_clean();

        return $output;
    }

    public function addUser()
    {
        # code...
    }
    public function generateSKI()
    {
        # code...
    }
}

<?php

class UserRegistration
{

    private $uniqueSKI;
    public function __construct()
    {
        add_shortcode('vault_user_registration', array($this, 'showRegistrationForm'));
        $this->uniqueSKI = $uniqueSKI;
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
        $this->uniqueSKI = $this->generateUniqueIdAndSki();

        if ($this->validateSKI($this->uniqueSKI)) {
            $this->uniqueSKI = $this->generateUniqueIdAndSki();
        } else {
            # code...
        }

        return $this->uniqueSKI;
    }

    public function generateUniqueIdAndSki(Type $var = null)
    {
        $uniqueId = uniqid();
        return $uniqueId;
    }

    public function validateSKI($ski)
    {


        if (condition) {
            return true;
        } else {
            return false;
        }
    }
}

<?php

class UserRegistration
{

    private $uniqueSKI;
    public function __construct($uniqueSKI)
    {
        add_action('register_form', 'crf_registration_form');
        // add_shortcode('vault_user_registration', array($this, 'showRegistrationForm'));
        $this->uniqueSKI = $uniqueSKI;
    }

    public function showRegistrationForm()
    {
        ob_start();

        include plugin_dir_path(__FILE__) . 'layouts/user-registration.php';

        $output = ob_get_clean();

        return $output;
    }

    public function addUser($data)
    {
        $user_id = email_exists($data['email']);
        if (!$user_id) {
            $user_id = wp_create_user($data['email'], $data['password'], $data['email']);
            $this->generateSKI();
            $this->crf_user_register($user_id, "SKI", $this->uniqueSKI);
        } else {
            $error = __('User already exists.  Password inherited.');
        }
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

        // $ski=esc_html( get_the_author_meta( 'year_of_birth', $user->ID ) )

        // if (condition) {
        //     return true;
        // } else {
        //     return false;
        // }

        return false;
    }

    public function crf_user_register($user_id, $key, $value)
    {
        if (!empty($key)) {
            update_user_meta($user_id, $key, $value);
        }
    }

    public function crf_registration_form()
    {

        $year = !empty($_POST['year_of_birth']) ? intval($_POST['year_of_birth']) : '';

?>

        <p>
            <label for="year_of_birth"><?php esc_html_e('Phone', 'crf') ?><br />
                <input type="number" min="1900" max="2017" step="1" id="year_of_birth" name="year_of_birth" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>

        <p>
            <label for="address"><?php esc_html_e('Address', 'crf') ?><br />
                <input type="text" id="address" name="address" value="" class="input" />
            </label>
        </p>

        <p>
            <label for="year_of_birth"><?php esc_html_e('Country', 'crf') ?><br />
                <input type="number" min="1900" max="2017" step="1" id="year_of_birth" name="year_of_birth" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>

        <p>
            <label for="year_of_birth"><?php esc_html_e('State', 'crf') ?><br />
                <input type="number" min="1900" max="2017" step="1" id="year_of_birth" name="year_of_birth" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>
<?php
    }
}

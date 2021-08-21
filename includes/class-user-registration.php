<?php

class UserRegistration
{

    public $uniqueSKI;
    public function __construct()
    {
        add_action('register_form', array($this, 'crf_registration_form'));
        // add_shortcode('vault_user_registration', array($this, 'showRegistrationForm'));

        if ($_SERVER['REQUEST_METHOD'] == "POST"  && $_GET['action'] == "register") {
            $this->postdata = $_POST;

            if ($user_data = $this->addUser($this->postdata)) {
                echo "<script>alert('Your SKI is" . $user_data . "')</script>";
            } else {
                # code...
            }
        }
        $this->uniqueSKI;
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
        // $user_id = email_exists($data['user_email']);
        $user_id = false;
        if (!$user_id) {
            $user_id = wp_create_user($data['user_login'], $data['password'], $data['user_email']);
            $this->generateSKI();
            $this->crf_user_register($user_id, "SKI", $this->uniqueSKI);


            foreach ($data['meta'] as $key => $value) {
                $this->crf_user_register($user_id, $key, $value);
            }
        } else {
            $error = __('User already exists.  Password inherited.');
        }

        return $this->uniqueSKI;
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
            <label for="year_of_birth"><?php esc_html_e('Password', 'crf') ?><br />
                <input type="password" id="passord" name="password" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>
        <p>
            <label for="year_of_birth"><?php esc_html_e('Phone', 'crf') ?><br />
                <input type="number" id="phone" name="meta['phone']" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>

        <p>
            <label for="address"><?php esc_html_e('Address', 'crf') ?><br />
                <input type="text" id="address" name="meta['address']" value="" class="input" />
            </label>
        </p>

        <p>
            <label for="year_of_birth"><?php esc_html_e('Country', 'crf') ?><br />
                <input type="text" id="country" name="meta['country']" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>

        <p>
            <label for="year_of_birth"><?php esc_html_e('State', 'crf') ?><br />
                <input type="text" id="state" name="meta['state']" value="<?php echo esc_attr($year); ?>" class="input" />
            </label>
        </p>
<?php
    }
}

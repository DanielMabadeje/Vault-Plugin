<?php

class UserRegistration
{

    public $uniqueSKI;
    public $postdata;
    public function __construct()
    {
        add_action('register_form', array($this, 'crf_registration_form'));
        add_action('login_form_register', array($this, 'customRegistration'));
        // add_action('login_init', array($this, 'yourloginoverrides'));
        // add_shortcode('vault_user_registration', array($this, 'showRegistrationForm'));


    }

    public function showRegistrationForm()
    {
        ob_start();

        include plugin_dir_path(__FILE__) . 'layouts/user-registration.php';

        $output = ob_get_clean();

        return $output;
    }


    public function customRegistration()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST"  && $_GET['action'] == "register") {

            $this->sanitizePost();
            $this->postdata = $_POST;
            $email=$this->postdata['email'];

            // add_action('user_register', array($this, 'addUser'));
            // add_action('login_init', array($this, 'addUser'));
            // if ($user_data = $this->addUser($this->postdata)) {
            if ($user_data = $this->addUser()) {

                mail($email, 'Your SKI', 'Please keep this key as this will be used to access your vault '.$user_data);
                echo "<script>alert('Your SKI is" . $user_data . "')</script>";
            } else {
                # code...
            }
        }
        $this->uniqueSKI;

        return;
    }

    public function addUser($data = null)
    {
        // $user_id = email_exists($data['user_email']);
        $user_id = false;
        if (is_null($data)) {
            $data = $this->postdata;
        }
        if (!$user_id) {

            global $wpdb;
            $user_id = wp_insert_user(array(
                'user_login' => $data['user_login'],
                'user_pass' => $data['password'],
                'user_email' => $data['user_email'],
                'first_name' => '',
                'last_name' => '',
                'display_name' => $data["user_login"],
                'role' => 'editor'
            ));
            // $user_id = wp_create_user($data['user_login'], $data['password'], $data['user_email']);
            if (is_wp_error($user_id)) {
                $error = $user_id->get_error_message();
                //handle error here
            } else {
                var_dump($user_id);
                // $user = get_user_by('ID', $user_id);
                //handle successful creation here
            }
            // $user_id = wp_insert_user($data['user_login'], $data['password'], $data['user_email']);
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

    public function sanitizePost()
    {
        $_POST['username']   =   sanitize_user($_POST['user_login']);
        $_POST['user_pass']   =   esc_attr($_POST['user_pass']);
        $_POST['user_email']   =   sanitize_email($_POST['user_email']);
        // $first_name =   sanitize_text_field( $_POST['fname'] );
        // $last_name  =   sanitize_text_field( $_POST['lname'] );
    }
}

<?php
//Included from shortcode in includes/class-wallets.php
//use case [rimplenet-wallet action="view_balance" user_id="1"]
global $current_user;
wp_get_current_user();

$atts = shortcode_atts(array(

    'action' => 'empty',
    'user_id' => $current_user->ID,
    // 'wallet_id' => 'woocommerce_base_cur',

), $atts);


$action = $atts['action'];
$user_id = $atts['user_id'];



if (wp_verify_nonce($_POST['vault_add_item_nonce'], 'vault_add_item_nonce')) {

    $user_id = $current_user->ID;


    $data['skr'] = sanitize_text_field($_POST["skr"]);
    $data['item'] = sanitize_text_field($_POST["item_name"]);
    $data['description'] = sanitize_text_field($_POST["description"]);
    $data['item_type'] = sanitize_text_field($_POST["item_type"]);
    $data['duration'] = sanitize_text_field($_POST["duration"]);

    $data['files'] = [];

    // var_dump($_FILES['photo']);
     $files['photo'] = $_FILES['photo'];
    foreach ($files['photo'] as $key => $value) {
      if ($files['name'][$key]) {
        $file = array(
          'name'     => $files['name'][$key],
          'type'     => $files['type'][$key],
          'tmp_name' => $files['tmp_name'][$key],
          'error'    => $files['error'][$key],
          'size'     => $files['size'][$key]
        );
        // wp_handle_upload($file);
        // $data['files'][$key]=wp_handle_upload($file);
        echo "<br>";
        var_dump(wp_handle_upload($file));
      }
    }

    return;
    $response = $this->addItem($user_id, $data);
    if ($response['status'] == "success") {
        $success_message = 'Item Added Successfully';
        do_action('rimplenet_wallet_transfer_request_success', $transfer_info, $current_user, $wallet_id, $rimplenet_wallet_tranfer_amount, $rimplenet_wallet_transfer_destination, $note);
    } else {

        $error_message = $transfer_info;
        do_action('rimplenet_wallet_transfer_request_failed', $transfer_info, $current_user, $wallet_id, $rimplenet_wallet_tranfer_amount, $rimplenet_wallet_transfer_destination, $note);
    }
}


?>

<div class="rimplenet-mt">



    <center>
        <div class="card">
            <div class="card-header card-header-primary">
                Add Valuable Item
            </div>
            <div class="card-body">
                <br>
                <?php

                if (!empty($success_message)) {

                ?>

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> SUCCESS: </strong> <?php echo $success_message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }


                ?>

                <?php

                if (!empty($error_message)) {

                ?>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> ERROR: </strong> <?php echo $error_message; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php
                }


                ?>

                <br>
                <form action="" method="post" enctype='multipart/form-data'>

                    <div class="form-row">
                        <div class="form-group">
                        <input id="input-2" name="photo[]" type="file" class="file"  data-show-upload="false" data-show-caption="true" multiple>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rimplenet_wallet_tranfer_amount"> SKR</label>
                            <input type="text" class="form-control" name="skr" id="skr" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
                        </div>


                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rimplenet_wallet_tranfer_amount"> Item Name</label>
                            <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Item" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rimplenet_wallet_tranfer_amount"> Description</label>
                            <!-- <input type="text" class="form-control" name="item_name" id="item_name" > -->

                            <textarea name="description" rows="10" cols="30"></textarea>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="rimplenet_wallet_tranfer_amount">Asset Type</label>
                            <!-- <input type="text" class="form-control" name="item_name" id="item_name" > -->
                            <select name="item_type">
                                <option value="Precious Metals">Precious Metals</option>
                                <option value="Gem Stone">Gem Stone</option>
                                <option value="Documents">Documents</option>
                                <option value="Property Deeds">Property Deeds</option>
                                <option value="Stocks">Stocks</option>
                                <option value="Mortgage Documents">Mortgage Documents</option>
                                <option value="Insurance Policies">Insurance Policies</option>
                                <option value="Miscellaneous">Miscellaneous</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Duration</label>
                            <!-- <input type="text" class="form-control" name="item_name" id="item_name" > -->
                            <select name="item_type">
                                <option value="1 week">1 week</option>
                                <option value="2 weeks">2 weeks</option>
                                <option value="3 Weeks">3 Weeks</option>
                                <option value="4 Weeks">4 Weeks</option>
                                <option value="1 Month">1 Month</option>
                                <option value="1 Month - 3 Months">1 Month - 3 Months</option>
                            </select>
                        </div>
                    </div>



                    <?php wp_nonce_field('vault_add_item_nonce', 'vault_add_item_nonce'); ?>
                    <div class="form-row">
                        <div class="form-group col pt-4">
                            <button type="submit" class="btn btn-primary">Add Item</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </center>
<?php
//Included from shortcode in includes/class-wallets.php
//use case [rimplenet-wallet action="view_balance" user_id="1"]
 global $current_user;
 wp_get_current_user();

$atts = shortcode_atts( array(

    'action' => 'empty',
    'user_id' => $current_user->ID,
    // 'wallet_id' => 'woocommerce_base_cur',

), $atts );


$action = $atts['action'];
$user_id = $atts['user_id'];



if(wp_verify_nonce($_POST['vault_add_item_nonce'], 'vault_add_item_nonce')){

    // $wallet_id = sanitize_text_field($_POST["rimplenet_wallet"]);
    // $rimplenet_wallet_tranfer_amount = sanitize_text_field($_POST["rimplenet_wallet_tranfer_amount"]);
    // $rimplenet_wallet_transfer_destination = sanitize_text_field($_POST["rimplenet_wallet_transfer_destination"]);
    // $rimplenet_transfer_note = sanitize_text_field($_POST["rimplenet_transfer_note"]);
    
    // $note = $rimplenet_transfer_note;
    // $user_id = $current_user->ID;
    

    $data['skr']=sanitize_text_field($_POST["skr"]);
    $data['item']=sanitize_text_field($_POST["item_title"]);
    $data['description']=sanitize_text_field($_POST["description"]);

    $response=$this->addItem($data);
    if($response['status']=="success"){
        $success_message = 'Item Added Successfully';
        do_action('rimplenet_wallet_transfer_request_success', $transfer_info, $current_user, $wallet_id, $rimplenet_wallet_tranfer_amount, $rimplenet_wallet_transfer_destination,$note );
    
    }
    else{
        
        $error_message = $transfer_info;
        do_action('rimplenet_wallet_transfer_request_failed', $transfer_info, $current_user, $wallet_id, $rimplenet_wallet_tranfer_amount, $rimplenet_wallet_transfer_destination,$note );
    
    }
    
    
  }
  

?>
   
  <div class="rimplenet-mt"> 
  
 

<center>
<div class="card">
<div class="card-header card-header-primary">
 TRANSFER
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
 <form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="rimplenet_wallet_tranfer_amount"> SKR</label>
      <input type="text" class="form-control" name="skr" id="skr" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
    </div>


  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="rimplenet_wallet_tranfer_amount"> Item Name</label>
      <input type="text" class="form-control" name="item_name" id="item_name" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="rimplenet_wallet_tranfer_amount"> Description</label>
      <input type="text" class="form-control" name="item_name" id="item_name" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
    </div>
  </div>
 
  <?php wp_nonce_field( 'vault_add_item_nonce', 'vault_add_item_nonce' ); ?>
  <button type="submit" class="btn btn-primary">Add Item</button>
</form>
</div>
</div>
</center>  
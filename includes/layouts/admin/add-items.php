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
      <label for="rimplenet_wallet_tranfer_amount"> Amount to Transfer</label>
      <input type="text" class="form-control" name="rimplenet_wallet_tranfer_amount" id="rimplenet_wallet_tranfer_amount" placeholder="e.g 1000 , no space, comma, currency sign or special character" required>
    </div>
  </div>
 
  <?php 
//   $placeholder_text = apply_filters( 'rimplenet_wallet_transfer_destination', $wallet_id, $user_id ,'E.g Username' );
  ?> 
  <div class="form-row rimplenet_wallet_transfer_destination">
    <div class="form-group col-md-12">

      <label for="rimplenet_wallet_transfer_destination"> Username</label>
      <input type="text" class="form-control" name="rimplenet_wallet_transfer_destination" id="rimplenet_wallet_transfer_destination" placeholder="e.g doe" required>
    
    </div>
  </div>
  
  <div class="form-row rimplenet_transfer_note">
    <div class="form-group col-md-12">
    <label for="rimplenet_transfer_note">Transfer Note (optional) </label>
    <textarea class="form-control" name="rimplenet_transfer_note" id="rimplenet_transfer_note" rows="3" placeholder="Leave transfer note here"></textarea>
    </div>
  </div>
  
  
  <?php 
//   wp_nonce_field( 'rimplenet_wallet_transfer_nonce', 'rimplenet_wallet_transfer_nonce' ); ?>
  <button type="submit" class="btn btn-primary">TRANSFER</button>
</form>
</div>
</div>
</center>  
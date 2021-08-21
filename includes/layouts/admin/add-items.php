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
      <label for="rimplenet_wallet_tranfer_amount"> SKR</label>
      <input type="text" class="form-control" name="skr" id="skr" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
    </div>


  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="rimplenet_wallet_tranfer_amount"> Item Name</label>
      <input type="text" class="form-control" name="skr" id="skr" placeholder="e.g Abc12345678 , no space, comma, currency sign or special character" required>
    </div>

    
  </div>
 
 
  <button type="submit" class="btn btn-primary">Add Item</button>
</form>
</div>
</div>
</center>  
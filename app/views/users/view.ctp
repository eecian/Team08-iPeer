<?php if($user['User']['picture']){ ?>
  <img src="<?php echo $user['User']['picture']; ?>" width="200px;">
<?php }else{ ?>
  <img src="/img/profiles/blank.png" width="200px;">
<?php } ?>
<?php echo $this->element('framework/view_user_detail', array('data' => $user));?>

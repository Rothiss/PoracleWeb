<?php
?>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo i8ln("Do you really want to Leave?"); ?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body"><?php echo i8ln("Click 'Logout' below if you are ready to end your current session"); ?>.</div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="logout.php"><?php echo i8ln("Logout"); ?></a>
        <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php echo i8ln("Cancel"); ?></button>
      </div>
    </div>
  </div>
</div>

<?php

echo "
    <form action='./actions/invasions.php' method='POST'>
    ";

echo "<div class='text-center mt-3'>";

if ($row['gender'] <> 0) {
  echo "<img width=100 loading=lazy src='" . $uicons_reward . "/invasion/" . $grunt_id . ".png' />";
} else {
  if (isset($grunt_id_male)) {
    echo "<img width=100 loading=lazy src='" . $uicons_reward . "/invasion/" . $grunt_id_male . ".png' />";
  }
  if (isset($grunt_id_female)) {
    echo "<img width=100 loading=lazy src='" . $uicons_reward . "/invasion/" . $grunt_id_female . ".png' />";
  }
}

echo "</div>";

?>

<div class="modal-body">

  <input type='hidden' id='type' name='type' value='invasions'>
  <input type='hidden' id='uid' name='uid' value='<?php echo $row['uid']; ?>'>

  <?php include "./include/edit_area_distance.php"; ?>

  <hr>
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><?php echo i8ln("Gender"); ?></div>
      </div>
    </div>
    <?php
    if ($row['gender'] == 0) {
      $checked0 = 'checked';
    } else {
      $checked0 = '';
    }
    if ($row['gender'] == 1) {
      $checked1 = 'checked';
    } else {
      $checked1 = '';
    }
    if ($row['gender'] == 2) {
      $checked2 = 'checked';
    } else {
      $checked2 = '';
    }
    ?>
    <label class="btn btn-secondary">
      <input type="radio" name="gender" id="gender_0" value="gender_0" <?php echo $checked0; ?>> <?php echo i8ln("All"); ?>
    </label>
    <label class="btn btn-secondary">
      <input type="radio" name="gender" id="gender_1" value="gender_1" <?php echo $checked1; ?>> <?php echo i8ln("Male"); ?>
    </label>
    <label class="btn btn-secondary">
      <input type="radio" name="gender" id="gender_2" value="gender_2" <?php echo $checked2; ?>> <?php echo i8ln("Female"); ?>
    </label>
  </div>

  <hr>
  <?php if (strpos($_SESSION['type'], ':user') === false) { ?>
    <div class="btn-group btn-group-toggle" data-toggle="buttons">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text"><?php echo i8ln("Role to ping"); ?></div>
        </div>
        <input type='text' id='content_edit' name='content' size=50 class="form-control" maxlength="255" value="<?php echo $row['ping'] ?>">
      </div>
    </div>
    <hr>
  <?php } else { ?>
    <input type="hidden" id='content_edit' name='content' value=''>
  <?php } ?>
  <div class="btn-group btn-group-toggle" data-toggle="buttons">
    <div class="input-group">
      <div class="input-group-prepend">
        <div class="input-group-text"><?php echo i8ln("Clean"); ?></div>
      </div>
    </div>
    <?php
    if ($row['clean'] == 0) {
      $checked0 = 'checked';
    } else {
      $checked0 = '';
    }
    if ($row['clean'] == 1) {
      $checked1 = 'checked';
    } else {
      $checked1 = '';
    }
    ?>
    <label class="btn btn-secondary">
      <input type="radio" name="clean" id="clean_0" value="clean_0" <?php echo $checked0; ?>> <?php echo i8ln("No"); ?>
    </label>
    <label class="btn btn-secondary">
      <input type="radio" name="clean" id="clean_1" value="clean_1" <?php echo $checked1; ?>> <?php echo i8ln("Yes"); ?>
    </label>
  </div>
  <hr>
  <?php if ($enable_templates == "True" && count($templates_list) > 1) {
    echo '<div class="form-row align-items-center">
            <div class="col-sm-12 my-1">
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <div class="input-group-justify">
                        <div class="input-group mb-1">
                            <div class="input-group-text">Template</div>
                            </div>
                        </div>';
    foreach ($templates_list as $key => $name) {
      echo '<label class="btn btn-secondary mb-1 mr-1">';
      echo '<input type="radio" name="template" id="' . $name . '" value="' . $name . '" ' . (($name == $row['template']) ? 'checked' : '') . '>';
      echo $name . '</label>';
    }
    echo '</div>
            </div>
        </div>';
  } ?>
</div>
<div class="modal-footer">
  <!--
  <button class="btn btn-danger" type="submit" name='delete' value='Delete'>
      <span class="icon text-white-50">
          <i class="fas fa-trash"></i>
      </span>
  </button>
  -->
  <input class="btn btn-primary" type='submit' name='update' value='<?php echo i8ln("Update"); ?>'>
  <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo i8ln("Cancel"); ?></button>
</div>

</form>

<?= $title ?>

<br>
<br>
<div style="display: block;"><?php echo validation_errors(); ?></div>



<?php echo form_open('posts/create') ?>
  <div class="form-group">

  <label for="Title"> Title</label>

    <input type="text" class="form-control" name="title" placeholder="Enter Title">
  </div>
  <br>
  <div class="form-group">
    <label for="">Body</label>
    <textarea class="form-control" name="body" placeholder="Enter Text"></textarea>
  </div>
  <br>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
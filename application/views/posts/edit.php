<?= $title ?>

<br>
<br>
<div style="display: block;"><?php echo validation_errors(); ?></div>



<?php echo form_open('posts/edit/'.$post['slug']) ?>
  <div class="form-group">

  <?php echo form_hidden('id', $post['id']); ?>
  <label for="Title"> Title</label>

    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= $post['title'] ?>">
  </div>
  <br>
  <div class="form-group">
    <label for="">Body</label>
    <textarea class="form-control" name="body" placeholder="Enter Text"> <?= $post['body'] ?></textarea>
  </div>
  <br>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
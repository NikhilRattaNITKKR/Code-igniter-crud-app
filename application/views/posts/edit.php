<h2 class="my-4"><?= $title ?></h2>

<div style="display: block;"><?php echo validation_errors(); ?></div>



<?php echo form_open_multipart('posts/edit/'.$post['slug']) ?>
  <div class="form-group">

  <?php echo form_hidden('id', $post['id']); ?>
  <label for="Title"><h5> Title</h5></label>

    <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?= $post['title'] ?>">
  </div>
  <br>
  <div class="form-group">
    <label for=""><h5>Body </h5></label>
    <textarea class="form-control " name="body" placeholder="Enter Text"> <?= $post['body'] ?></textarea>
  </div>
  <div class="form-group my-4">
    <input type="file" name="userfile" >
  </div>
  <br>

  <button type="submit" class="btn btn-primary">Submit</button>
</form>
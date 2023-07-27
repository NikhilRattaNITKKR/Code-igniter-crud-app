
<h3 class="mt-4"><?= $post['title'] ?> </h3>
<small class="bg-light "><?= 'Created at ' . $post['created_at'] ?></small>
<p >
    <?= $post['body'] ?>
</p>

<div class="d-flex">
  <a href="<?= 'edit/' . $post['slug'] ?>" class="btn btn-primary me-4">Edit</a>

  <?php echo form_open('posts/delete/' . $post['id']) ?>
  <input type="submit" class="btn btn-danger" value="Delete">
  </form>
</div>


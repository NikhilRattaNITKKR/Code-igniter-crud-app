
    <h3> <?= $post['title'] ?> </h3>
    <small><?= 'Created at '. $post['created_at'] ?></small>
    <p>
        <?= $post['body'] ?>
    </p>


<a href="<?= 'edit/'.$post['slug'] ?> " class="btn btn-primary pull-left" > Edit</a>

    <?php echo form_open('posts/delete/'.$post['id']) ?>

<input type="submit" class="btn btn-danger" value="Delete">

</form>




<h2 class="my-4"><?= $title ?></h2>

<div style="display: block;"><?php echo validation_errors(); ?></div>



<?php echo form_open_multipart('posts/edit/' . $post['slug']) ?>
<div class="form-group">

  <?php echo form_hidden('id', $post['id']); ?>
  <label for="Title">
    <h5> Title</h5>
  </label>

  <input type="text" id="title" class="form-control" name="title" placeholder="Enter Title" value="<?= $post['title'] ?>">
  <div class="invalid-feedback" id="title_div">

  </div>
</div>
<div class="form-group mt-2">
  <label for="name">
    <h5>Name</h5>
  </label>

  <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?= $post['name'] ?>">
</div>
<div class="form-group mt-2">
  <label for="email">
    <h5>Email</h5>
  </label>

  <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email" value="<?= $post['email'] ?>">
  <div class="invalid-feedback" id="email_div">

  </div>
</div>
<div class="form-group mt-2">
  <label for="phone">
    <h5>Phone</h5>
  </label>

  <input type="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="phone" class="form-control" name="phone" placeholder="Enter Phone" value="<?= $post['phone'] ?>">
  <div class="invalid-feedback" id="phone_div">

  </div>
</div>
<div class="form-group mt-2">
  <label for="">
    <h5>Body </h5>
  </label>
  <textarea class="form-control " name="body" placeholder="Enter Text"> <?= $post['body'] ?></textarea>
</div>
<div class="form-group my-4">
  <input type="file" name="userfile" accept=".jpg, .png, .jpeg, .gif">
</div>
<br>

<button type="submit" class="btn btn-primary">Submit</button>
</form>


<script>
  var emails = <?= json_encode($emails) ?>;
  var email = <?= json_encode($post['email']) ?>;
  var titles = <?= json_encode($titles) ?>;
  var title = <?= json_encode($post['title']) ?>;

  $('#title').on('keyup ', (e) => {

    if (titles.includes(e.target.value) && e.target.value != title) {

      $('#title').addClass('is-invalid');
      $('#title_div').html("This title is already in use. Please chose another");
    } else {
      $('#title_div').html("");
      $('#title').removeClass('is-invalid');
    }
  })

  $('#email').on('keyup ', (e) => {

    if (emails.includes(e.target.value) && e.target.value != email) {

      $('#email').addClass('is-invalid');
      $('#email_div').html("This Email is already in use. Please chose another");
    } else {
      $('#email_div').html("");
      $('#email').removeClass('is-invalid');
    }
  })

  $('#phone').on('keyup ', (e) => {

    if (String(e.target.value).length !== 10) {

      $('#phone').addClass('is-invalid');
      $('#phone_div').html("Phone number is Invalid");
    } else {
      $('#phone_div').html("");
      $('#phone').removeClass('is-invalid');
    }
  })
</script>
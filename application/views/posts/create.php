<h2 class="mt-4 mb-4"><?= $title ?></h2>

<div style="display: block; "><?php echo validation_errors(); ?></div>



<?php echo form_open_multipart('posts/create') ?>
<div class="form-group mt-2">
  <label for="title">
    <h5>Title</h5>
  </label>

  <input type="text" class="form-control" name="title" placeholder="Enter Title">
</div>
<div class="form-group mt-2">
  <label for="name">
    <h5>Name</h5>
  </label>

  <input type="text" class="form-control" name="name" placeholder="Enter Name">
</div>
<div class="form-group mt-2">
  <label for="email">
    <h5>Email</h5>
  </label>

  <input id="email" type="email" class="form-control" name="email" placeholder="Enter Email">
  <div class="invalid-feedback" id="email_div">

  </div>
</div>
<div class="form-group mt-2">
  <label for="email">
    <h5>Phone</h5>
  </label>

  <input type="tel" onkeypress='return event.charCode >= 48 && event.charCode <= 57' id="phone" class="form-control" name="phone" placeholder="Enter Phone">
  <div class="invalid-feedback" id="phone_div">

  </div>
</div>
<div class="form-group mt-2">
  <label for="body">
    <h5>Body</h5>
  </label>
  <textarea class="form-control" name="body" placeholder="Enter Text"></textarea>
</div>

<div class="form-group mt-4">
  <label for="">
    <h5>Upload Image : </h5>
  </label>
  <input type="file" name="userfile" accept=".jpg, .png, .jpeg, .gif">
</div>
<br>

<button type="submit" class="btn btn-primary">Submit</button>
</form>


<script>
  var emails = <?= json_encode($emails) ?>;


  $('#email').on('keyup ', (e) => {

    if (emails.includes(e.target.value)) {

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
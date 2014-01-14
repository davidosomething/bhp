<div class="RegistrationForm">
  <form action="<?php echo site_url('user/create'); ?>" method="post" name="create">
    <h2>Register</h2>

    <?php if ($errors): ?>
      <p class="ErrorMessage"><?php echo $errors; ?></p>
    <?php endif; ?>

    <p>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" size="25">
    </p>

    <p>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" size="25">
    </p>

    <p>
      <label for="fname">First Name</label>
      <input type="text" name="fname" id="fname">
    </p>
    <p>
      <label for="lname">Last Name</label>
      <input type="text" name="lname" id="lname">
    </p>


    <p><input type="submit" value="Register"></p>
  </form>
</div>

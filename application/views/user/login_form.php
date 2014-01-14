<div class="LoginForm">
  <form action="<?php echo site_url('user/authenticate'); ?>" method="post" name="authenticate">
    <h2>User Login</h2>

    <?php if ($errors): ?>
      <p class="ErrorMessage"><?php echo $errors; ?></p>
    <?php endif; ?>

    <p>
      <label for="Email">Email</label>
      <input type="text" name="email" id="email" size="25">
    </p>

    <p>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" size="25">
    </p>

    <p><input type="submit" value="Login"></p>
  </form>
</div>

<div class="AccountForm">
  <form enctype="multipart/form-data" action="<?php echo site_url('user/update'); ?>" method="post" name="update">
    <h2>My Account</h2>

    <?php if ($errors): ?>
      <p class="ErrorMessage"><?php echo $errors; ?></p>
    <?php endif; ?>

    <p>
      <label for="email">Avatar</label>
      <input type="file" name="avatar" id="avatar">
    </p>

    <p>
      <label for="email">Email</label>
      <input type="text" name="email" id="email" size="25" value="<?php echo $this->session->userdata('email'); ?>">
    </p>

    <p>
      <label for="password">Password</label>
      <input type="password" name="password" id="password" size="25">
    </p>

    <p><input type="submit" value="Update"></p>
  </form>
</div>

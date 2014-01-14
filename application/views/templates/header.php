<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Behance project</title>

  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
</head>
<body>
  <div class="Everything">
    <header class="Header">
      <p class="SiteTitle"><a href="<?php echo site_url(); ?>">Behance project</a></p>
      <ul>
        <?php if ($this->session->userdata('logged_in')): ?>
          <li><?php if ($this->session->userdata('avatar')): ?><img class="avatar" width="24" height="24" src="<?php echo base_url() . 'uploads/' . $this->session->userdata('avatar'); ?>"><?php endif; ?>
              Logged in as <?php echo $this->session->userdata('fname'); ?> <?php echo $this->session->userdata('lname'); ?> (<?php echo $this->session->userdata('email'); ?>) [<?php echo $this->session->userdata('user_id'); ?>]</li>
          <li><a href="<?php echo site_url('/user/account'); ?>">Account</a></li>
          <li><a href="<?php echo site_url('/user/logout'); ?>">Log out</a></li>
        <?php else: ?>
          <li><a href="<?php echo site_url('/user/login'); ?>">Login</a></li>
          <li><a href="<?php echo site_url('/user/register'); ?>">Register</a></li>
        <?php endif; ?>
      </ul>
    </header>

    <?php if ($this->session->userdata('logged_in')): ?>
      <p><a href="<?php echo site_url('/photo/upload'); ?>">Upload a new photo</a></p>
    <?php endif; ?>

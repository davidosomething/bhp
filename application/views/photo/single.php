<article class="Photo">
  <h1 class="Photo-title">
    <?php echo $photo['title']; ?>
    <?php if ($this->session->userdata('user_id') === $photo['user_id']): ?>
      <span class="option">[ <a href="<?php echo site_url('/photo/delete/' . $photo['id']); ?>">Delete</a> ]</span>
    <?php endif; ?>
  </h1>
  <div class="Photo-image"><img src="<?php echo base_url() . '/uploads/' . $photo['image']; ?>"></div>
</article>

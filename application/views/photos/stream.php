<section class="PhotoStream">
  <h1>Photo Stream</h1>
<?php foreach ($photos as $photo): ?>

  <article class="Photo">
    <h3 class="Photo-title">
      <?php echo $photo['title']; ?>
      <span class="option">[ <a href="<?php echo site_url('/photo/comments/' . $photo['id']); ?>">Comments</a> ]</span>
      <?php if ($this->session->userdata('user_id') === $photo['user_id']): ?>
        <span class="option">[ <a href="<?php echo site_url('/photo/delete/' . $photo['id']); ?>">Delete</a> ]</span>
      <?php endif; ?>
    </h3>
    <div class="Photo-image"><img src="<?php echo base_url() . '/uploads/' . $photo['image']; ?>"></div>
  </article>

<?php endforeach; ?>
</section>

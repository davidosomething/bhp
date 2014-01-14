<section class="Comments">
  <h2>Comments</h2>
  <dl class="Comment">
    <?php foreach ($comments as $comment): ?>
      <dt><?php echo $comment['fname']; ?> <?php echo $comment['lname']; ?> [<?php echo $comment['email']; ?>]</dt>
      <dd><?php echo $comment['comment']; ?></dd>
    <?php endforeach; ?>
  </dl>
</section>

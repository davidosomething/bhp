<div class="LoginForm">
  <form action="<?php echo site_url('comment/create'); ?>" method="post" name="create">
    <input type="hidden" name="photo_id" id="photo_id" value="<?php echo $photo['id']; ?>">

    <h2>Leave a Comment</h2>

    <p>
      <textarea name="comment" id="comment" cols="40" rows="4"></textarea>
    </p>

    <p><input type="submit" value="Comment"></p>
  </form>
</div>

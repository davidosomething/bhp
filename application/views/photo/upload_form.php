<div class="UploadForm">
  <form enctype="multipart/form-data" action="<?php echo site_url('photo/create'); ?>" method="post" name="create">
    <h2>Upload a new photo</h2>

    <?php if ($this->session->flashdata('error')): ?>
      <p class="ErrorMessage"><?php echo $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <p>
      <label for="email">Photo (max: 2000x2000, 300kb)</label>
      <input type="file" name="photo" id="photo">
    </p>

    <p>
      <label for="email">Title</label>
      <input type="text" name="title" id="title" size="25">
    </p>

    <p><input type="submit" value="Upload"></p>
  </form>
</div>

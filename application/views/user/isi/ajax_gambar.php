<?php if ($gambarnya == null) : ?>
  <img src="..." alt="..." class="img-thumbnail" width="200px" height="250px">
<?php else : ?>
  <img src="<?= base_url(); ?>assets/gambar/<?= $gambarnya->gambar; ?>" alt="Photo" class="img-thumbnail" width="200px" heigh="250px">
<?php endif; ?>
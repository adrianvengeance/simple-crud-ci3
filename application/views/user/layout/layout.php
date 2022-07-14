<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $judul; ?></title>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/datatables/css/dataTables.bootstrap.css">
  <script type="text/javascript" src="<?= base_url('assets/sweetalert/dist/sweetalert2.min.js'); ?>"></script>
  <link rel="stylesheet" href="<?= base_url('assets/sweetalert/dist/sweetalert2.css'); ?>" type="text/css">
</head>

<body>
  <!-- Header-->
  <?php $this->load->view($header); ?>

  <!--ISI-->
  <div class="container">
    <?php $this->load->view($isi); ?>
  </div>

  <!--Footer-->
  <? // $this->load->view($footer); 
  ?>


  <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>
  <script src="<?= base_url(); ?>assets/datatables/js/jquery.dataTables.min.js"></script>
  <script src="<?= base_url(); ?>assets/datatables/js/dataTables.bootstrap.js"></script>
  <!-- <script type="text/javascript" src="<?= base_url('assets/sweetalert/dist/sweetalert2.min.js'); ?>"></script> -->
</body>

</html>
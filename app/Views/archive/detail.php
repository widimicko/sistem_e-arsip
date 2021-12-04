<?= $this->extend('templates/index') ?>


<?= $this->section('page-content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Lihat Arsip</h1>

  <div class="card shadow mb-4" style="height: 1000px;">
    <div class="card-header py-3 d-flex justify-content-between">
      <div class="d-block color-black">
        <h4 class="m-0 font-weight-bold"><?= $archive['title'] ?></h4>
        <p>Kategori: <?= $archive['category'] ?></p>
      </div>
      <?php $lastUpdate = date_create($archive['updated_at']); ?>
      <p><span>Terakhir diubah: <?= date_format($lastUpdate, 'l\, jS F Y \a\t g:ia') ?></span></p>
    </div>
    <div class="card-body">
      <a href="<?= base_url('archive/download/'.$archive['id']) ?>">Klik untuk mengunduh dokumen</a><br>
      <?php $extension = pathinfo($archive['document'], PATHINFO_EXTENSION); ?>
      <?php if ($extension == 'png' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'webp') : ?>
        <img src="<?= base_url('document/'. $archive['document']) ?>" class="img-fluid" alt="<?= $archive['document'] ?>" style="border: 2px solid black;">
      <?php elseif ($extension == 'doc' || $extension == 'docx' || $extension == 'xls' || $extension == 'xlsx' || $extension == 'ppt' || $extension == 'pptx') : ?>
        <p>Format file Microsoft Office tidak didukung untuk ditampilkan, Silahkan convert kedalam format pdf atau unduh dokumen pada link diatas</p>
      <?php elseif ($extension == 'pdf') : ?>
        <div id="viewPDF"></div>
      <?php else : ?>
        <p>Format file tidak didukung untuk ditampilkan</p>
      <?php endif ?>
    </div>
  </div>

</div>

<?php if ($extension == 'pdf') : ?>
  <!-- PDF Object -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.min.js"></script>
  <script>
    if(PDFObject.supportsPDFs){
      PDFObject.embed("<?= base_url('document/'. $archive['document']) ?>", "#viewPDF");
    } else {
      document.querySelector('#eviewPDF').innerHTML = 'Browser yang digunakan tidak mendukung penampil PDF'
    }
  </script>
<?php endif ?>

<!-- /.container-fluid -->
<?= $this->endSection() ?>

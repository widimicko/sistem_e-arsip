<?= $this->extend('templates/index') ?>


<?= $this->section('page-content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Edit Arsip</h1>

  <?php if(session()->getFlashData('tx_success_message')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashData('tx_success_message'); ?>
    </div>
  <?php elseif(session()->getFlashData('tx_error_message')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashData('tx_error_message'); ?>
    </div>
  <?php endif ?>

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <form action="<?= base_url('archive/update/'. $archive['id']) ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <div class="form-horizontal">
          <div class="form-group">
            <label>Judul</label>
            <input type="text" name="title" class="form-control form-control-user <?= session('errors.title') ? 'is-invalid' : '' ?>" value="<?= $archive['title'] ?>" required>
            <div class="invalid-feedback">
              <?= session('errors.title') ?>
            </div>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="category" class="form-control form-control-user <?= session('errors.category') ? 'is-invalid' : '' ?>" value="<?= $archive['category'] ?>" required>
            <div class="invalid-feedback">
              <?= session('errors.category') ?>
            </div>
          </div>
          <div class="form-group">
            <label>Dokumen (Saat ini: <?= $archive['document'] ?>)</label>
            <input class="form-control-file <?= session('errors.document') ? 'is-invalid' : '' ?>" type="file" name="document">
            <div class="invalid-feedback">
              <?= session('errors.document') ?>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-10">
              <a href="<?= base_url('/archive') ?>" class="btn btn-default btn-flat"><span class="fa fa-arrow-left"></span> Kembali</a>
              <button type="submit" class="btn btn-primary btn-flat"><span class="fa fa-save"></span> Simpan Perubahan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
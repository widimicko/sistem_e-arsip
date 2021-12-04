<?= $this->extend('templates/index') ?>


<?= $this->section('page-content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Pengelolaan Arsip</h1>

  <?php if(session()->getFlashData('tx_success_message')) : ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashData('tx_success_message'); ?>
    </div>
  <?php elseif(session()->getFlashData('tx_error_message')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashData('tx_error_message'); ?>
    </div>
  <?php endif ?>
  <?= view('Myth\Auth\Views\_message_block') ?>

  <!-- DataTales -->
  <div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Data Arsip</h6>
      <a href="<?= base_url('archive/add')?>" class="btn btn-primary">+ Tambah</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>              
              <th>Dokumen</th>
              <th>Kategori</th>
              <th>Dibuat pada</th>
              <th>Diubah pada</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($archives as $archive) : ?>
            <?php $createdDate =  date_create($archive['created_at']); $updatedDate =  date_create($archive['updated_at']); ?>
              <tr>              
                <td><?= $i++ ?></td>              
                <td><?= $archive['title'] ?></td>              
                <td><?= $archive['document'] ?></td>
                <td><?= $archive['category'] ?></td>
                <td><?= date_format($createdDate, 'jS M Y') ?></td>
                <td><?= date_format($updatedDate, 'jS M Y') ?></td>
                <td>
                  <a href="<?= base_url('archive/detail/'. $archive['id']) ?>" class="btn btn-info">Lihat</a>
                  <a href="<?= base_url('archive/edit/'. $archive['id']) ?>" class="btn btn-warning">Ubah</a>
                  <a href="<?= base_url('archive/delete/'. $archive['id']) ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
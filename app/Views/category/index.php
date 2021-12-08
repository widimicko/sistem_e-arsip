<?= $this->extend('templates/index') ?>


<?= $this->section('page-content') ?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Pengelolaan Kategori</h1>

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
      <h6 class="m-0 font-weight-bold text-primary">Tabel Data Kategori</h6>
      <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createModal">+ Tambah</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="categories-table table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>No</th>
              <th class="d-none">ID</th>
              <th>Kategori</th>              
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($categories as $category) : ?>
              <tr>              
                <td><?= $i++ ?></td>
                <td class="d-none"><?= $category['id'] ?></td>         
                <td><?= $category['name'] ?></td>              
                <td>
                  <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editModal">Ubah</a>
                  <a href="<?= base_url('category/delete/'. $category['id']) ?>" class="btn btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Create Modal-->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="<?= base_url('/category/create') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah Kategori</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <?= csrf_field() ?>
          <div class="form-group">
            <label>Kategori</label>
            <input type="text" class="form-control" name="category" required>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Modal-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="editForm" method="POST">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <?= csrf_field() ?>
            <div class="form-group">
              <label>Kategori</label>
              <input type="text" id="input-edit-category" class="form-control " name="category" required>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
      </div>
    </form>
  </div>
</div>

<script>
  // Table onRowClick event
  const table = document.querySelector(".categories-table")

  if (table) {
    for (let i = 0; i < table.rows.length; i++) {
      table.rows[i].onclick = function() {
        getDataRow(this)
      }
    }
  }

  function getDataRow(tableRow) {
    // Get row data
    const id = tableRow.childNodes[3].innerHTML
    const name = tableRow.childNodes[5].innerHTML

    console.log(id, name)

    // set to modal
    document.getElementById('editForm').setAttribute('action', `${window.location.origin}/category/update/${id}`)
    document.getElementById('input-edit-category').setAttribute("value", name)
  }
</script>

</div>
<!-- /.container-fluid -->
<?= $this->endSection() ?>
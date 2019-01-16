<div class="container mt-3">

    <div class="row">
        <div class="col-lg-6">
            <?php Flasher::flash();?>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-6">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary tombolTambahData" data-toggle="modal" data-target="#formModal">
                Tambah data mahasiswa
            </button>    
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-lg-6">
            <form action="<?= BASE_URL;?>/mahasiswa/search" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="cari mahasiswa..." name="keyword" id="keyword" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="buttonSearch">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">    
        <div class="col-lg-6">
            <h2>Data Mahasiswa</h2>
            <ul class="list-group">
                <?php foreach($data['mahasiswa'] as $mhs) : ?>
                    <li class="list-group-item">
                        <?= $mhs['nama'];?>
                        <a href='<?= BASE_URL;?>/mahasiswa/delete/<?= $mhs['id'];?>' class='badge badge-danger float-right ml-1' onclick="return confirm('Kamu yakin ingin menghapus?');">delete</a>
                        <a href='<?= BASE_URL;?>/mahasiswa/update/<?= $mhs['id'];?>' class="badge badge-success float-right ml-1 tampilModalUbah" data-toggle="modal" data-target="#formModal" data-id="<?= $mhs['id'];?>">change</a>
                        <a href='<?= BASE_URL;?>/mahasiswa/detail/<?= $mhs['id'];?>' class='badge badge-primary float-right ml-2'>detail</a>
                    </li>
                <?php endforeach;?>                
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModalLabel">Tambah data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form method="post" action="<?= BASE_URL;?>/mahasiswa/create">
        <div class="modal-body">
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder=""/>
            </div>
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="number" class="form-control" id="nim" name="nim" placeholder=""/>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder=""/>
            </div>
            <div class="form-group">
                <label for="jurusan">Jurusan</label>
                <select class="form-control" id="jurusan" name="jurusan">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Teknik Industri">Teknik Industri</option>
                    <option value="Teknik Komputer">Teknik Komputer</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Ilmu Komputer">Ilmu Komputer</option>
                </select>
            </div>
            <input type="hidden" name="id" id="id"/>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan data</button>
        </div>
    </form>
    </div>
  </div>
</div>
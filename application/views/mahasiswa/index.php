<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <?php foreach($this->session->flashdata() as $f => $m) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data <strong><?=$m; $this->session->unmark_flash($f); ?></strong> di<?=$f ?>!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endforeach?>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-6">
            <a class="btn btn-primary" href="<?=$base ?>mahasiswa/tambah">Tambah data mahasiswa</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <form action="" method="POST">
                <div class="input-group">
                    <input value="<?=isset($keyword) ? $keyword : ''?>" id="keyword" name="keyword" type="text" class="form-control" placeholder="Cari mahasiswa">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
                    <button class="btn btn-outline-secondary" type="button" id="reset">Clear</button>
                    <script>
                        document.getElementById('reset').onclick = function(){
                            document.getElementById('keyword').value = '';
                            document.getElementById('keyword').focus();
                        }
                    </script>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <h3>Daftar Mahasiswa</h3>
            <?php if(empty($mahasiswa)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>Data mahasiswa tidak tersedia.</p>
                </div>
            <?php else: ?>
                <ul class="list-group">
                    <?php foreach($mahasiswa as $mhs) : ?>
                        <li class="list-group-item d-flex w100 justify-content-between">
                            <div class="nama">
                                <?=$mhs['nama'] ?>
                            </div>
                            <div class="aksi">
                                <a href="<?=$base ?>mahasiswa/detail/<?=$mhs['id'] ?>" class="badge bg-primary text-decoration-none">Detail</a>
                                <a href="<?=$base ?>mahasiswa/edit/<?=$mhs['id'] ?>" class="badge bg-warning text-decoration-none">Edit</a>
                                <a onclick="return confirm('Hapus data?')" href="<?=$base ?>mahasiswa/hapus/<?=$mhs['id'] ?>" class="badge bg-danger text-decoration-none">Hapus</a>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </div>
    </div>
</div>
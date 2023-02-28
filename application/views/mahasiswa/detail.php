<div class="container">
    <div class="row mt-3">
        <?php if(isset($error)) : ?>
            <p>Data tidak ditemukan</p>
        <?php else : ?>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Detail Mahasiswa
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$mahasiswa['nama'] ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?=$mahasiswa['email'] ?></h6>
                        <p class="card-text"><?=$mahasiswa['nim'] ?></p>
                        <p class="card-text"><?=$prodi['nama'] ?></p>
                        <a href="<?=base_url() ?>mahasiswa" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>
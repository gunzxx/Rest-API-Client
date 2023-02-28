<div class="container">
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Form Tambah Data Mahasiswa
                </div>
                <div class="card-body">
                    <!-- <?php if(validation_errors()) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?=validation_errors() ?>
                        </div>
                    <?php endif ?> -->
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                            <div id="emailHelp" class="form-text text-danger"><?=form_error('nama') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="number" class="form-control" id="nim" name="nim">
                            <div id="emailHelp" class="form-text text-danger"><?=form_error('nim') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email">
                            <div id="emailHelp" class="form-text text-danger"><?=form_error('email') ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <select name="prodi" id="prodi" class="form-select">
                                <?php foreach($prodi as $p) : ?>
                                    <option value="<?=$p['id'] ?>"><?=$p['nama'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <button type="submit" name="tambah" class="btn btn-primary float-end">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
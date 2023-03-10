<?= $this->extend('admin/dashboard/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2><?= $title; ?></h2>
    </div>
    <div class="panel-body">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <form action="<?php echo base_url('/admin/logo-config/save-logo') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="logo" class="form-control" value="<?= $config[0]['logo']; ?>">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Unggah Logo Baru</label>
                        <input type="file" name="logo" class="form-control <?= ($validation->hasError('logo')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('logo'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/default.png" class="img-thumbnail img-preview">
                        <div class="alert alert-warning">
                            <i>
                                <strong>Rekomendasi Ukuran Gambar (dalam pixels) :</strong><br>
                                <strong>Kecil</strong> : 640 x 431<br>
                                <strong>Besar</strong> : 1920 x 1295 (atau lebih dari ukuran tsb)<br>
                            </i>
                        </div>
                    </div>
                </div>

                <label>Logo saat ini:</label><br>
                <img src="<?= base_url(); ?>/uploaded/images/<?= $config[0]['logo']; ?>" width="200px">
        </div>

        <div class="col-md-12">
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
        </div>
        </form>

    </div>
</div>
</div>
<?= $this->endSection(); ?>
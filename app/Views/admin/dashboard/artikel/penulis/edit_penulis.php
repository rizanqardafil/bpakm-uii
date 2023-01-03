<?= $this->extend('admin/dashboard/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2><?= $title; ?></h2>
    </div>
    <div class="panel-body">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
        <?php endif; ?>

        <script src="<?php echo base_url() ?>/admin/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            tinymce.init({
                file_browser_callback: function(field, url, type, win) {
                    tinyMCE.activeEditor.windowManager.open({
                        file: '<?php echo base_url() ?>/admin/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
                        title: 'KCFinder',
                        width: 700,
                        height: 500,
                        inline: true,
                        close_previous: false
                    }, {
                        window: win,
                        input: field
                    });
                    return false;
                },
                selector: "#isi",
                height: 250,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        </script>

        <style>
            .img-thumbnail {
                margin: 20px 0;
                height: 150px;
                width: 150px;
                object-fit: cover;
            }
        </style>

        <form action="<?php echo base_url('/admin/penulis/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <input type="hidden" name="slug_penulis" class="form-control" value="<?= $writer['slug_penulis']; ?>">
                    <input type="hidden" name="path_gambar" class="form-control" value="<?= $writer['path_gambar']; ?>">
                </div>

                <div class="form-group input-group-lg">
                    <label>Nama Penulis</label>
                    <input type="text" name="nama_penulis" class="form-control <?= ($validation->hasError('nama_penulis')) ? 'is-invalid' : '' ?>" value="<?= (old('nama_penulis')) ?? $writer['nama_penulis']; ?>" required placeholder="Nama Penulis">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_penulis'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Profil Penulis</label>
                    <input type="file" name="path_gambar" class="form-control <?= ($validation->hasError('path_gambar')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('path_gambar'); ?>
                    </div>
                    <img src="<?= base_url(); ?>/uploaded/images/<?= $writer['path_gambar']; ?>" class="img-thumbnail img-preview">
                    <div class="alert alert-warning">
                        <i>
                            <strong>Rekomendasi Ukuran Gambar (dalam pixels) :</strong><br>
                            <strong>Kecil</strong> : 640 x 431<br>
                            <strong>Besar</strong> : 1920 x 1295 (atau lebih dari ukuran tsb)<br>
                        </i>
                    </div>
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Ubah" class="btn btn-primary">
                    <a href="<?php echo base_url('admin/penulis/') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>
</div>

</form>
</div>
</div>

<?= $this->endSection(); ?>
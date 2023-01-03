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

        <form action="<?php echo base_url('/admin/laporan/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <label>Nama Laporan</label>
                    <input type="text" name="nama_laporan" class="form-control <?= ($validation->hasError('nama_laporan')) ? 'is-invalid' : '' ?>" value="<?= old('nama_laporan'); ?>" required placeholder="Nama Laporan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_laporan'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Laporan Pertanggung Jawaban</label>
                    <input type="file" name="path_laporan" class="form-control <?= ($validation->hasError('path_laporan')) ? 'is-invalid' : '' ?>" id="path_laporan" onchange="previewDocs()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('path_laporan'); ?>
                    </div>
                    <!-- <img src="../../images/bangunan.jpeg" class="img-thumbnail img-preview"> -->
                    <!-- <div class="alert alert-warning">
                        <i>
                            <strong>Image Size</strong> : 1140px X 400px<br>
                        </i>
                    </div> -->
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default">
                    <a href="<?php echo base_url('admin/laporan') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>

    </form>
</div>
</div>

<?= $this->endSection(); ?>
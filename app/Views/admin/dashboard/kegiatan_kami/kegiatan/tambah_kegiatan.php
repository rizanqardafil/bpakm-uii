<?= $this->extend('admin/dashboard/layout/template'); ?>

<?= $this->section('content'); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2><?= $title; ?></h2>
    </div>
    <div class="panel-body">
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

        <form action="<?= base_url('/admin/kegiatan-kami/save'); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <label>Nama Kegiatan</label>
                    <input type="text" name="judul" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : '' ?>" value="<?= old('judul'); ?>" required placeholder="Nama Kegiatan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Keterangan Kegiatan</label>
                    <textarea name="sub_judul" rows="6" class="form-control <?= ($validation->hasError('sub_judul')) ? 'is-invalid' : '' ?>" placeholder="Isi keterangan singkat mengenai Kegiatan tersebut..."><?= old('sub_judul'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('sub_judul'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Gambar Kegiatan</label>
                    <input type="file" name="image" class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('image'); ?>
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
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default">
                    <a href="<?php echo base_url('admin/kegiatan-kami') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>

    </form>
</div>
</div>

<?= $this->endSection(); ?>
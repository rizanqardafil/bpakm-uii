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

        <form action="<?php echo base_url('/admin/artikel/save') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <label>Pilihan Penulis</label>
                    <select name="id_penulis" class="form-control">
                        <?php foreach ($writers as $writer) : ?>
                            <option value="<?= $writer['id_penulis']; ?>" <?= (old('id_penulis') == $writer['id_penulis']) ? 'selected' : ''; ?>><?= $writer['nama_penulis']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group input-group-lg">
                    <label>Judul Artikel</label>
                    <input type="text" name="judul_artikel" class="form-control <?= ($validation->hasError('judul_artikel')) ? 'is-invalid' : '' ?>" value="<?= old('judul_artikel'); ?>" required placeholder="Judul Artikel">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul_artikel'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Isi Artikel</label>
                    <textarea name="isi_artikel" id="isi_artikel" class="form-control <?= ($validation->hasError('isi_artikel')) ? 'is-invalid' : '' ?>" required>
                        <?= old('isi_artikel'); ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_artikel'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Cover Artikel</label>
                    <input type="file" name="path_gambar" class="form-control <?= ($validation->hasError('path_gambar')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('path_gambar'); ?>
                    </div>
                    <img src="<?= base_url(); ?>/uploaded/images/default.png" class="img-thumbnail img-preview">
                    <div class="alert alert-warning">
                        <i>
                            <strong>Rekomendasi Ukuran Gambar (dalam pixels) :</strong><br>
                            <strong>Besar</strong> : 1920 x 1295 (atau lebih dari ukuran tsb)<br>
                        </i>
                    </div>
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default">
                    <a href="<?php echo base_url('admin/artikel/') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>
</div>

</form>
</div>
</div>

<?= $this->endSection(); ?>
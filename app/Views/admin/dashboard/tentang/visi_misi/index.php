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
            <script src="<?= base_url(); ?>/admin/tinymce/js/tinymce/tinymce.min.js"></script>
            <script type="text/javascript">
                tinymce.init({
                    file_browser_callback: function(field, url, type, win) {
                        tinyMCE.activeEditor.windowManager.open({
                            file: '<?= base_url(); ?>/admin/kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
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
                    selector: "#about",
                    height: 250,
                    plugins: [
                        "advlist autolink lists link image charmap print preview anchor",
                        "searchreplace visualblocks code fullscreen",
                        "insertdatetime media table contextmenu paste"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                });
            </script>

            <form action="<?php echo base_url('/admin/tentang-kami/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <input type="hidden" name="slug_visi_misi" value="<?= $visi_misi[0]['slug_visi_misi']; ?>">
                <input type="hidden" name="path_gambar_visi" value="<?= $visi_misi[0]['path_gambar_visi']; ?>">
                <input type="hidden" name="path_gambar_misi" value="<?= $visi_misi[0]['path_gambar_misi']; ?>">

                <div class="form-group input-group-lg">
                    <label>Keterangan Visi</label>
                    <textarea name="isi_visi" id="isi_visi" class="form-control <?= ($validation->hasError('isi_visi')) ? 'is-invalid' : '' ?>" required>
                        <?= old('isi_visi') ?: $visi_misi[0]['isi_visi']; ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_visi'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Keterangan Misi</label>
                    <textarea name="isi_misi" id="isi_misi" class="form-control <?= ($validation->hasError('isi_misi')) ? 'is-invalid' : '' ?>" required>
                        <?= old('isi_misi') ?: $visi_misi[0]['isi_misi']; ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_misi'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Gambar Visi</label>
                        <input type="file" name="path_gambar_visi" class="form-control <?= ($validation->hasError('path_gambar_visi')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('path_gambar_visi'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/<?= ($visi_misi[0]['path_gambar_visi']) ?: 'default.png'; ?>" class="img-thumbnail img-preview">
                        <div class="alert alert-warning">
                            <i>
                                <strong>Rekomendasi Ukuran Gambar (dalam pixels) :</strong><br>
                                <strong>Kecil</strong> : 640 x 431<br>
                                <strong>Besar</strong> : 1920 x 1295 (atau lebih dari ukuran tsb)<br>
                            </i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Gambar Misi</label>
                        <input type="file" name="path_gambar_misi" class="form-control <?= ($validation->hasError('path_gambar_misi')) ? 'is-invalid' : '' ?>" id="file2" onchange="previewImage2()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('path_gambar_misi'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/<?= ($visi_misi[0]['path_gambar_misi']) ?: 'default.png'; ?>" class="img-thumbnail img-preview2">
                        <div class="alert alert-warning">
                            <i>
                                <strong>Rekomendasi Ukuran Gambar (dalam pixels) :</strong><br>
                                <strong>Kecil</strong> : 640 x 431<br>
                                <strong>Besar</strong> : 1920 x 1295 (atau lebih dari ukuran tsb)<br>
                            </i>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>

            </form>


        </div>
    </div>
</div>



<?= $this->endSection(); ?>
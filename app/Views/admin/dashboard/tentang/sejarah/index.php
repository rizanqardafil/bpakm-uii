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

            <form action="<?php echo base_url('/admin/sejarah/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug_sejarah" value="<?= $sejarah[0]['slug_sejarah']; ?>">
                <input type="hidden" name="path_gambar_sejarah" value="<?= $sejarah[0]['path_gambar_sejarah']; ?>">
                <input type="hidden" name="path_gambar_logo" value="<?= $sejarah[0]['path_gambar_logo']; ?>">

                <div class="form-group input-group-lg">
                    <label>Keterangan Sejarah BPA KM UII</label>
                    <textarea name="isi_sejarah" id="isi_sejarah" class="form-control <?= ($validation->hasError('isi_sejarah')) ? 'is-invalid' : '' ?>" required>
                        <?= old('isi_sejarah') ?: $sejarah[0]['isi_sejarah']; ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_sejarah'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Keterangan Filosofi Logo BPA KM UII</label>
                    <textarea name="isi_logo" id="isi_logo" class="form-control <?= ($validation->hasError('isi_logo')) ? 'is-invalid' : '' ?>" required>
                        <?= old('isi_logo') ?: $sejarah[0]['isi_logo']; ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('isi_logo'); ?>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Gambar Sejarah</label>
                        <input type="file" name="path_gambar_sejarah" class="form-control <?= ($validation->hasError('path_gambar_sejarah')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('path_gambar_sejarah'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/<?= ($sejarah[0]['path_gambar_sejarah']) ?: 'default.png'; ?>" class="img-thumbnail img-preview">
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
                        <label>Upload Gambar Logo</label>
                        <input type="file" name="path_gambar_logo" class="form-control <?= ($validation->hasError('path_gambar_logo')) ? 'is-invalid' : '' ?>" id="file2" onchange="previewImage2()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('path_gambar_logo'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/<?= ($sejarah[0]['path_gambar_logo']) ?: 'default.png'; ?>" class="img-thumbnail img-preview2">
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
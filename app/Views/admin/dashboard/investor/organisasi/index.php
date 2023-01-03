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

            <form action="<?php echo base_url('/admin/organisasi/save') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug_organisasi" value="<?= $org[0]['slug_organisasi']; ?>">
                <input type="hidden" name="image" value="<?= $org[0]['image']; ?>">

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Organisasi</label>
                        <input type="text" name="nama" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" value="<?= (old('nama')) ?? $org[0]['nama']; ?>" required placeholder="Nama Organisasi">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Struktur Organisasi</label>
                        <textarea name="keterangan" rows="6" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>" placeholder="Isi keterangan mengenai struktur organisasi..."><?= (old('keterangan')) ?? $org[0]['keterangan']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('keterangan'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Upload Struktur Organisasi</label>
                        <input type="file" name="image" class="form-control <?= ($validation->hasError('image')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('image'); ?>
                        </div>
                        <img src="<?= base_url(); ?>/uploaded/images/<?= $org[0]['image']; ?>" class="img-thumbnail img-preview">
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
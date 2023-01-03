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

            <form action="<?php echo base_url('admin/config/save-config') ?>" method="post">
                <div class="col-md-6">
                    <h3>Pengaturan Umum</h3>
                    <hr>
                    <div class="form-group">
                        <label>Nama Website</label>
                        <input type="text" name="namaweb" placeholder="Nama Website" value="<?= (old('namaweb')) ?? $config[0]['namaweb']; ?>" required class="form-control <?= ($validation->hasError('namaweb')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('namaweb'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" placeholder="Email" value="<?= (old('email')) ?? $config[0]['email']; ?>" required class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Nomor Telepon (whatsapp)</label>
                        <input type="text" name="telepon" placeholder="Format nomor telepon: 08xxxxxx" value="<?= (old('telepon')) ?? $config[0]['telepon']; ?>" required class="form-control <?= ($validation->hasError('telepon')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('telepon'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Link Google Drive Untuk Laporan Pertanggung Jawaban</label>
                        <input type="text" name="link_drive_laporan" placeholder="Format link google drive https://drive.google.com/file/" value="<?= (old('link_drive_laporan')) ?? $config[0]['link_drive_laporan']; ?>" required class="form-control <?= ($validation->hasError('link_drive_laporan')) ? 'is-invalid' : '' ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('link_drive_laporan'); ?>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h3>Modul SEO (<i>Search Engine Optimization</i>)</h3>
                    <hr>
                    <div class="form-group">
                        <label>keyword (<i>Google search keyword</i>)</label>
                        <textarea name="keyword" rows="3" class="form-control <?= ($validation->hasError('keyword')) ? 'is-invalid' : '' ?>" placeholder="Kata kunci / keyword"><?= (old('keyword')) ?? $config[0]['keyword']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('keyword'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Metatext (Ex : Deskripsi)</label>
                        <textarea name="metatext" rows="5" class="form-control <?= ($validation->hasError('metatext')) ? 'is-invalid' : '' ?>" placeholder="Kode metatext"><?= (old('metatext')) ?: $config[0]['metatext']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('metatext'); ?>
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
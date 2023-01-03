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

        <form action="<?php echo base_url('/admin/produk/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <input type="hidden" name="slug_produk" class="form-control" value="<?= $product[0]->slug_produk; ?>">
                    <input type="hidden" name="path_gambar_cover" class="form-control" value="<?= $product[0]->path_gambar_cover; ?>">
                </div>
                <div class="form-group input-group-lg">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : '' ?>" value="<?= (old('nama_produk')) ?? $product[0]->nama_produk; ?>" required placeholder="Nama Produk">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_produk'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Detail Produk</label>
                    <textarea name="detail_produk" id="detail_produk" class="form-control <?= ($validation->hasError('detail_produk')) ? 'is-invalid' : '' ?>" required>
                        <?= (old('detail_produk')) ?? $product[0]->detail_produk; ?>
                    </textarea>
                    <div class="invalid-feedback">
                        <?= $validation->getError('detail_produk'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Kontak WA</label>
                    <input type="text" name="kontak" class="form-control <?= ($validation->hasError('kontak')) ? 'is-invalid' : '' ?>" value="<?= (old('kontak')) ?? $product[0]->kontak; ?>" placeholder="Format kontak WA: 08xxxxxx">
                    <div class="invalid-feedback">
                        <?= $validation->getError('kontak'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Upload Cover Produk</label>
                    <input type="file" name="path_gambar_cover" class="form-control <?= ($validation->hasError('path_gambar_cover')) ? 'is-invalid' : '' ?>" id="file" onchange="previewImage()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('path_gambar_cover'); ?>
                    </div>
                    <img src="<?= base_url(); ?>/uploaded/images/<?= $product[0]->path_gambar_cover; ?>" class="img-thumbnail img-preview">
                    <div class="alert alert-warning">
                        <i>
                            <strong>Image Size</strong> : 1140px X 400px<br>
                        </i>
                    </div>
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Ubah" class="btn btn-primary">
                    <a href="<?php echo base_url('admin/produk/') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>

    </form>
</div>
</div>

<?= $this->endSection(); ?>
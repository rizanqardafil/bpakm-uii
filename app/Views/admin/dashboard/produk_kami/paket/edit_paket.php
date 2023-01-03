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

        <form action="<?php echo base_url('/admin/paket/update') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <input type="hidden" name="slug_paket" class="form-control" value="<?= $package[0]->slug_paket; ?>">
                </div>
                <div class="form-group input-group-lg">
                    <label>Nama Paket</label>
                    <input type="text" name="nama_paket" class="form-control <?= ($validation->hasError('nama_paket')) ? 'is-invalid' : '' ?>" value="<?= (old('nama_paket')) ?? $package[0]->nama_paket; ?>" required placeholder="Nama Paket">
                    <div class="invalid-feedback">
                        <?= $validation->getError('nama_paket'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Produk Untuk Paket</label>
                    <select name="id_produk" class="form-control">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product->id_produk; ?>" <?= (((old('id_produk')) ?? $package[0]->id_produk) == $product->id_produk) ? 'selected' : ''; ?>><?= $product->nama_produk; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group input-group-lg">
                    <label>Harga Paket</label>
                    <input type="number" name="harga" class="form-control <?= ($validation->hasError('harga')) ? 'is-invalid' : '' ?>" value="<?= (old('harga')) ?? $package[0]->harga; ?>" required placeholder="Harga Paket">
                    <div class="invalid-feedback">
                        <?= $validation->getError('harga'); ?>
                    </div>
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Ubah" class="btn btn-primary">
                    <a href="<?php echo base_url('admin/paket') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>

    </form>
</div>
</div>


<?= $this->endSection(); ?>
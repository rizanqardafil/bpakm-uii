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

        <?php
        date_default_timezone_set('UTC');

        $date = date('Y-m-d H:i:s');
        ?>
        <form action="<?php echo base_url('/admin/pesanan/save') ?>" method="post">
            <?= csrf_field(); ?>
            <div class="col-md-12">
                <div class="form-group input-group-lg">
                    <label>Tanggal Pinjam</label>
                    <input type="date" id="tanggalPeminjaman" name="tanggal_pinjam" class="form-control <?= ($validation->hasError('tanggal_pinjam')) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_pinjam'); ?>" min=<?= $date; ?>>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_pinjam'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Tanggal Kembali</label>
                    <input type="date" id="tanggalPengembalian" name="tanggal_kembali" class="form-control <?= ($validation->hasError('tanggal_kembali')) ? 'is-invalid' : '' ?>" value="<?= old('tanggal_kembali'); ?>" min=<?= $date; ?>>
                    <div class="invalid-feedback">
                        <?= $validation->getError('tanggal_kembali'); ?>
                    </div>
                </div>
                <div class="form-group input-group-lg">
                    <label>Produk Untuk Pesanan</label>
                    <select name="id_produk" class="form-control">
                        <?php foreach ($products as $product) : ?>
                            <option value="<?= $product->id_produk; ?>" <?= (old('id_produk') == $product->id_produk) ? 'selected' : ''; ?>><?= $product->nama_produk; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group"><br>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                    <input type="reset" name="reset" value="Reset" class="btn btn-default">
                    <a href="<?php echo base_url('admin/pesanan/') ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
    </div>

    </form>
</div>
</div>


<?= $this->endSection(); ?>

<?= $this->section('scripts'); ?>
<script>
    $(document).ready(function() {
        datePemesanan();
    });
</script>
<?= $this->endSection(); ?>
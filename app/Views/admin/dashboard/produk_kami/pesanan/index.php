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

        <a href="<?php echo base_url('/admin/pesanan/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Pesanan</a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Produk Untuk Pesanan</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <?php $index = 1; ?>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <?= $order->tanggal_pinjam; ?>
                        </td>
                        <td>
                            <?= $order->tanggal_kembali; ?>
                        </td>
                        <td>
                            <!-- Isi dengan Kategori Pesanan -->
                            <?= $order->nama_produk; ?>
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/pesanan/edit/' . $order->id_pesanan); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/pesanan/delete/' . $order->id_pesanan); ?>" method="post" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onClick="return confirm('Apakah anda yakin?')"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<?= $this->endSection(); ?>
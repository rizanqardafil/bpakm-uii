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

        <a href="<?php echo base_url('/admin/gambar/tambah') ?>" class="btn btn-primary spacing"><i class="fa fa-plus"></i> Tambah Gambar Produk</a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="150px">Gambar Produk</th>
                    <th>Nama Gambar</th>
                    <th>Produk Untuk Gambar</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <?php $index = 1; ?>
            <tbody>
                <?php foreach ($images as $image) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <!-- Isi dengan Gambar Produk -->
                            <img class="img-thumbnail" src="<?= base_url(); ?>/uploaded/images/<?= $image->path_gambar; ?>" width="150px">
                        </td>
                        <td>
                            <?= $image->nama_gambar; ?>
                        </td>
                        <td>
                            <?= $image->nama_produk; ?>
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/gambar/edit/' . $image->slug_gambar); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <!-- View Biz -->
                            <form action="<?= base_url('/admin/gambar/delete/' . $image->id_gambar); ?>" method="post" style="display: inline-block;">
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
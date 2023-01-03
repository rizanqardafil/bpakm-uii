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

        <a href="<?php echo base_url('/admin/laporan/tambah') ?>" class="btn btn-<?= ($total_report < 4) ? 'primary' : 'default disabled'; ?> spacing"><i class="fa fa-plus"></i> Tambah Laporan</a>
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>No</th>
                    <th width="150px">File Laporan</th>
                    <th>Nama Laporan</th>
                    <th width="80px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $index = 1; ?>
                <?php foreach ($reports as $report) : ?>
                    <tr class="odd gradeX">
                        <td>
                            <?= $index++; ?>
                        </td>
                        <td>
                            <!-- Isi dengan Gambar Struktur Organisasi -->
                            <?= ($report->path_nama_laporan) ?: 'Belum Mengunggah laporan'; ?>
                            <!-- <img src="" width="150px"> -->
                        </td>
                        <td>
                            <?= $report->nama_laporan; ?>
                        </td>
                        <td class="center">
                            <a href="<?php echo base_url('/admin/laporan/edit/' . $report->slug_laporan); ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                            <form action="<?= base_url('/admin/laporan/delete/' . $report->id_laporan); ?>" method="post" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onClick="return confirm('Apakah anda yakin menghapus dokumen laporan?')"><i class="fa fa-trash"></i></button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<?= $this->endSection(); ?>
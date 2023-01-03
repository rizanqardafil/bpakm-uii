<?= $this->extend('admin/dashboard/layout/template'); ?>

<?= $this->section('content'); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h2><?= $title; ?></h2>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <!-- Content -->
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('message') ?></div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>

            <!--  Modals-->
            <div class="panel-body">
                <p><a class="btn btn-primary" href="<?php echo base_url('/admin/users/tambah') ?>"><i class="fa fa-plus"></i> Tambah Admin</a></p>

                <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">Tambah Admin Baru</h4>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('/admin/users/save'); ?>" method="post">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input name="name" type="text" autofocus required class="form-control" placeholder="Nama Admin" value="<?php echo set_value('name') ?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input name="username" type="text" autofocus required class="form-control" placeholder="Username" value="<?php echo set_value('username') ?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="email" name="email" class="form-control" placeholder="Alamat email" required value="<?php echo set_value('email') ?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required value="<?php echo set_value('password') ?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input type="password" name="repeat_password" class="form-control" placeholder="Ulangi Password" autocomplete="off" required value="<?php echo set_value('repeat_password') ?>">
                                    </div>
                                    <div class="form-group input-group">
                                        <input type="submit" name="submit" value="Save" class="btn btn-primary btn-md">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modals-->

            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Admin</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($users as $user) { ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['username'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td class="center">
                                <a href="<?php echo base_url('/admin/users/' . $user['slug_user']) ?>" class="btn btn-<?= ($user['username'] !== 'admin') ? 'primary' : 'default disabled'; ?>"><i class="fa fa-pencil"></i> Ubah</a>
                                <form action="<?php echo base_url('/admin/users/delete') ?>" method="POST" style="display: inline-block;">
                                    <input type="hidden" value="<?= $user['id_user']; ?>" name="id_user">
                                    <button type="submit" class="btn btn-<?= ($user['username'] !== 'admin') ? 'danger' : 'default disabled'; ?>" onClick="return confirm('Yakin ingin menghapus admin ini?')"><i class="fa fa-trash"></i> Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php $i++;
                    } ?>
                </tbody>
            </table>

            <!-- End content -->

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
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

            <form action="<?php echo base_url('/admin/users/update/' . $user['slug_user']) ?>" method="post">

                <div class="form-group input-group <?= ($validation->hasError('name')) ? 'margin-error' : '' ?>">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="name" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" placeholder="Nama Admin" required value="<?= (old('name')) ?? $user['name']; ?>">
                </div>
                <div class="form-group">
                    <div class="invalid-feedback">
                        <?= $validation->getError('name'); ?>
                    </div>
                </div>
                <div class="form-group input-group <?= ($validation->hasError('email')) ? 'margin-error' : '' ?>">
                    <span class="input-group-addon">@</span>
                    <input type="email" name="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : '' ?>" placeholder="Alamat email" required value="<?= (old('email')) ?? $user['email']; ?>">
                </div>
                <div class="form-group">
                    <div class="invalid-feedback">
                        <?= $validation->getError('email'); ?>
                    </div>
                </div>
                <div class="form-group input-group <?= ($validation->hasError('username')) ? 'margin-error' : '' ?>">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required value="<?= (old('username')) ?? $user['username']; ?>" readonly disabled>
                </div>
                <div class="form-group">
                    <div class="invalid-feedback">
                        <?= $validation->getError('username'); ?>
                    </div>
                </div>
                <div class="form-group input-group <?= ($validation->hasError('password')) ? 'margin-error' : '' ?>">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password Baru" value="<?= old('password'); ?>">
                </div>
                <div class="form-group">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group input-group <?= ($validation->hasError('repeat_password')) ? 'margin-error' : '' ?>">
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                    <input type="password" name="repeat_password" class="form-control <?= ($validation->hasError('repeat_password')) ? 'is-invalid' : '' ?>" placeholder="Ulangi Password" value="<?= old('repeat_password'); ?>">
                </div>
                <div class="form-group">
                    <div class="invalid-feedback">
                        <?= $validation->getError('repeat_password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Ubah" class="btn btn-primary btn-md">
                    <a href="<?php echo base_url('/admin/users/') ?>" class="btn btn-primary"> Kembali</a>
                </div>
            </form>


            <!-- End content -->

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
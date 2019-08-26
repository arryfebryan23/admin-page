<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-md-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <!-- Form Change Password -->
    <div class="row">
        <div class="col-md-8">

            <form method="post" action="<?= base_url('user/changePassword'); ?>">
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="current_password" class="col-sm-3 col-form-label">Current Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                        <?= form_error('current_password', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password1" class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="New Password">
                        <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password2" class="col-sm-3 col-form-label">Repeat Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat new password">
                        <?= form_error('password1', '<small class="text-danger pl-1">', '</small>'); ?>
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End of Begin Page Content -->
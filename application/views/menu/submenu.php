<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg">
            <?= form_error(
                'title',
                '<div class="alert alert-danger" role="alert">',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            ) ?>
            <?= form_error(
                'menu_id',
                '<div class="alert alert-danger" role="alert">',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            ) ?>
            <?= form_error(
                'url',
                '<div class="alert alert-danger" role="alert">',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            ) ?>
            <?= form_error(
                'icon',
                '<div class="alert alert-danger" role="alert">',
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
            ) ?>
            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubmenuModal">Add New Submenu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">URL</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($subMenu as $sm) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $sm['title']; ?></td>
                        <td><?= $sm['menu']; ?></td>
                        <td><?= $sm['url']; ?></td>
                        <td><?= $sm['icon']; ?></td>
                        <td><?= $sm['is_active']; ?></td>
                        <td>
                            <a href="" class="badge badge-primary">edit</a>
                            <a href="<?= base_url('menu/deleteSubMenu/') . $sm['id'] . '/' . $sm['title']; ?>" class="badge badge-danger" onclick="return confirm('Are you sure want to drop this menu?')">delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

</div>
<!-- End of Begin Page Content -->

<!-- Modal -->
<div class="modal fade" id="newSubmenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubmenuModalLabel">Add New Submenu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/subMenu'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="menu_id" class="col-sm-3 col-form-label-sm">Select Menu</label>
                        <div class="col-sm-9">
                            <select name="menu_id" id="menu_id" class="form-control form-control-sm">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="col-sm-3 col-form-label-sm">Submenu Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="title" name="title" placeholder="Submenu Title">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="url" class="col-sm-3 col-form-label-sm">Submenu URL</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="url" name="url" placeholder="Submenu URL">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="icon" class="col-sm-3 col-form-label-sm">Submenu Icon</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="icon" name="icon" placeholder="Submenu icon">
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-sm-1">
                            <input type="checkbox" class="mt-2 form-check-input-sm" value="1" name="is_active" id="is_active" checked>
                        </div>
                        <label for="is_active" class="col-form-label-sm">Active?</label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add New Submenu</button>
                </div>
            </form>
        </div>
    </div>
</div>
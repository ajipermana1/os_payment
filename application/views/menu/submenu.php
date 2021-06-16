<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addNewSubMenuModal">Add New Submenu</a>
    <?= form_error('title', '<div class="alert alert-danger">', '</div>'); ?>
    <?= form_error('menu_id', '<div class="alert alert-danger">', '</div>'); ?>
    <?= form_error('url', '<div class="alert alert-danger">', '</div>'); ?>
    <?= form_error('icon', '<div class="alert alert-danger">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Table Submenu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Menu</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Icon</th>
                            <th>Active Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 0;
                        foreach ($sub_menu as $sm) : $i++; ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $sm['menu']; ?></td>
                                <td><?= $sm['title']; ?></td>
                                <td><?= $sm['url']; ?></td>
                                <td><?= $sm['icon']; ?></td>
                                <td><?= $sm['is_active']; ?></td>
                                <td>
                                    <a href="<?= base_url('menu/editSubMenu/') . $sm['id']; ?>" class="badge badge-success">edit</a>
                                    <a href="<?= base_url('menu/deleteSubMenu/') . $sm['id']; ?>" onclick="return confirm('Yakin?');" class="badge badge-danger">delete</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Title</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active Status</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($sub_menu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active']; ?></td>
                            <td>
                                <a href="<?= base_url('menu/editSubMenu/') . $sm['id']; ?>" class="badge badge-success">edit</a>
                                <a href="<?= base_url('menu/deleteSubMenu/') . $sm['id']; ?>" onclick="return confirm('Yakin?');" class="badge badge-danger">delete</a>
                            </td>

                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                </tbody>
            </table> -->
</div>




<!-- /.container-fluid -->

<!-- End of Main Content -->
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="addNewSubMenuModal" tabindex="-1" aria-labelledby="addNewSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewSubMenuModalLabel">Add Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/submenu'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="New SubMenu">
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Url">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Icon">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" checked>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Submenu</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('menu/edit'); ?>" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>
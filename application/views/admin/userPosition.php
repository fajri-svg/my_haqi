<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title ?>
    </h1> -->
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="row">
            <div class="col-lg">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($alternatif as $d) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $d['name']; ?></td>
                                    <td><?= $d['email']; ?></td>
                                    <td>
                                        <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal"><?= $d['role']; ?></a>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('admin/toggle/') . $d['id_user'] ?>" class="btn btn-icon-split <?= $d['is_active'] ? 'btn-success' : 'btn-secondary' ?>" title="<?= $d['is_active'] ? 'Nonaktifkan User' : 'Aktifkan User' ?>">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-fw fa-power-off"></i>
                                            </span>
                                            <span class="text"><?= $d['nama']; ?></span>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="#" data-toggle="modal" data-target="#deleteModal<?= $d['id_user']; ?>" class="btn btn-danger">Delete</a>
                                        <div class="modal fade" id="deleteModal<?= $d['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">Select "Delete" below if you are sure to delete user: <b><?= $d['id_user'] . ' | ' . $d['name'] ?></b>
                                                        .</div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                        <a class="btn btn-danger" href="<?= base_url('admin/delete/') . $d['id_user'] ?>">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Edit Modal Role User -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Edit Role User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('admin/updateRole'); ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <select name="id_user" class="form-control">
                            <?php foreach ($alternatif as $d) : ?>
                                <option value="<?= $d['id_user']; ?>"><?= $d['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="new_role_id" class="form-control">
                            <!-- Isi dengan role yang diinginkan -->
                            <option value="1">Admin</option>
                            <option value="2">Member</option>
                            <option value="3">Operator</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
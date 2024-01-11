<!-- <div class="container">
<?= validation_errors(); ?>

<form action="<?= base_url(); ?>menu/edit_submenu/<?= $submenu['id']; ?>" method="post">
    <input type="hidden" name="id" value="<?= $submenu['id']; ?>">
    <div class="form-group">
        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $submenu['title']; ?>">
    </div>
</form>
</div> -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php if (validation_errors()) : ?>
            <div class="alert 
            alert-danger" role="alert"><?= validation_errors() ?>
            </div>
        <?php endif ?>

        <!-- Page Heading -->
        <!-- <h1 class="h3 mb-2 text-gray-800">Tables</h1>
    <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('menu/edit_menu/' . $menu['id']); ?>" method="POST">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Menu</th>
                                    <th>Menu</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <!-- Isi tabel -->
                            <tbody>

                                <tr>
                                    <td><input type="text" class="form-control" name="id" value="<?= $menu['id']; ?>" readonly></td>
                                    <td><input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>"></td>
                                    <td>
                                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        <!-- <a href="" class="badge badge-success">edit</a>
                                    <a href="" class="badge badge-danger">delete</a> -->
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
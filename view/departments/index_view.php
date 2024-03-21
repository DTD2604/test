<?php
if (!defined('APP_ROOT_PATH')) {
    die('Can not access');
}

$namePage = 'Department';
?>
<!-- load header view -->
<?php require APP_PATH_VIEW . "partials/header_view.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Department</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php?c=dashboard">Home</a></li>
                        <li class="breadcrumb-item active">List view</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <a class="btn btn-primary" href="index.php?c=department&m=add"> Create new Department</a>
                    <?php if($state === 'delete_success'): ?>
                        <div class="my-3 text_success">Delete department successfully !</div>
                    <?php elseif($state === 'delete_failure'): ?>
                        <div class="my-3 text-danger">Delete department failure !</div>
                    <?php endif; ?>
                    <table class="mt-3 table table-bordered tables-striped">
                        <thead class="table-primary">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Leader</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th width="10%" class="text-center" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($department as $key => $item): ?>
                                <tr>
                                    <td><?= $item['id'];?></td>
                                    <td><?= $item['name'];?></td>
                                    <td width="10%">
                                        <img src="public/uploads/img/<?= $item['logo']; ?>" alt="<?= $item['name'];?>" class="img-fluid">
                                    </td>
                                    <td><?= $item['leader'];?></td>
                                    <td><?= $item['beginning_date'];?></td>
                                    <td><?= $item['status'] == 1 ? 'Active' : 'Deactive';?></td>
                                    <td>
                                        <a href="index.php?c=department&m=edit&id=<?= $item['id'];?>" class="btn btn-info brn-sm">edit</a>
                                    </td>
                                    <td>
                                        <a href="index.php?c=department&m=delete&id=<?= $item['id'];?>" class="btn btn-danger btn-sm">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- load footer view -->
<?php require APP_PATH_VIEW . "partials/footer_view.php"; ?>
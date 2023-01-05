<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Kelas</h4>
                    <div class="row">
                        <div class="col s12">
                            <table id="page-length-option" class="display">
                                <thead>
                                    <tr>
                                        <th>Kode Kelas</th>
                                        <th>Nama Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $val) {
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $val->kode_kelas ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?= $val->kelas ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#modal_edit<?= $val->id ?>">
                                                    <button class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                                                </a>
                                                <a href="<?= base_url("staff/delete_kelas/$val->id") ?>">
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END RIGHT SIDEBAR NAV -->
</div>

<?php foreach ($data as $val) { ?>
    <div id="modal_edit<?= $val->id ?>" class="modal">
        <div class="modal-content">
            <h4>Edit Kelas</h4>
            <form action="<?= base_url("staff/kelas/edit_kelas/$val->id") ?>" method="POST">

            </form>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Disagree</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        </div>
    </div>
<?php } ?>
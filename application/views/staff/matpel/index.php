
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Matpel</h4>
                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add"><i class="fa fa-plus-circle"></i> Tambah Data Matpel</a>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Matpel</th>
                                        <th>Nama Matpel</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($data as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <?= $val->kode_matpel ?>
                                            </td>
                                            <td> <?= $val->matpel ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val->id_matpel ?>"><i class="fa fa-plus-circle"></i> Edit</a>
                                                <a class="waves-effect waves-dark btn modal-trigger mb-2 mr-1" href="#modal_delete<?= $val->id_matpel ?>"><i class="fa fa-plus-circle"></i> Delete</a>
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

<div id="modal_add" class="modal">
    <form action="<?= base_url('staff/add_matpel') ?>" method="POST">
    <div class="modal-content">
        <h4>Tambah Data Matpel</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="fn" name="kode_matpel">
                    <label for="fn">Kode Matpel</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nama_matpel">
                    <label for="fn">Nama Matpel</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
        </div>
    </form>
</div>

<?php foreach ($data as $val) { ?>
<div id="modal_edit<?= $val->id_matpel ?>" class="modal">
    <form action="<?= base_url("staff/edit_matpel/$val->id_matpel") ?>" method="POST">
    <div class="modal-content">
        <h4>Edit Data Matpel</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="fn" name="kode_matpel" value="<?= $val->kode_matpel ?>">
                    <label for="fn">Kode Matpel</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nama_matpel" value="<?= $val->matpel ?>">
                    <label for="fn">Nama Matpel</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
        </div>
    </form>
</div>

<div id="modal_delete<?= $val->id_matpel ?>" class="modal">
    <form action="<?= base_url("staff/delete_matpel/$val->id_matpel") ?>" method="POST">
    <div class="modal-content">
        <h4>Delete Data Matpel</h4>
            <p>Yakin Ingin Menghapus File?</p>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Hapus
                    <i class="material-icons right">send</i>
                </button>
        </div>
    </form>
</div>
<?php } ?>

<script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
<script>
    
$(function() {
    $('.modal').modal();
        
});
</script>
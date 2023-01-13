
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Kelas</h4>
                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add"><i class="fa fa-plus-circle"></i> Tambah Data Kelas</a>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($data as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_detail<?= $val->id_kelas ?>"><i class="fa fa-plus-circle"></i> Detail</a>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val->id_kelas ?>"><i class="fa fa-plus-circle"></i> Edit</a>
                                                <a class="waves-effect waves-dark btn modal-trigger mb-2 mr-1" href="#modal_delete<?= $val->id_kelas ?>"><i class="fa fa-plus-circle"></i> Delete</a>
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
    <form action="<?= base_url('staff/add_kelas') ?>" method="POST">
    <div class="modal-content">
        <h4>Tambah Data Kelas</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nama_kelas">
                    <label for="fn">Nama Kelas</label>
                </div>
                <div class="input-field col s12">
                    <select class="select2 browser-default" multiple="multiple" name="id_matpel[]">
                        <option value=""></option>
                        <?php foreach($matpel as $val) { ?> 
                            <option value="<?= $val->id_matpel ?>"><?= $val->matpel ?></option>    
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</div>
<?php foreach ($data as $val) { 
    $data = $this->db->select('*')
        ->from('detail_kelas')
        ->join('matpel', 'detail_kelas.id_matpel=matpel.id_matpel')
        ->where('id_kelas', $val->id_kelas)->get()->result();
?>
<div id="modal_edit<?= $val->id_kelas ?>" class="modal">
    <form action="<?= base_url("staff/edit_kelas/$val->id_kelas") ?>" method="POST">
    <div class="modal-content">
        <h4>Edit Data Kelas</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nama_kelas" value="<?= $val->kelas ?>">
                    <label for="fn">Nama Kelas</label>
                </div>
                <div class="input-field col s12">
                    <select class="select2<?= $val->id_kelas ?> browser-default" multiple="multiple" name="id_matpel[]">
                        <option value=""></option>
                        <?php foreach($matpel as $x) { ?> 
                            <?php foreach ($data as $t) { ?>
                            <option value="<?= $x->id_matpel ?>" <?= $x->id_matpel == $t->id_matpel ? 'selected' : ''; ?>><?= $x->matpel ?></option>    
                        <?php } 
                    } ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</div>


<div id="modal_detail<?= $val->id_kelas ?>" class="modal">
    <div class="modal-content">
        <h4>Detail Kelas</h4>
            <div class="row">
                <table class="bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Nama MataPelajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach($data as $row) {
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $val->kelas ?></td>
                            <td><?= $row->matpel ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
            </div>
    </div>
</div>

<div id="modal_delete<?= $val->id_kelas ?>" class="modal">
    <form action="<?= base_url("staff/delete_kelas/$val->id_kelas") ?>" method="POST">
    <div class="modal-content">
        <h4>Tambah Data Kelas</h4>
            <p>Yakin Ingin Menghapus File?</p>
            <div class="modal-footer">
                <!-- <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a> -->
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Hapus
                    <i class="material-icons right">send</i>
                </button>
            </div>
    </div>
    </form>
</div>
<?php } ?>


<script src="<?= base_url() ?>app-assets/js/vendors.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/select2/select2.full.min.js"></script>

<script>
$(function() {
    $('.modal').modal();
    $('#modal_add').modal('open');
    $('#modal_add').modal('close');
        
    $(".select2").select2({
        placeholder: "Tambah Matpel",
        dropdownAutoWidth: true,
        dropdownParent: "#modal_add",
        width: '100%',
    });
    
<?php foreach ($data as $val) { ?>
    $(".select2<?= $val->id_kelas ?>").select2({
        placeholder: "Tambah Matpel",
        dropdownAutoWidth: true,
        dropdownParent: "#modal_edit<?= $val->id_kelas ?>",
        width: '100%',
    });
<?php } ?>
});
</script>
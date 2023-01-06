
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Wali Kelas</h4>
                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add"><i class="fa fa-plus-circle"></i> Tambah Data Wali Kelas</a>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Nomor Telpon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($users as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td>
                                                <img src="<?= base_url("foto/$val->pict") ?>" style="width:30px;height:30px;" alt="">
                                            </td>
                                            <td> <?= $val->nik ?> </td>
                                            <td> <?= $val->username ?> </td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td> <?= $val->phone ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val->id_user ?>"><i class="fa fa-plus-circle"></i> Edit</a>
                                                <a class="waves-effect waves-dark btn modal-trigger mb-2 mr-1" href="#modal_delete<?= $val->id_user ?>"><i class="fa fa-plus-circle"></i> Delete</a>
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
    <form action="<?= base_url('staff/user/wali_kelas') ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <h4>Tambah Data Wali Kelas</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="fn" name="username">
                    <label for="fn">Nama Lengkap</label>
                </div>
                <div class="col s12">
                    <select class="select2 browser-default" name="id_kelas">
                        <option value=""></option>
                        <?php foreach($kelas as $row) { ?> 
                        <option value="<?= $row->id_kelas ?>"><?= $row->kelas ?></option>
                        <?php } ?> 
                    </select>
                    <label>Kelas</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nik">
                    <label for="fn">Nomor Induk</label>
                </div>
                <div class="input-field col s12">
                    <input id="phone-code" type="text" name="no_telp">
                    <label for="phone-code"></label>
                </div>
                <div class="input-field col s12">
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                    <input id="confirmPassword" type="password" name="confirmPassword">
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="file" id="input-file-now" name="foto" class="dropify" data-default-file="" />
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

<?php foreach ($users as $val) { ?>
<div id="modal_edit<?= $val->id_user ?>" class="modal">
    <form action="<?= base_url('staff/user/wali_kelas') ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <h4>Tambah Data Wali Kelas</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="id_user" value="<?= $val->id_user ?>"> 
                    <input type="hidden" name="pict" value="<?= $val->pict ?>"> 
                    <input type="text" id="fn" name="username" value="<?= $val->username ?>">
                    <label for="fn">Nama Lengkap</label>
                </div>
                <div class="col s12">
                    <select class="select2-edit<?= $val->id_user ?> browser-default" name="id_kelas">
                        <option value=""></option>
                        <?php foreach($kelas as $row) { ?> 
                        <option value="<?= $row->id_kelas ?>" <?= $val->kelas_id == $row->id_kelas ? 'selected' : '' ?>><?= $row->kelas ?></option>
                        <?php } ?> 
                    </select>
                    <label>Kelas</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="nik" value="<?= $val->nik ?>">
                    <label for="fn">Nomor Induk</label>
                </div>
                <div class="input-field col s12">
                    <input id="phone-code<?= $val->id_user ?>" type="text" name="no_telp" value="<?= $val->phone ?>">
                    <label for="phone-code"></label>
                </div>
                <div class="input-field col s12">
                    <input id="password" type="password" name="password">
                    <label for="password">Password</label>
                </div>
                <div class="input-field col s12">
                    <input id="confirmPassword" type="password" name="confirmPassword">
                    <label for="confirmPassword">Confirm Password</label>
                </div>
                
                <div class="input-field col s12">
                    <input type="file" id="input-file-now" name="foto" class="dropify" data-default-file="<?= base_url("foto/$val->pict") ?>" />
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

<div id="modal_delete<?= $val->id_user ?>" class="modal">
    <form action="<?= base_url("staff/user/wali_kelas") ?>" method="POST">
    <div class="modal-content">
        <h4>Hapus Data Wali Kelas</h4>
            <p>Yakin Ingin Menghapus File?</p>
            <input type="hidden" name="destroy" value="<?= $val->id_user ?>">
            <input type="hidden" name="username" value="<?= $val->username ?>">
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
<script src="<?= base_url() ?>app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/dropify/js/dropify.min.js"></script>
<script>
    
$(function() {
    $('.modal').modal();
    $(".select2").select2({
        /* the following code is used to disable x-scrollbar when click in select input and
        take 100% width in responsive also */
        placeholder: "Pilih Kelas",
        dropdownAutoWidth: true,
        dropdownParent: "#modal_add",
        width: '100%',
    });
    <?php foreach($users as $b) { ?> 
        $(".select2-edit<?= $b->id_user ?>").select2({
            /* the following code is used to disable x-scrollbar when click in select input and
            take 100% width in responsive also */
            placeholder: "Pilih Kelas",
            dropdownAutoWidth: true,
            dropdownParent: "#modal_edit<?= $b->id_user ?>",
            width: '100%',
        });  
        $("#phone-code<?= $b->id_user ?>").formatter({
            'pattern': '+62 {{999}}-{{999}}-{{999}}-{{9999}}',
            'persistent': true
        });  
    <?php } ?>
    $('#phone-code').formatter({
        'pattern': '+62 {{999}}-{{999}}-{{999}}-{{9999}}',
        'persistent': true
    });
    $('.dropify').dropify();
});
</script>
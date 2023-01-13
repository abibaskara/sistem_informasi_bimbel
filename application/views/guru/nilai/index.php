
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Siswa Pada Mata Pelajaran <?= $matpel->matpel ?></h4>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kelas</th>
                                        <th>Nomor Induk</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($siswa as $val) { 
                                        $cek = $this->db->get_where('nilai', [
                                            'id_matpel' => $matpel->id_matpel,
                                            'id_user' => $val->id_user
                                        ])->row();
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td> <?= $val->nik ?> </td>
                                            <td> <?= $val->username ?> </td>
                                            <td> <?= $val->phone ?> </td>
                                            <td>
                                                <?php 
                                                if($cek) { ?> 
                                                Nilai Sudah Di input
                                                <?php } else { ?> 
                                                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add<?= $val->id_user ?>"><i class="fa fa-plus-circle"></i> Beri Nilai</a>    
                                                <?php } ?>
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


<?php foreach($siswa as $val) { ?> 
    
    <div id="modal_add<?= $val->id_user ?>" class="modal">
        <form action="<?= base_url("guru/penilaian/$val->id_kelas") ?>" method="POST">
        <div class="modal-content">
            <h4>Penilaian Siswa/i <?= $val->username ?></h4>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="hidden" name="id_matpel" value="<?= $matpel->id_matpel ?>">
                        <input type="hidden" name="id_user" value="<?= $val->id_user ?>">
                        <input type="text" id="fn" value="<?= $val->username ?>" readonly>
                        <label for="fn">Nama Siswa</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="fn" name="absensi" max="25" required>
                        <label for="fn">Absensi (max. 25)</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="fn" name="tugas" max="100" required>
                        <label for="fn">Tugas (max. 100)</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="fn" name="uts" max="100" required>
                        <label for="fn">UTS (max. 100)</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="number" id="fn" name="uas" max="100" required>
                        <label for="fn">UAS (max. 100)</label>
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
});
</script>

<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>
<?php

    function cek($bulan)
    {
        $CI = get_instance();
        return $CI->db->get_where('tarif_spp', ['bulan' => $bulan])->row();
    }

?>
<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Tarif SPP</h4>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($table as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val ?> </td>
                                            <?php if (cek($val)) { ?>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_show<?= $val ?>"><i class="fa fa-plus-circle"></i> Detail</a>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val ?>"><i class="fa fa-plus-circle"></i> Edit</a>
                                                <a class="waves-effect waves-dark btn modal-trigger mb-2 mr-1" href="#modal_delete<?= $val ?>"><i class="fa fa-plus-circle"></i> Delete</a>
                                            </td>
                                            <?php } else { ?> 
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add<?= $val ?>"><i class="fa fa-plus-circle"></i> AturTarif</a>
                                            </td>
                                            <?php } ?>
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
<?php foreach($table as $row) { ?> 
<div id="modal_add<?= $row ?>" class="modal" style="height:100%">
    <form action="<?= base_url('staff/tarif_spp') ?>" method="POST">
    <div class="modal-content">
        <h4>Atur Tarif SPP Bulan <?= $row ?></h4>
            <div class="row">
                <div class="input-field col s12">
                    <select class="select2-pilihan<?= $row ?> browser-default" name="pilihan_tarif">
                        <option value=""></option>
                        <option value="Ya">Ya</option>
                        <option value="Tidak">Tidak</option>
                    </select>
                </div>
                <div id="tampil_tarif<?= $row ?>"></div>
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


<div id="modal_show<?= $row ?>" class="modal" style="height:100%">
    <div class="modal-content">
        <h4>Detail Tarif SPP Bulan <?= $row ?></h4>
            <div class="row">
                <table class="bordered">
                    <thead>
                        <tr>
                            <th data-field="id">Nama Kelas</th>
                            <th data-field="name">Harga</th>
                            <th data-field="price">Keterangan</th>
                            <th data-field="price">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $CI = get_instance();
                        $bulan = $CI->db->select('*')
                        ->from('tarif_spp')
                        ->join('kelas', 'tarif_spp.id_kelas=kelas.id_kelas')
                        ->where('bulan', $row)
                        ->get()
                        ->result();
                        foreach($bulan as $d) { ?> 
                            <tr>
                                <td><?= $d->kelas ?></td>
                                <td>
                                    <?= $d->harga ?>
                                </td>
                                <td>
                                    <?= $d->keterangan ?>
                                </td>
                                <td>
                                    tombol
                                </td>
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

<div id="modal_edit<?= $row ?>" class="modal" style="height:100%">
    <form action="<?= base_url('staff/tarif_spp') ?>" method="POST">
    <div class="modal-content">
        <h4>Edit Tarif SPP Bulan <?= $row ?></h4>
            <div class="row">
            <table class="bordered">
                <thead>
                    <tr>
                        <th data-field="id">Nama Kelas</th>
                        <th data-field="name">Harga</th>
                        <th data-field="price">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                     $CI = get_instance();
                     $bulan = $CI->db->select('*')
                     ->from('tarif_spp')
                     ->join('kelas', 'tarif_spp.id_kelas=kelas.id_kelas')
                     ->where('bulan', $row)
                     ->get()
                     ->result();
                    foreach($bulan as $c) { ?> 
                        <tr>
                            <td><?= $c->kelas ?></td>
                            <td>
                                <div class="input-field col s12">
                                    
                                    <input type="hidden" id="fn" name="id_tarif[]" value="<?= $c->id_tarif_spp ?>">
                                    <input type="hidden" id="fn" name="bulan" value="<?= $row ?>">
                                    <input type="hidden" id="fn" name="id_kelas[]" value="<?= $c->id_kelas ?>">
                                    <input type="number" id="fn" name="harga[]" value=<?= $c->harga ?>>
                                    <label for="fn">Tarif Perbulan</label>
                                </div>
                            </td>
                            <td>
                                <div class="input-field col s12">
                                    <textarea name="keterangan[]" cols="30" rows="10" id="fn" placeholder="Keterangan Tarif"><?= $c->keterangan ?></textarea>
                                </div>
                                </td>
                        </tr>  
                    <?php } ?>
                </tbody>
            </table>

            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
                <button class="btn cyan waves-effect waves-light right" type="submit" name="action">Update
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </div>
</div>

<div id="modal_delete<?= $row ?>" class="modal">
    <form action="<?= base_url("staff/tarif_spp") ?>" method="POST">
    <div class="modal-content">
        <h4>Hapus Data Siswa</h4>
            <p>Yakin Ingin Menghapus File?</p>
            <input type="hidden" name="destroy" value="<?= $row ?>">
            <input type="hidden" name="bulan" value="<?= $row ?>">
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
    <?php foreach($table as $b) { ?> 

        $(".select2-pilihan<?= $b ?>").select2({
            /* the following code is used to disable x-scrollbar when click in select input and
            take 100% width in responsive also */
            placeholder: "Custom Tarif",
            dropdownAutoWidth: true,
            dropdownParent: "#modal_add<?= $b ?>",
            width: '100%',
        });

        $(".select2-pilihan<?= $b ?>").on('change', function() {
            var val = $(this).val()
            if(val == "Tidak")
            {
                var html = `
                <div class="input-field col s12">
                    <select class="select2<?= $b ?> browser-default" multiple="multiple" name="id_kelas[]">
                        <option value=""></option>
                        <?php foreach($kelas as $val) { ?> 
                            <option value="<?= $val->id_kelas ?>"><?= $val->kelas ?></option>    
                        <?php } ?>
                    </select>
                </div>
                <div class="input-field col s12">
                    <input type="hidden" id="fn" name="bulan" value="<?= $b ?>">
                    <input type="number" id="fn" name="harga">
                    <label for="fn">Tarif Perbulan</label>
                </div>
                <div class="input-field col s12">
                    <textarea name="keterangan" cols="30" rows="10" id="fn" placeholder="Keterangan Tarif"></textarea>
                </div>`

                $("#tampil_tarif<?= $b ?>").html(html);
                
                $(".select2<?= $b ?>").select2({
                    /* the following code is used to disable x-scrollbar when click in select input and
                    take 100% width in responsive also */
                    placeholder: "Pilih Kelas",
                    dropdownAutoWidth: true,
                    dropdownParent: "#modal_add<?= $b ?>",
                    width: '100%',
                });
            } else {
                var html = `
                            <table class="bordered">
                                <thead>
                                    <tr>
                                        <th data-field="id">Nama Kelas</th>
                                        <th data-field="name">Harga</th>
                                        <th data-field="price">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($kelas as $c) { ?> 
                                        <tr>
                                            <td><?= $c->kelas ?></td>
                                            <td>
                                                <div class="input-field col s12">
                                                    <input type="hidden" id="fn" name="bulan" value="<?= $b ?>">
                                                    <input type="hidden" id="fn" name="id_kelas[]" value="<?= $c->id_kelas ?>">
                                                    <input type="number" id="fn" name="harga[]">
                                                    <label for="fn">Tarif Perbulan</label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-field col s12">
                                                    <textarea name="keterangan[]" cols="30" rows="10" id="fn" placeholder="Keterangan Tarif"></textarea>
                                                </div>
                                                </td>
                                        </tr>  
                                    <?php } ?>
                                </tbody>
                            </table>
                `
                $("#tampil_tarif<?= $b ?>").html(html);
            }
        })
    <?php } ?>
});
</script>
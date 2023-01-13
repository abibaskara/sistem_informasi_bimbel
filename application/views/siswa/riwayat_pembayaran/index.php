
<div class="flash-data-success" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<div class="flash-data-info" data-flashdata="<?= $this->session->flashdata('info'); ?>"></div>
<div class="flash-data-error" data-flashdata="<?= $this->session->flashdata('error'); ?>"></div>

<div class="container">

    <!-- Page Length Options -->
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Data Riwayat Pembayaran SPP</h4>
                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_add"><i class="fa fa-plus-circle"></i> Bayar SPP</a>
                    <div class="row mt-4">
                        <div class="col s12">
                            <table id="page-length-option" class="display" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Kelas</th>
                                        <th>Bulan</th>
                                        <th>Grand Total</th>
                                        <th>Sisa Bayar</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i=1;
                                    foreach ($data as $val) { ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td> <?= $val->username ?> </td>
                                            <td> <?= $val->kelas ?> </td>
                                            <td> <?= $val->bulan ?> </td>
                                            <td> <?= $val->grandtotal ?> </td>
                                            <td> <?= $val->sisa_bayar ?> </td>
                                            <td> <?= $val->status ?> </td>
                                            <td>
                                                <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_show<?= $val->id_pembayaran ?>"><i class="fa fa-plus-circle"></i> Detail</a>
                                                <a class="waves-effect waves-light btn mb-2 mr-1" href="<?= base_url("siswa/nota/$val->id_pembayaran") ?>"><i class="fa fa-plus-circle"></i>Nota </a>
                                                <?php if($val->sisa_bayar != 0) { ?> 
                                                    <a class="waves-effect waves-light btn modal-trigger mb-2 mr-1" href="#modal_edit<?= $val->id_pembayaran ?>"><i class="fa fa-plus-circle"></i> Lunasi</a>
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

<div id="modal_add" class="modal">
    <form action="<?= base_url('siswa/riwayat_pembayaran_spp') ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <h4>Bayar SPP Bulanan</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="id_kelas" value="<?= $this->session->kelas_id ?>">
                    <select class="select2 browser-default" name="bulan" id="bulan">
                        <option value="">Pilih Bulan</option>
                        <?php foreach($bulan as $row) { ?> 
                        <option value="<?= $row ?>"><?= $row ?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="grandtotal" id="grandtotal" placeholder="Grand Total">
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="jumlah">
                    <label for="fn">Jumlah Ingin Dibayar (Rp)</label>
                </div>
                <!-- <div class="input-field col s12">
                    </div> -->
                <div class="input-field col s12">
                    <input type="file" id="input-file-now" name="bukti_bayar" class="dropify" data-default-file="" />
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
    
    $detail = $this->db->select('*')
        ->from('pembayaran')
        ->join('detail_pembayaran', 'pembayaran.id_pembayaran=detail_pembayaran.id_pembayaran')
        ->where('detail_pembayaran.id_pembayaran', $val->id_pembayaran)->get()->result();
?>
<div id="modal_show<?= $val->id_pembayaran ?>" class="modal">
    <div class="modal-content">
        <h4>Detail Pembayaran Bulan <?= $val->bulan ?></h4>
            <div class="row">
                <table class="striped" style="text-align: center; width: 100%;">
                    <tbody>
                        <tr>
                            <td style="border: 1px solid black; border-collapse: collapse;">Jumlah Pembayaran SPP Bulan <?= $val->bulan ?></td>
                            <td style="border: 1px solid black; border-collapse: collapse;">Rp. <?= number_format($val->grandtotal); ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="bordered mt-2" style="text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid black; border-collapse: collapse;">No</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Jumlah Bayar</th>
                            <th style="border: 1px solid black; border-collapse: collapse;">Tanggal Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($detail as $d) {
                        ?>
                            <tr>
                                <td style="border: 1px solid black; border-collapse: collapse;"><?= $no++; ?></td>
                                <td style="border: 1px solid black; border-collapse: collapse;">Rp. <?= number_format($d->jumlah) ?></td>
                                <td style="border: 1px solid black; border-collapse: collapse;"><?= $d->tgl_bayar; ?></td>
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

<div id="modal_edit<?= $val->id_pembayaran ?>" class="modal">
    <form action="<?= base_url('siswa/riwayat_pembayaran_spp') ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-content">
        <h4>Bayar SPP Bulanan</h4>
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" name="edit" value="<?= $val->id_pembayaran ?>">
                    <input type="hidden" id="id_kelas<?= $val->id_pembayaran ?>" value="<?= $this->session->kelas_id ?>">
                    <select class="select2<?= $val->id_pembayaran ?> browser-default" name="bulan" id="bulan<?= $val->id_pembayaran ?>">
                        <option value="">Pilih Bulan</option>
                        <?php foreach($bulan as $row) { ?> 
                        <option value="<?= $row ?>" <?= $val->bulan == $row ? 'selected' : '' ?>><?= $row ?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="grandtotal" id="grandtotal<?= $val->id_pembayaran ?>" placeholder="Grand Total (Rp)" value="<?= $val->grand_total ?>">
                    <label for="fn">Grand Total (Rp)</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" placeholder="Sisa Bayar (Rp)" value="<?= $val->sisa_bayar ?>">
                    <label for="fn">Sisa Bayar (Rp)</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="fn" name="jumlah" value="<?= $val->sisa_bayar ?>">
                    <label for="fn">Jumlah Ingin Dibayar (Rp)</label>
                </div>
                <!-- <div class="input-field col s12">
                    </div> -->
                <div class="input-field col s12">
                    <input type="file" id="input-file-now" name="bukti_bayar" class="dropify<?= $val->id_pembayaran ?>" data-default-file="" />
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
<script src="<?= base_url() ?>app-assets/vendors/formatter/jquery.formatter.min.js"></script>
<script src="<?= base_url() ?>app-assets/vendors/dropify/js/dropify.min.js"></script>
<script>
    
$(function() {
    $(".select2").select2({
        /* the following code is used to disable x-scrollbar when click in select input and
        take 100% width in responsive also */
        placeholder: "Pilih Bulan",
        dropdownAutoWidth: true,
        dropdownParent: "#modal_add",
        width: '100%',
    });
    $('#grandtotal').attr('readonly', true)

    $('#bulan').on('change', function() {
        var bulan = $(this).val();
        var id_kelas = $('#id_kelas').val();
        $.ajax({
            url: '<?= base_url('siswa/get_grandtotal') ?>',
            method: 'GET',
            data: {
                id_kelas: id_kelas,
                bulan: bulan,
            },
            dataType: 'JSON',
            success: function(result) {
                $('#grandtotal').val(result.grandtotal)
            }
        })
    });
    $('.dropify').dropify();

    
    <?php foreach ($data as $val) { ?>
        $(".select2<?= $val->id_pembayaran ?>").select2({
            /* the following code is used to disable x-scrollbar when click in select input and
            take 100% width in responsive also */
            placeholder: "Pilih Bulan",
            dropdownAutoWidth: true,
            dropdownParent: "#modal_add",
            width: '100%',
        });
        $('#grandtotal<?= $val->id_pembayaran ?>').attr('readonly', true)

        $('#bulan<?= $val->id_pembayaran ?>').on('change', function() {
            var bulan = $(this).val();
            var id_kelas = $('#id_kelas<?= $val->id_pembayaran ?>').val();
            $.ajax({
                url: '<?= base_url('siswa/get_grandtotal') ?>',
                method: 'GET',
                data: {
                    id_kelas: id_kelas,
                    bulan: bulan,
                },
                dataType: 'JSON',
                success: function(result) {
                    $('#grandtotal<?= $val->id_pembayaran ?>').val(result.grandtotal)
                }
            })
        });
        $('.dropify<?= $val->id_pembayaran ?>').dropify();
    <?php } ?>
});
</script>
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="row">
    <!-- Left: Form -->
    <div class="col-lg-6">
        <?= form_open('buy', 'class="row g-3"') ?>

        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input([
            'type'  => 'hidden',
            'name'  => 'total_harga',
            'id'    => 'total_harga',
            'value' => (string) $total
        ]) ?>

        <?= form_input(['type' => 'hidden', 'name' => 'biaya_admin', 'id' => 'biaya_admin', 'value' => (string) ($biaya_admin ?? 0)]) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'diskon_kupon', 'id' => 'diskon_kupon', 'value' => (string) ($diskon_kupon ?? 0)]) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'cashback', 'id' => 'cashback', 'value' => (string) ($cashback ?? 0)]) ?>

        <div class="col-12">
            <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'nama',
                'id'       => 'nama',
                'class'    => 'form-control',
                'value'    => session()->get('username'),
                'readonly' => true]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'alamat',
                'id'    => 'alamat',
                'class' => 'form-control',
                'value' => $alamat ?? '']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
            <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?>
            <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?>
        </div>

        <div class="col-12">
            <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'ongkir',
                'id'       => 'ongkir',
                'class'    => 'form-control',
                'value'    => $response2[0]['cost'] ?? ($ongkir ?? ''),
                'readonly' => true,
            ]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Kode Kupon', 'kupon_code', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'kupon_code',
                'id'    => 'kupon_code',
                'class' => 'form-control',
                'placeholder' => 'HEMAT atau SUPER',
                'value' => $kupon_code ?? ''
            ]) ?>
            <small class="text-muted">Tersedia: HEMAT (15%), SUPER (20%)</small>
        </div>

        <div class="col-12">
            <?= form_submit('submit', 'Buat Pesanan', ['class' => 'btn btn-primary']) ?>
        </div>

        <?= form_close() ?>
    </div>

    <!-- Right: Summary -->
    <div class="col-lg-6">
                <div class="card">
            <div class="card-body">
                <style>
                    /* small presentation styles for checkout summary */
                    .product-table tbody tr td{padding: .6rem .5rem;}
                    .product-table tbody tr + tr td{padding-top: .8rem;}
                    .product-table tbody tr:last-child td{padding-bottom: .9rem;}
                    .product-table { margin-bottom: .75rem; }

                    .summary-table tbody tr td{padding: .6rem .5rem;}
                    .summary-table tbody tr + tr td{border-top: 1px solid #e9ecef;}
                    .summary-table tbody tr:first-child td{border-top: 1px solid #e9ecef;padding-top: .9rem;}
                    .summary-table thead th{border-bottom: 1px solid #e9ecef;}
                </style>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Ringkasan Pesanan</h5>
                </div>

                <!-- Products table: header + rows combined so columns align -->
                <div class="row mb-2">
                    <div class="col-12">
                        <table class="table table-borderless table-sm mb-0 product-table">
                            <thead>
                                <tr class="small text-muted">
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($items)) : ?>
                                    <?php foreach ($items as $item) : ?>
                                        <tr>
                                            <td><?= esc($item['name']) ?></td>
                                            <td><?= number_to_currency($item['price'], 'IDR') ?></td>
                                            <td><?= $item['qty'] ?></td>
                                            <td><?= number_to_currency($item['qty'] * $item['price'], 'IDR') ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="4" class="text-muted">Keranjang kosong</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-12">
                            <table class="table table-borderless table-sm summary-table">
                                <tr>
                                    <td>Subtotal</td>
                                    <td class="text-end" id="display_subtotal"><?= number_to_currency($subtotal, 'IDR') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-danger">Diskon Kupon</td>
                                    <td class="text-danger text-end" id="display_diskon_kupon">-<?= number_to_currency($diskon_kupon ?? 0, 'IDR') ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Admin</td>
                                    <td class="text-end" id="display_biaya_admin"><?= number_to_currency($biaya_admin ?? 0, 'IDR') ?></td>
                                </tr>
                                <tr>
                                    <td class="text-success">Cashback</td>
                                    <td class="text-success text-end" id="display_cashback">-<?= number_to_currency($cashback ?? 0, 'IDR') ?></td>
                                </tr>
                                <tr>
                                    <td>Subtotal (+Admin - Kupon)</td>
                                    <td class="text-end" id="display_adjusted_subtotal"><?= number_to_currency(($subtotal - ($diskon_kupon ?? 0)) + ($biaya_admin ?? 0), 'IDR') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Grand Total (incl. Ongkir)</strong></td>
                                    <td class="text-end"><strong id="display_total"><?= number_to_currency($total, 'IDR') ?></strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let ongkir = parseInt($('#ongkir').val() || 0);
    let subtotal = <?= $subtotal ?>;
    let diskonKupon = <?= $diskon_kupon ?? 0 ?>;
    let biayaAdmin = <?= $biaya_admin ?? 0 ?>;
    let cashback = <?= $cashback ?? 0 ?>;

    function formatIDR(v) {
        return `IDR ${v.toLocaleString('id-ID')}`;
    }

    function recalc() {
        ongkir = parseInt($('#ongkir').val() || 0);
        const kupon = $('#kupon_code').val().trim().toUpperCase();
        let kuponPersen = 0;
        if (kupon === 'HEMAT') kuponPersen = 15;
        if (kupon === 'SUPER') kuponPersen = 20;

        const subtotalBefore = subtotal;
        diskonKupon = Math.round((subtotalBefore * kuponPersen / 100) * 100) / 100;

        const subtotalAfterKupon = subtotalBefore - diskonKupon;
        if (subtotalBefore <= 20000000) {
            biayaAdmin = Math.round(subtotalBefore * 0.5 / 100);
        } else {
            biayaAdmin = Math.round(subtotalBefore * 0.75 / 100);
        }

        if (subtotalBefore > 10000000) {
            cashback = Math.round((subtotalBefore * 2 / 100));
        } else {
            cashback = 0;
        }

        const adjustedSubtotal = subtotalAfterKupon + biayaAdmin;
        const total = adjustedSubtotal + ongkir;

        $('#display_diskon_kupon').text('-' + formatIDR(diskonKupon));
        $('#display_biaya_admin').text(formatIDR(biayaAdmin));
        $('#display_cashback').text(formatIDR(cashback));
        $('#display_adjusted_subtotal').text(formatIDR(adjustedSubtotal));
        $('#display_total').text(formatIDR(total));

        $('#diskon_kupon').val(diskonKupon);
        $('#biaya_admin').val(biayaAdmin);
        $('#cashback').val(cashback);
        $('#total_harga').val(total);
    }

    recalc();

    $('#kupon_code, #ongkir').on('input change', function() {
        recalc();
    });

    $('#kelurahan').select2({
        placeholder: 'Cari daerah tujuan',
        minimumInputLength: 3,
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                return data;
            },
            cache: true
        }
    });

    $("#kelurahan").on('change', function () {
        let id_kelurahan = $(this).val();

        $("#layanan").empty();
        ongkir = 0;
        recalc();

        $.ajax({
            url: "<?= site_url('ajax/costs') ?>",
            dataType: "json",
            data: {
                destination: id_kelurahan
            },
            success: function (data) {
                data.forEach(function (item) {
                    // normalize cost value (API may return array or number)
                    var costVal = item.cost;
                    if (Array.isArray(costVal) && costVal.length) {
                        costVal = costVal[0].value || costVal[0].cost || costVal[0];
                    }

                    $("#layanan").append(
                        $('<option>', {
                            value: costVal,
                            text: `${item.description} (${item.service}) : estimasi ${item.etd}`
                        })
                    );
                });
            }
        });
    });

    $("#layanan").on('change', function() {
        ongkir = parseInt($(this).val() || 0);
        // set the input so recalc reads the updated value and user sees it
        $('#ongkir').val(ongkir);
        recalc();
    });
});
</script>
<?= $this->endSection() ?>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="section-to-print">
    <div>
        <img class="logo" src="<?= base_url('assets/logo.png') ?>" alt="">
    </div>
    <div class="web-title">
        www.pasarbertais.com
    </div>
    <div class="order-no">
        #FVI15521611153
    </div>
    <hr class="dashed mb-2">
    <table class="mb-2">
        <tr class="pb-2">
            <td width="30">1</td>
            <td width="180">Apel</td>
            <td class="text-right" width="52">15,000</td>
        </tr>
        <tr class="pb-2">
            <td width="30">3</td>
            <td width="180">Ayam</td>
            <td class="text-right" width="52">15,000</td>
        </tr>
        <tr class="pb-2">
            <td width="30">4</td>
            <td width="180">Tahu</td>
            <td class="text-right" width="52">15,000</td>
        </tr>
        <tr class="pb-2">
            <td width="30">10</td>
            <td width="180">Tempe</td>
            <td class="text-right" width="52">15,000</td>
        </tr>
    </table>
    <hr class="dashed mb-1">
    <div class="my-footer">
        <div class="text-center">
            Terima kasih telah berbelanja di <br>
            <strong>PasarBertais.com</strong> <br>
            Dengan belanja di PasarBertais.com,
            ibu telah membantu perekonomian pedagang <strong>pasar Bertais</strong>
        </div>
    </div>
</div>
<!-- Header -->
<div class="header bg-primary pb-6 not-print">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Order #<?php echo $data->order_number; ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i
                                        class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/orders'); ?>">Order</a></li>
                            <li class="breadcrumb-item active" aria-current="page">#<?php echo $data->order_number; ?>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6 not-print">

    <div class="row">
        <div class="col-md-8">
            <div class="card-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Data Produk</h3>
                        <?php if ($order_flash) : ?>
                        <span class="float-right text-success font-weight-bold"
                            style="margin-top: -30px;"><?php echo $order_flash; ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush table-striped">
                            <tr>
                                <td>Nomor</td>
                                <td><b>#<?php echo $data->order_number; ?></b></td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td><b><?php echo get_formatted_date($data->order_date); ?></b></td>
                            </tr>
                            <tr>
                                <td>Item</td>
                                <td><b><?php echo $data->total_items; ?></b></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td><b>Rp <?php echo format_rupiah($data->total_price); ?></b></td>
                            </tr>
                            <tr>
                                <td>Metode pembayaran</td>
                                <td><b><?php echo ($data->payment_method == 1) ? 'Transfer bank' : 'Bayar ditempat'; ?></b>
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><b
                                        class="statusField"><?php echo get_order_status($data->order_status, $data->payment_method); ?></b>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <form action="<?php echo site_url('admin/orders/status'); ?>" method="POST">
                            <input type="hidden" name="order" value="<?php echo $data->id; ?>">
                            <input type="hidden" name="total_price" value="<?= $data->total_price; ?>">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <select class="form-control" id="status" name="status">
                                            <option value="1"
                                                <?php echo ($data->order_status == 1) ? ' selected' : ''; ?>>Menunggu
                                                Konfirmasi
                                            </option>
                                            <option value="2"
                                                <?php echo ($data->order_status == 2) ? ' selected' : ''; ?>>Dalam
                                                proses</option>
                                            <option value="3"
                                                <?php echo ($data->order_status == 3) ? ' selected' : ''; ?>>Dalam
                                                pengiriman
                                            </option>
                                            <option value="4"
                                                <?php echo ($data->order_status == 4) ? ' selected' : ''; ?>>Selesai
                                            </option>
                                            <option value="5"
                                                <?php echo ($data->order_status == 5) ? ' selected' : ''; ?>>Batalkan
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="text-right">
                                        <input type="submit" value="OK" class="btn btn-md btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card card-primary" id="pesanan">
                    <div class="card-header">
                        <h3 class="mb-0">Barang dalam pesanan</h3>

                        <a href="<?php echo site_url('admin/orders/create/'.$order_id); ?>"
                            class="btn btn-outline-primary"><i class="fa fa-plus"></i> Produk</a>

                        <button onclick="window.open('<?php echo site_url('admin/orders/invoice/'.$order_id); ?>')"
                            class="btn btn-outline-primary"><i class="fa fa-print"></i>
                            Invoice</button>
                    </div>
                    <div class="card-body p-0">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Harga satuan</th>
                                    <th scope="col">Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($items as $item) : ?>
                                <tr id="item-id-<?= $item->product_id ?>">
                                    <td>
                                        <img class="img img-fluid rounded" style="width: 60px; height: 60px;"
                                            alt="<?php echo $item->name; ?>"
                                            src="<?php echo base_url('assets/uploads/products/'. $item->picture_name); ?>">
                                    </td>
                                    <td>
                                        <h5 class="mb-0"><?php echo $item->name; ?></h5>
                                    </td>
                                    <td>
                                        <?php echo $item->order_qty; ?>
                                    </td>

                                    <td>Rp <?php echo format_rupiah($item->order_price); ?></td>
                                    <td>Rp <?php echo format_rupiah($item->order_price*$item->order_qty); ?></td>
                                    <td>
                                        <button class="btn btn-success btn-sm btn-sunting"
                                            for="item-order-<?= $item->product_id ?>"><i
                                                class="fa fa-edit"></i></button>
                                        <button
                                            onclick="mDelete('<?php echo $item->id;?>','<?php echo $item->order_id;?>');"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <tr id="item-order-<?= $item->product_id ?>" class="item-order" style="display: none;">

                                    <form
                                        action="<?php echo site_url('admin/orders/update_order_item/'.$item->order_id); ?>"
                                        method="POST">
                                        <input type="hidden" name="product_id" value="<?= $item->product_id ?>">
                                        <td>
                                            <img class="img img-fluid rounded" style="width: 60px; height: 60px;"
                                                alt="<?php echo $item->name; ?>"
                                                src="<?php echo base_url('assets/uploads/products/'. $item->picture_name); ?>">
                                        </td>
                                        <td>
                                            <h5 class="mb-0"><?php echo $item->name; ?></h5>
                                        </td>
                                        <td>
                                            <input type="number" id="order_qty" name="order_qty"
                                                class="form-control input-number"
                                                value="<?php echo $item->order_qty; ?>" min="1" max="100" size="2">
                                        </td>
                                        <td>Rp <?php echo format_rupiah($item->order_price); ?></td>
                                        <td>Rp <?php echo format_rupiah($item->order_price*$item->order_qty); ?></td>
                                        <td>
                                            <button type="submit" href="#" class="btn btn-primary btn-sm"><i
                                                    class="fa fa-save"></i></button>
                                            <button class="btn btn-danger btn-sm btn-batal"
                                                for="item-id-<?= $item->product_id ?>">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="mb-0">Data Penerima</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table align-items-center table-flush table-hover">
                        <tr>
                            <td>Nama</td>
                            <td><b><?php echo $delivery_data->customer->name; ?></b></td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td><b><?php echo $delivery_data->customer->phone_number; ?></b></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>
                                <div style="white-space: initial;">
                                    <b><?php echo $delivery_data->customer->address; ?></b>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td><b><?php echo $delivery_data->note; ?></b></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
    var url = "<?php echo site_url('admin/orders/delete/');?>";

    function mDelete(id, order_id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + id + "/" + order_id;
        else
            return false;
    }


    $(".btn-sunting").click(function() {
        var item_id = $(this).attr("for");
        $("#" + item_id).show();
        var parrent = $(this).closest('tr');
        parrent.hide();
    });
    $(".btn-batal").click(function() {
        var item_id = $(this).attr("for");
        $("#" + item_id).show();
        var parrent = $(this).closest('tr');
        parrent.hide();
    });
    </script>
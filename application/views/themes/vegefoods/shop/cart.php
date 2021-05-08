<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_1.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span>Keranjang Belanja</span>
                </p>
                <h1 class="mb-0 bread">Keranjang Belanja Saya</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-Keranjang Belanja" id="app">
    <div class="container">
        <?php if ( count($carts) > 0) : ?>
        <form action="<?php echo site_url('shop/checkout'); ?>" method="POST">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Kuantitas</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(item, index) in carts">
                                    <tr v-bind:class="'text-center cart-'+item.rowid">
                                        <td class="product-remove"><a href="#" class="remove-item"
                                                v-bind:data-rowid="item.rowid"><span class="ion-ios-close"></span></a>
                                        </td>
                                        <td class="image-prod">
                                            <div class="img img-fluid rounded"
                                                v-bind:style="'background-image:url('+img_url+item.picture_name+')'">
                                            </div>
                                        </td>

                                        <td class="product-name">
                                            <h3>{{item.name}}</h3>
                                        </td>
                                        <td class="price">Rp {{formatNumber(item.price)}}</td>
                                        <td class="quantity">
                                            <div class="input-group mb-3">
                                                <input @change="cekHarga(item.rowid)" type="number"
                                                    v-bind:data-id="item.rowid" v-bind:name="'quantity['+item.rowid+']'"
                                                    class="quantity form-control input-number" v-model="item.qty"
                                                    @updated="val=>item.qty=val" min="1" max="100">
                                            </div>
                                        </td>
                                        <td class="total">Rp {{formatNumber(item.subtotal)}}</td>
                                    </tr><!-- END TR-->
                                </template>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kupon" id="inlineRadio1"
                                v-model="voucher" value="kode kupon" checked>
                            <label class="form-check-label" for="inlineRadio1">Kode Kupon</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis_kupon" id="inlineRadio2"
                                v-model="voucher" value="kode refral">
                            <label class="form-check-label" for="inlineRadio2">Kode Refral</label>
                        </div>
                        <br><br>
                        <!-- <h3>Kode Kupon</h3> -->
                        <p>Punya <strong>{{voucher}}</strong>? Gunakan {{voucher}} kamu untuk mendapatkan potongan harga menarik</p>

                        <div class="form-group">
                            <label for="code">Kode:</label>
                            <input id="code" name="coupon_code" type="text" class="form-control text-left px-3"
                                placeholder="">
                        </div>

                    </div>

                </div>

                <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Rincian Keranjang</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span class="n-subtotal font-weight-bold">Rp {{formatNumber(total_cart)}}</span>
                        </p>
                        <p class="d-flex">
                            <span>Biaya pengiriman</span>
                            <?php if ( $total_cart >= get_settings('min_shop_to_free_shipping_cost')) : ?>
                            <span class="n-ongkir font-weight-bold">Gratis</span>
                            <?php else : ?>
                            <span class="n-ongkir font-weight-bold">Rp
                                <?php echo format_rupiah(get_settings('shipping_cost')); ?></span>
                            <?php endif; ?>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span class="n-total font-weight-bold">Rp {{formatNumber(total_price)}}</span>
                        </p>
                    </div>
                    <p><button type="submit" class="btn btn-primary py-3 px-4">Checkout</button></p>
                </div>
            </div>
        </form>
        <?php else : ?>
        <div class="row">
            <div class="col-md-12 ftco-animate">
                <div class="alert alert-info">Tidak ada barang dalam
                    keranjang.<br><?php echo anchor('browse', 'Jelajahi produk kami'); ?> dan mulailah berbelanja!</div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<script src="https://unpkg.com/vue@3.0.5"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
    integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
    crossorigin="anonymous"></script>
<script>
const app = Vue.createApp({
    data() {
        return {
            img_url: '<?php echo base_url('assets/uploads/products/'); ?>',
            carts: JSON.parse('<?= json_encode($carts) ?>'),
            more: true,
            voucher: "kode kupon",
            total_cart: '<?php echo $total_cart; ?>',
            total_price: '<?php echo $total_price; ?>',
        }
    },
    mounted() {
        console.log(this.carts);
    },
    methods: {
        getTotalCart: function() {
            this.total_cart = 0;
            for (var prop in this.carts) {
                this.total_cart += this.carts[prop].subtotal;
            }
            this.total_price = this.total_cart;
        },
        // getTotal: function() {
        //   this.total_cart
        // },
        formatNumber(number) {
            return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + ".00";
        },
        cekHarga: function(id) {
            let grosir = this.carts[id]['grosir'];
            const jml = this.carts[id].qty;
            for (i = 0; i < grosir.length; i++) {
                if (jml >= grosir[i].jumlah_minimal) {
                    this.carts[id]['price'] = grosir[i].harga_satuan;
                    break;
                }
            }
            this.carts[id]['subtotal'] = this.carts[id]['price'] * jml;
            this.getTotalCart();
            this.updateCart(id);
        },
        updateCart: function(index) {
            const cart = this.carts[index];
            const qty = cart.qty;
            axios.post("<?= site_url('home/cart_api'); ?>", {
                    rowid: cart.rowid,
                    qty,
                    action: 'update_item'
                })
                .then((response) => {
                    console.log(response);
                    if (response.status == 200) {
                        console.log("berhasil")
                    } else {
                        console.log('Terjadi kesalahan');
                    }
                }, (error) => {
                    console.log(error);
                });
        },
    }
})
app.mount('#app')
</script>
<script>
var carts = JSON.parse('<?= json_encode($carts) ?>');

$('.remove-item').click(function(e) {
    e.preventDefault();

    var rowid = $(this).data('rowid');
    var tr = $('.cart-' + rowid);

    $('.product-name', tr).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

    $.ajax({
        method: 'POST',
        url: '<?php echo site_url('shop/cart_api?action=remove_item'); ?>',
        data: {
            rowid: rowid
        },
        success: function(res) {
            if (res.code == 204) {
                tr.addClass('alert alert-danger');

                setTimeout(function(e) {
                    tr.hide('fade');

                    $('.n-subtotal').text(res.total.subtotal);
                    $('.n-ongkir').text(res.total.ongkir);
                    $('.n-total').text(res.total.total);
                }, 2000);
            }
        }
    })
})
</script>
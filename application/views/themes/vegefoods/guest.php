<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_1.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span>Pesanan</span>
                </p>
                <h1 class="mb-0 bread">Pesanan Saya</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-Keranjang Belanja" id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mb-5">
                <h4>Terimakasih Telah Melakukan Pemesanan</h4>
                <h4>No Pesanan Anda #{{order_number}}</h4>
                <h4><span class="badge badge-primary">{{status[order_status]}}</span></h4>
            </div>
            <div class="col-md-12">
            </div>
            <div class="col-md-12 ftco-animate">
                <div class="cart-list">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr class="text-center">
                                <th>&nbsp;</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(item, index) in carts">
                                <tr v-bind:class="'text-center cart-'+item.id">
                                    <td class="image-prod">
                                        <div class="img img-fluid rounded"
                                            v-bind:style="'background-image:url('+img_url+item.picture_name+')'">
                                        </div>
                                    </td>

                                    <td class="product-name">
                                        <h3>{{item.name}}</h3>
                                    </td>
                                    <td class="price">Rp {{formatNumber(item.order_price)}}</td>
                                    <td class="quantity">
                                        <div class="text-center">
                                            {{item.order_qty}} x
                                        </div>
                                    </td>
                                    <td class="total">Rp {{formatNumber(item.order_price*item.order_qty)}}</td>
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
                    <h3>Rincian Pesanan</h3>
                    <p class="d-flex">
                        <span>Subtotal</span>
                        <span class="n-subtotal">Rp {{formatNumber(subtotal)}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Biaya pengiriman</span>
                        <span v-if="ongkir == 0"><strong>GRATIS</strong></span>
                        <span v-else>Rp {{formatNumber(ongkir)}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Potongan Harga</span>
                        <span class="n-discount"><i>- Rp {{formatNumber(discount)}}</i></span>
                    </p>
                    <hr>
                    <p class="d-flex total-price">
                        <span>Total</span>
                        <span class="n-total font-weight-bold">Rp {{formatNumber(total_price)}}</span>
                    </p>
                </div>
            </div>

            <div class="col-lg-8 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Data Penerima</h3>
                    <p class="d-flex">
                        <span>Nama</span>
                        <span class="font-weight-bold">{{customer.name}}</span>
                    </p>
                    <p class="d-flex">
                        <span>No HP</span>
                        <span class="font-weight-bold">{{customer.phone_number}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Alamat Kecamatan</span>
                        <span class="font-weight-bold">{{customer.kecamatan}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Alamat Lengkap</span>
                        <span class="font-weight-bold">{{customer.address}}</span>
                    </p>
                    <p class="d-flex">
                        <span>Catatan</span>
                        <span class="font-weight-bold">{{note}}</span>
                    </p>
                </div>

            </div>
        </div>
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
            carts: JSON.parse('<?= json_encode($items) ?>'),
            note: JSON.parse('<?= json_encode($delivery_data->note) ?>'),
            customer: JSON.parse('<?= json_encode($delivery_data->customer) ?>'),
            more: true,
            total_price: '<?= $data->total_price ?>',
            subtotal: '<?= $data->subtotal ?>',
            ongkir: '<?= $data->ongkir ?>',
            discount: '<?= $data->discount ?>',
            order_number: '<?= $data->order_number ?>',
            order_status: '<?= $data->order_status ?>',
            status: [
                "",
                 "Menunggu Konfirmasi",
                 "Dalam Proses",
                 "Dalam Pengiriman",
                 "Selesai",
                 "Batalkan",
            ],
        }
    },
    mounted() {},
    methods: {
        getTotalCart: function() {
            this.total_cart = 0;
            for (var prop in this.carts) {
                this.total_cart += this.carts[prop].subtotal;
            }
            this.total_price = this.total_cart;
        },
        formatNumber(number) {
            number = parseInt(number);
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
    }
})
app.mount('#app')
</script>
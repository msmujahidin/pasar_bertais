<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
.kotak-alamat {
    position: absolute;
    /* z-index: 5; */
    background-color: #fff;
}

.box-alamat {
    max-height: 250px;
    overflow-y: scroll;
    cursor: pointer;
}

.list-alamat:hover {
    background-color: #82ae46;
    color: #fff;
}
</style>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_1.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span>Checkout</span>
                </p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>x
        </div>
    </div>
</div>

<section class="ftco-section" id="app">
    <div class="container">
        <form action="<?php echo site_url('shop/checkout/order'); ?>" method="POST">

            <div class="row justify-content-center">
                <div class="col-xl-7 ftco-animate">
                    <h3 class="mb-4 billing-heading">Alamat Pengiriman</h3>

                    <div class="form-group">
                        <label for="name" class="form-control-label">Pengiriman untuk (nama):</label>
                        <input type="text" name="name" value="" class="form-control" id="name" required>
                    </div>

                    <div class="form-group">
                        <label for="hp" class="form-control-label">No. HP:</label>
                        <input type="text" name="phone_number" value="" class="form-control" id="hp" required>
                    </div>

                    <div class="form-group">
                        <label for="kecamatan" class="form-control-label">Kecamatan:</label>
                        <input type="text" name="kecamatan" v-model="set_kecamatan" :value="set_kecamatan"
                            class="form-control" id="kecamatan" required readonly @click="toogleAlamatBox()">
                        <input type="text" name="ongkir" v-model="ongkir" hidden>
                        <input type="text" name="subtotal" v-model="subtotal" hidden>
                        <input type="text" name="total_price" v-model="total" hidden>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <button type="button" class="btn btn-primary"
                                    @click="toogleAlamatBox()">{{alamat_search.btn_text}}</button>
                            </div>
                            <div class="col-10">
                                <div class="kotak-alamat" v-if="alamat_search.box">
                                    <input type="text" placeholder="cari kecamatan" v-model="search"
                                        class="form-control">
                                    <div class="box-alamat border">
                                        <div v-for="(kec, index) in filterKec" class="px-3 py-1 list-alamat"
                                            @click="setKecamatan(index)">
                                            {{kec.provinsi + ", " + kec.kabupaten_kota + ", " + kec.kecamatan}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-control-label">Alamat Lengkap:</label>
                        <textarea name="address" class="form-control" id="address" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="note" class="form-control-label">Catatan:</label>
                        <textarea name="note" class="form-control" id="note"></textarea>
                    </div>

                </div>
                <div class="col-xl-5">
                    <div class="row mt-5 pt-3">
                        <div class="col-md-12 d-flex mb-5">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Rincian Belanja</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>{{formatNumber(subtotal)}}</span>
                                </p>
                                <p class="d-flex">
                                    <span>Ongkos kirim</span>
                                    <span v-if="!refral">{{ formatNumber(ongkir)}}</span>
                                    <span v-else><strong>GRATIS</strong></span>
                                </p>
                                <p class="d-flex">
                                    <span>Kode Refral</span>
                                    <span><?php echo $refral_text; ?></span>
                                </p>
                                <p class="d-flex">
                                    <span>Kupon</span>
                                    <span><?php echo $discount_text; ?></span>
                                    <input type="text" name="discount" id="" value="<?= $discount ?>">
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>{{formatNumber(total)}}</span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-12">

                        </div>


                    </div>
                </div> <!-- .col-md-8 -->

                <div class="form-group text-right" style="margin-top: 10px;">
                    <input type="submit" class="btn btn-primary py-2 px-2" value="Buat Pesanan">
                </div>
            </div>

        </form>
    </div>
</section> <!-- .section -->
<script src="https://unpkg.com/vue@3.0.5"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
    integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
    crossorigin="anonymous"></script>
<script>
const app = Vue.createApp({
    data() {
        return {
            img_url: '<?php echo base_url('assets/uploads/products/'); ?>',
            kecamatan: JSON.parse('<?= json_encode($kecamatan) ?>'),
            subtotal: '<?= $subtotal ?>',
            discount: '<?= $discount ?>',
            refral: '<?= $refral ?>',
            total: '<?= $total ?>',
            kec: {},
            set_kecamatan: '',
            ongkir: null,
            search: '',
            alamat_search: {
                box: false,
                btn_text: "Cari",
            },
        }
    },
    mounted() {
        if(!this.refral){
            this.refral = false;
        }else{
            this.refral = true;
        }
        console.log(this.refral)
    },
    methods: {
        toogleAlamatBox() {
            const alamat = this.alamat_search;
            alamat.box = !alamat.box;
            if (alamat.box) {
                alamat.btn_text = "X";
            } else {
                alamat.btn_text = "Cari"
            }
        },
        setTotal() {
            if(this.refral){
                this.total = parseInt(this.subtotal);
            }else{
                this.total = parseInt(this.subtotal) + parseInt(this.ongkir) -parseInt(this.discount);
            }
        },
        setKecamatan(index) {
            let kec = this.kecamatan[index];
            this.ongkir = kec.ongkir;
            this.set_kecamatan = kec.kecamatan + ", " + kec.kabupaten_kota + ", " + kec.provinsi;
            this.setTotal();
            this.toogleAlamatBox();
        },
        formatNumber(number) {
            number = parseInt(number);
            return !number ? "-" : "Rp " + number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") + ".00";
        },
    },
    computed: {
        filterKec: function() {
            return this.kecamatan.filter((kec) => {
                return kec.kecamatan.toLowerCase().match(this.search.toLowerCase());
            })
        }
    }
})
app.mount('#app')
</script>
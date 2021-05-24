<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?php echo 'Order #'. $data->order_number; ?></title>
    <!-- Favicon -->
    <link rel="icon" href="<?php echo get_theme_uri('img/brand/favicon.png', 'argon'); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/nucleo/css/nucleo.css', 'argon'); ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo get_theme_uri('js/plugins/@fortawesome/fontawesome-free/css/all.min.css', 'argon'); ?>"
        type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/argon9f1e.css?v=1.1.0', 'argon'); ?>" type="text/css">

    <script src="<?php echo get_theme_uri('vendor/jquery/dist/jquery.min.js', 'argon'); ?>"></script>
    <script src="<?php echo get_theme_uri('vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 'argon'); ?>"></script>

</head>

<body class="@yield('sidebar_type')">
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-sm navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <a class="navbar-brand" href="<?php echo base_url(); ?>">
                    <img src="<?php echo get_store_logo(); ?>" class="navbar-brand-img"
                        alt="Logo <?php echo get_store_name(); ?>">
                </a>
                <div class="ml-auto">
                    <!-- Sidenav toggler -->
                    <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin"
                        data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin'); ?>">
                                <i class="ni ni-tv-2 text-primary"></i>
                                <span class="nav-link-text">Dasbor</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/gambar'); ?>">
                                <i class="fas fa-image"></i>
                                <span class="nav-link-text">Gambar</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/products/category'); ?>">
                                <i class="ni ni-bullet-list-67 text-info"></i>
                                <span class="nav-link-text">Kategori Produk</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/products'); ?>">
                                <i class="fa fa-shopping-cart text-success"></i>
                                <span class="nav-link-text">Produk</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/ongkir'); ?>">
                                <i class="fa fa-list"></i>
                                <span class="nav-link-text">Ongkir</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/orders'); ?>">
                                <i class="fa fa-file-invoice text-danger"></i>
                                <span class="nav-link-text">Pesanan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/products/coupons'); ?>">
                                <i class="fa fa-money-bill-alt text-info"></i>
                                <span class="nav-link-text">Kupon</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/pegawai'); ?>">
                                <i class="fa fa-address-book"></i>
                                <span class="nav-link-text">Pegawai</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/customers'); ?>">
                                <i class="fa fa-users text-primary"></i>
                                <span class="nav-link-text">Reseler</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('admin/laporan'); ?>">
                                <i class="fa fa-book"></i>
                                <span class="nav-link-text">Laporan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Search form -->
                    <div class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main"
                        action="<?php echo site_url('admin/products/search'); ?>" required>
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" v-model="search_input" v-on:input="searchProducts()"
                                    placeholder="Cari..." type="text">
                            </div>
                        </div>
                        <button @click="searchProducts()" type="button" class="close" data-action="search-close"
                            data-target="#navbar-search-main" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-md-auto">
                        <li class="nav-item d-xl-none">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item d-sm-none">
                            <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                <i class="ni ni-zoom-split-in"></i>
                            </a>
                        </li>

                    </ul>
                    <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img src="<?php echo get_admin_image(); ?>">
                                    </span>
                                    <div class="media-body ml-2 d-none d-lg-block">
                                        <span
                                            class="mb-0 text-sm  font-weight-bold"><?php echo get_admin_name(); ?></span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <a href="<?php echo site_url('admin/settings/profile'); ?>" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profil</span>
                                </a>
                                <a href="<?php echo site_url('admin/settings'); ?>" class="dropdown-item">
                                    <i class="ni ni-settings-gear-65"></i>
                                    <span>Pengaturan</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <div class="header bg-primary pb-6">
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
                                    <li class="breadcrumb-item"><a
                                            href="<?php echo site_url('admin/orders'); ?>">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        #<?php echo $data->order_number; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--6">

            <div class="row">
                <div class="col-md-12">
                    <div class="card-wrapper">

                        <div v-if="!search_container" class="card card-primary" id="pesanan">
                            <div class="card-header">
                                <h3 class="mb-0">Pilih Produk</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col" class="text-center">Produk</th>
                                            <th scope="col">Harga</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($products as $item) : ?>
                                        <tr id="item-id-<?= $item->id ?>">
                                            <form
                                                action="<?php echo site_url('admin/orders/insert_order_item/'.$order_id); ?>"
                                                method="post">
                                                <td class="text-center">
                                                    <img class="img img-fluid rounded"
                                                        style="width: 100px; height: 100px;"
                                                        alt="<?php echo $item->name; ?>"
                                                        src="<?php echo base_url('assets/uploads/products/'. $item->picture_name); ?>">
                                                    <h5 class="mb-0"><?php echo $item->name; ?></h5>
                                                    <input type="hidden" name="product_id" value="<?= $item->id ?>">
                                                    <input type="hidden" name="order_price" value="<?= $item->price ?>">
                                                </td>
                                                <td>Rp <?php echo format_rupiah($item->price); ?></td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary btn-lg"><i
                                                            class="fa fa-plus"></i></button>
                                                </td>
                                            </form>
                                        </tr>

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div v-if="search_container" class="card card-primary" id="pesanan">
                            <div class="card-header">
                                <h3 class="mb-0">Hasil Pencarian <i class="text-warning">"{{search_result}}"</i></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3" v-for="item in filterProducts">
                                        <form :action="add_order_url" method="post">
                                            <input type="hidden" name="product_id" v-model="item.id">
                                            <input type="hidden" name="order_price" v-model="item.price">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-heading">{{item.name}}</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="text-center">
                                                        <img :alt="item.name" class="img img-fluid rounded"
                                                            :src="img_path_url+item.picture_name"
                                                            style="width: 1000px; max-height: 800px">
                                                        <br>
                                                        <br>
                                                        Rp {{formatNumber(item.price)}}
                                                    </div>

                                                </div>
                                                <div class="card-footer text-center">
                                                    <button type="submit" class="btn btn-primary btn-block"><i
                                                            class="fa fa-plus"> Produk</i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center text-lg-left text-muted">
                            &copy; 2020 <a href="#" class="font-weight-bold ml-1"
                                target="_blank"><?php echo get_store_name(); ?></a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="<?php echo get_theme_uri('vendor/js-cookie/js.cookie.js', 'argon'); ?>"></script>
    <script src="<?php echo get_theme_uri('vendor/jquery.scrollbar/jquery.scrollbar.min.js', 'argon'); ?>"></script>
    <script src="<?php echo get_theme_uri('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js', 'argon'); ?>">
    </script>

    <!-- Argon JS -->
    <script src="<?php echo get_theme_uri('js/argon9f1e.js?v=1.1.0', 'argon'); ?>"></script>
    <script src="https://unpkg.com/vue@3.0.5"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
        integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
        crossorigin="anonymous"></script>
    <script>
    const app = Vue.createApp({
        data() {
            return {
                search_input: "",
                search_result: "",
                search_container: true,
                filterProducts: [],
                img_path_url: "<?php echo base_url('assets/uploads/products/'); ?>",
                add_order_url: "<?php echo site_url('admin/orders/insert_order_item/'.$order_id); ?>",
            }
        },
        mounted() {
            this.searchProducts();
        },
        methods: {
            searchProducts: function() {
                const search = this.search_result = this.search_input;
                if (search != "") {
                    this.search_container = true;
                } else {
                    this.search_container = false;
                }
                axios.post("<?= site_url('home/search'); ?>", {
                        search,
                    })
                    .then((response) => {
                        this.filterProducts = response.data;
                        console.log(this.filterProducts);
                    }, (error) => {
                        console.log(error);
                    });

            },
            formatNumber(number) {
                number = parseInt(number);
                return number.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            },
        }
    })
    app.mount('#panel')
    </script>
</body>


</html>
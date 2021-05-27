<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Laporan Laba Rugi</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">pemasukan</h5>
                                    <!-- <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_income); ?></span> -->
                                    <span class="h2 font-weight-bold mb-0">Rp 1.000.000,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span class="text-nowrap">Total pemasukan</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">pengeluaran</h5>
                                    <!-- <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_income); ?></span> -->
                                    <span class="h2 font-weight-bold mb-0">Rp 112.000,00</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-warning mr-2"><i class="fa fa-arrow-down"></i></span>
                                <span class="text-nowrap">Total pengeluaran</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">keuntungan</h5>
                                    <!-- <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_income); ?></span> -->
                                    <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah(1000000-112000); ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                        <i class="ni ni-money-coins"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-3 mb-0 text-sm">
                                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                <span class="text-nowrap">Total keuntungan</span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Laporan Pemasukan</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#"
                                class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nilai Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col">
                                    1
                                </th>
                                <td>
                                    Penjualan
                                </td>
                                <td>
                                    Rp 1.000.000,00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Laporan Pengeluaran</h3>
                        </div>
                        <div class="col text-right">
                            <a href="#"
                                class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nilai Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col">
                                    1
                                </th>
                                <td>
                                    Gaji Karyawan
                                </td>
                                <td>
                                    Rp 100.000,00
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">
                                    2
                                </th>
                                <td>
                                    Sewa Tempat
                                </td>
                                <td>
                                    Rp 2.000,00
                                </td>
                            </tr>
                            <tr>
                                <th scope="col">
                                    3
                                </th>
                                <td>
                                    Air
                                </td>
                                <td>
                                    Rp 10.000,00
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
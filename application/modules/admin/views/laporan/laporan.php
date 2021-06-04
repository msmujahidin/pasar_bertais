<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">

            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-12">
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
            <div class="row mb-4">
                <div class="col-xl-3 col-md-4">
                    <form action="" method="POST">
                        <div class="form-row">
                            <div class="col-12 py-1">
                                <label class="text-white">Dari tanggal:</label>
                                <input name="first_date" value="<?= $first_date; ?>" type="date" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 py-1">
                                <label class="text-white">Sampai tanggal:</label>
                                <input name="second_date" value="<?= $second_date; ?>" type="date" class="form-control"
                                    required>
                            </div>
                            <div class="col-12 py-1">
                                <button class="btn btn-secondary btn-block d-md-none">submit</button>
                                <button class="btn btn-secondary d-none d-md-block">submit</button>
                            </div>
                        </div>
                    </form>
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
                                    <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_income); ?></span>
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
                                    <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_outcome); ?></span>
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
                                    <span class="h2 font-weight-bold mb-0">Rp
                                        <?php echo format_rupiah($total_profit); ?></span>
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
                            <a href="#" data-target="#addModalPemasukan" data-toggle="modal"
                                class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th width="10">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nilai Total</th>
                                <th width="10"></th>
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
                                    Rp <?php echo format_rupiah($income); ?>
                                </td>
                                <td></td>
                            </tr>
                            <?php foreach($other_incomes as $no => $income): ?>
                            <tr>
                                <th scope="col">
                                    <?= $no+2 ; ?>
                                </th>
                                <td>
                                    <?= $income->name; ?>
                                </td>
                                <td>
                                    Rp. <?= format_rupiah($income->value); ?>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <button data-target="#updateModalPemasukan" data-toggle="modal"
                                            data-id="<?= $income->id ?>" data-name="<?= $income->name ?>"
                                            data-value="<?= $income->value ?>"
                                            class="btn btn-warning btn-sm btn-edit"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_income('<?= $income->id ?>')"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
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
                            <a href="#" data-target="#addModalPengeluaran" data-toggle="modal" class="btn btn-sm btn-primary">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th width="10">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Nilai Total</th>
                                <th width="10"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($outcomes as $no => $outcome): ?>
                            <tr>
                                <th scope="col">
                                    <?= $no+1 ; ?>
                                </th>
                                <td>
                                    <?= $outcome->name; ?>
                                </td>
                                <td>
                                    Rp. <?= format_rupiah($outcome->value); ?>
                                </td>
                                <td>
                                    <div class="text-right">
                                        <button data-target="#updateModalPengeluaran" data-toggle="modal"
                                            data-id="<?= $outcome->id ?>" data-name="<?= $outcome->name ?>"
                                            data-value="<?= $outcome->value ?>"
                                            class="btn btn-warning btn-sm btn-edit-pengeluaran"><i class="fa fa-edit"></i></button>
                                        <button onclick="delete_outcome('<?= $outcome->id ?>')"
                                            class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalPemasukan" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent">
                            <h3 class="card-heading text-center mt-2">Tambah Pemasukan Lainnya</h3>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?= site_url('admin/laporan/income_api?action=add_income') ?>"
                                method="POST" id="addPemasukanForm">

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input name="name" class="form-control" placeholder="Nama " type="text"
                                            minlength="4" maxlength="255" required>
                                    </div>
                                    <div class="text-danger err name-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input name="value" class="form-control" placeholder="Nilai " type="number"
                                            required>
                                    </div>
                                    <div class="text-danger err value-error"></div>
                                </div>

                                <div class="text-left">
                                    <button type="button" class="btn btn-secondary my-4"
                                        data-dismiss="modal">Batal</button>
                                </div>
                                <div class="float-right" style="margin-top: -90px">
                                    <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModalPemasukan" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent">
                            <h3 class="card-heading text-center mt-2">Ubah data Pemasukan</h3>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?= site_url('admin/laporan/income_api?action=update_income') ?>"
                                method="POST" id="addPemasukanForm">
                                <input id="pemasukan-id" type="hidden" name="id" value="id">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input id="pemasukan-name" name="name" class="form-control" placeholder="Nama "
                                            type="text" minlength="4" maxlength="255" required>
                                    </div>
                                    <div class="text-danger err name-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input id="pemasukan-value" name="value" class="form-control"
                                            placeholder="Nilai " type="number" required>
                                    </div>
                                    <div class="text-danger err value-error"></div>
                                </div>

                                <div class="text-left">
                                    <button type="button" class="btn btn-secondary my-4"
                                        data-dismiss="modal">Batal</button>
                                </div>
                                <div class="float-right" style="margin-top: -90px">
                                    <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addModalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent">
                            <h3 class="card-heading text-center mt-2">Tambah Pengeluaran Lainnya</h3>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?= site_url('admin/laporan/outcome_api?action=create') ?>"
                                method="POST" id="addPengeluaranForm">

                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input name="name" class="form-control" placeholder="Nama " type="text"
                                            minlength="4" maxlength="255" required>
                                    </div>
                                    <div class="text-danger err name-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input name="value" class="form-control" placeholder="Nilai " type="number"
                                            required>
                                    </div>
                                    <div class="text-danger err value-error"></div>
                                </div>

                                <div class="text-left">
                                    <button type="button" class="btn btn-secondary my-4"
                                        data-dismiss="modal">Batal</button>
                                </div>
                                <div class="float-right" style="margin-top: -90px">
                                    <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="modal-form"
        aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-secondary border-0 mb-0">
                        <div class="card-header bg-transparent">
                            <h3 class="card-heading text-center mt-2">Ubah data Pengeluaran</h3>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form" action="<?= site_url('admin/laporan/outcome_api?action=update') ?>"
                                method="POST" id="addPengeluaranForm">
                                <input id="pengeluaran-id" type="hidden" name="id" value="id">
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input id="pengeluaran-name" name="name" class="form-control" placeholder="Nama "
                                            type="text" minlength="4" maxlength="255" required>
                                    </div>
                                    <div class="text-danger err name-error"></div>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-box-2"></i></span>
                                        </div>
                                        <input id="pengeluaran-value" name="value" class="form-control"
                                            placeholder="Nilai " type="number" required>
                                    </div>
                                    <div class="text-danger err value-error"></div>
                                </div>

                                <div class="text-left">
                                    <button type="button" class="btn btn-secondary my-4"
                                        data-dismiss="modal">Batal</button>
                                </div>
                                <div class="float-right" style="margin-top: -90px">
                                    <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const url = "<?php echo site_url();?>";

    function delete_income(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "/admin/laporan/income_api?action=delete_income&id=" + id;
        else
            return false;
    }
    function delete_outcome(id) {
        var r = confirm("Do you want to delete this?")
        if (r == true)
            window.location = url + "/admin/laporan/outcome_api?action=delete&id=" + id;
        else
            return false;
    }

    $(".btn-edit").click(function() {
        const id = $(this).attr('data-id');
        const name = $(this).attr('data-name');
        const value = $(this).attr('data-value');
        $("#pemasukan-id").val(id);
        $("#pemasukan-name").val(name);
        $("#pemasukan-value").val(value);
    });
    $(".btn-edit-pengeluaran").click(function() {
        const id = $(this).attr('data-id');
        const name = $(this).attr('data-name');
        const value = $(this).attr('data-value');
        $("#pengeluaran-id").val(id);
        $("#pengeluaran-name").val(name);
        $("#pengeluaran-value").val(value);
    });
    </script>
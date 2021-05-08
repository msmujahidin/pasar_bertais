<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Update Reseler</h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i
                                        class="fas fa-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo site_url('admin/customers'); ?>">Reseler</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
    <?php echo form_open_multipart('admin/customers/edit_customer/'.$customer->id); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card-wrapper">
                <div class="card">
                    <div class="card-header">
                        <h3 class="mb-0">Data Reseler</h3>
                        <?php if ($flash) : ?>
                        <span class="float-right text-success font-weight-bold" style="margin-top: -30px">
                            <?php echo $flash; ?>
                        </span>
                        <?php endif; ?>
                    </div>

                    <div class="card-body">

                        <!-- <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="username">Username:</label>
                                    <input id="username" class="form-control" type="text" placeholder="Username" minlength="4" maxlength="16" name="username" value="<?php echo set_value('username'); ?>" required>
                                    <?php echo form_error('username'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="password">Password:</label>
                                    <input id="password" class="form-control" type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" required>
                                    <?php echo form_error('password'); ?>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label class="form-control-label" for="name">Nama lengkap:</label>
                            <input id="name" class="form-control" type="text" placeholder="Nama lengkap" name="name"
                                value="<?php echo set_value('name', $customer->name); ?>" required>
                            <?php echo form_error('name'); ?>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="phone_number">No. HP:</label>
                            <input id="phone_number" class="form-control" type="text" placeholder="No. HP" minlength="9"
                                maxlength="15" name="phone_number" value="<?php echo set_value('phone_number', $customer->phone_number); ?>"
                                required>
                            <?php echo form_error('phone_number'); ?>
                        </div>

                        <div class="form-group">
                            <label class="form-control-label" for="kode_refral">Kode Refral:</label>
                            <input id="kode_refral" class="form-control" type="text" placeholder="Kode Refral" minlength="9"
                                maxlength="15" name="kode_refral" value="<?php echo set_value('kode_refral', $customer->kode_refral); ?>"
                                required>
                            <?php echo form_error('kode_refral'); ?>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="nilai_refral">Nilai Refral:</label>
                                    <input id="nilai_refral" class="form-control" type="text" placeholder="Nilai Refral" name="nilai_refral"
                                        value="<?php echo set_value('nilai_refral', $customer->nilai_refral); ?>" required>
                                    <?php echo form_error('nilai_refral'); ?>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="diskon">Diskon:</label>
                                    <input id="diskon" class="form-control" type="text" placeholder="Diskon"
                                        name="diskon" value="<?php echo set_value('diskon', $customer->diskon); ?>" required>
                                    <?php echo form_error('diskon'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-control-label" for="address">Alamat:</label>
                            <input id="address" class="form-control" type="text" placeholder="Alamat" name="address"
                                value="<?php echo set_value('address', $customer->address); ?>" required>
                            <?php echo form_error('address'); ?>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </div>

            </div>

        </div>
        <!-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-0">Foto</h3>
                </div>
                <div class="card-body">
                   <div class="form-group">
                     <label class="form-control-label" for="pic">Foto:</label>
                     <input type="file" name="picture" class="form-control" id="pic">
                     <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                   </div>
                </div>
                <div class="card-footer text-right">
                    <input type="submit" value="Tambah Produk Baru" class="btn btn-primary">
                </div>
            </div>
        </div> -->
    </div>

    </form>
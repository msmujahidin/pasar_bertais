<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/nucleo/css/nucleo.css', 'argon'); ?>"
        type="text/css">
    <link rel="stylesheet"
        href="<?php echo get_theme_uri('js/plugins/@fortawesome/fontawesome-free/css/all.min.css', 'argon'); ?>"
        type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="<?php echo get_theme_uri('css/argon9f1e.css?v=1.1.0', 'argon'); ?>" type="text/css">

</head>
<style>
.my-footer {
    width: 280px;
    height: 30px;
}


body {
    margin: 0;
    padding: 0;
    /* size: auto; */
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 14px;
    /* identical to box height */
    color: #000000;
    background-color: #fff;
}

.logo {
    width: 113.86px;
    height: 49.84px;
    margin-left: 72.19px;
    margin-top: 6mm;
    transform: rotate(0.21deg);
}

.web-title {
    margin-left: 74px;
}

.order-no {
    /* #Nomor_Pesanan */
    margin-left: 86px;
    margin-top: 10px;
    top: 81px;
}

hr.dashed {
    margin: 0;
    margin-top: 3px;
    border-top: 1px dashed #000;
}

@page {
    size: 58mm <?php echo $height ?>;
    margin: 0;
    padding: 0;
    margin-left: 6mm;
    margin-right: 6mm;
}

#section-to-print * {
    visibility: hidden;
}

@media print {
    body * {
        visibility: hidden;
    }

    #section-to-print * {
        visibility: visible;
    }
}
</style>

<body>
    <div id="section-to-print">
        <div>
            <img class="logo" src="<?= base_url('assets/logo.png') ?>" alt="">
        </div>
        <div class="web-title">
            www.pasarbertais.com
        </div>
        <div class="order-no">
            #<?= $data->order_number; ?>
        </div>
        <hr class="dashed mb-2">
        <table class="mb-2">
            <?php foreach($items as $item): ?>
                <tr class="pb-2">
                    <td width="30"><?= $item->order_qty ?></td>
                    <td width="180"><?= $item->name ?></td>
                    <td class="text-right" width="52"><?= format_rupiah($item->order_price) ?></td>
                </tr>
            <?php endforeach; ?>
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
</body>

<script src="<?php echo get_theme_uri('vendor/jquery/dist/jquery.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 'argon'); ?>"></script>

<script>
window.print();
</script>

</html>
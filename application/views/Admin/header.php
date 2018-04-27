<!DOCTYPE html>
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin </title>

    <link href="<?= base_url();?>assets/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/bootstrap/dist/css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/bootstrap/dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/bootstrap/dist/css/css.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/sb-admin.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/css/plugins/morris.css" rel="stylesheet">
    <link href="<?= base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="<?= base_url();?>assets/js/jquery-1.11.0.min.js"></script>
    <script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/morris/raphael.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/morris/morris.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/morris/morris-data.js"></script>
    <script src="<?= base_url();?>assets/js/jquery.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="<?= base_url();?>assets/js/plugins/flot/flot-data.js"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

</head>

<body>
    <?=anchor(base_url().'Login/logout', 'Cerrar sesión')?>
    <?=anchor(base_url().'Admin/aprobar', 'Aprobar')?>

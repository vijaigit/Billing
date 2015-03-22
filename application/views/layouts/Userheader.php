<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $template['title']; ?></title>
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css">
        <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.sheepItPlugin.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
        <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
        <script>
            function logout()
            {
                window.location = '<?php echo base_url(); ?>admin/logout';
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row-fluid well headtext">
                <div class="row-fluid pull-right">
                    <!-- img src="<?php echo base_url(); ?>assets/images/userheader.jpg"  / --> Billing Section
                </div>

            </div>
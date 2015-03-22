<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php if(isset($productid)){ ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
        <script src="<?php echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css">
        <style>
            body{
               color:#2D1717!important;
               font-size:14px!important;
            }
            .container{
                width:75%!important;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="row-fluid text-center well">
                <h2 style="color:#2D1717!important"><?php echo get_hotelname(); ?></h2> 
            </div>
            <div class="row-fluid well">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Item Price</th>    
                            <th>Qty</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($productid as $key => $value) {
                            if ($productid[$key] != ''):
                                ?>
                                <tr>
                                    <td><?php echo $productname[$key]; ?></td>
                                    <td><?php echo $price[$key]; ?></td>
                                    <td><?php echo $quantity[$key]; ?></td>
                                    <td><?php echo date("Y-m-d"); ?></td>
                                    <td><?php echo date("h:i:sa"); ?></td>
                                    <td><?php echo $total[$key]; ?></td>
                                    
                                </tr>
                                <?php
                            endif;
                        }
                        ?>
                    </tbody>
                </table>
                <div class="row text-center">
                    <center style="color:#2D1717!important">Total ----------------- <?php echo $totalamount; ?></center>
                </div>
                <div class="well row-fluid text-center" style="margin-top:10px">
                    <center>
                        <div style="margin-left:40px;word-break: break-all">
                            <?php echo get_address(); ?>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
</body> 
</html>
<?php } ?>
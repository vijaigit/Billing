<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui-1.10.4.custom.min.css" />
<script src="<?php echo base_url(); ?>assets/js/jquery-ui-1.10.4.custom.min.js"></script>
<style>
    .input-large{
        width: 169px!important;
    }
    .styleatag{
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
        color: #072417;
        font-size: 15;
        padding: 26;
        text-shadow: 1px 1px 1px #524646;
        padding-left: 10px;
        text-decoration:underline;
        cursor: pointer
    }
</style>
<div class="row-fluid well">
    <form action="" method="post" onsubmit="return validateform()">
        <div class="row-fluid"> 
            <center><legend><?php echo get_hotelname(); ?></legend></center>
        </div>
        <div class="row-fluid well">
            <div class="span1" style="margin-left:15px"><a href="<?php echo  base_url('user/daily_reports'); ?>" class="btn btn-danger"><li class="icon-download-alt"></li>Reports</a></div>
            <div class="span2 offset8" style="width:8.53%!important"><a class="btn btn-info" href="<?php echo base_url('user'); ?>"><li class="icon-refresh"></li> Refresh</a></div><div id="bill_add" class="span3" style="width:9.53%!important"><a class="offset btn btn-success"><li class="icon-plus"></li> Add More</a></div>
        </div>
        <div class="row-fluid">
            <div class="span2 offset1"><h5>Product Id</h5></div>
            <div class="span2"><h5>Product Name</h5></div>
            <div class="span2"><h5>Price</h5></div>
            <div class="span3"><h5>Quantity</h5></div>
            <div class="span2"><h5>Total</h5></div>
        </div>
        <div class="row-fluid">
            <div id="bill">
                <div id="bill_template">
                    <div class="span2 offset1"><input id="bill_#index#_id" name="productid[]" type="text" class="productid input-mini"/></div>
                    <div class="span2"><input id="bill_#index#_name" name="productname[]" type="text" class="productname input-large" /></div>
                    <div class="span2"><input id="bill_#index#_price" name="price[]" type="text" class="input-mini" readonly="true"/></div>
                    <div class="span3"><input id="bill_#index#_quantity" name="quantity[]" type="text" class="quanitity input-mini"/></div>
                    <div class="span2"><input id="bill_#index#_total" name="total[]" type="text" class="total input-small" readonly="true"/></div>
                </div>
                <div id="bill_noforms_template">No Fields</div>
            </div>


        </div>
        <div class="row-fluid well">

            <center><div class="span1 offset8"><b>Total</b>:</div><div class="span3"><input type="text" id="totalamount" name="totalamount" class="input-large" readonly="true"/></div></center>

        </div>
        <div class="row-fluid text-center">
            <input type="submit" id="pay" name="pay" class="btn btn-primary" value="Proceed"/>
        </div>

    </form>

</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#bill').sheepIt({
            separator: '',
            allowRemoveLast: true,
            allowRemoveCurrent: true,
            allowRemoveAll: true,
            allowAdd: true,
            allowAddN: true,
            maxFormsCount: 10,
            minFormsCount: 1,
            iniFormsCount: 5,
            afterAdd: function(source, newForm) {
                intiateautocomplete();
            }
        });
    });
</script>
<script>
    /* To get product name and price */
    function intiateautocomplete()
    {
        $(".productid").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/autocomplete',
                    dataType: "json",
                    data: {
                        name_startsWith: request.term,
                        type: 'product'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item,
                                value: item
                            }
                        }));
                    }
                });
            },
            select: function(e, u) {
                pid = u.item.value;
                /* get name and price from this id via ajax*/
                var id_productid = e.target.id;
                var id_productname = id_productid.replace('id', 'name');
                var id_price = id_productid.replace('id', 'price');
                var id_quantity = id_productid.replace('id', 'quantity');
                var id_total = id_productid.replace('id', 'total');
                $.post("<?php echo base_url('user/getProductid'); ?>",
                        {
                            pid: pid
                        },
                function(data, status) {
                    data = data.split('####');
                    $("#" + id_productname).val(data[0]);
                    $("#" + id_price).val(data[1]);
                    $("#"+id_quantity).val("");
                    $("#"+id_total).val("");
                });
            },
            autoFocus: true,
            minLength: 0
        });
        $('.productid').keyup(function() {
            var pid = $(this).val();
            var id_productid = $(this).attr('id');
            var id_productname = id_productid.replace('id', 'name');
            var id_price = id_productid.replace('id', 'price');
            var id_quantity = id_productid.replace('id', 'quantity');
            var id_total = id_productid.replace('id', 'total');
            $.post("<?php echo base_url('user/getProductid'); ?>",
                    {
                        pid: pid
                    },
            function(data, status) {
                data = data.split('####');
                $("#" + id_productname).val(data[0]);
                $("#" + id_price).val(data[1]);
                $("#" + id_quantity).val("");
                $("#" + id_total).val("");
            });
        });
        $('.quanitity').keyup(function() {
            var id = $(this).attr('id');
            var id_price = id.replace('quantity', 'price');
            var id_total = id.replace('quantity', 'total');
            price = $('#' + id_price).val();
            quantity = $(this).val();
            total = price * quantity
            $('#' + id_total).val(total);
            var totalamount = 0;
            $('.total').each(function() {
                if ($(this).val() != '')
                {
                    value = $(this).val();
                    totalamount = parseFloat(totalamount) + parseFloat(value);

                }
            });
            $('#totalamount').val(totalamount);

        });

        /* New functionality after fisrt demo */
        $(".productname").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '<?php echo base_url(); ?>user/autocomplete',
                    dataType: "json",
                    data: {
                        name_startsWith: request.term,
                        type: 'productname'
                    },
                    success: function(data) {
                        response($.map(data, function(item) {
                            return {
                                label: item,
                                value: item
                            }
                        }));
                    }
                });
            },
            select: function(e, u) {
                pname = u.item.value;
                /* get name and price from this id via ajax*/
                var id_productname = e.target.id;
                var id_productid = id_productname.replace('name', 'id');
                var id_price = id_productid.replace('id', 'price');
                var id_quantity = id_productid.replace('id', 'quantity');
                var id_total = id_productid.replace('id', 'total');
                $.post("<?php echo base_url('user/getProductid'); ?>",
                        {
                            pname: pname
                        },
                function(data, status) {
                    data = data.split('####');
                    $("#" + id_productid).val(data[0]);
                    $("#" + id_price).val(data[1]);
                     $("#" + id_quantity).val("");
                     $("#" + id_total).val("");
                });
            },
            autoFocus: true,
            minLength: 0
        });
        $('.productname').keyup(function() {
            var pname = $(this).val();
            var id_productname = $(this).attr('id');
            var id_productid = id_productname.replace('name', 'id');
            var id_price = id_productname.replace('name', 'price');
            var id_quantity = id_productname.replace('name', 'quantity');
            var id_total = id_productname.replace('name', 'total');
            $.post("<?php echo base_url('user/getProductid'); ?>",
                    {
                        pname: pname
                    },
            function(data, status) {
                data = data.split('####');
                $("#" + id_productid).val(data[0]);
                $("#" + id_price).val(data[1]);
                $("#" + id_quantity).val("");
                $("#" + id_total).val("");
            });
        });
        

    }
</script>
<script>
    function validateform()
    {
        var total = $('#totalamount').val();
        if (total > 0)
        {
            return true;
        } else {
            bootbox.alert('No value detected in Total box,Kindly Check it');
            return false;
        }

    }
</script>

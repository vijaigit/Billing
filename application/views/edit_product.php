<?php
##To Edit
if (!empty($details)) {
    $id = $details[0]['id'];
    $productId = $details[0]['productId'];
    $productName = $details[0]['productName'];
    $price = $details[0]['price'];
    $status = $details[0]['status'];
}
?>
<div class="row-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> >> </li>
        <li class="active">Update Products</li>
    </ol>
</div>
<?php
if ($this->session->userdata('info')) {
    ?>
    <div class="row-fluid alert-success text-center">
        <?php echo $this->session->userdata('info'); ?>
    </div>
    <?php
    $this->session->unset_userdata('info');
}
?>
<form class="form-horizontal" action="<?php echo base_url(); ?>admin/edit_products/<?php echo $id; ?>" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Add Product Form</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="pname">Product Name</label>
            <div class="controls">
                <input type="hidden" name="pidhidden" value="<?php echo (isset($id)) ? $id : ''; ?>">
                <input id="pname" name="pname" type="text" placeholder="Enter Product Name" value="<?php echo (isset($productName)) ? $productName : ''; ?>" class="input-xlarge" required="">
                <input type="hidden" id="hiddenPname" name="hiddenPname" value="<?php echo $productName; ?>" />
                <?php echo form_error('pname', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="productid">Product Id</label>
            <div class="controls">
                <input id="pid" name="productid" type="text" placeholder="####" class="input-xlarge" value="<?php echo (isset($productId)) ? $productId : ''; ?>" required="">
                <input type="hidden" id="hiddenPid" name="hiddenPid" value="<?php echo $productId; ?>" />
                <?php echo form_error('productid', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="price">Price</label>
            <div class="controls">
                <input id="price" name="price" type="text" value="<?php echo (isset($price)) ? $price : ''; ?>" placeholder="####" class="input-xlarge" required="">
                <?php echo form_error('price', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Multiple Radios -->
        <div class="control-group">
            <label class="control-label" for="status">Status</label>
            <div class="controls">
                <label class="radio" for="status-0">
                    <input type="radio" name="status" id="status-0" value="1"  <?php echo ($status == 1) ? 'checked="checked"' : ''; ?> >
                    Active
                </label>
                <label class="radio" for="status-1">
                    <input type="radio" name="status" id="status-1" value="0" <?php echo ($status == 0) ? 'checked="checked"' : ''; ?>>
                    Inactive
                </label>
                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="control-group">
            <label class="control-label" for="save"></label>
            <div class="controls">
                <input type="submit" id="save" name="save" class="btn btn-success" value="Update" />
                <button id="cancel" type="reset" name="cancel" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </fieldset>
</form>

<script>
    $(function() {
        /*  To check the uniqueness of productid and product name */
        $('#pname').blur(function() {
            var pname = $(this).val();
            var hiddenPname = $('#hiddenPname').val();
            if (pname != hiddenPname) {
                $.post("<?php echo base_url('admin/checkUnique'); ?>",
                        {
                            pname: pname,
                        },
                        function(data, status) {
                            if (data > 0)
                            {
                                $('#pname').val(hiddenPname);
                                bootbox.alert('Product name already exists');
                            }

                        });
            }

        });
        $('#pid').blur(function() {

            var pid = $(this).val();
            var hiddenPid = $('#hiddenPid').val();
            if (pid != hiddenPid) {
                $.post("<?php echo base_url('admin/checkUnique'); ?>",
                        {
                            pid: pid,
                        },
                        function(data, status) {
                            if (data > 0)
                            {
                                $('#pid').val(hiddenPid);
                                bootbox.alert('Product Id already exists');
                            }
                        });
            }
        });


    });
</script>

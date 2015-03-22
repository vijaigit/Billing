<div class="row-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> >> </li>
        <li class="active">Add Products</li>
    </ol>
</div>
<?php
if ($this->session->userdata('info')) {
    ?>
<div class="row-fluid alert-success text-center">
    <?php echo $this->session->userdata('info'); ?>
</div>
<?php $this->session->unset_userdata('info'); }
?>
<form class="form-horizontal" action="<?php echo base_url('admin/add_product'); ?>" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>Add Product Form</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="pname">Product Name</label>
            <div class="controls">
                <input id="pname" name="pname" type="text" placeholder="Enter Product Name" value="<?php echo set_value('pname'); ?>" class="input-xlarge" required="">
                <?php echo form_error('pname', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="productid">Product Id</label>
            <div class="controls">
                <input id="pid" name="productid" type="text" placeholder="####" class="input-xlarge" value="<?php echo set_value('productid'); ?>" required="">
                <?php echo form_error('productid', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="price">Price</label>
            <div class="controls">
                <input id="price" name="price" type="text" value="<?php echo set_value('price'); ?>" placeholder="####" class="input-xlarge" required="">
                <?php echo form_error('price', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Multiple Radios -->
        <div class="control-group">
            <label class="control-label" for="status">Status</label>
            <div class="controls">
                <label class="radio" for="status-0">
                    <input type="radio" name="status" id="status-0" value="1"  <?php echo (set_value('status') == 1)?'checked="checked"':''; ?> >
                    Active
                </label>
                <label class="radio" for="status-1">
                    <input type="radio" name="status" id="status-1" value="0" <?php echo (set_value('status') == 0)?'checked="checked"':''; ?>>
                    Inactive
                </label>
                <?php echo form_error('status', '<div class="error">', '</div>'); ?>
            </div>
        </div>

        <!-- Button (Double) -->
        <div class="control-group">
            <label class="control-label" for="save"></label>
            <div class="controls">
                <input type="submit" id="save" name="save" class="btn btn-success" value="Add" />
                <button id="cancel" type="reset" name="cancel" class="btn btn-danger">Cancel</button>
            </div>
        </div>

    </fieldset>
</form>

<?php
##To Edit
if (!empty($datas)) {
    $hname = $datas[0]['HOTEL_NAME'];
    $address = $datas[0]['ADDRESS'];
}
?>
<div class="row-fluid">
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>admin/dashboard">Dashboard</a> >> </li>
        <li class="active">General Settings</li>
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
<form class="form-horizontal" action="<?php echo base_url(); ?>admin/general_settings" method="post">
    <fieldset>

        <!-- Form Name -->
        <legend>General Settings Form</legend>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="hname">Hotel Name</label>
            <div class="controls">
                <input id="hname" name="hname" type="text" placeholder="Enter Hotel Name" value="<?php echo $hname; ?>" class="input-xlarge" required="">
            </div>
        </div>

        <!-- Text input-->
        <div class="control-group">
            <label class="control-label" for="address">Address</label>
            <div class="controls">
                <textarea class="input-xlarge" cols="50" rows="10" name="address"><?php echo $address; ?></textarea>
            </div>
        </div>

                <!-- Button (Double) -->
        <div class="control-group">
            <label class="control-label" for="save"></label>
            <div class="controls">
                <input type="submit" id="save" name="save" class="btn btn-success" value="Save" />
                <button id="cancel" type="reset" name="cancel" class="btn btn-danger">Reset</button>
            </div>
        </div>

    </fieldset>
</form>

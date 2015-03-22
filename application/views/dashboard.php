<style>
    #dashboard_length select{
        width:50px;  
    }
    table.dataTable tbody th, table.dataTable tbody td{
        padding:7px 18px;
    }
</style>
<div class="row-fluid ">
    <ol class="breadcrumb">
        <li class="active">Dashboard</li>
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
<form action="<?php echo base_url('admin/action'); ?>" method="post" onsubmit="return validate_checkbox()">
    <div class="row-fluid well text-right">
        <a href="<?php echo base_url(); ?>admin/general_settings" class="btn"><i class="icon-wrench"></i> <strong>General Settings</strong></a>
    </div>
    <div class="row-fluid well text-right">
        <a href="<?php echo base_url(); ?>admin/add_product" class="btn"><i class="icon-plus-sign"></i> <strong>Add Product</strong></a>
        <button name="delete" value="1" type="submit" class="btn"><i class="icon-trash"></i> <strong>Delete</strong></button>
        <button name="active" value="1" type="submit" class="btn"><i class="icon-ok"></i> <strong>Active</strong></button>
        <button name="inactive" value="1" type="submit" class="btn"><i class="icon-stop"></i> <strong>Inactive</strong></button>
    </div>
    <div class="well">
        <table class="table table-bordered" id="dashboardtable">
            <thead>
            <th><input type="checkbox" name="checkall" id="checkall"></th>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Actions</th>
            </thead>
            <tbody>
                <?php if (!empty($products)) { ?>
                    <?php foreach ($products as $details): ?>
                        <tr>
                            <td><input class="checkbox" name="products[]" type="checkbox" value="<?php echo $details['id']; ?>"></td>
                            <td><?php echo $details['productId']; ?></td>
                            <td><?php echo $details['productName']; ?></td>
                            <td><?php echo $details['price']; ?></td>
                            <td><?php echo $details['addedDate']; ?></td>
                            <th><?php
                                $status = $details['status'];
                                if ($status == 0) {
                                    echo '<text class="red">Inactive<text>';
                                } else {
                                    echo '<text class="green">Active<text>';
                                }
                                ?></th>
                            <td>
                                <a class="btn btn-success" href="<?php echo base_url(); ?>admin/edit_products/<?php echo $details['id']; ?>">
                                    <i class="icon-edit"></i> <strong>Edit</strong>
                                </a>
                            </td>
                        </tr>   
                        <?php
                    endforeach;
                }
                ?>
            </tbody>

        </table>
    </div>
</form>
<script>
    $(function() {
        $('#checkall').click(function() {
            if ($("#checkall").is(':checked'))
            {
                $('.checkbox').each(function() {
                    $(this).prop('checked', true);
                })
            } else {
                $('.checkbox').each(function() {
                    $(this).prop('checked', false);
                })
            }
        });

        /* Jquery datatable */
        $('#dashboardtable').DataTable(
                {
                    "iDisplayLength": 10,
                });

    });

    function validate_checkbox()
    {
        var matches = [];
        $(".checkbox:checked").each(function() {
            matches.push(this.value);
        });
        if (matches != '')
        {
            return true;
        } else {
            bootbox.alert('Select Any Products to Proceed');
            return false;
        }


    }
</script>

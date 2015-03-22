<div class="row-fluid"> 
    <div class="span5  well offset3 text-center">
        <form action="" method="post" class="form-horizontal">
            <fieldset>
                <legend>
                    Login
                </legend>
                <div class="control-group">
                    <?php if ($this->session->userdata('info')): ?>
                        <div class="alert alert-error">
                            <a class="close" data-dismiss="alert" href="#">×</a><?php echo $this->session->userdata('info'); ?>
                        </div>
                        <?php $this->session->unset_userdata('info');
                    endif; ?>
                </div>
                <div class="control-group">
                    <label class="control-label">User Name :</label>
                    <input type="text" id="username" name="username" class="input-large" required="" value="<?php echo set_value('username'); ?>"/> 
<?php echo form_error('username', '<div class="error">', '</div>'); ?>
                </div>
                <div class="control-group">
                    <label class="control-label">Password :</label>
                    <input type="password" id="password" name="password" class="input-large" required="" value="<?php echo set_value('password'); ?>"/> 
<?php echo form_error('password', '<div class="error">', '</div>'); ?>
                </div>
                <div class="form-actions">
                    <input type="submit" id="submit" name="submit" class="btn btn-success" value="Login" /> 
                </div>
            </fieldset>




        </form>
    </div>
</div>
<?php
include APPPATH.'views/admin/header.php';
?>

    <div id="login_form">
        <?php echo form_open($this->config->item('admin_url').'/login', 'post') ?>

        <ul>
            <li>
                <?php echo form_label( 'username' ) ?>
                <?php echo form_input('username') ?>
            </li>
            <li>
                <?php echo form_label( 'password' ) ?>
                <?php echo form_password('password') ?>
            </li>
        </ul>

        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

        <?php echo form_submit('Login') ?>

        <?php echo form_close() ?>
    </div>

<?php
include APPPATH.'views/admin/footer.php';
?>
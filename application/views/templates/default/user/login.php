<style type="text/css">
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        max-width: 400px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
        box-shadow: 0 1px 2px rgba(0,0,0,.05);
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
        margin-bottom: 10px;
    }
    .form-signin input[type="text"],
    .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
    }

</style>

<?php $params = array('class' => 'form-signin'); ?>
<?php echo form_open('login', $params); ?>
    <?php if($this->session->flashdata("auth_reason")){ ?>
    <div class='alert alert-block'>
        <button type='button' class='close' data-dismiss='alert'>&times;</button>
        <?php echo $this->session->flashdata("auth_reason"); ?>
    </div>
    <?php } ?>
    <?php echo validation_errors("<div class='alert alert-error alert-block'><button type='button' class='close' data-dismiss='alert'>&times;</button>", "</div>"); ?>                                
    <h2 class="form-signin-heading">Sign in</h2>
    <input type="text" name="username" class="input-block-level" value="<?php echo set_value('username'); ?>" placeholder="Email address / Username">
    <input type="password" name="password" class="input-block-level" placeholder="Password">
    <label class="checkbox">
        <input type="checkbox" name="remember_me" <?php echo set_checkbox('remember_me', 'yes'); ?> value="yes"> Remember me
    </label>
    <button class="btn btn-large btn-primary" type="submit">Sign in</button>
</form>
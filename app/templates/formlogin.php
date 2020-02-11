<?php ob_start() ?>
<div class="col center-block ">

<h2 class="text-center">Log in</h2>
<form name="formlogin" method="POST" class="text-center">
<div class="form-label">
    <label for="username">
        Email
    </label>
</div>
<div class="form-input">
    <input type="text" name="username" id="username" size="15" value="" autocomplete="username" required>
</div>

<div class="form-label">
    <label for="password">Password</label>
</div>

<div class="form-input">
    <input type="password" name="password" id="password" size="15" value="" autocomplete="current-password" required>
</div>

<div class="rememberpass">
    <input type="checkbox" name="rememberusername" id="rememberusername" value="1" />
    <label for="rememberusername">Remember username</label>
</div>

<button class="btn btn-primary" type="submit" id="login" name="login" value="Log in" >Log In</button>
<button class="btn btn-secondary" type="button" onclick="" id="goToSingup" name="goToSingup" value="Sing up" >Sing up</button>
<div class="forgetpass">
    <a href="forgot_password.php">Forgotten your username or password?</a>
</div>
</form>
<script>
    window.onload = function () {
        $('#goToSingup').click(() => {
            location = 'index.php?ctl=formregistro';
        });
    }
</script>
</div>
<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>

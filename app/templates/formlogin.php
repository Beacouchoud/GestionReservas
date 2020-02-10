<?php ob_start() ?>
<h2>Log in</h2>
<!-- <form name="formlogin" action="index.php?ctl=login" method="POST">
<p>User<input type="text" name="nombre_user" id="nombre_user"> </p>
<p>Password<input type="password" name="pass" id="pass"> </p>
<p> <input type="button" value="Sing in" name="login" id="login" > </p>
<a href="#">Forgot my password </a> -->
<form name="formlogin" method="POST">
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

<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>


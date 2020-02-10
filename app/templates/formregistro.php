<?php ob_start() ?>
<h2>Sing Up</h2>
<form name="formsingup"  method="POST" class="form-row d-flex justify-content-center">
 <div class="col-3">
 <div class="row">
    <div class="col-12 form-group">
        <label class="d-flex justify-content-start" for="name">
            Name
        </label>
        <input type="text" class="form-control" name="name" id="name" size="15" value="" autocomplete="name" required>
    </div>

    <div class="col-12 form-group">
        <label for="lastname" class="d-flex justify-content-start">
        Last name
        </label>
        <input type="text" class="form-control" name="lastname" id="lastname" size="15" value="" autocomplete="lastname" required>
    </div>

    <div class="col-12 form-group">
        <label for="email" class="d-flex justify-content-start">Email</label>
        <input type="email" class="form-control" name="email" id="email" size="15" value="" autocomplete="current-email" required>
    </div>

    <div class="col-12 form-group">
        <label for="password" class="d-flex justify-content-start">Password</label>
        <input type="password" class="form-control" name="password" id="password" size="15" value="" autocomplete="current-password" required>
    </div>

    <div class="col-12 form-group ">
        <label for="imagen" class="d-flex justify-content-start">Profile Photo</label>
        <input type="file" size="44" name="imagen" id="imagen" accept="image/x-png,image/gif,image/jpeg" >
    </div>

<div class="col-12 d-flex justify-content-around">
    <button type="submit" class="btn btn-primary btn-lg" id="singup" name="singup" value="Sign up" >Sign up</button>
    <button type="button" class="btn btn-secondary btn-lg" id="gotToLogin" name="gotToLogin" value="Log in" >Log In</button>
</div>
    </div>
 </div>
</form>
<script>
    window.onload = function () {
        $('#gotToLogin').click(() => {
            location = 'index.php?ctl=formlogin';
        });
    }
</script>


<?php $contenido = ob_get_clean() ?>

<?php include 'layoutinicial.php' ?>
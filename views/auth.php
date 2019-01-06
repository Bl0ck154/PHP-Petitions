<div class="container text-center w-75">
    <form method="post" action="#" class="form-signin">

        <div class="form-group">
            <input type="email" name="email" class="form-control"
                   placeholder="Email" value="<?=$email?>" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button class="btn btn-primary w-100" type="submit">Login</button>
    </form>
    <a href="recover.php">Forgot password?</a>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/main.js"></script>

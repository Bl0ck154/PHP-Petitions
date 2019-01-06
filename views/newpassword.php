<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-3">
            <a href="http://<?=$_SERVER['HTTP_HOST']?>">Index</a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <form method="post" action="#">

                <div class="form-group">
                    <input type="password" name="password" class="form-control"
                           placeholder="New password" required>
                    <input type="password" name="cpassword" class="form-control"
                           placeholder="Confirm password" required>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="../js/main.js"></script>
</body>
</html>
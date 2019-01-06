<div class="container">
    <br/>
    <div class="card">
        <div class="card-header">
            <h4>Petition "<?=$petition->title?>"</h4>
        </div>
        <div class="card-body">
            <div><?=$petition->description?></div>
        </div>
        <div class="card-footer text-muted d-flex justify-content-between">
            <div class="author">Created by: <?=$petition->email?></div>
            <div class="count h6"><?=$petition->signs?> signatures</div>
        </div>
    </div>
    <br/>
    <div class="float-right">
        <form method="post" action="sign.php?id=<?=$petition->pid?>">
            <input type="submit" value="Sign this petition" class="btn btn-success">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/main.js"></script>

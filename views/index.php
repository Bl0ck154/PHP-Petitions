<div class="container">
    <div class="d-flex justify-content-center">
        <h5><?=$sessionMessage?></h5>
    </div>

    <nav aria-label="...">
        <ul class="pagination justify-content-center">
            <li class="page-item<?if($current_page == 1) echo ' disabled';?>">
                <a class="page-link" href="1" aria-label="First">
                    <span aria-hidden="true">First</span>
                    <span class="sr-only">First</span>
                </a>
            </li>
            <li class="page-item<?if($current_page == 1) echo ' disabled';?>">
                <a class="page-link" href="<?=$current_page-1?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <? $start = max(1, $current_page-($current_page == $total_pages ? 2 : 1));
            for ($i = $start; $i <= min($total_pages,$start+2); $i++) {?>
                <li class="page-item<?if($i == $current_page) echo ' active';?>">
                    <a class="page-link" href="<?=$i?>"><?=$i?></a>
                </li>
            <?}?>

            <li class="page-item<?if($current_page >= $total_pages) echo ' disabled';?>">
                <a class="page-link" href="<?=$current_page+1?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            <li class="page-item<?if($current_page >= $total_pages) echo ' disabled';?>">
                <a class="page-link" href="<?=$total_pages?>" aria-label="Last">
                    <span aria-hidden="true">Last</span>
                    <span class="sr-only">Last</span>
                </a>
            </li>
        </ul>
    </nav>


    <? foreach ($petitions as $petition) {?>
        <div class="petition-block" id="petition-<?=$petition->id?>">
            <div class="card bg-light mb-3 m-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="h5">
                            <?=$petition->title?>
                        </div>
                        <div class="card-signs">
                            Signs: <?=$petition->signs?>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <?=$petition->shortDescription?>
                        <div class="sticky-bottom">
                            <a class="btn btn-outline-primary btn-sm" href="petition.php?id=<?=$petition->id?>">Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}?>

</div>

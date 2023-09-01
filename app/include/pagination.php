<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
        <a class="page-link" href="              
          <?php if(!isset($_GET['id'])): ?>
            ?page=1
          <?php else: ?>  
            ?id=<?= $_GET['id']?>&page=1
          <?php endif?>">First
        </a>
    </li>

    <?php if($page > 1):?>
        <li class="page-item">
            <a class="page-link" href="
              <?php if(!isset($_GET['id'])): ?>
                ?page=<?php echo ($page - 1)?>
              <?php else: ?>  
                ?id=<?= $_GET['id']?>&page=<?php echo ($page - 1)?>
              <?php endif?>">Prev
            </a>
        </li>
    <?php endif?> 

    <?php if(!isset($_GET['id'])): ?>
      <?php for($i=1; $i<=$total; $i++): ?>
            <li class="page-item">      
                <a class="page-link" href="?page=<?php echo $i?>">
                    <?php echo $i?>
                </a>           
            </li>
      <?php endfor?>
    <?php endif?>

    <?php if($page < $total):?>
        <li class="page-item">
            <a class="page-link" href="
              <?php if(!isset($_GET['id'])): ?>
                ?page=<?php echo ($page + 1)?>
              <?php else: ?>  
                ?id=<?= $_GET['id']?>&page=<?php echo ($page + 1)?>
              <?php endif?>">Next
            </a>
        </li>
    <?php endif?>  
       
    <li class="page-item">
      <a class="page-link" href="
          <?php if(!isset($_GET['id'])): ?>
            ?page=<?php echo $total?>
          <?php else: ?>  
            ?id=<?= $_GET['id']?>&page=<?php echo $total?>
          <?php endif?>">Last
      </a>
    </li>
  </ul>
</nav>
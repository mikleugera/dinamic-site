<?php if(count($errMSG) > 0): ?>
    <ul>
        <?php foreach($errMSG as $error): ?>
            <li><?=$error?></li>
        <?php endforeach?>  
    </ul>  
<?php endif?>
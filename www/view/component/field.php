<?php
/**
* @var array $data
*/

$name = $data["name"];
?>

<div class="form-group">
    <label class="label" for="<?=$name?>"><?=$data["title"]?>:</label>
    <input class="input" type="<?=$data["type"]?>" id="<?=$name?>" name="<?=$name?>"/>
    <?php if ($session->has($name)) { ?>
    <ul style="color:red;">
        <?php foreach ($session->getFlash($name) as $error) { ?>
        <li><?=$error?></li>
        <?php }?>
    </ul>
    <?php } ?>
</div>

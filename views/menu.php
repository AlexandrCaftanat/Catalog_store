<?php defined("CATALOG") or die("Access denied");?>

<ul class="menu" >

<!-- Получаем alias в $link title в $item_page -->

<?php foreach ($pages as $link => $item_page): ?>
<?php if ($item_page == 'Главная'): ?>
    <li><a href="<?=PATH?>"><?=$item_page?></a></li>
        <?php else:?>
    <li><a href="<?php echo PATH .'page/'. $link?>"><?=$item_page?></a></li>
    <?php endif;?>
<?php endforeach;?>

    <!-- <li><a href="">link1</a></li>
    <li><a href="">link2</a></li>
    <li><a href="">link3</a></li> -->
</ul>
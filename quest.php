<?php
    require_once 'function.php';

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Гостевая страница</title>
</head>
<body>
<h2>Гостевая страница</h2>
<?php
    $text = file_get_contents('list.php');
    If (!empty($text)){
        $string = explode(" ", $text);
        array_pop($string);
    } else {
        echo "Тесты не загружены"; die;
    }
?>
<form name="n1" action="test.php" method="GET">
    <div>Доступные тесты:</div>
    <br>
    <?php foreach($string as $key=>$el){?>
        <div><?php echo "$el";?></div>
        <div><name="<?php echo "$key";?>" value="a" /> </div>
        <br>
    <?php }    ?>
    <input type="button" value="Выйти" onclick="location='index.php' "/>
</form>
</body>
</html>
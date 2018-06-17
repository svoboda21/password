<?php
    require_once 'function.php';
    if (empty($_SESSION['test'])) {
        header("HTTP/1.1 403 Forbidden");
        die;
    }
    require_once 'function.php';
    if (!isAuthorized()) {
        redirect('index');
    }
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
      <title>Тест</title>
  </head>
<body>
<?php

    $text = file_get_contents('list.php');
    If (!empty($text)) {
        $string = explode(" ", $text);
        array_pop($string);
    } else {
        echo "Тесты не загружены";
        redirect('admin');
    }

?>
  <form name="n1" action="test.php" method="GET">
    <div>Доступные тесты:</div>
    <br>
        <?php foreach($string as $key=>$el){?>
          <div><?php echo "$el";?></div>
          <div><input type="radio" name="<?php echo "$key";?>" value="a" /> </div>
          <div><input type="submit" name="1" value="Начать"></div>
            <br>
            <div><input type="submit" name="2" value="Удалить"></div>
            <br>
            <input type="button" value="Выйти" onclick="location='index.php' "/>
<?php
    if (isset($_GET[2])){
        if (file_exists($el)) {
            unlink($el);
            $erase = str_replace("$el ", "", $text);
            file_put_contents('list.php', $erase);
            echo "Файл $el удален";
            redirect('admin');
            } else {
                echo "Файл $el уже удален";
                die;
            }
    }
                }
    for($i=0; $i<count($string);$i++){
            if (isset($_GET[$i])){
                $filenew1 = file_get_contents("$string[$i]");
                $filenew = json_decode($filenew1,true);
                file_put_contents('temp.txt', $filenew['decision']);
                file_put_contents('temp1.txt',$filenew['question']);
                file_put_contents('temp2.txt', $filenew['question1'] );
?></form>
      <form action="test.php" method="GET">
          <br>
          <fieldset>
              <legend><?php echo "$filenew[question]"; ?></legend>
              <label><input type="radio" name="q1" value="1"> <?php echo $filenew['answer'][1]; ?></label>
              <label><input type="radio" name="q1" value="2"> <?php echo $filenew['answer'][2]; ?></label>
              <label><input type="radio" name="q1" value="3"> <?php echo $filenew['answer'][3]; ?></label>
              <label><input type="radio" name="q1" value="4"> <?php echo $filenew['answer'][4]; ?></label>
          </fieldset>
          <br>
          <fieldset>
              <legend><?php echo "$filenew[question1]"; ?></legend>
              <label><input type="radio" name="q2" value="5"> <?php echo $filenew['answer1'][5]; ?></label>
              <label><input type="radio" name="q2" value="6"> <?php echo $filenew['answer1'][6]; ?></label>
              <label><input type="radio" name="q2" value="7"> <?php echo $filenew['answer1'][7]; ?></label>
              <label><input type="radio" name="q2" value="8"> <?php echo $filenew['answer1'][8]; ?></label>
          </fieldset>
          <br>
          <input type="submit" value="Отправить">
          <?php
              }
              };
              $temp = file_get_contents("temp.txt");
              $temp1 = file_get_contents("temp1.txt");
              $temp2 = file_get_contents("temp2.txt");
              $answer1=substr($temp, 0,1);
              $answer2=substr($temp, 1);
          ?>
      </form>
      <br>
      <?php if (!empty($_GET["q1"])&& $_GET["q1"]== $answer1) {
          echo "Ответ на вопрос: \"$temp1\" - Правильный!";
          $_SESSION['a']=1;
            };
      ?>
      <br>
      <?php if (!empty($_GET["q1"])&& $_GET["q1"]!== $answer1){echo "Ответ на вопрос: \"$temp1\" -Не правильно!";
          $_SESSION['a']=0;
      };?>
      <br>
      <?php if (!empty($_GET["q2"])&& $_GET["q2"]== $answer2){echo "Ответ на вопрос: \"$temp2\" - Правильный!";
          $_SESSION['b']=1;
      };?>
      <br>
      <?php if (!empty($_GET["q2"])&& $_GET["q2"]!== $answer2){echo "Ответ на вопрос: \"$temp2\" -Не правильно!";
          $_SESSION['b']=0;
      };?>
<form action="result.php" method="POST">
    <br>
    <p><input type='submit' value='Получить серификат'></p>
</form>
</body>



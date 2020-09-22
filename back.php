<?php



$x = isset($_GET['x']) ? intval($_GET['x']) : null;
$y = isset($_GET['y']) ? floatval($_GET['y']) : null;
$r = isset($_GET['r']) ? floatval($_GET['r']) : null;

session_start();

date_default_timezone_set('Europe/Moscow');
$currentTime = date("H:i:s");
if (!validate($x, $y, $r)) {
    http_response_code(400);
    return;
}
$res = check($x, $y, $r) ? "<span style='color: #439400'>Попала</span>" : "<span style='color: #94002D'>Не попала</span>";
$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];


$_SESSION['results'][] = [$x, $y, $r, $currentTime, $time, $res];

function check($x, $y, $r){
    if(($x>=0)&&($y>=0)){
        if ($y<=($r/2)-$x){
            return true;
        }
        else{
            return false;
        }
    }
    else if(($x<0)&&($y>0)){
        if(($y<=$r/2)&&($x>=-$r)){
            return true;
        }
        else{
            return false;
        }
    }
    else if(($x>=0)&&($y<=0)){
        if(($x*$x)+($y*$y) <= $r*$r){
            return true;
        }
        else{
            return false;
        }
    }
    else{
        return false;
    }
}
function validate($x, $y, $r)
{
    return in_array($x, [-4, -3, -2, -1, 0, 1, 2, 3, 4])
        and is_numeric($y) and $y >= -3 and $y <= 3
        and in_array($r, [1, 2, 3, 4, 5]);
}

?>

<table align="center" class="result_table">
    <tr>
        <th width="15%">X</th>
        <th width="15%">Y</th>
        <th width="15%">R</th>
        <th width="15%">Время запуска</th>
        <th width="15%">Время работы</th>
        <th width="15%">Результат</th>
    </tr>
    <?php foreach ($_SESSION["results"] as $i) { ?>
        <tr>
            <th><?php echo $i[0] ?></th>
            <th><?php echo $i[1] ?></th>
            <th><?php echo $i[2] ?></th>
            <th><?php echo $i[3] ?></th>
            <th><?php echo $i[4] ?></th>
            <th><?php echo $i[5] ?></th>
        </tr>
    <?php } ?>
</table>

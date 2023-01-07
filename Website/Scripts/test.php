<?php
require_once "Config.php";
$ref = "ITW_03_01_2023_5MsRkB";
$query="SELECT id FROM orders WHERE invoice = '".$ref."'";
$query = mysqli_query($link,$query);
$task = mysqli_fetch_assoc($query);
$result = $task['id'];
if(!empty($result))
{
    echo $result;
    return $result;
}
else
{
    return false;
}
mysqli_close($link);
?>
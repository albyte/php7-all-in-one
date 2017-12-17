<?php
$format = 'H:i:s';
$now = time();
$after1hour = strtotime("+1 hour");
?>
Now: <b>"<?= date($format, $now); ?>"</b><br>
After 1 hour: <b><?= date($format, $after1hour); ?>
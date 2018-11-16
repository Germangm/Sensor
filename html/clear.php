<?php

exec("sudo pkill python3");

exec("sudo rm /home/pi/output.csv");
exec("sudo rm /var/www/html/output.csv");
echo("Todos los Datos fueron Borrados");
?>

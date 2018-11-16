<?php
// Set time.
exec("sudo date -u -s \"@" . $_POST["time"] . "\"");

$port = exec("ls -ltr /dev|grep -i ttyACM0");
if ($port != "")
{

	exec("sudo pkill python3");

	exec("sudo python3 /home/pi/recolector.py > /dev/null &");
	echo("Recolectando Datos");
}
else
{
	echo("Favor de Conectar y prender el Sensor");
}
?>

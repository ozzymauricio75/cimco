<b>Errores de PHP</b>
<pre>
<?php

$mensajes = system("/usr/bin/tail -20 /var/log/httpd/error_log", $codigo);

echo $mensajes;

?>
</pre>
<b>Errores de SQL y Sistema Operativo</b>
<pre>
<?php

$mensajes = system("/usr/bin/tail -20 /var/log/syslog", $codigo);

echo $mensajes;

?>
</pre>

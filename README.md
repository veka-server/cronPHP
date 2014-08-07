cronPHP
=======

Une classe php qui permet de faire des taches plus ou moin regulierement sans cron.

Exemple d'utilisation
====

Ne pas oublier d'éditer le chemin dans le fichier class.

Exemple de fichier appelant
```
<?php
	include "cronPHP.php";

	$cron = new PHPCron();

	// script de sauvegarde de BDD
	$cron->addTache('script.php', 6); // 604800 = 6 secondes

	// script de sauvegarde de BDD
	$cron->addTache('saveBDD.php', 604800); // 7 jours

	// script de newsletter
	$cron->addTache('newsletter.php', 604800); // 7 jours
?>
```


Exemple de script a éxécuter
```
<?php
	ob_end_clean();
	header("Connection: close");
	ignore_user_abort(true);
	ob_start();
	$size = ob_get_length();
	header("Content-Length: $size");
	ob_end_flush(); 
	flush();


  // faire se que l'on veux 
?>
```

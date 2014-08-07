<?php 

/**
* Execute des taches planifié 
*/
class PHPCron
{
	public $chemin = '/srv/http/cronPHP/'; // chemin vers le dossier de destination des fichier temporaire

	public function __construct()
	{
		$this->init();
	}

	/*
	*	Frequence en seconde
	*/
	public function addTache($action, $frequence, $salt="8po5y")
	{
		$id = md5($action.$frequence.$salt);

		if (file_exists($this->chemin.$id) and !is_writable($this->chemin.$id))
			die('Le fichier de sauvegarde de la tache <b>'.$action.'</b> n\'est pas disponible en ecriture');
		elseif (!file_exists($this->chemin.$id))
			file_put_contents($this->chemin.$id, '{"last" : '.time().'}');

		$json = file_get_contents($this->chemin.$id);
		$json = json_decode($json);

		if( ($json->last+$frequence) < time())
		{
			file_put_contents($this->chemin.$id, '{"last" : '.time().'}');

			include($action);
		}
	}

	public function init()
	{
		if(!is_writable($this->chemin))
			die('Le dossier de sauvegarde <b>'.$this->chemin.'</b> n\'est pas disponible en ecriture.');
	}

}

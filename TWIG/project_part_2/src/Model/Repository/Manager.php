<?php

namespace MyApp\Model\Repository;

use PDO;
use PDOException;

/**
 * Class EntityManager
 * @package MyApp\Repository
 */
class Manager
{
	/**
	 * @var PDO
	 */
	protected $db;

	/**
	 * EntityManager constructor.
	 */
	public function __construct()
	{
//		Le "try catch" fonctionne comme une condition classique, dans le try on essaie, si cela fonctionne, on execute, sinon on rentre dans le catch et on renvoie une erreur
		try {
//			Initialisation de PDO en récupérant les constantes défini dans confid.php
			$this->db = new PDO(APP_DSN, APP_DB_USER, APP_DB_PWD);

//			Ajoute d'option permettant une meilleur gestion des erreurs
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $e) {
			echo 'Connexion échouée : ' . $e->getMessage();
		}
	}
}
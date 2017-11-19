<?php

namespace MyApp\Model\Repository;

use MyApp\Model\Entity\User;
use PDO;

/**
 * Class UserManager
 * @package MyApp\Model\Repository
 */
class UserManager extends Manager {

	/**
	 * Get all user
	 * @return array
	 */
	public function getAll(){
//		Définition de la requete
		$req = $this->db->query('SELECT * FROM user');

//		Traitement et renvoie du résultat
//		Ici, grâce à PDO, la réponse sera formaté sous forme d'objet de type **User**, d'ou l'intérêt d'avoir une entité User correspondant exactement à la structure de la table User
		return $req->fetchAll(PDO::FETCH_CLASS, User::class);
	}
}
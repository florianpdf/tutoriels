<?php

namespace MyApp\Controllers;

/**
 * Class DefaultController
 * @package MyApp\Controllers
 */
class DefaultController extends Controller
{
	public function indexAction(){
		$users = [
			[
				'prenom' => "Florian",
				'nom' => "Grandjean",
				'age' => "28"
			],
			[
				'prenom' => "Alexis",
				'nom' => "Ducerf",
				'age' => "28"
			],
		];
		return $this->twig->render('home.html.twig', array(
			'users' => $users
		));
	}
}
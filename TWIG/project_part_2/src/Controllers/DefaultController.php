<?php

namespace MyApp\Controllers;

/**
 * Class DefaultController
 * @package MyApp\Controllers
 */
class DefaultController extends Controller
{
	public function indexAction(){
		$userManager = new \MyApp\Model\Repository\UserManager();
		$users = $userManager->getAll();

		return $this->twig->render('home.html.twig', array(
			'users' => $users
		));
	}
}
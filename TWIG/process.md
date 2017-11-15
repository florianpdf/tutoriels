1. Creation de l'architecture
	1. Créer un dossier public
		1. Dans le dossier public:
			1. Créer index.php
			1. Un dossier assets qui contiendra css, js, et image
	1. Créer un dossier src
		1. Dans le dossier src
			1. Créer un dossier Controller
			1. Créer un dossier Views

2. Initialisation avec composer
	1. `composer init` dans le terminal dans le dossier du projet
	2. Valider tous les champs avec la conf par défault
	3. A la question voulez vous charger les dépendances (prod et dev) de manière interactive, répondre **no**

3. Initialiser l'autoload dans le composer.json
	1. Rajouter les lignes ci dessous au *composer.json* et remplacer **MyApp** par votre namespace global
	```
	    "autoload": {
        "psr-4": {
            "MyApp\\": "src/"
        }
    },
    ```
    2. Mettre à jour composer
    	1. `composer update` dans le terminal dans le dossier du projet

4. Charger twig
	1. `composer require twig/twig` dans le terminal dans le dossier du projet

5. Configurer twig
	1. Dans le dossier controller, créer un fichier **Controller.php**
	2. Ajouter dans ce fichier la configuration de twig (ceci est une configuration type), penser à remplacer **MyApp** par votre namespace global que vous avez défini dans le **composer.json**
	```
	<?php

	namespace MyApp\Controllers;

	use Twig_Loader_Filesystem;
	use Twig_Environment;
	use Twig_Extension_Debug;

	/**
	 * Class Controller
	 */
	class Controller
	{
		/**
		 * @var Twig_Environment
		 */
		protected $twig;

		/**
		 * Twig Controller constructor.
		 */
		public function __construct()
		{
	//		Load Twig Configuration
			$loader = new Twig_Loader_Filesystem('../src/Views/');
			$this->twig = new Twig_Environment($loader, array(
				'cache' => false,
				'debug' => true
			));
			$this->twig->addExtension(new Twig_Extension_Debug());
		}
	}
	```

6. Créer un fichier **DefaultController.php**
	7. Dans le fichier déclarer une class **DefaultController** qui va hériter de la class **Controller* (pour rappel, la class controller dispose de la configuration de twig, DefaultController pourra donc profiter de cette configutation)  
	Remplacer **MyApp** par votre namespace global defini dans le **composer.json**
	```
	<?php

	namespace MyApp\Controllers;


	/**
	 * Class DefaultController
	 * @package MyApp\Controllers
	 */
	class DefaultController extends Controller
	{

	}
	```

7. Le dispatcher
Dans index.php (le fichier se trouve dans le dossier public), créer notre dispatcher, **index.php** est notre controller frontal, c'est ce fichier qui a pour mission de rediriger l'utilisateur vers le controller adequat.
Penser à faire un require de l'autoload.
```
<?php

// Get Vendor autoload
require_once '../vendor/autoload.php';

use MyApp\Controllers\DefaultController;

$defaultController = new DefaultController();

if (empty($_GET)){
	echo $defaultController->indexAction();
}
```
Ici, si l'utilisateur ne renseigne rien dans l'url, la méthode **indexAction()** du controller **DefaultController** sera appelé.

8. Définition de la méthode dans le **DefaultController**
	1. Dans le fichier **DefaultController**, création de la methode **indexAction()** qui va retourner vers la vue "home.html.twig" (cette dernière n'existe pas encore)
	```
	public function indexAction(){
		return $this->twig->render('user/home.html.twig');
	}
	```

9. Création de la vue
	1. Dans le dossier views, création dans un premier temps de la structure général de notre html
	2. Création d'un fichier **layout.html.twig** et ajouter la structure html "type"
	```
	<!doctype html>
	<html lang="fr">
	<head>
	    <meta charset="UTF-8">
	    <title>My APP</title>
	</head>
	<body>
	    <div class="container">
	        {% block body %}
	        {% endblock %}
	    </div>
	</body>
	</html>
	```
	Dans ce dernier, on défini un emplacement qui accueillera le contenu de nos différentes page, l'emplacement est matérialisé par ```{% block body %}{% endblock %}```

10. Création de la vue **home.html.twig**
	1. Dans le dossier **Views**, créer un fichier **home.html.twig**. Ce dernier va hériter de la structure html global (notre layout.html.twig).
	```
	{% extends 'layout.html.twig' %}

	{% block body %}
	    <h1>Hello World</h1>
	{% endblock %}
	```
	Tout ce qui sera défini à l'intérieur du block body viendra se positionner à l'emplacement reservé dans notre **layout.html.twig**

11. Ouvrir index.php dans le navigateur, *Hello world* doit s'afficher


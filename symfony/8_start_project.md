## Objectifs

* Créer un nouveau projet Symfony
* Importer un projet dans Phpstorm
* Configurer la base de données

## Etapes

### Créer un nouveau projet Symfony

Nous allons commencer par créer un projet symfony dans ton serveur local. A ce stade tu dois avoir un serveur Apache installé sur ta machine.
Place-toi dans le dossier racine de ton serveur et crée un projet Symfony :

    cd /var/www/html
    symfony new flyaround

Si tout se passe bien tu devrais obtenir quelque chose comme ça :

![Install Symfony](http://images.innoveduc.fr/sf2_install.png)

Synfony te raconte qu'il a réussi à créer un nouveau projet et t'explique ce qu'il te reste à faire pour le voir dans ton navigateur.
Alors au boulot :

    cd flyaround

Maintenant tu peux te rendre sur l'URL suivante : [http://localhost/flyaround/web/app_dev.php](http://localhost/flyaround/web/app_dev.php)
Tu devrais voir une page comme ça :

![Symfony home](http://images.innoveduc.fr/sf2_home.png)

> C'est trop facile, ça cache quelque chose ?

Sans que tu t'en rendes compte Symfony a fait pas mal de choses dans ton dos. Dans le dossier flyaround, tu trouveras un ensemble de fichiers et de dossiers qui constituent l'architecture de ton projet Symfony. On y trouve tous les outils nécessaires pour construire une plateforme sur des bases saines et solides. Jette un oeil dans la deuxième ressource pour savoir le rôle de ces dossiers.

> Il ne manque pas une étape dans notre installation ?

Eh oui Symfony a dit *Configure your application in app/config/parameters.yml file*. On s'occupera de ça bientot mais avant on va importer le projet dans Phpstorm.

### Importer un projet SF dans Phpstorm

Tu l'as compris, Phpstorm va nous servir à faire du Symfony.
Pour importer un projet c'est tout simple :

1. Dans Phpstorm, tu cliques sur file>New Project From Existing Files...
2. Tu sélectionnes le premier scénario puis Next
3. Tu sélectionnes le dossier flyaround puis Project Root puis Next
4. Quand il te demande de choisir un serveur tu sélectionnes ton localhost, ou tu en crées un puis Next et Finish

Si tu as bien installé le plugin Symfony lors de l'installation de Phpstorm, ce dernier reconnaîtra qu'il a chargé un projet Symfony et te proposera d'activer le plugin

![Phpstorm Symfony plugin](http://images.innoveduc.fr/sf2_plugin.png)

Tu n'as qu'à cliquer sur *With auto configuration now* et Phpstorm fait le job.

> Jusque-là beaucoup de choses se font toutes seules mais pas d'inquiétude nous n'allons pas tarder à ouvrir le capot SF2 et tu mettras les mains dans le code.

### Configurer un projet Symfony2

Nous y voilà. Il ne nous reste plus qu'à configurer ce que Symfony ne peux pas faire tout seul. C'est-à-dire la base de données et l'envoi d'email.

> Il fait quasiment tout tout seul et ça il ne sait pas faire ?

En fait tu as plutôt intérêt à ce qu'il ne sache pas le faire. Ces données sont confidentielles, c'est toi qui configures ton serveur de bases de données (SGBD) et ton compte d'email. Ce fichier regroupe donc toutes les informations confidentielles relatives à tes comptes et configs persos. Tu pourras y rajouter des champs si par exemple tu as des clés ssh à stoquer ou d'autres identifiants persos.
Attention de ne pas le partager sur Github ! Mais encore une fois Symfony prévoit un garde-fou puisqu'il inclut d'emblée un .gitignore qui exclut parameters.yml

A présent, ouvre le fichier parameters.yml avec Phpstorm. Dans la partie projet qui t'affiche les dossiers et fichiers de ton projet, tu verras que parameters.yml est grisé. Cela veut dire qu'il est ignoré par .gitignore. Pratique non ?
Pour le moment, nous n'allons configurer que la base de données, nous parlerons de la config de l'email dans la quête sur ce sujet.
Dans *database_host* tu indiques l'ip du serveur sur lequel est hébergée ta base de données. Dans notre cas, mysql est installé en local donc on laissera 127.0.0.1, qui correspond à l'ip du localhost.
*database_port* designe le port du SGBD. Si tu lui mets null il prendra le port mysql par défaut, c'est à dire 3306. Attention, si tu es sous Mac, le port mysql est souvent le 8889. Vérifie ta config mysql.
*database_name* ce n'est pas très difficile à deviner, c'est le nom de la base de données qui sera utlisée pour le projet. Nous l'appelerons flyaround
*database_user* et *database_password* tes identifiants mysql

    database_host: 127.0.0.1
    database_port: null
    database_name: flyaround
    database_user: root
    database_password: azerty1234

Dans le terminal tu peux maintenant lancer la commande

    php app/console doctrine:database:create

Et si ta config est bonne Symfony créera une base de données vide. Tu peux vérifier le travail avec phpmyadmin.

Pour conclure cette quête j'aimerais te donner trois références en matière de tuto Symfony.

#### Ressources

* [The tuto SF2](https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2)
  En partenariat avec Sensiolabs
* [Le tuto guide de SF2](http://jobeet.thuau.fr/sommaire)
  Tutoriel pas forcément à jour mais très bien construit autour d'un projet fil rouge et très pratique à réutiliser quand on a un trou de mémoire
* [Le book](http://symfony.com/doc/current/book/index.html)
  Le book est la documentation officielle de Symfony. L'unique pour SF3 à ce jour.

### Bonus : Cloner un projet Symfony

Comme nous l'avons vu dans les étapes précédentes, certains fichiers, voir des dossiers entiers, sont ignorés par le .gitignore de Symfony. Deux questions : pourquoi sont-ils ignorés et comment les récupérer quand je clone un projet ?

Pourquoi ignorer des fichiers ?
-------------------------------
La première raison qui nous pousse à ne pas partager certains fichiers (ou dossiers) sur github est la confidentialité. Rappelle-toi du fichier parameters.yml, il contient des informations confidentielles spécifiques à une instance du projet.

D'autres fichier sont ignorés à cause de leur pertinence. Les fichiers de cache et de log ne sont pertinents qu'à l'échelle d'une instance. Si tu installes une instance de flyaround en Autriche et une autre instance en France, les logs de l'instance Française enregistreront l'activité de cette instance et ne seront donc pas partagés avec les autres instances.

Enfin j'attire ton attention sur le dossier vendor. C'est sûrement le plus gros fichier de l'application et il est ignoré. Il contient les librairies utilisées par l'application. C'est-à-dire qu'il contient toutes les 'briques' préconçues de ton application. Ces briques sont disponibles sur internet. On peut les télécharger à n'importe quel moment et elles sont toutes renseignées dans le fichier composer.json.
C'est le travail du gestionnaire de dépendance. Celui de Symfony s'appelle Composer et il est capable de recréer tout le dossier vendor en téléchargeant toutes les libraires ou dépendances qu'il trouvera dans commposer.json.

Comment récupérer les fichiers absents (ignorés) du dépôt Git ?
---------------------------------------------------------------

J'ai déjà amorcé la réponse, c'est le travail de composer. Pour cela il te faut installer l'utilitaire (voir ressource) puis lancer la commande

    composer install

Attention, il faut que tu sois dans le dossier du projet Symfony.

Ensuite tu peux reprendre les étapes 2 et 3.

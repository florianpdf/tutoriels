# Générer le CRUD

A ce stade, tu dois avoir un projet Symfony tout beau, tout neuf qui s'appelle flyaround et qui tourne sur un serveur Apache.
Dans cette quête nous allons créer un bundle, les entités (modèles) pour les avions, les vols et les réservations ainsi que les pages pour créer, lire, mettre à jour et supprimer nos entités. Ces quatre actions redondantes sont souvent regroupées sous l'acronyme CRUD pour Create Read Update Delete

> Tout ça dans une seule quête ?

Oui, mais rassure toi Symfony est là pour t'aider.

## Objectifs

* Générer un bundle en ligne de commande
* Générer une entité
* Générer un CRUD

## Etapes

### Générer le bundle Coav

Pour le moment Symfony a créé un bundle dans le dossier src pour qu'une page s'affiche quand tu lances l'appli pour la première fois. Il s'appelle AppBundle et il ne nous servira à rien. Tu peux donc simplement le supprimer afin qu'il ne crée pas de confusion chez les développeurs qui reprendraient ton code.

> Il est très important de ne pas garder de "code mort" dans tes projets. Le code mort est du code qui n'est jamais exécuté par l'application et c'est toujours très frustrant de faire l'effort de comprendre un bout de code puis de s'apercevoir qu'il ne sert à rien et que le développeur précédent à juste oublié de l'enlever.

Un fois le dossier supprimé pense à supprimer la ligne qui le concerne dans app/AppKernel.php. Ce fichier indique à Symfony tous les bundles qu'il doit charger pour fonctionner. On y trouve à la fois les bundles vendors (qui sont dans vendor) et les bundles propres au projet (qui sont dans src).

Tu peux maintenant créer ton bundle en tapant la commande suivante dans un terminal. Pense à sélectionner le dossier flyaround comme dossier courant (```cd /var/www/html/flyaround```).

    php bin/console generate:bundle

Là, Symfony te pose plusieures questions qui vont lui permettre de générer le bundle qu'il te faut. Réponds-y comme moi puis nous commenterons ces réponses.

![Generate Symfony bundle](http://images.innoveduc.fr/sf2_bundle.png)

Nom du bundle
-------------
La norme de Symfony impose que le nom d'un bundle commence par une majuscule et finisse par Bundle.
La bonne pratique en vigueur dans de nombreuses entreprises (dont la Wild Code School) veut que les bundles soient stoqués dans le sous-dossier src/WCS et que leur nom soit écrit en CamelCase (Vois la ressource 1 pour plus d'info).

Le format de la configuration
-----------------------------
La configuration du bundle peut être écrite de plusieurs façons. Le YAML (abrégé yml) permet d'avoir une configuration isolée dans un fichier clair et lisible. De plus nous réutiliserons le YAML pour d'autres configurations plus tard dans le projet.

Génération du bundle
--------------------
Ici, Symfony ne nous demande rien mais nous informe de ce qu'il fait. Va voir dans src/WCS/CoavBundle pour admirer tout son travail. Tu remarqueras notamment la présence d'un contrôleur et d'une vue (src/WCS/CoavBundle/Resources/views/Default/index.html.twig) mais pas de modèle pour l'instant.
Le bundle est activé automatiquement dans AppKernel.php et le chargement des routes est aussi automatique. Tu le verras dans le fichier app/config/config.yml. Tu peux d'ailleurs supprimer les routes concernant le bundle AppBundle pendant qu'on y est.

Bien sûr, tout ça peut aussi être fait à la main. Le seul fichier indispensable dans notre bundle est WCSCoavBundle.php. Il contient une classe WCSCoavBundle qui elle-même étend la classe Bundle. La norme de Symfony impose que chaque fichier contienne une seule classe qui a le même nom que le fichier.

#### Ressources

* [Wikipédia CamelCase](https://fr.wikipedia.org/wiki/CamelCase)
  Le CamelCase est une convention de nommage courrament utilisée en programmation
* [Création d'un bundle avec Openclassrooms](https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/utilisons-la-console-pour-creer-un-bundle)
  Le tutoriel d'openclassrooms donne plus de détails

### Génération de l'entité

Dans le monde de Symfony les modèles du MVC sont appelés entités. Plus exactement les entités sont les modèles que l'on souhaite enregistrer en BDD. C'est le cas des avions que nous allons aussi générer avec la console SF2.
Je te propose de générer l'entité PlaneModel avec les champs suivants :

![Plane table](http://images.innoveduc.fr/sf2_plane.png)

C'est Doctrine qui va faire le travail de générer l'entité :

    php bin/console doctrine:generate:entity

Doctrine commence par te demander de donner un nom à ton entité. Comme chaque entité est enregistrée dans un bundle, on l'indique à Doctrine dans le nommage de l'entité.
Pour la configuration je te propose de garder le YAML pour rester cohérent.
Ensuite on attaque la saisie des champs. Pas la peine de lui indiquer qu'il y a un attribut id. Doctrine le crée tout seul et en fait une clé primaire.
Tu remarqueras que la convention de nommage des attributs est du camelCase. C'est une sorte de CamelCase dans lequel le première lettre du premier mot est une minuscule.

![Generate Symfony entity](http://images.innoveduc.fr/sf2_entity.png)

Résultat, trois fichiers ont été générés :
* PlaneModel.php : Il contient la classe PlaneModel avec les attributs demandés. Chaque attribut est déclaré en private et vient avec un getter et un setter sauf l'id qui n'a qu'un getter. L'id est géré automatiquement par Doctrine et ne doit pas être saisi à la main.
* PlaneModelRepository.php : Le repository sert à créer des requêtes sur l'ensemble de la table PlaneModel. On pourra par exemple y créer une méthode qui nous renvoie tous les avions de n places. La classe est vide pour le moment mais étend EntityRepository qui fournit quelques méthodes très utiles.
* PlaneModel.orm.yml : C'est le fichier de config de l'ORM, en l'occurence Doctrine, qui va faire le lien entre l'entité en tant que classe ou objet et la table PlaneModel de la base de donnée.

> Quand on utilise un ORM une entité est d'un côté une classe qui s'intancie en objets et de l'autre une table dans une BDD. Ainsi les attributs de la classe correspondent aux champs de la table. Attention aux confusions.

En créant cette entité nous avons modifié le schéma de la base de données. Il faut donc indiquer à doctrine qu'il doit le mettre à jour. Utilise la commande suivante

    php bin/console doctrine:schema:update --force

> Il ne peut pas faire ça tout seul ce traine savate ?

La mise à jour du schéma de BDD est une opération qui peut s'avérer sensible sur une base de données de production. Des données pourraient etre perdues définitivement. C'est aussi la raison pour laquelle doctrine nous impose de préciser --force pour que l'on prenne bien conscience de ce que l'on est en train de faire.

#### Ressources

* [Le model de données](http://jobeet.thuau.fr/le-modele-de-donnees)
  Ce tuto propose une autre méthode pour générer les données. Nous l'utiliserons plus tard pour mettre à jour nos entités
* [Les entités avec OpenClassrooms](https://openclassrooms.com/courses/developpez-votre-site-web-avec-le-framework-symfony2/la-couche-metier-les-entites)
  Chez OpenClassrooms on configure l'ORM avec des annotations

### Génération du CRUD

Il ne nous reste plus qu'à générer le CRUD, alors allons-y.
Entre la commande suivante dans le terminal :

    php bin/console doctrine:generate:crud

Voilà le résultat de la commande :

![Generate Symfony CRUD](http://images.innoveduc.fr/sf2_crud.png)

Commentons ce résultat :

* Le CRUD s'applique forcément à une entité, donc la première étape consiste à préciser à Symfony l'entité sur laquelle il génèrera le CRUD. Attention ! Il faut que cette entitée ait été créée en amont.
* Il nous demande ensuite si l'on veut générer les actions d'écriture. Il parle des action du controleur qu'il va générer. Si l'utilisateur doit pouvoir créer des entités, il faut lui générer ces actions d'écriture. Dans notre cas les utilisateurs pourront créer des model d'avion donc on aura besoin des actions d'écriture.
* Pour la config c'est toujours la même chose. Il nous parle ici de la config des routes.
* Le préfix des routes sert à la construction des URL : /planemodel/, /planemodel/{id}/show, /planemodel/{id}/new

> C'est quoi cette erreur qu'il affiche avant de dire OK ?

Symfony charge toutes les routes à partir du fichier /app/config/routing.yml (et encore même ça on pourrait le customiser). Mais tu imagines s'il fallait lister toutes les routes de notre appli dans un seul fichier, il serait illisible. On importe donc d'autres fichiers en lui précisant qu'il doit les charger comme une ressource. Dans notre cas, il charge le fichier "@WCSCoavBundle/Resources/config/routing.yml" qui lui même charge le fichier "@WCSCoavBundle/Resources/config/routing/planemodel.yml" en préfixant toutes les routes par planemodel.

> Mais alors elles viennet d'où toutes les routes qui s'affichent quand on lance la commande ```php bin/console debug:router``` ?

Par défaut cette commande affiche les routes de l'environnement de dév. Essaie avec cette commande ```php bin/console debug:router --env=prod```. L'environnement de dév donne accès à un certain nombre de choses que tu ne veux pas forcément exposer aux utilisateurs finaux. C'est le cas de la barre en bas de l'écran par exemple.

Allons voir maintenant ce qu'a fait Symfony. Rends-toi sur l'URL suivante : http://localhost/flyaround/web/app_dev.php/planemodel
Symfony a créé tout ce qu'il faut pour créer des avions, les lister, les mettre à jour et les supprimer. Tout ce qu'il faut c'est-à-dire :

* Un controller (PlaneModelController) avec les actions index, show, new, edit et delete
* Des vues (edit, index, new, show) dans le dossier app/Resources/views/planemodel
* Un formulaire et un fichier de tests (nous rentrerons dans ces détails plus tard)

#### Ressources

* [Le routage](http://jobeet.thuau.fr/le-routage)
  Tous les détails sur les routes de Symfony
* [La doc SF2 sur les routes](http://symfony.com/doc/2.8/book/routing.html)
  La doc officielle montre les autres méthodes de définition des routes (XML, Annotations et PHP)

Commande à effectuer en cli

Cloner un projet:
git clone <adresse du dépot>
ex: git clone git@github.com:mariellelau/point_jardin.git
Par défault un dossier point_jardin sera créé, si l'on souhaite cloner dans un dossier différent ==>
git clone git@github.com:mariellelau/point_jardin.git hello_plop
Sera cloner dans hello_plop

1 Créer une branche
git branch <nom de la branche> ==> création
git chekcout <nom de la branche> ==> on se déplace sur la branche

OU

git checkout -b <nom de la branche> ==> on cré et on se déplace en même temps

2 On  peut maintenant commencer le travail sur "notre version" de l'application. Vu que nous sommmes sur notre branche, les modification n'impacte en rien la version original de l'application ce qui se trouve sur la branche master

3 Une fois la modif effectuer.
git status ==> on vérifie l'état de la branch, on vois les fichiers modifier

4 J'ajoute les fichiers au dépot git
git add . ==> j'ajoute tous les fichiers modifiers

OU

git add <nom fichier> <nom fichier> <...> ==> j'ajout les fichiers un par un

5 On commit (fait un photos de la version)
git commit -m "<msg du commit" ==> si message court

OU

git commit ==> un éditeur s'ouvre, message de commit plus long, attention la premier ligne correspond au titre du commit

6 Pour information
git log ==> affiche les messages des derniers commit
git diff <nom du fichier> ==> Permet de voir les différence entre le fichier à l'état actuel et le fichier au dernier commit
git checkout -- <nom du fichier> ==> j'annule les modification effectuées sur le fichier depuis le dernier commit OU git checkout -- . j'annule les modifs faite sur tous les fichiers

7 Mise en ligne sur GitHub
git push origin <nom de la branche sur laquelle je me trouve>
ex: git push origin plop

8 RDV Sur git hub
Onglet pull request
New Pull Request
Select gauche ==> branche de destination
Select droite ==> branche à envoyer
Si message  "Able to merge" ==> pas de conflit entre les branches, on peut proposer la pull request

9 Je retourne sur mon terminal
1. Je reste sur la même branche car ma fonctionnalité n'est pas terminé
je retourne sur Master afin de me tenir à jour du projet
git checkout master
Je met master à jour
git pull origin master

ATTENTION master est à jour mais pas ma branche
git checkout <nom de la branche>

Je fusionne master et ma branche
git merge master

Ma branche est à jour, je peux continuer à travailler

2. Ma fonctionnalité est terminé
Je retourne sur la branche master
git checkout master
Je met à jour master
git pull origin master
Je cré une nouvelle branche pour developper ma nouvelle fonctionnalité
git checkout -b <nom de labranche>


etc......


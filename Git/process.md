# Un Workflow qui déchire

## 1. La ou tout commence...
### 1. Je crée un dépot
1. **Je crée un repository directement en ligne sur Github en cliquant sur "new repository"**

Je renseigne le nom du dépot, etc...  
Après validation, une liste de commande à executer s'affiche.  
Exemple:
```
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/florianpdf/hello_world.git
git push -u origin master
```
Attention, pensez à selectionner une adresse ssh si vous l'avez configuré en amont sur votre machine.  
Mon dépot est initialisé, et ma liaison entre Git (local) et GitHub (distant) est établit.

### 2. Je rejoins un dépot existant
1. **Je clone le dépot avec la commande *git clone***  

Je me place dans mon dossier de travail puis:

```
git clone <adresse du dépot>
```

Exemple:

```
git clone https://github.com/florianpdf/hello_world.git
```

Par défault un dossier *"hello_world"* sera créé, si l'on souhaite cloner dans un dossier différent on ajoute le nom du dossier à la fin de la commande.  

Exemple:
```
git clone https://github.com/florianpdf/hello_world.git plop
```

Un dossier *"plop"* sera créé et le projet sera cloné à l'intérieur.

## 2. Je me met à travailler
1. **Créer les branches**  

La première branche à créer est la branche *"dev"* ou *"develop"*.  
Cette branche sera considéré comme la branche de "pre-production".

<dl>
  <dt>Rappel:</dt>
  <dd>La branche "master" est la branche de production, tout ce qui se trouve dessus doit être déployable.</dd>
  <dd>La branche "dev" permet le test et la fusion de toutes les autres branches.</dd>
</dl>

```
git branch <nom de la branche> ==> création
git chekcout <nom de la branche> ==> on se déplace sur la branche
```

OU

```
git checkout -b <nom de la branche> ==> on cré et on se déplace en même temps
```

Exemple

```
git checkout -b dev
```
On a créé la branche *"dev"* puis on s'est déplacé dessus.  
Une fois sur *"dev"* je peux créer ma branche de travail, il est conseillé de créer une branche par fonctionnalité et non une branche par personne.  

Exemple:
```
git checkout -b slider
```
J'ai créé et me suis déplacé sur la branche *"slider"*.  
Je peux travailler sur ma fonctionnalité sans impacter le reste du travail, étant donné que je suis sur "ma version" de l'application.  

## 3. J'ai terminé

1. **Je contrôle les fichiers modifiés grâce à `git status`**  

Exemple:

```
git status
```
 
Cette commande nous affiche les fichiers modifiés depuis le dernier commit. 
 
<dl>
  <dt>Utile:</dt>
  <dd>La commande "git diff <nom d'un fichier>" permet d'afficher les modifications effectuées sur ce fichier depuis le denrier commit</dd>
</dl>

Exemple:

```
git diff index.html
```

<dl>
  <dt>Utile:</dt>
  <dd>La commande "git checkout -- <nom du fichier>" annule les modifications effectuées sur le ou les fichiers depuis le dernier commit</dd>
</dl>

Exemple:

```
git checkout -- index.html
```
Annule les modifs depuis le dernier commit sur index.html

```
git checkout -- .
```
Annule les modifs depuis le dernier commit sur tous les fichiers modifiés.

2. **J'ajoute les fichiers au dépot git grâce à `git add`**  

Exemple:

```
git add index.html contact.html
```

Les fichiers "index.html" et "ìmage.html" seront ajoutés au dépot git.  

OU

```
git add .
```

Tous les fichiers modifiés seront ajoutés au dépot git.

3. **On commit (fait une photo de la version) grâce à `git commit**

Exemple:

```
git commit -m "création du slider"
```

A utiliser en cas de message court.

OU

```
git commit 
```

Un éditeur s'ouvre, à utiliser pour un message de commit plus long.  
*Attention*: la premier ligne correspond au titre du commit

<dl>
  <dt>Utile:</dt>
  <dd>La commande "git log" affiche les derniers commit ainsi que leurs messages</dd>
</dl>

4. **Je met en ligne sur sur GitHub grâce à *"git push"***

Exemple:

```
git push origin slider
```
Je "push" le contenu de la branche slider sur le repository distant sur GitHub.


## 4. Je fusionne avec le reste du projet ==> RDV Sur GitHub

1. **Je peux cliquer directement sur *"Compare & pull request"* ou sur l'onglet *"Pull requests"* puis sur le bouton *"New pull request"***  
 
voir photos

3. **Je crée ma pull request**

voir photo

### Cas 1:  **"Able to merge"**  

>Pas de conflit entre les branches, je peux proposer la pull request.  
Une fois la pull request proposer, je peux continuer à travailler.  
> #### Ce n'est pas à moi d'accepter ma pull request mais à un autre membre du groupe
> La pull request permet de fusionner un travail à l'issue d'une validation contrairement au merge fait directement dans le temrinal  
La personne qui valide la pull request peut re-lire le code, le commenter, et pourquoi pas refuser la demande de fusion.
 
> #### Cas 1: Je reste sur la même branche car ma fonctionnalité n'est pas terminé
> Je retourne sur mon terminale.  
> Je dois mettre à jour ma branche par rapport au reste du projet  
> 1. Je retourne sur la branche dev afin de mettre le projet à jour  
`git checkout dev`  
> 2. Je mets à jour dev  
`git pull origin dev`  
> 3. Je reviens sur ma branche  
`git checkout slider`  
> 4. Je mets à jour ma branche par rapport à dev  
`git merge dev`  
> 5. Je suis à jour par rapport à la branche dev, je peux continuer à travailler  

> #### Cas 2: J'ai terminé ma fonctionnalité
> Je retourne sur mon terminale.  
> Je dois supprimer ma branche et en créer une nouvelle  
> 1. Je retourne sur la branche dev afin de mettre le projet à jour  
`git checkout dev`  
> 1. Je mets à jour    
`git pull origin dev`  
> 3. Je supprime ma branche avec *"git branch -D"*  
`git branch -D slider`  
> 4. Je crée ma nouvelle branche et me déplace dessus (je suis actuellement sur dev) *"git checkout -b"*  
`git checkout -b formulaire`  
> 5. Je peux commencer à travailler sur ma nouvelle fonctionnalité    
> 6. Je suis à jour par rapport à la branche dev car la branche formulaire à été créé depuis dev.   
> 7. Une fois ma pull-request acceptée, je pense également à supprimer ma branche sur GiyHub

### Cas 2: "Can’t automatically merge." 

> Tu as un conflit entre les deux branches, soit les deux versions de ton programme.  
Git ne peut pas décider à ta place ce qui est bon ou mauvais, tu vas devoir résoudre les conflits.  
Afin de faciliter le travail d'équipe, c'est toujours celui qui propose une version qui règle les conflits.
> 1. Je retourne sur la branche dev afin de mettre le projet à jour  
`git checkout dev`  
> 1. Je mets à jour    
`git pull origin dev`  
> 3. Je retourne sur ma branche avec *"git checkout"* 
`git checkout slider`  
> 4. Je rappatri la branche dev sur la mienne avec *"git merge"*  
`git merge dev`  
> 5. La liste des conflits apparait dans le terminal  
> 6. Je résous les conflits
> 7. Une fois les conflits résolut, j'ajoute, commit et push à nouveau  
> `git add .`  
> `git commit -m "fix conflits"`  
> `git push origin slider`  
> 6. Je retourne proposer ma version via une pull request, si j'ai bien résolu tous mes conflits, le message "Able to merge" 
doit apparaitre.  

> #### Ce n'est pas à moi d'accepter ma pull request mais à un autre membre du groupe
> La pull request permet de fusionner un travail à l'issue d'une validation contrairement au merge fait directement dans le temrinal  
La personne qui valide la pull request peut re-lire le code, le commenter, et pourquoi pas refuser la demande de fusion.
 
> #### Cas 1: **Je reste sur la même branche car ma fonctionnalité n'est pas terminé**
> Je retourne sur mon terminale.  
> Je dois mettre à jour ma branche par rapport au reste du projet  
> 1. Je retourne sur la branche dev afin de mettre le projet à jour  
`git checkout dev`  
> 2. Je mets à jour dev  
`git pull origin dev`  
> 3. Je reviens sur ma branche  
`git checkout slider`  
> 4. Je mets à jour ma branche par rapport à dev  
`git merge dev`  
> 5. Je suis à jour par rapport à la branche dev, je peux continuer à travailler  

> #### Cas 2: **J'ai terminé ma fonctionnalité**
> Je retourne sur mon terminale.  
> Je dois supprimer ma branche et en créer une nouvelle  
> 1. Je retourne sur la branche dev afin de mettre le projet à jour  
`git checkout dev`  
> 1. Je met à jour    
`git pull origin dev`  
> 3. Je supprimer ma branche avec *"git branch -D"*  
`git branch -D slider`  
> 4. Je cré ma nouvelle branche et me déplace dessus (je suis actuellement sur dev) *"git checkout -b"*  
`git checkout -b formulaire`  
> 5. Je peux commencer à travailler sur ma nouvelle fonctionnalité 
> 6. Je suis à jour par rapport à la branche dev 
> 7. Une fois ma pull-request accepté, je pense également à supprimer ma branche sur GitHub
# Se connecter en ssh sur un serveur

### Un peu de culture:

*Secure Shell (SSH) est à la fois un programme informatique et un protocole de communication sécurisé. Le protocole de connexion impose un échange de clés de chiffrement en début de connexion. Par la suite, tous les segments TCP sont authentifiés et chiffrés. Il devient donc impossible d'utiliser un sniffer pour voir ce que fait l'utilisateur.
Le protocole SSH a été conçu avec l'objectif de remplacer les différents programmes rlogin, telnet, rcp, ftp et rsh.*

[SSH - Wikipedia ](https://fr.wikipedia.org/wiki/Secure_Shell "SSH - Wikipedia")  
[SSH - Ubuntu ](https://doc.ubuntu-fr.org/ssh "SSH - Ubuntu")  

### Comment se connecter sur un serveur en ssh:

#### Une connection ssh se fait via le terminal

##### 1. Connection au serveur via ssh

```
ssh user@adresse_ip
```

Exemple:

```
root@123.234.43.65
```

##### 2. Saisir le mot de passe comme demandé

##### 3. Se déplacer dans le dossier lu par le serveur apache

Exemple:

```
cd /var/www/html/
```

# Process gestion des droits sur symfony

### [Documentation officiel](http://symfony.com/doc/current/setup/file_permissions.html)

##### 1. Une fois dans le dossier du projet, executer les ligne suivantes dans le terminal

**- Mac**
```
rm -rf var/cache/*
rm -rf var/logs/*

HTTPDUSER=`ps axo user,comm | grep -E   '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`  
sudo chmod -R +a "$HTTPDUSER allow delete,write,append,file_inherit,directory_inherit" var  
sudo chmod -R +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" var  
```

**- Linux**
```
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`

sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
```

**A chaque nouveau projet, ou chaque récupération de projet Symfony sur github, vous devez ré-executer les commandes précédentes**

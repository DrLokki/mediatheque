# médiathèque 



## Deployment

Pour installer ce projet en local
(vérifier que vous avez bien php8 et postgresql d'installer)

cloner le git
```bash
    git clone git@github.com:DrLokki/mediatheque.git
```
placer vous dans le dossier fichier_SQL 
```bash
    cd mediatheque/fichier_SQL
```

crée et alimenter la base de donner postgres
```bash
    sudo su postgres
    psql 
    \i creationUser.sql
    \q
    psql media_db -U ulna -h localhost -W radius2
    \i creationDBB.sql
    \i feadDBB.sql
    \q
```
placer vous dans le dossier src
```bash
    cd ..
```

lancer le serveur local 
```bash
    php -s localhost:8000
```

Suiver le manuel d'utilisation pour utiliser l'application.

## ajouter des employer
Pour ajouter des employer faite les commande suivante pour utiliser l'utilitaire de creation d'employer.

```bash
    sudo apt install lua5.3
    sudo apt install luarocks
    luarocks install luasql-postgres
    lua utility/emploCreator.lua
```

suivie les instructions donner dans l'utilitaire pour la suite.


### utility dev link
https://catalogue.bnf.fr/couverture?&appName=NE&idArk=ark:/12148/cb450989938&couverture=1

https://data.bnf.fr/sparql

http://catalogue.bnf.fr/api/SRU?version=1.2&operation=searchRetrieve&query=bib.fuzzyIsbn%20adj%20"[ISBN]"

https://data.bnf.fr/sparql?default-graph-uri=&query=[SPARQL]&format=text%2Fhtml&timeout=0&should-sponge=&debug=on

https://data.bnf.fr/sparql?default-graph-uri=&query=[SPARQL]&format=application/json

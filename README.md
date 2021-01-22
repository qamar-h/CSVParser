## Description

Une librairie permettant de parser un fichier CSV à partir de la console afin de le présenter sous forme de tableau ou en json

## Init

1. Télécharger le projet
2. Se rendre dans le dossier du projet
3. Installer les dépendences :
```bash
composer install
```

## Commande

- Argument: le chemin du fichier, fichier CSV requis
- Option: --json ou -j pour avoir un retour en JSON (par défaut la commande retourne un tableau formaté)
```bash
php bin/console app:csv-parser /path/file/csv [ --json | -j ]
```

## Cron

Pour l'exécution d'un CRON tous les jours entre 7h00 et 19h00 voici la fréquence :

```bash
00 07-19 * * * .....
```

## Composants utilisés
```bash
symfony/console
symfony/serializer
```
 

<h1>README :</h1>

<h2>Outils requis</h2>
- php version 7.2.5 ou supérieure
- client Symfony
- Composer
- Une console type powershell
- Postman (optionnel)
<h2>Installation du projet :</h2>
Ouvrir la console et se placer dans le dossier du projet puis entrer les commandes suivantes :
- composer install
- composer update
- php bin/console cache:clear

<h2>Utilisation avec Postman</h2>
- Entrer la commande dans la console : "symfony:server:start" pour démarrer le serveur symfony
- Ouvrir Postman
- Créer deux requêtes GET : 
  - chemin local/trickWinnersNT/jeu
  - chemin local/trickWinners/jeu/atout
  - avec chemin local par défaut : 127.0.0.1 ou l'adresse indiquée par symfony server:start
  - trickWinnersNT pour un jeu sans atout
  - tricksWinners pour un jeu avec atout
  - jeu la suite des cartes format anglais "KD-AH-6C-10S-2H..."
  - atout la première lettre de la couleur atout en anglais pour la partie : H, D, S ou C
  
<h2>Utilisation avec la console</h2>
Avec la console les parties ainsi que les atouts, s'il y en a, seront créés aléatoirement pour permettre d'effectuer de nombreux tests à la chaîne
- dans la console lancer la commande : php bin/console app:play 
- par défaut la commande lance sans atout
- pour lancer une partie avec atouts ajouter l'option trump : php bin/console app:play --trump=1
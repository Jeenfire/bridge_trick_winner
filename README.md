# bridge_trick_winner
technical test for 52 entertainement
<h1>README :</h1>

<h2>Outils requis</h2>
- php version 7.2.5 ou supérieure<br>
- client Symfony<br>
- Composer<br>
- Une console type powershell<br>
- Postman (optionnel)<br>
<h2>Installation du projet :</h2>
Ouvrir la console et se placer dans le dossier du projet puis entrer les commandes suivantes :<br>
- composer install<br>
- composer update<br>
- php bin/console cache:clear<br>

<h2>Utilisation avec Postman</h2>
- Entrer la commande dans la console : "symfony:server:start" pour démarrer le serveur symfony<br>
- Ouvrir Postman<br>
- Créer deux requêtes GET : <br>
  - chemin local/trickWinnersNT/jeu<br>
  - chemin local/trickWinners/jeu/atout<br>
  - avec chemin local par défaut : 127.0.0.1 ou l'adresse indiquée par symfony server:start<br>
  - trickWinnersNT pour un jeu sans atout<br>
  - tricksWinners pour un jeu avec atout<br>
  - jeu la suite des cartes format anglais "KD-AH-6C-10S-2H..."<br>
  - atout la première lettre de la couleur atout en anglais pour la partie : H, D, S ou C<br>
  
<h2>Utilisation avec la console</h2>
Avec la console les parties ainsi que les atouts, s'il y en a, seront créés aléatoirement pour permettre d'effectuer de nombreux tests à la chaîne<br>
- dans la console lancer la commande : php bin/console app:play <br>
- par défaut la commande lance sans atout<br>
- pour lancer une partie avec atouts ajouter l'option trump : php bin/console app:play --trump=1<br>

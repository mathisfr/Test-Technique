# Kaffein Test Technique
Projet réalisé durant le test technique.
## Quel est ce projet ?
Nous devions pour un client fictif utiliser le CRM hubspot, et mettre à disposition pour ses commerciaux une plateforme de visualisation des entreprises et contacts du CRM.
Nous devions utiliser les technologies suivantes: Laravel + Vue.js (Inertiajs)
## Comment faire fonctionner le projet ?
Vous devez avoir Laravel, nodejs et une base de données.
Une fois que vous avez téléchargé le dossier et correctement initialisé l'application avec la commande ```npm install```, vous devez configurer les ```.env``` pour pouvoir vous connecter à votre base de données:
```php
DB_CONNECTION=mysql // Le système de gestion de bases de données
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kaffein // Nom de votre base de données
DB_USERNAME=root // Votre nom utilisateur de la base de données pour la connexion
DB_PASSWORD= // Votre mot de passe utilisateur de la base de données pour la connexion
```
Vous devez après effectuer la commande ```php artisan migration``` pour construire les tables de votre base de données, puis vous pouvez lancer une première fois la commande ```php artisan command:api-to-database``` pour effectuer la première requête de l'api vers l'enregistrement dans la base de données.
Vous ne devez pas oublier de taper la commande: ```php artisan schedule:work``` pour activer la planification automatique des requêtes ```API TO DATABASES``` du projet.

De mon côté j'ai fait tourner l'application avec [Laragon](https://laragon.org/), qui est un environnement de développement Web dédié au système d’exploitation Windows. Il est accompagné de différentes technologies qui nous facilite la création de nouveaux projets.
## Diagramme de base de données:
Ouvrir le diagramme sur [app.diagrams.net](https://drive.google.com/file/d/1fgm5xlFn4asYhi4SV6KhH20RADzuMtN0/view?usp=sharing), premier diagramme de BDD donc n'hésitez pas à me contacter et me corriger pour que je puisse apprendre et m'amélioré.
## Diagramme de classes PHP:
Ouvrir le diagramme sur [app.diagrams.net](https://drive.google.com/file/d/1jfFHig7KsU-RNlyYsy7BKkk2s0ZBdesY/view?usp=sharing), premier diagramme de classes donc n'hésitez pas à me contacter et me corriger pour que je puisse apprendre et m'amélioré.
## Ce que j'ai appris:
Ce teste était excellent pour moi car il m'a permis de commencer à apprendre et à avoir les bases dans:
- Laravel qui est un framework exceptionnel avec énormément d'outils qui nous facilite grandement la vie.
- Vue js qui est un framework Javascript pour faire des applications de qualité très simplement.
- Tailwindcss qui est un framework Css qui nous facilite le travail (même si je me sens plus productif en Css pure).
- J'ai appris pas mal de chose en programmation orienter objet en PHP et ça m'a permis de voir du code concret, professionnel et sécurisé.
- L'outil git pour la gestion de versions de projets décentralisé.
- L'outil Trello pour la gestion du projet. Voici le lien de mon Trello pour ce projet [Trello.com](https://trello.com/b/2PGqOdSC/kaffein-test-technique)
## Conclusion:
Il me reste encore beaucoup à apprendre comme les designs patterns, m'améliorer en programmation orienter objet et encore plein d'autres technologies et je suis motivé à apprendre tout ça car j'aime ce métier.
J'ai vu que je pouvais apprendre pas mal de technologie en un temps plutôt court, ce que je trouve génial car je me suis rendu compte que j'avais les capacités à m'adapter à des situations totalement nouvelles.

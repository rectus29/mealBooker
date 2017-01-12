HINT

php vendor\doctrine\orm\bin\doctrine orm:schema-tool:update --force


change list

+++ - deplacement de l'adresse dans la profil utilisateur
+++ - mail lors d'un reservation recap de la commande info sur la personne et la date de reservation et date de livraison + lieu

bug sur lh'eure de reservation

++ - deplacer l'auth à la validation du panier
++ - nom et prenom non requis lors de l'inscription
++ - penser à sauter les weekend lors de la reservation
++ - changer message de bloquage de reservation en stipulant la date au lieu de demain (pour gerer les weekends)
++ - utiliser la short desc sur la page d'accueil
++ - intégrer le prix hors taxe à l'objet menu

+ - intégrer la quantité au panier
+ - prevoir un mode de fermeture previsionnel (congés) date ouverture/fermeture + message texte
+ - prevoir une gestion de la TVA
+ - incrementation des numero de commande + 100
+ - "commander" a la place de reserver dans la page menu

Gestion des stock
- nombre de repas renseignée dans l'admin
- decremantation automatique
- boloquage en cas de commmande superieur au nombre de repas dispo

Gestion du responsive
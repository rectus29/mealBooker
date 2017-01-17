HINT

php vendor\doctrine\orm\bin\doctrine orm:schema-tool:update --force


change list

DONE
--------------------------------------------

+++ - deplacement de l'adresse dans la profil utilisateur
+++ - mail lors d'un reservation recap de la commande info sur la personne et la date de reservation et date de livraison + lieu
++ - deplacer l'auth à la validation du panier
++ - nom et prenom non requis lors de l'inscription
++ - changer message de bloquage de reservation en stipulant la date au lieu de demain (pour gerer les weekends)
++ - utiliser la short desc sur la page d'accueil
++ - intégrer le prix hors taxe à l'objet menu
+ - "commander" a la place de reserver dans la page menu

NOT DONE
--------------------------------------------

+++ - bug sur lh'eure de reservation
++ - penser à sauter les weekend lors de la reservation
+ - intégrer la quantité au panier
+ - prevoir un mode de fermeture previsionnel (congés) date ouverture/fermeture + message texte
+ - prevoir une gestion de la TVA
+ - incrementation des numero de commande + 100

DELAYED
--------------------------------------------

Gestion des stock
- nombre de repas renseignée dans l'admin
- decremantation automatique
- bloquage en cas de commmande superieur au nombre de repas dispo
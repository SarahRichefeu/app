Description du projet :
Dans le cadre d'une évaluation en cours de formation lors de ma formation de developpeur web Front-End, j'ai réalisé cette application pour Vincent Parrot, un client fictif, propriétaire d'un garage automobile, souhaitant être visible sur internet.

Le site est disponible en ligne à l'adresse suivante : https://www.parrot-garage.sarahrichefeu.fr/

Pour l'installer en local :
Ce projet est réalisé à partir de symfony. 
Assurez-vous d'avoir installé : 
    - PHP (8.1 minimum)
    - Composer
    - Git
    - Symfony CLI

Pour vérifier que votre machine peut faire tourner un projet symfony, utilisez la commande symfony check:requirements

Pour le récupérer, effecutez les commandes suivantes dans une console placée dans le dossier dans lequel vous voulez importer le projet.

    - git clone https://github.com/SarahRichefeu/v.parrotGarage.git


Placez vous dans le bon dossier avec la commande : 
    - cd v.parrotGarage

Listez et vérifiez que vous êtes bien placés sur la branche master

Ensuite, installez toutes les dépendances nécessaires au bon fonctionnement de l'application:

    - composer install

Pour avoir accès à la base de donnée, vous pouvez utiliser une base de données en local, avec XAMPP par exemple. Il faudra ensuite configurer le fichier .env pour y mettre vos identifiants. Vous pouvez aussi créer un fichier .env.local avec vos identifants et le mettre dans le .gitignore pour plus de sécurité.

Pour créer la base de données : 

    - symfony console doctrine:database:create

Puis exécuter les migrations présentes avec :

    - symfony console doctrine:migrations:migrate

Pour inclure la fixture :

    - symfony console doctrine:fixtures:load --append

Vous pouvez alors lancer le serveur symfony avec :

    - symfony serve

J'ai ajouté un fichier sql contenant des données utiles pour l'affichage du site. Exécutez-les dans l'ordre. Pour le reste des fonctionnalités, pour une question de sécurité, il vaut mieux passer directement par l'interface du site.


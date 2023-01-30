# Test Technique
Php 7.4, Symfony 5.4

Docker version 20.10.23, build 7155243

## Installation
Dans le directory, build docker :

    docker compose up -d --build
    docker excec -it web /bin/bash

Dans le container web :
    
    composer install
    bin/console doctrine:migration:migrate
    bin/console doctrine:fixture:load

La création d'un nouvel user se fait par un Admin. 

Ici le profil de base est créer par la fixture doctrine.

    Username : dev_symfony_1
    Password : password
1) Clone the project to any folder
2) Navigate to that folder and execute following commands with the console:
    php app/console server:run
    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force
    php app/console doctrine:fixtures:load --append
3) Go to http://localhost:8000/ and login with following credentials:
    username: admin
    password: admin

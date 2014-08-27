1) Clone the projects to your folder
2) Navigate to folder and execute following commands:
    php app/console server:run
    php app/console doctrine:database:create
    php app/console doctrine:schema:update --force
    php app/console doctrine:fixtures:load --append
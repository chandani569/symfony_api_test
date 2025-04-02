System requirements
- Linux OR Windows OS
- Also Required Symfony installed in the system
- PHP 8.1+

Configure and run the Sample
- Clone the project URL
- Install the project's dependencies:
- composer install OR composer update
- Run: php bin/console doctrine:migrations:migrate
- Run: symfony server:start
- Test api into postman: http://127.0.0.1:8000/api/login
- http://127.0.0.1:8000/api/properties

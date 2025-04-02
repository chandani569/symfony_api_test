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
- If JWT authentication is not setup, generate the private and public key:
- php bin/console lexik:jwt:generate-keypair
- Run: php bin/console security:hash-password
- Enter a password and store the hashed password in your database.
- Make a POST request to postman: http://127.0.0.1:8000/api/login
- Content-Type: application/json
{
  "email": "user@example.com",
  "password": "yourpassword"
}
- You will got JSON Response : { token }
- Make a GET reqest to postman: http://127.0.0.1:8000/api/properties
- Use this token in the Authorization header :
- You will got Response: {
    "current_page": 1,
    "total_items": 3,
    "total_pages": 1,
    "data": [
        {
            "id": 1,
            "address": "123 Main St",
            "price": 100000,
            "source": "api2",
            "owner": "John Doe",
            "contact": "123-456-7890"
        },
        {
            "id": 2,
            "address": "456 Elm St",
            "price": 150000,
            "source": "api1"
        },
        {
            "id": 3,
            "address": "789 Oak St",
            "price": 200000,
            "source": "api2"
        }
    ]
}

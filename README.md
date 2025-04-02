**Symfony API with JWT Authentication and Pagination**

**System requirements**

- Operating System:  Linux OR Windows OS
- PHP Version: 8.1+
- Symfony Installed
- Composer Installed

 **Setup Instructions**

1. Clone the Project Repository
- git clone https://github.com/chandani569/symfony_api_test.git
cd symfony_api_test
  
2. Configure the Database
- Ensure your .env file has the correct database credentials, then run:
  
  php bin/console doctrine:migrations:migrate
  
3. Start the Symfony Server:
   
    symfony server:start

4. Setup JWT Authentication (If not already configured)
- Generate the private and public keys:
  
  php bin/console lexik:jwt:generate-keypair
  
5. Hash a Password for a User
- To create a new user, generate a hashed password:

  php bin/console security:hash-password
  - Enter a password and store the hashed password in the database.


 **Usage**

1. Obtain a JWT Token
   
   Make a POST request in Postman:

    EndPoint:

    POST http://127.0.0.1:8000/api/login
   
   Headers:
   
   Content-Type: application/json

    Request Body:

    {
    "email": "user@example.com",
    "password": "yourpassword"
    }

    Response:

   {
   "token": "your-jwt-token"
   }
   

2. Access Protected API Endpoint
   
 - Make a GET request to fetch properties:

   Endpoint:

    GET http://127.0.0.1:8000/api/properties

   Headers:

   Authorization: Bearer your-jwt-token

   Response:

   {
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

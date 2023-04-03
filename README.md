## Laravel CRUD API with Auth
Basic Laravel CRUD API application included with Authentication Module & Product Module. It's included with JWT authentication and Swagger API format.

----

### Language & Framework Used:
1. PHP-8
1. Laravel-10

### Architecture Used:
1. Laravel 10.x
1. Interface-Repository Pattern
1. Model Based Eloquent Query
1. Swagger API Documentation - https://github.com/DarkaOnLine/L5-Swagger
1. JWT Auth - https://github.com/tymondesigns/jwt-auth

### API List:
##### Authentication Module
1. [x] Register User API with Token
1. [x] Login API with Token
1. [x] Authenticated User Profile
1. [x] Refresh Data
1. [x] Logout

##### Post Module
1. [x] Post List
1. [x] Create Product
1. [x] Edit Post
1. [x] View Post
1. [x] Delete Post

### How to Run:
1. Clone Project -

```bash
git clone https://github.com/burhonov007/crud_swagger.git
```
1. Go to the project drectory by `cd crud_swagger` & Run the
2. Create `.env` file & Copy `.env.example` file to `.env` file
3. Create a database called - `crud_api`.
4. Install composer packages - `composer install`.
5. Now migrate and seed database to complete whole project setup by running this-
``` bash
php artisan migrate:refresh --seed
```
It will create `50`  Posts.
6. Generate Swagger API
``` bash
php artisan l5-swagger:generate
```
7. Run the server -
``` bash
php artisan serve
```
8. Open Browser -
   http://127.0.0.1:8000 & go to API Documentation -
   http://127.0.0.1:8000/api/documentation
9. You'll see a Swagger Panel.


### Procedure
1. First Register and Login with the credential 
2. Set bearer token to Swagger Header or Post Header as Authentication
3. Hit Any API, You can also hit any API, before authorization header data set to see the effects.



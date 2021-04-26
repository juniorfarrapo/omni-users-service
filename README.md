
# omni-users-service

Service to create users and managing login with generating access token
  
The project has two defaults branches of developing, using the git-flow methodology.

- main: branch to deploying in cloud;

- develop: branch to developing environment.

## How install and Running Laravel API
You can install, configures and run this project using Artisan CLI, follow these steps:

- Clone the Github repository and navegate to **/backend** folder.
- Use composer to install dependencies.
> $ composer install
	
- Configure MySql connection, duplicate file **.env.example** and rename to **.env**, add configurations follow your MySql configuration.
 ````properties
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
````

- Run Artisan CLI comand to configure database using migrations.
> $ php artisan migrate

- Run two Artisan CLI comands to configure **Passport**, necessary to auth access.
> $ php artisan passport:install
> $ php artisan key:generate

- Now, you are able to run the API, uses the follow comand.
> $ php artisan serve

- The API are running in address: `http://127.0.0.1:8000`
	
## Frontend app

In the web application, you can access login page, register a new login and view you profile user data.

Run the API, navegate to **/frontend** and open in your browser the file `'login.html'`

## API Methods
You need to add in all header:
```json
{
"Accept": ["aplication/json"]
}
```

### User Create

**URL** : `/api/register/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**
```json
{
"name": ["string"],
"email": ["string"],
"password": ["string"],
"gender": ["string"],
"social_name": ["string"],
"document_number_cpf": ["string"],
"birthday": ["date"],
"phonenumber_1": ["string"],
"phonenumber_2": ["string"],
"number": ["string"],
"neighborhood": ["string"],
"city": ["string"],
"state": ["string"],
"zipcode": ["string"],
"complement": ["string"],
"address": ["string"]
}
```

**Response**
```json
{
"token": ["string: access token"]
}
```

### User Login

**URL** : `/api/login/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**
```json
{
"email": ["string"],
"password": ["string"]
}
```

**Response**
```json
{
"token": ["string: access token"]
}
```

### User Profile

**URL** : `/api/profile/`

**Method** : `GET`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Response**
```json
{
"success": ["boolean"],
"data": {
	"id": ["integer"],
	"name": ["string"],
	"email": ["string"],
	"email_verified_at": ["boolean"],
	"created_at": ["datetime"],
	"updated_at": ["datetime"],
	"gender": ["string"],
	"social_name": ["string"],
	"document_number_cpf": ["string"],
	"birthday": ["date"],
	"phonenumber_1": ["string"],
	"phonenumber_2": ["string"],
	"address": ["string"],
	"number": ["string"],
	"neighborhood": ["string"],
	"city": ["string"],
	"state": ["string"],
	"zipcode": ["string"],
	"complement": ["string"]
	}
}
```

### User Profile Update

**URL** : `/api/profile/`

**Method** : `PUT`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Data constraints**
```json
{
"name": ["string"],
"gender": ["string"],
"social_name": ["string"],
"birthday": ["date"],
"phonenumber_1": ["string"],
"phonenumber_2": ["string"],
"address": ["string"],
"number": ["string"],
"neighborhood": ["string"],
"city": ["string"],
"state": ["string"],
"zipcode": ["string"],
"complement": ["string"]
}
```

**Response**
```json
{
"success": ["boolean"]
}
```

### User Change Password

**URL** : `/api/changePassword/`

**Method** : `POST`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Data constraints**
```json
{
"oldPassword" : ["string"],
"newPassword" : ["string"],
"confirmNewPassword" : ["string"]	
}
```

**Response**
```json
{
"success": ["boolean"]
}
```

### User Logout (Revoke user token)

**URL** : `/api/logout/`

**Method** : `POST`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Response**
```json
{
"success": ["boolean"]
}
```

### Ticket Create/Update

**URL** : `/api/tickets/{$id}`

**Method** : `POST, PUT`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Data constraints**
```json
{
"title" : ["string"]
}
```

**Response**
```json
{
"success": ["boolean"],
"data": {
    "title": ["string"],
    "user_id": ["integer"],
    "updated_at": ["datetime"],
    "created_at": ["datetime"],
    "id": ["integer"]
  }
}
```

### Ticket Read

**URL** : `/api/tickets/{$id}`

**Method** : `GET`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Response**
```json
{
"success": ["boolean"],
"data": {
    "title": ["string"],
    "user_id": ["integer"],
    "updated_at": ["datetime"],
    "created_at": ["datetime"],
    "id": ["integer"]
  }
}
```

### Ticket Delete

**URL** : `/api/tickets/{$id}`

**Method** : `DELETE`

**Auth required** : YES

**Header**
```json
{
"Authorization": ["Bearer token"],
"Accept": ["aplication/json"]
}
```

**Response**
```json
{
"success": ["boolean"]
}
```

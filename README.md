
# omni-users-service

Service to create users and managing login with generating access token
  
The project has two defaults branches of developing, using the git-flow methodology.

- main: branch to deploying in cloud;

- develop: branch to developing environment.

  

## How install the API

## Running API

## Frontend app
  
  
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

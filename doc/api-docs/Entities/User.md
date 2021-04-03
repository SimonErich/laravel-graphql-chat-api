
# User Entity

The following queries/mutations can be used by the client to work with users.

* register: Register new user (mutation)
* authenticate: Login existing user with email and password
* me: Get user credentials for the currently logged in user

## Authentication

To be able to write messages, you have to be authenticated.
You add an authentication (register / login) process using the following 2 queries.


### register Mutation

Can be used to register/create new users.

_Query:_
```graphql
mutation($input: RegisterUserInput!){
  register(input: $input){
    accessToken
    user {
      id
      name
      email
    }
  }
}
```

_Variables:_
```json
{ 
  "input": {
      "email": "demo@demo.at",
      "password": "123456789",
      "password_confirmation": "123456789",
      "name": "John Doe"
  }
}
```


_Result:_
```json
{
  "data": {
    "authenticate": {
      "accessToken": "2|6okeHVOnUeHR392ArASz957LV2dBFCG5QHtFpn16",
      "user": {
        "id": "1",
        "name": "John Doe",
        "email": "demo@demo.at"
      }
    }
  }
}
```

### authenticate Mutation

Can be used to authenticate users.

_Query:_
```graphql
mutation($input: AuthenticateInput!){
  authenticate(input: $input){
    accessToken
    user {
      id
      name
      email
    }
  }
}
```

_Variables:_
```json
{ 
  "input": {
      "email": "demo@demo.at",
      "password": "123456789",
  }
}
```


_Result:_
```json
{
  "data": {
    "authenticate": {
      "accessToken": "2|6okeHVOnUeHR392ArASz957LV2dBFCG5QHtFpn16",
      "user": {
        "id": "1",
        "name": "John Doe",
        "email": "demo@demo.at"
      }
    }
  }
}
```

### me Query

Can be used to get all user data for a specific accessToken.
(in this case only the accessToken is used instead of the credentials, like in the `authenticate` case.)

**request preparation:**
To make this query (and all other room/message queries work) you need to pass the `accessToken` from the mutations above as a Authorization header.

So, the headers should have at least the following content.
```json
{
    "Authorization": "Bearer ${REPLACE_ACCESS_TOKEN_FROM_ABOVE}"
}
```

_header example (accessToken from authenticate filled in):_
```json
{
    "Authorization": "Bearer 2|6okeHVOnUeHR392ArASz957LV2dBFCG5QHtFpn16"
}
```



**example:**

_Query:_
```graphql
query getUser {
  me{
    id
    name
    email
  }
}
```

_Variables:_

no variables needed


_Result:_
```json
{
  "data": {
    "id": "1",
    "name": "Frodo12",
    "email": "demo@demo.at"
  }
}
```

# Room Entity

The following queries/mutations can be used by the client to create, update or delete chat rooms.
These rooms act to group messages like threads.

**Queries:**
* getRooms: returns a list of all rooms available
* getRoom: returns details for a specific room

**Mutations:**
* createRoom: open a new room
* updateRoom: change the details of a room
* deleteRoom: remove a room permanently and delete all messages inside of it


## Queries

The following queries make it possible to read and list rooms.

### getRooms Query

This query returns a paginated list (see [more about Pagination](https://lighthouse-php.com/5.3/eloquent/getting-started.html#pagination)) of rooms to show an overview.

_Query:_
```graphql
query getRoomsQuery($first: Int, $page: Int){
  getRooms(first: $first, page: $page){
    data {
      id
      title
      description
    }
    paginatorInfo {
      currentPage
      hasMorePages
      total
    }
  }
}
```

_Variables:_
```json
{
  "first": 20, // number of entries to fetch per page
  "page": 0 // page number to fetch (0 means the first page. If we had "first" on 20 and "page" on 3, we would start from entry 20 x 3 = 60 row in the database)
}
```


_Result:_
```json
{
  "data": {
    "getRooms": {
      "data": [
        {
          "id": "1",
          "title": "random",
          "description": "Just a random room to talk a bit"
        },
        {
          "id": "2",
          "title": "watercooler",
          "description": "A room to hang out and smalltalk"
        },
        {
          "id": "3",
          "title": "work",
          "description": "This is where real work is done!"
        },
      ],
      "paginatorInfo": {
        "currentPage": 1,
        "hasMorePages": false,
        "total": 3
      }
    }
  }
}
```


### getRoom Query

This query returns details for a specific room.

It also returns a short excerpt of the last 20 messages, but if you want all messages, you should use the [getMessages Query](./Message.md).


_Query:_
```graphql
query getRoomQuery($id: ID!) {
  getRoom(id: $id){
    id
    title
    description
  }
}
```

_Variables:_
```json
{
	"id": 6 // unique id of the room we want to get the details of
}
```


_Result:_
```json
{
  "data": {
    "getRoom": {
      "id": "6",
      "title": "random",
      "description": "Just a random room to talk a bit"
    }
  }
}
```




## Mutations

The following mutations allow manipulation of rooms.


### createRoom Mutation

Creates a new room and attaches the currently logged in user as the creator.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation createRoomMutation($title: String!, $description: String, $public: Boolean) {
  createRoom(title: $title, description: $description, public: $public){
    id
    title
    description
    creator {
      id
      name
    }
    public
    createdAt
  }
}
```

_Variables:_
```json
{
   "title": "random", // the name for this chatroom (i.e: "watercooler", "random", "small talk", ...)
   "description": "Just a random room to talk a bit", // a short explanation what to talk about in this room
   "public": false // whether this room is visible for everyone or just the creator. (public = false means only the creator will see and be able to post in it)
}
```


_Result:_
```json
{
  "data": {
    "createRoom": {
      "id": "1",
      "title": "random",
      "description": "Just a random room to talk a bit",
      "creator": {
        "id": "1",
        "name": "TheFrog"
      },
      "public": false,
      "createdAt": "2021-04-03 12:08:44"
    }
  }
}
```


### updateRoom Mutation

Updates data (title and description) of a chat room.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation updateRoomMutation($id: ID!, $title: String!, $description: String) {
  updateRoom(id: $id, title: $title, description: $description){
    id
    title
    description
    creator {
      id
      name
    }
    public
    createdAt
  }
}
```

_Variables:_
```json
{
    "id": 1, // the unique id of the room, we want to update
    "title": "random", // the name for this chatroom (i.e: "watercooler", "random", "small talk", ...)
    "description": "Just a random room to talk a bit", // a short explanation what to talk about in this room
}
```


_Result:_
```json
{
  "data": {
    "updateRoom": {
      "id": "1",
      "title": "random new name",
      "description": "Just a random room to talk a bit but changed",
      "creator": {
        "id": "3",
        "name": "JohnDoe124"
      },
      "public": false,
      "createdAt": "2021-04-03 12:42:32"
    }
  }
}
```


### deleteRoom Mutation

Creates a new room and attaches the currently logged in user as the creator.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation deleteRoomMutation($id: ID!) {
  deleteRoom(id: $id){
    id
    title
    description
    creator {
      id
      name
    }
    public
    createdAt
  }
}
```

_Variables:_
```json
{
	"id": 1 // the unique id of the room, we want to delete
}
```


_Result:_
```json
{
  "data": {
    "deleteRoom": {
      "id": "1",
      "title": "random new name",
      "description": "Just a random room to talk a bit but changed",
      "creator": {
        "id": "3",
        "name": "JohnDoe124"
      },
      "public": false,
      "createdAt": "2021-04-03 12:42:32"
    }
  }
}
```
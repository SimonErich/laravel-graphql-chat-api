
# Message Entity

The following queries/mutations can be used by the client to create, update or delete chat messages.
These messages are the main type for conversation and always have to be assigned to a specific chat room.

**Queries:**
* getMessages: returns a paginated list of messages within a conversation

**Mutations:**
* createMessage: write a new message
* updateMessage: change the message content
* deleteMessage: remove a message permanently


## Queries

The following queries make it possible to get messages

### getMessages Query

This query returns a paginated list (see [more about Pagination](https://lighthouse-php.com/5.3/eloquent/getting-started.html#pagination)) of messages within a chat room

_Query:_
```graphql
query getMessagesQuery($first: Int, $page: Int, $roomId: ID!){
  getMessages(first: $first, page: $page, roomId: $roomId){
    data {
      id
      body
      author {
        avatar
        id
        name
      }
      createdAt
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
    "page": 0, // page number to fetch (0 means the first page. If we had "first" on 20 and "page" on 3, we would start from entry 20 x 3 = 60 row in the database)
    "roomId": 1 // The unique id of the room we want to get the messages in
}
```


_Result:_
```json
{
  "data": {
    "getMessages": {
      "data": [
        {
          "id": "1",
          "body": "Oh, no. Let me change that: Hello World again!",
          "author": {
            "avatar": "https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/John_Lennon_1969_%28cropped%29.jpg/220px-John_Lennon_1969_%28cropped%29.jpg",
            "id": "3",
            "name": "JohnDoe124"
          },
          "createdAt": "2021-04-03 13:24:25"
        },
        {
          "id": "2",
          "body": "Hello World 2",
          "author": {
            "avatar": "https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/John_Lennon_1969_%28cropped%29.jpg/220px-John_Lennon_1969_%28cropped%29.jpg",
            "id": "3",
            "name": "JohnDoe124"
          },
          "createdAt": "2021-04-03 13:25:31"
        }
      ],
      "paginatorInfo": {
        "currentPage": 1,
        "hasMorePages": false,
        "total": 2
      }
    }
  }
}
```



## Mutations

The following mutations allow manipulation of messages.


### createMessage Mutation

Creates a new message in a specific room and attaches the currently logged in user as the author.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation createMessageMutation($body: String!, $roomId: ID!) {
  createMessage(body: $body, roomId: $roomId){
    id
    body
    author {
      avatar
      id
      name
    }
    createdAt
  }
}
```

_Variables:_
```json
{
	"roomId": 6,  // the unique room id we want to post this message in
    "body": "Hello World 1"  // the message content, we want to post
}
```


_Result:_
```json
{
  "data": {
    "createMessage": {
      "id": "1",
      "body": "Hello World 1",
      "author": {
        "avatar": null,
        "id": "3",
        "name": "JohnDoe124"
      },
      "createdAt": "2021-04-03 13:24:25"
    }
  }
}
```


### updateMessage Mutation

Updates the content of a chat message, that has been posted.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation updateMessageMutation($id: ID!, $body: String!) {
  updateMessage(id: $id, body: $body){
    id
    body
    author {
      avatar
      id
      name
    }
    createdAt
  }
}
```

_Variables:_
```json
{
	"id": 1,  // the unique id of the message we want to change
	"body": "Oh, no. Let me change that: Hello World again!" // the new message content, we want to change it to
}
```


_Result:_
```json
{
  "data": {
    "updateMessage": {
      "id": "1",
      "body": "Oh, no. Let me change that: Hello World again!",
      "author": {
        "avatar": null,
        "id": "3",
        "name": "JohnDoe124"
      },
      "createdAt": "2021-04-03 13:24:25"
    }
  }
}
```


### deleteMessage Mutation

Deletes a specific message permantenly.

(This mutation requires an authenticated user: see [Authentication](../Authentication.md))


_Query:_
```graphql
mutation deleteMessageMutation($id: ID!) {
  deleteMessage(id: $id){
    id
    body
    author {
      avatar
      id
      name
    }
    createdAt
  }
}
```

_Variables:_
```json
{
	"id": 3
}
```


_Result:_
```json
{
  "data": {
    "deleteMessage": {
      "id": "3",
      "body": "Hello World 3",
      "author": {
        "avatar": null,
        "id": "3",
        "name": "JohnDoe124"
      },
      "createdAt": "2021-04-03 13:25:34"
    }
  }
}
```
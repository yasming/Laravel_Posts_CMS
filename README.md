# Posts-CMS

This project simulate a cms posts systems, where the post have a content, title, author and tags, the user needs to authenticate to use the posts system .

## Prerequisites

```
PHP >= 7.3
```

```
PHP Unit >=9.3.3
```

```
Laravel >= 8.12
```


### API Collection

https://www.getpostman.com/collections/94a84cdf476c573e0566

### API Swagger Documentation

https://app.swaggerhub.com/apis-docs/yasminguimaraes/Posts_CMS/1.0.0

### Public project's url: 

https://posts-cms.herokuapp.com/

### Getting Started

- After you clone the project: 

```
composer install
```

```
cp .env.example .env
```

```
php artisan key:generate
```

```
php artisan jwt:generate
```

```
php artisan migrate --seed
```

### How to run project's tests

```
php artisan test
```

### How to consume the project routes: 

```
Auth
```

```
POST https://posts-cms.herokuapp.com/api/login
```

```
Body: 
```

```
{
    "email": "email@example.com",
    "password": "password"
}
```

```
Response: 
```

```
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXBpXC9sb2dpbiIsImlhdCI6MTYwNTM0OTA2OSwiZXhwIjoxNjA1MzUyNjY5LCJuYmYiOjE2MDUzNDkwNjksImp0aSI6Im9rRmw5MjdsSEJqSDJhOEQiLCJzdWIiOjEsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.fW_wZSbZZogCZMIWnMBpttassvGUMQV-wxfbXxyPrhY",
    "user": {
        "id": 1,
        "name": "Eusebio Fisher Sr.",
        "email": "email@example.com",
        "email_verified_at": "2020-11-11T20:34:17.000000Z",
        "created_at": "2020-11-11T20:34:17.000000Z",
        "updated_at": "2020-11-11T20:34:17.000000Z"
    }
}
```

```
List all posts
```

```
GET lhttps://posts-cms.herokuapp.com/api/posts
```

```
Headers:
```

```
Authorization: Bearer Token
```

```
Response:
```

```
{
    "data": [
         {
            "id": 2,
            "title": "hotel test",
            "author": "Jett Hilpert",
            "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
            "tags": [
                "node",
                "organizing",
                "webapps",
                "domain",
                "developer",
                "https",
                "proxy"
            ]
        },
        {
            "id": 4,
            "title": "Miss",
            "author": "Prof. Bertha Hayes",
            "content": "Sed consectetur aut quibusdam animi non molestias doloribus. Qui molestias ut rerum ut rerum. Laborum temporibus ducimus ipsam qui. Dicta occaecati facilis quibusdam molestias facere tempora.",
            "tags": [
                "api",
                "json",
                "schema",
                "node",
                "github",
                "rest"
            ]
        },
   ]
}
```

```
Response Code: 200
```

```
Search post by tag
```

```
GET https://posts-cms.herokuapp.com/api/posts?tag=organization
```

```
Headers:
```

```
Authorization: Bearer Token
```

```
Response:
```

```
{
    "data": [
        {
            "id": 5,
            "title": "Prof.",
            "author": "Wendell Leuschke",
            "content": "Ipsa error earum quia maiores facere. Consequatur rem minima rerum consequatur amet impedit. Consequuntur consequatur at cupiditate accusamus consectetur tempore aut.",
            "tags": [
                "organization",
                "planning",
                "collaboration",
                "writing",
                "calendar"
            ]
        },
     ]
}
```

```
Response Code: 200
```

```
Create Post
```

```
POST https://posts-cms.herokuapp.com/api/posts
```

```
Headers:
```

```
Authorization: Bearer Token
```

```
Body:
```

```
{ 
    "title": "hotel",
    "author": "Jett Hilpert",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags":["node", "organizing", "webapps", "domain", "developer", "https", "proxy"]
}
```

```
Response:
```

```
{
    "title": "hotel",
    "author": "Jett Hilpert",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags": [
        "node",
        "organizing",
        "webapps",
        "domain",
        "developer",
        "https",
        "proxy"
    ],
    "id": 23
}
```

```
Response Code: 201
```

```
Update Post
```

```
PUT https://posts-cms.herokuapp.com/api/posts/2
```

```
Headers:
```

```
Authorization: Bearer Token
```

```
Body:
```

```
{ 
    "title": "hotel test",
    "author": "Jett Hilpert",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags":["node", "organizing", "webapps", "domain", "developer", "https", "proxy"]
}
```

```
Response:
```

```
{
    "id": 2,
    "title": "hotel test",
    "author": "Jett Hilpert",
    "content": "Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.",
    "tags": [
        "node",
        "organizing",
        "webapps",
        "domain",
        "developer",
        "https",
        "proxy"
    ]
}
```

```
Response Code: 200
```

```
Delete Post
```

```
DELETE https://posts-cms.herokuapp.com/api/posts/2
```

```
Headers:
```

```
Authorization: Bearer Token
```

```
Response:
```

```
{
    []
}
```

```
Response Code: 204
```

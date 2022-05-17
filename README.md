## Setup Instructions

The following instructions assumes that you are familiar with the following technologies and you have them installed and setup on you local environment if needed:

- Laravel 8/9
- PHP >= 8
- Mysql 8.0.28
- Laravel sail
- Docker 20
- Docker-Compose
- Node & NPM
- Git
- Postman

### Clone the repo from github 
```
$ git clone https://github.com/mokgosi/library-app.git
```

### Install dependencies 
```
$ composer install
```

### Setup Environment variables file in your root directory
```
$ cp .env.example .env
```

Open .env file from root and setup the following variables

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=library_db
DB_USERNAME=sail
DB_PASSWORD=password

BOOKS_BORROWED_LIMIT=5
BOOKS_BORROWED_TIME_LIMIT_DAYS=7
BOOKS_PENALTIES_CHARGE_LIMIT=50.00
BOOKS_PENALTIES_CHARGE_PER_DAY=02.00
```

### (OPTIONAL) Run these commands to stop any conflicting running containers and services
```
$ sudo aa-remove-unknown
$ docker container kill $(docker ps -q) // kill all running containers
$ sudo systemctl start apparmor 
$ sudo apparmor_parser -r /var/lib/snapd/apparmor/profiles/*
$ sudo systemctl stop apache2
$ sudo /etc/init.d/mysql stop
```

### Setup containers and images
```
$ ./vendor/bin/sail up 
```

### Setup application unique key
```
$ ./vendor/bin/sail artisan key:generate 
```

### Database migration and seed
```
$ ./vendor/bin/sail artisan migrate:fresh --seed
```
### Test your app here

http://localhost

OR

TEST using POSTMAN

### 1. Register to acquire your Bearer Token

Request

```
POST   http://localhost/api/register
Content-Type: application/json
Body: 
{
    "name": "New User",
    "email": "user@mail.com",
    "password": "S3cr3tP@sssw0rd",
    "password_confirmation": "S3cr3tP@sssw0rd"
}
```

Response:

```
{
    "user": {
        "name": "New User",
        "email": "user@mail.com",
        "updated_at": "2022-05-10T04:17:11.000000Z",
        "created_at": "2022-05-10T04:17:11.000000Z",
        "id": 3
    },
    "token": "1|Ogz8KZQ7emPer0p8jo0Y65wORBTI1eGAkvv30JXA"
}
```

### 2. Login

Request

```
GET   http://localhost/api/login
Content-Type: application/json
Body: 
{
    "email": "user@mail.com",
    "password": "S3cr3tP@sssw0rd",
}
```

Response:

```
{
    "user": {
        "id": 3,
        "name": "New User",
        "email": "user@mail.com",
        "email_verified_at": null,
        "created_at": "2022-05-10T04:17:11.000000Z",
        "updated_at": "2022-05-10T04:17:11.000000Z"
    },
    "token": "2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE"
}
```


### Create Member

Request

```
POST   http://localhost/api/members
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body: 
{
    "first_name": "Lauryn Udated",
    "last_name": "Cole Updated",
    "id_number": "7320445157958",
    "date_of_birth": "2019-05-12",
    "home_address": "42762 Macejkovic Knoll\nHillsborough, VT 16286-9001",
    "penalties": 0,
    "status": "Active",
    "email": "pietro75@example.net",
    "phone": "0675991632"
}
```

Response:

```
{
    "data": {
        "first_name": "Lauryn Udated",
        "last_name": "Cole Updated",
        "id_number": "7320445157958",
        "date_of_birth": "2019-05-12",
        "home_address": "42762 Macejkovic Knoll\nHillsborough, VT 16286-9001",
        "email": "pietro75@example.net",
        "phone": "0675991632",
        "status": "Active",
        "updated_at": "2022-05-17T06:44:44.000000Z",
        "created_at": "2022-05-17T06:44:44.000000Z",
        "id": 11,
        "full_name": "Lauryn Udated Cole Updated"
    }
}
```

### Create Member

Request

```
POST   http://localhost/api/books
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body: 
{
    "title": "Horizontal coherent intranet Updated",
    "copies": 2,
    "description": "Nam nulla hic molestiae autem. Updated",
    "author": "Dr. Jake Hickle DVM",
    "isbn": 9789419177428,
    "category_id": 1
}
```

Response:

```
{
    "data": {
        "title": "Horizontal coherent intranet Updated",
        "description": "Nam nulla hic molestiae autem. Updated",
        "author": "Dr. Jake Hickle DVM",
        "isbn": 9789419177428,
        "category_id": 1,
        "copies": 2,
        "updated_at": "2022-05-17T06:51:04.000000Z",
        "created_at": "2022-05-17T06:51:04.000000Z",
        "id": 101
    }
}
```



### Get Books List

Request

```
GET   http://localhost/api/books
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "title": "Horizontal coherent intranet",
        "copies": 2,
        "description": "Nam nulla hic molestiae autem. Delectus consectetur eos alias quas sit. Placeat modi laudantium hic et voluptatem consequatur eos.",
        "author": "Dr. Jake Hickle DVM",
        "isbn": 9789419177428,
        "category": "Ameliorated intangible forecast"
    },
    ........
}
```

### Get Members List

Request

```
GET   http://localhost/api/members
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "first_name": "Lauryn",
        "last_name": "Cole",
        "id_number": "7320445157058",
        "date_of_birth": "2019-05-12",
        "home_address": "42762 Macejkovic Knoll\nHillsborough, VT 16286-9001",
        "penalties": 0,
        "status": "Active",
        "email": "pietro75@example.net",
        "phone": "+15315991632",
        "created_at": "2022-05-16T20:04:06.000000Z",
        "updated_at": "2022-05-16T20:04:06.000000Z",
        "full_name": "Lauryn Cole"
    },
    ..........
}
```

### Get Transactions List

Request

```
GET   http://localhost/api/transactions
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 2,
            "transaction_id": "TRANS-0000002",
            "book_id": 86,
            "member_id": 3,
            "date_issued": "2022-05-14 23:52:15",
            "date_due": "2022-05-23 20:04:06",
            "date_returned": null,
            "status": "Completed",
            "penalty": "0.00",
            "created_at": "2022-05-16T20:04:06.000000Z",
            "updated_at": "2022-05-17T05:35:26.000000Z",
            "days_overdue": 0,
            "penalty_fee": 0,
            "member": {
                "id": 3,
                "first_name": "Ellsworth",
                "last_name": "Lockman",
                "id_number": "3955600713621",
                "date_of_birth": "2004-01-17",
                "home_address": "7404 Von Lane\nReichelstad, NC 07189",
                "penalties": 0,
                "status": "Active",
                "email": "martin.witting@example.com",
                "phone": "+15678826389",
                "created_at": "2022-05-16T20:04:06.000000Z",
                "updated_at": "2022-05-16T20:04:06.000000Z",
                "full_name": "Ellsworth Lockman"
            },
            "book": {
                "id": 86,
                "title": "Total clear-thinking info-mediaries",
                "author": "Chaz Cartwright",
                "description": "Aliquam aut hic mollitia quia. Nostrum facere animi tempora. Aut voluptatem sunt impedit et.",
                "copies": 3,
                "isbn": 9792346792992,
                "category_id": 1,
                "created_at": "2022-05-16T20:04:06.000000Z",
                "updated_at": "2022-05-16T20:04:06.000000Z"
            }
    },
    ..........
}
```

### Get Members List

Request

```
GET   http://localhost/api/Categories
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "title": "Horizontal coherent intranet",
        "copies": 2,
        "description": "Nam nulla hic molestiae autem. Delectus consectetur eos alias quas sit. Placeat modi laudantium hic et voluptatem consequatur eos.",
        "author": "Dr. Jake Hickle DVM",
        "isbn": 9789419177428,
        "category": "Ameliorated intangible forecast"
    },
    ..........
}
```

### Update Category

Request

```
PUT   http://localhost/api/categories/1
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body:
{
    "name": "Re-contextualized maximized artificialintelligence updated"
}
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "name": "Re-contextualized maximized artificialintelligence updated",
        "created_at": "2022-05-16T20:04:06.000000Z",
        "updated_at": "2022-05-17T06:17:21.000000Z"
    }
}
```

### Update Book

Request

```
PUT   http://localhost/api/books/1
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body:
{
    "title": "Horizontal coherent intranet Updated",
    "author": "Dr. Jake Hickle DVM",
    "description": "Nam nulla hic molestiae autem. Updated",
    "copies": 2,
    "isbn": 9789419177428,
    "category_id": 1,
}
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "title": "Horizontal coherent intranet Updated",
        "author": "Dr. Jake Hickle DVM",
        "description": "Nam nulla hic molestiae autem. Updated",
        "copies": 2,
        "isbn": 9789419177428,
        "category_id": 1,
        "created_at": "2022-05-16T20:04:06.000000Z",
        "updated_at": "2022-05-17T06:30:14.000000Z"
    }
}
```


### Update Member

Request

```
PUT   http://localhost/api/members/2
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body:
{
    "first_name": "Lauryn Udated",
    "last_name": "Cole Updated",
    "id_number": "7320445157058",
    "date_of_birth": "2019-05-12",
    "home_address": "42762 Macejkovic Knoll\nHillsborough, VT 16286-9001",
    "penalties": 0,
    "status": "Active",
    "email": "pietro75@example.net",
    "phone": "0675991632"
}
```

Response:

```
{
    "data": [
    {
        "id": 2,
        "first_name": "Lauryn Udated",
        "last_name": "Cole Updated",
        "id_number": "7320445157058",
        "date_of_birth": "2019-05-12",
        "home_address": "42762 Macejkovic Knoll\nHillsborough, VT 16286-9001",
        "penalties": 0,
        "status": "Active",
        "email": "pietro75@example.net",
        "phone": "0675991632",
        "created_at": "2022-05-16T20:04:06.000000Z",
        "updated_at": "2022-05-17T06:40:39.000000Z",
        "full_name": "Lauryn Udated Cole Updated"
    }
}
```

### Delete Member

Request

```
DELETE   http://localhost/api/members/2
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

### Delete Book

Request

```
DELETE   http://localhost/api/books/2
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

### Delete Transaction

Request

```
DELETE   http://localhost/api/transactions/2
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

### Delete Category

Request

```
DELETE   http://localhost/api/categories/2
Accept:  application/json
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```


TODO: (Due to time constraints)

- Unit Tests
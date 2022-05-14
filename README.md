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
DB_DATABASE=student_db
DB_USERNAME=sail
DB_PASSWORD=password
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

### 3. Get Student List

Request

```
GET   http://localhost/api/students
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "first_name": "Dovie",
        "last_name": "Harvey",
        "id_number": "3579508079000",
        "date_of_birth": "2003-02-24",
        "home_address": "451 Avis Harbors\nSouth Bernitaborough, KY 07822-3835",
        "email": "khills@example.com",
        "phone": "+17033748497",
        "school_id": 5,
        "created_at": "2022-05-09T13:50:56.000000Z",
        "updated_at": "2022-05-09T13:50:56.000000Z",
        "school": {
            "id": 5,
            "name": "Ernser, Mertz and Leuschke",
            "area": "Turkmenistan",
            "province_id": 7,
            "created_at": "2022-05-09T13:50:56.000000Z",
            "updated_at": "2022-05-09T13:50:56.000000Z",
            "students_count": 5
        }
    },
    ........
}
```

4. Get School List

Request

```
GET   http://localhost/api/schools
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "name": "Kerluke LLC",
        "area": "Lesotho",
        "province_id": 6,
        "created_at": "2022-05-09T13:50:56.000000Z",
        "updated_at": "2022-05-09T13:50:56.000000Z",
        "students_count": 4,
        "province": {
            "id": 6,
            "name": "Eastern Cape"
        }
    },
    ..........
}
```

5. Update School

Request

```
PUT   http://localhost/api/schools/1
Content-Type: application/json
Bearer: 2|RYYCbpILwVsvrnIrWzbR3jd5jrc5FMo7g06d6DwE
Body:
{
    "name": "Kerluke LLCC",
    "province_id": 6,
    "area": "Lesotho"
}
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "name": "Kerluke LLC",
        "area": "Lesotho",
        "province_id": 6,
        "created_at": "2022-05-09T13:50:56.000000Z",
        "updated_at": "2022-05-09T13:50:56.000000Z",
        "students_count": 4,
        "province": {
            "id": 6,
            "name": "Eastern Cape"
        }
    }
}
```

5. Update Student

Request

```
PUT   http://localhost/api/students/1
Content-Type: application/json
Bearer: 1|Ogz8KZQ7emPer0p8jo0Y65wORBTI1eGAkvv30JXA
Body:
{
    "first_name": "Dovie",
    "last_name": "Harvey",
    "id_number": "3579508079000",
    "date_of_birth": "2003-02-24",
    "home_address": "451 Avis Harbors\nSouth Bernitaborough, KY 07822-3835",
    "email": "khills@example.com",
    "phone": "0673748497",
    "school_id": 5
}
```

Response:

```
{
    "data": [
    {
        "id": 1,
        "name": "Kerluke LLC",
        "area": "Lesotho",
        "province_id": 6,
        "created_at": "2022-05-09T13:50:56.000000Z",
        "updated_at": "2022-05-09T13:50:56.000000Z",
        "students_count": 4,
        "province": {
            "id": 6,
            "name": "Eastern Cape"
        }
    }
}
```

TODO: (Due to time constraints)

- Unit Tests
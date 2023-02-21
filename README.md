# [Laravel CRUD App]
----------

# Getting started

## Installation

Clone the repository

    git clone https://github.com/IraIvanova/crud-app.git

Switch to the repo folder

    cd laravel-realworld-example-app

Run Docker

    docker-compose up -d --build

Run the database migrations and seeders in docker container (**Set the database connection in .env before migrating and MYSQL_ROOT_PASSWORD in docker-compose.yml**)

    docker-compose exec php-app php artisan migrate --seed

You can now access the server at http://localhost:8080

The api can be accessed at [http://localhost:8080/api](http://localhost:8080/api).

## API Specification

**Companies and projects**

| **URL** 	               | **METHOD** | 	 **DESCRIPTION**    | 
|-------------------------|------------|-----------------------|
| /companies	           | GET   	    | Get companies list    |
| /companies/{id}/show    | GET	    | Get one company	    |
| /companies/{id}/store   | POST 	    | Create company        |
| /companies/{id}/update  | PUT   	    | Update company data   |
| /companies/{id}/destroy  | DELETE     | Delete company        |


**Users**

| **URL** 	           | **METHOD** | 	 **DESCRIPTION**    | 
|---------------------|------------|-----------------------|
| /users	             | GET   	    | Get users list    |
| /users/{id}/show    | GET	    | Get one users	    |
| /users/{id}/update  | PUT   	    | Update users data   |
| /users/{id}/destroy | DELETE     | Delete users        |

**Authentication**

| **URL** 	      | **METHOD** | 	 **DESCRIPTION**      | 
|----------------|------------|------------------------|
| /auth/login    | POST   	   | Login                  |
| /auth/register | POST	      | Register	              |




#### ***Authentication required for next actions: CREATE, UPDATE, DELETE***

----------

#### Request headers

| **Required** 	| **Key**              	 | **Value**            	    |
|----------	|------------------------|---------------------------|
| Yes      	| Accept    	            | application/json 	        |
| Optional 	| Authorization    	     | Bearer token       	 |

----------

# Authentication

This applications uses Laravel Sanctum to handle authentication.


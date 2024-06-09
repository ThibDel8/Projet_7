# BileMo API

## Description

BileMo is a company offering a selection of high-end mobile phones. This API allows partner platforms to access BileMo's product catalog and manage users linked to each client. The project focuses on B2B (business to business) sales exclusively.

## Features

The API allows:

- Viewing the list of BileMo products.
- Viewing the details of a BileMo product.
- Viewing the list of registered users linked to a client.
- Viewing the details of a registered user linked to a client.
- Adding a new user linked to a client.
- Deleting a user added by a client.

Only registered clients can access the API, and they must be authenticated via JWT.

## Prerequisites

- PHP 8.2 or higher
- Composer
- Symfony 7.0.7 or higher
- MySQL

## Installation

1. Clone the GitHub repository:
   git clone https://github.com/ThibDel8/Projet_7.git

2. Install dependencies with Composer:
composer install

3. Configure the database in the .env file:
DATABASE_URL="mysql://user:password@localhost:3306/BileMo"

4. Create the database and run migrations:
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

5. Start the Symfony development server:
symfony serve

## Endpoints

### Products
GET /api/products : View the list of products
GET /api/products/{id} : View the details of a product

### Users
GET /api/users : View the list of users for a client
GET /api/users/{id} : View the details of a user
POST /api/users/{id} : Add a new user
DELETE /api/users/{id} : Delete a user

## Authentication
The API uses JWT for authentication.

## Documentation
Complete API documentation is available [here](https://localhost/api/doc).
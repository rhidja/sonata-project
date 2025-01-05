# Sonata Project

This application is built using [Symfony](https://symfony.com/) 6 famework + [Sonata Project](https://docs.sonata-project.org/en/master/) 4,
it based on [Symfony REST API](https://github.com/rhidja/symfony-rest-api).

It provides:
- Rest API secured using `X-Auth-Token`
- Backoffice (Sonata Project)

## Table of Contents

This guide will walk you through setting up the project, running the server, and testing the API.

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Running the Application](#running-the-application)
- [API Documentation](#api-documentation)

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP (8.1 or higher)
- Composer
- Symfony CLI (optional but recommended)
- Database (MySQL, etc., depending on your setup)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/rhidja/sonata-project
   cd sonata-project

2. Then run the following `make` command to install the application

```shell
make init
```

This command will:

- Run `composer install`.
- Drop the old database if it exists.
- Create a new database.
- Run migrations.
- Run fixtures
- Start the Symfony Local Server.

## Running the Application

- Backoffice access:
  - Url:  https://127.0.0.1:8000/admin
  - Login: `admin`
  - Password: `admin`


- Api: https://127.0.0.1:8000/api


- A `Postman` collection is included to test different endpoints of the api.

```
./docs/postman_collection.json // Contain a collection of endpoints.
./docs/postman_environnement.json // The environment variables.
```

## API Documentation

To see different endpoints of the api [https://127.0.0.1:8000/api/doc](https://127.0.0.1:8000/api/doc/)

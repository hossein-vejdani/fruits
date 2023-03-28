The project uses a PostgreSQL database and Docker for containerization.

Requirements

    PHP 8 or later
    Symfony CLI
    Docker
    Composer

Setup

Clone the repository

Run this command to install the required dependencies.
```bash
composer install
```
Run this commnad to start the PostgreSQL database and mail server.
```bash
docker-compose up -d
```
Run this command to migrate the database schema.
```bash
symfony console doctrine:migrations:migrate
```
To fetch initial data and save it to the database  run:
```bash
Run symfony console fetch-fruits 
```
Run this command to start the development server on port 8000.
```bash
symfony server:start -d
```

Usage

Once the development server is up and running, run frontend project.

Notes

    The database credentials are set in the .env file.
    To stop the Docker container, run docker-compose down.
    To view the database, you can use a PostgreSQL client such as pgAdmin or DBeaver. The database is running on port 5432.
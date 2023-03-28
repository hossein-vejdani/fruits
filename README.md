
[![fruits!](https://i.ibb.co/qCMJhkz/fruits-project.png)](https://i.ibb.co/qCMJhkz/fruits-project.png)



## Requirements

    PHP 8 or later
    Symfony CLI
    Docker
    Composer
    Nodejs 16 or later

Clone the repository 

## Setup
```bash
git clone https://github.com/hossein-vejdani/fruits.git
```

### Backend

Go to backend directory

```bash
cd backend
```

Run this command to install the required dependencies.
```bash
composer install
```
Run this commnad to start the PostgreSQL database and mail server.
```bash
docker-compose up -d
```
Run this command to create database.
```bash
symfony console doctrine:database:create
```
Run this command to migrate the database schema.
```bash
symfony console doctrine:migrations:migrate
```
To fetch initial data and save it to the database  run:
```bash
symfony console fetch-fruits 
```
Run this command the development server on port 8000.
```bash
symfony server:start -d to start
```

### Frontend

Go to frontend directory and open termainl

Then make sure to install the dependencies:

```bash
# yarn
yarn install

# npm
npm install

# pnpm
pnpm install
```

#### Development Server

Start the development server on http://localhost:3000

```bash
npm run dev
```

#### Production

Build the application for production:

```bash
npm run build
```

Locally preview production build:

```bash
npm run preview

```

#### Run unit test

```bash
npm run unit:test
```


## Notes

    The database credentials are set in the .env file.
    To stop the Docker container, run docker-compose down.
    To view the database, you can use a PostgreSQL client such as pgAdmin or DBeaver. The database is running on port 5432.
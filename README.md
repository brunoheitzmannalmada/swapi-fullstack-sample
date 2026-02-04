# SWAPI Fullstack Sample

By [Bruno Heitzmann Almada](https://www.linkedin.com/in/brunoheitzmannalmada/).

This project is a **full-stack application** that integrates with the Star Wars API (SWAPI) to:
- Search for People and Movies
- Display detailed information in a responsive UI
- Log people searches in the database
- Provide a clean API abstraction between frontend and backend

---

## Requirements

- Docker
- Docker Compose
- git

> No local PHP, Composer, or MySQL installation is required.

---

## Tech Stack

### Backend
- PHP 8.2
- Laravel 10
- MySQL 8

### Frontend
- Vue3
- TypeScript
- Vite

### Infra
- Docker
- Docker Compose

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/brunoheitzmannalmada/swapi-fullstack-sample
cd swapi-fullstack-sample
```

### 2. Environment file

Copy the example environment file:

```bash
cp backend/.env.example backend/.env
```

### 3. Build and start the containers

```bash
docker compose up --build -d
```

This will start:
- backend-php
- backend-db
- frontend-vue

First build may take a few minutes.

### 4. Install PHP dependencies

```bash
docker compose exec backend composer install
```
This will install all PHP dependencies required by the Laravel application.

### 5. Generate application key

```bash
docker compose exec backend php artisan key:generate
```

### 6. Run database migrations

```bash
docker compose exec backend php artisan migrate
```
This will create the required tables, including `search_logs`.

## Useful Commands

### View running containers
```bash
docker ps
```

### Stop containers
```bash
docker compose down
```

### Restart containers
```bash
docker compose up -d
```

### Enter backend container
```bash
docker compose exec backend bash
```

### Run Laravel commands
```bash
docker compose exec backend php artisan migrate
```
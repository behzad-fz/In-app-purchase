# T E K N A S Y O N
In-app Purchase Service<br>

## Requirements:
- Docker
- Docker-compose

## Dockerized Environment:
- NGINX
- PHP-FPM
- MySQL

## Installation Guide (Only First Time)
Run below commands into your terminal:

NOTICE: if your port 8889 and 3308 is already in use, please set DOCKER_HTTP_PORT and DOCKER_MYSQL_PORT to free ports in .env file.

```
git clone https://github.com/behzad-fz/In-app-purchase.git
cd In-app-purchase
cp .env.example .env
docker-compose build
docker-compose up -d
```
NOTICE: Wait enough for docker to create database. Make sure it is up and running and then run:
```
make setup
```
NOTICE: At the end it will require you to enter root password to set permission:

## Makefile
You can see available make commands by typing `make` in the terminal.

Now app should be alive on http://localhost:8889.

Enjoy :)

# Laravel Graphql Demo Chat Api 🚀

This is just a simple API for a demo chat using Laravel with a Graphql API and subscriptions.
This boilerplate is based on [Thomas Venturinis](https://github.com/tjventurini) awesome [Laravel Blueprint](https://tjventurini.github.io/laravel-blueprint/).

## API Structure data

The API is structured in a simple manner.
You can find a small documentation of all the available queries and mutations in the [Entities](./doc/Entities.md) section


## Getting Started

**Clone Repo:**

To get started, just clone this repo:

```bash
git clone git@github.com:SimonErich/laravel-graphql-chat-api.git
```


**Rename env files:**

Copy and rename the .env files for configuration

```bash
cp .env.example .env
cp .env.docker.example .env.docker
```


**Start up containers:**

And then run the `make init` command to spin up the docker containers.
(you need docker and docker-compose installed and working on your device)

```bash
make init
```


**Start up websocket server:**

Either ssh into your server or into the worker docker container and call the following artisan command:
```bash
php artisan websockets:serve
```
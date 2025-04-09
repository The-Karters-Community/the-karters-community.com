# the-karters-community.com

## Requirements

You need to install [Docker](https://www.docker.com/) in order to be able to locally run the project.
No other tool or utility is needed.

## Usage

### Build containers

If you already did what I am going to say once, then you can skip this section.

The very first step is to build all Docker containers needed by the project.
Each container will run a different process:

- Apache 2.4
- PHP 8.3
- MySQL 8

For that, execute the following command:

```shell
docker compose build
```

### Start and stop containers

Now that containers have been built, it is time to run them.
Simply run this command:

```shell
docker compose up -d --remove-orphans
```

Then, the project should be available at https://localhost:8000/.

You can stop all containers by using:

```shell
docker compose down
```

### Access to PHP CLI

First, you need to retrieve the name of your Docker PHP image.
You can display the whole list of images with:

```shell
docker ps
```

A table should appear as a result, the interesting one should end with `-php-1` in the column "_NAMES_".
In this example, let's say this is `the-karters-community-php-1`.

Now, you just have to run this instruction to access the CLI:

```shell
docker exec -ti the-karters-community-php-1 sh
```

Do not forget to run `exit` to leave the CLI.

## Development

### First start-up

After having built Docker container, you need to download all libraries used by the project.

In the CLI, run the following commands:

```shell
composer install
npm install
```

### Frontend

The project is powered by Vite for building frontend assets. Vite included a hot reload feature: it will watch for file
updates and will then automatically rebuild assets. You need to start it from the CLI:

```shell
npm run dev
```
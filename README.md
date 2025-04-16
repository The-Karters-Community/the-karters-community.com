# the-karters-community.com

## Installation

### Docker

You need to install [Docker](https://www.docker.com/) in order to be able to locally run the project.
No other tool or utility is needed.

### Windows configuration

_If you are not on Windows, please skip this whole section._

You will meet issues with page loading time (between 30 seconds and 1 minute) caused by the
hard drive operations being slow between Windows and Docker, passing through
[WSL](https://fr.wikipedia.org/wiki/Windows_Subsystem_for_Linux).

To fix this, you need to use WSL2 and to transfer all files into Linux, then editing the project directly there.

#### Installing Ubuntu

Open the **Microsoft Store** then download and install **Ubuntu 20.04.6 LTS**.

Execute `wsl --set-default Ubuntu-20.04` to use this distribution by default.

#### Checking WSL version

Open a shell and run `wsl -v` to know about your current WSL version. If it is not WSL2, then you must upgrade it.
For this, execute `wsl --set-version Ubuntu-20.04 2`.

More information [here](https://learn.microsoft.com/windows/wsl/install#upgrade-version-from-wsl-1-to-wsl-2).

#### Checking Docker configuration

In Docker, go to **Settings > General** and verify that the **Use the WSL 2 based engine** option is enabled.

Then in **Settings > Resources > WSL Integration**, turn on your previously installed distribution ; if you follow the
previous step, then it should be **Ubuntu-20.04**.

Finish this step by clicking **Apply & restart**.

If all is good, you can access your distro CLI by running `wsl` in Windows CLI, and `docker -v` should correctly display Docker
version.

#### Cloning project inside Ubuntu

On WSL/Ubuntu, Git might meet push & pull-related issues, so let's fix them. On Windows, create a new `wslconfig` file
in `C:/Users/<your-name>` with this content:

```ini
# Settings apply across all Linux distros running on WSL 2
[wsl2]

networkingMode = mirrored
```

And apply updates:

- `wsl --shutdown Ubuntu-20.04`
- Restart Docker
- `wsl` to start distro again

Then in Ubuntu CLI, clone the project: `git clone https://github.com/The-Karters-Community/the-karters-community.com.git`.
Do not forget to switch to `develop` branch and to pull commits.

#### Opening the project with your favorite IDE.

- [How to open the project with PHPStorm](https://www.jetbrains.com/help/phpstorm/how-to-use-wsl-development-environment-in-product.html#open-a-project-in-wsl)
- [How to open the project with VSCode](https://code.visualstudio.com/docs/remote/wsl#_open-a-remote-folder-or-workspace)

If I didn't forget anything, then we are good to go to the next section!

### Building Docker images

The very first step is to build all Docker containers needed by the project.
Each container will run a different process:

- Apache 2.4
- PHP 8.3
- MySQL 8

For that, execute the following command:

```shell
docker compose build
```

### Installing composer and npm packages

Now that containers have been built, it is time to run them.
Simply run this command:

```shell
docker compose up -d --remove-orphans
```

Then, the project should be available at http://localhost:8000/.

Time to install all packages now, but for this, you need to access Docker CLI (yes another one lol).

First, you need to retrieve the name of your Docker PHP image.
You can display the whole list of images with:

```shell
docker ps
```

A table should appear as a result, the interesting one should end with `-php-1` in the column "_NAMES_".
In this example, let's say this is `the-karters-communitycom-php-1`.

Now, you just have to run this instruction to access the CLI:

```shell
docker exec -ti the-karters-communitycom-php-1 sh
```

Do not forget you can leave the CLI with `exit`.

For installing packages, in the CLI, run the following commands:

```shell
composer install
npm install
```

## Usage

### Starting containers

```shell
docker compose up -d --remove-orphans
```

### Stopping containers

```shell
docker compose down
```

### URL

http://localhost:8000/

### Accessing Docker CLI

```shell
docker exec -ti XXX-php-1 sh
```

`XXX-php-1` can be found with `docker ps`.

### Building assets

The project is powered by Vite for building frontend assets. Vite included a hot reload feature: it will watch for file
updates and will then automatically rebuild assets. You need to start it from the Docker CLI:

```shell
npm run dev
```

## Development process

The project has two important branches: `main` and `develop`.

Later when the preproduction environment will be ready, the `main` branch will be deployed there.

On locale environments, we use the `develop` branch. This branch should ideally contain only working code and features.

When working on a specific feature, please create a new branch based on `develop` named `feature/<your-feature>`.
Create merge requests through command lines or directly with GitHub interface, I will check your commits and will merge
them on `develop`. I might write some comments when I think it could be improved, or just to discuss a part of the
code. :)
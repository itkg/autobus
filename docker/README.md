# Installation with Docker

## Requirements

You will need :
  - [Docker](https://docs.docker.com/engine/installation/)
  - [Docker-Compose](https://docs.docker.com/compose/install/)

## Get started

### Copy dist file
```bash
$ cp docker-compose.override.yml.dist docker-compose.override.yml
```

### Get the containers ready

```bash
$ docker-compose up
```

### Log into the main container

The following command allows you to log into the `autobus_php_1`
container.

```bash
$ docker exec -it autobus_php_1 bash
```

### Install the vendors with composer
```bash
# This command must be run from inside the container
$ composer install
```

### Allow to access the website from outside the container

The following command will associates the local IP address with the hostname.
```bash
# This command must be run from outside the container
$ echo '127.0.0.1 autobus.localhost www.autobus.localhost' | sudo tee --append /etc/hosts
```

You can now open [autobus.localhost](http://autobus.localhost) in your web browser.


### Stop the containers

When you are done working on the project you can stop the containers by running the following command.

```bash
$ docker-compose stop
```

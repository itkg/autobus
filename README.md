# Autobus - PHP service BUS

![Autobus Logo](https://raw.githubusercontent.com/autobus-php/autobus/master/autobus-logo.png)

## Install

```
composer create-project autobus-php/autobus --stability dev

# If needed, you may customize Docker Compose config
cp docker-compose.override.yml.dist docker-compose.override.yml

docker-compose up

docker-compose exec php bin/console d:s:u --force

# Load sample data
docker-compose exec php bin/console doctrine:fixtures:load
```

## Running async jobs

### Queue jobs

**TODO**

### Cron jobs

Add the following line to your crontab:

```
* * * * * php bin/console autobus:cron:run
```

## Create a job

To create a new job:

* Create it's class, implementing `Autobus\Bundle\BusBundle\Runner\RunnerInterface` ; it may extend `Autobus\Bundle\BusBundle\Runner\AbstractRunner`
* Declare it as a service in your bundle's `services.yml`, with tag `bus.runner`
* Create an instance from the web UI

## Requirements

* PHP 7+


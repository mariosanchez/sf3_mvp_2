# Symfony 3 MVP + Service layer
MPWAR Frameworks Symfony 3 MVP Example: 

## Disclaimer
This is only an example to practice and learn about clean and layered architectures using Symfony as a entry point.

All this project is *overengineering*. 

## Initialize

You can use a docker environment I've customized and used myself to run this project:

https://github.com/mariosanchez/docker-symfony

In other case you will need an http server (apache2 or nginx) and PHP 7.1 with the document root 
referencing `app/web` folder.

You also will need a mysql server properly configured in `app/app/config/parameters.yml`.

When you have all the environment ready and working run:

```
composer install
```

You also want to have the database schema, so run this in `app`:

```
php bin/console doctrine:schema:generate
```

If you prefer you can run the SQL files in `database` folder, also you have available demo data migrations you can run if you want.

## MPV Functionalities
This is a basic example of a beer review platform. 
You can CRUD beers and review them.

Every time you create a new review of a beer it log this event into dev/prod log.

## Service Layer
We have isolated Symfony from the business logic uncoupling it from the framework. 

Let's imagine that BeerScore is now a promising long term application with lots of investment and it needs to be very maintainable and very testable application as well as needs to be prepared for high changeability.

In this case we are trying to implement an example of ports and adapters (aka hexagonal) architecture for the BeerBundle (just as an example). 
The main goal of this kind of architectures is, in very huge applications, reach high maintainability and high testability.
As you can see, the logic is outside the framework folder structure, remaining it as a entry point. In our BeerBundle now we only have a very simple file structure:

```
    ├── CompilerPass
    ├── Controller
    └── Resources
```

And a more complex folder structure outside in the `src` folder:

```
└── Beer
    ├── Application
    │   └── Service
    ├── Domain
    │   └── Modelp
    └── Infrastructure
        ├── DependencyInjection
        └── Persistance
            └── Repository
                └── Doctrine
```

This structure follow some good practices seen in other example projects of hexagonal architectures, but it's only a 
suggestion and may not fit your project needs.

## Work we could do from here
* Implement CQRS (Commands & Queries + handlers)
* Implement domain events
* Separate our own models from the Doctrine ones
* Implement value objects
* Implement DTO and DataTransformers/Serializers
* Separate an API from rendering controllers in different bundles o microservices
* And much, much more...

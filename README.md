# Symfony 3 MVP + Service layer
MPWAR Frameworks Symfony 3 MVP Example: 

## Disclaimer
This is only an example to practice and learn about clean and layered architectures using Symfony as a entry point.

All this project is *overengineering*. 

## Initialize
```
composer install
```

## MPV Functionalities
This is a basic example of a beer review platform. 
You can CRUD beers and review them.

Every time you create a new review of a beer it log this event into dev/prod log.

## Service Layer
We will try to isolate Symfony from the business logic uncoupling it from the framework. 

Let's imagine that BeerScore is now a promising long term application with lots of investment and it needs to be very maintainable and very testable application as well as needs to be prepared for high changeability.

In this case we are trying to implement an example of ports and adapters (aka hexagonal) architecture for the BeerBundle (just as an example). 
The main goal of this kind of architectures is, in very huge applications, reach high maintainability and high testability.


## Work we could do from here
* Implement CQRS (Commands & Queries + handlers)
* Implement domain events
* Separate our own models from the Doctrine ones
* Implement value objects
* Implement DTO and DataTransformers/Serializers
* Separate an API from rendering controllers in different bundles o microservices
* And much, much more...

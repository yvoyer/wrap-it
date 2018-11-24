# wrap-it
Standard language syntax to generate DDD objects in php

## Aggregate

An aggregate is responsible of dispatching changes to its encapsulated entities. He has the responsibility of
dispatching events when a change occurs. The aggregates are the objects fetched
by repositories with which command handlers work to trigger a change.

### Syntax

```
// MyAggregate.wrap

aggregate MyAggregate
{
}
```

will generate

```php
final class MyAggregate
{
    // ...
}
```

By default, the system will generate all `__construct()` as private, and provide a `fromEmpty()` static method.

## Entity

An entity is encapsulated in an Aggregate, and should not be know to the outside world. As the aggregate,
its state might change through its lifecycle. The aggregate is responsible of calling the entities methods.


## Value object

A value object can never be changed once created. He keep his invariant and allow state change, but always
return a new immutable value object when changing of state. Used by Entities and Aggregate.

Filter
=======================

Data filtering and pagination made easy.

The implementation is based on:

 * having adapters for Input filter format. Contains 2 default implementations (DataTables and Api)
 * formatters for the output format (DataTables, Api, Raw)
 * adapters for the underlying DB (Doctrine ORM)
 
Every aspect can be extended as you see fit either by replacing the implementation or implementing the interfaces.

## Creating your first filter

The bundle comes with 2 predefined input adapters:

* DataTables Adapter (`App\Filter\Adapter\DataTableAdapter`): for parsing requests from DataTables
* Api Adapter (`App\Filter\Adapter\ApiAdapter`): for Api requests

In order to get it working we need to do some setup first. 3 things are required:

* a filter definition
* a transformer 
* a repository service

Each filter definition implements ```App\Filter\Definition\FilterDefinitionInterface```, you can also use
```App\Filter\Definition\BaseFilterDefinition``` as a starting point. The base class expects 2 parameters:

* the repository service that implements `App\Filter\Repository\FilterableRepositoryInterface` there are 2 default implementations:

     * `App\Filter\Repository\DoctrineORMRepository`
     * `App\Filter\Repository\MongoRepository`
  
* the transformer that implements ```App\Filter\Transformer\TransformerInterface```, normally you should extend:

     * for Api ```App\Filter\Transformer\ApiAbstractTransformer```
     * for DataTables ```App\Filter\Transformer\AbstractTransformer```

Normally both the transformer and the Filter Definition should be registered as services inside the app.

After that inside the controller it is as simple as:

```php
use App\Filter\Adapter\DataTableAdapter;
use App\Filter\Definition\UserDefinition;
...
        return new JsonResponse(
            $this
                ->get(DataTableAdapter::class)
                ->process($this->get(UserDefinition::class), $request)
        );
...
```

**Hint:** you can inject your services as method parameters instead of getting them from the Controller.

Please check the following files for examples:

[Definition example](doc/example_definition.md)

[Transformer example](doc/example_transformers.md)

## License

This package is available under the [MIT license](LICENSE).

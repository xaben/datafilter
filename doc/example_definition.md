## Example Filter Definitions

Please note: all filters are DB aware, so don't mix Doctrine and Mongo filters in same definition.

```php
namespace AppBundle\Filter\Definition;

use App\Filter\DataType\StringDataType;
use App\Filter\Definition\BaseFilterDefinition;
use App\Filter\Definition\FilterDefinitionInterface;
use App\Filter\Filter\FilterConfiguration;
use App\Filter\Filter\Mongo\ExactFilter;
use App\Filter\Pagination\PaginationConfiguration;
use App\Filter\Sort\SortConfiguration;
use App\Filter\Sort\SortDefinition;

class UserFilterDefinition extends BaseFilterDefinition implements FilterDefinitionInterface
{
public function getPaginationConfiguration(): ?PaginationConfiguration
{
    {
        return new PaginationConfiguration(25, 100);
    }

    public function getFilterConfiguration(): FilterConfiguration
    {
        return new FilterConfiguration([
            new ExactFilter('first_name', StringDataType::class, 'a.first_name', ['index' => 1]),
            new ExactFilter('last_name', StringDataType::class, 'a.last_name', ['index' => 2]),
            new ExactFilter('email', StringDataType::class, 'a.email', ['index' => 3]),
        ]);
    }

    public function getSortConfiguration(): SortConfiguration
    {
        return new SortConfiguration([
            new SortDefinition('first_name', 'a.first_name', 1, SortDefinition::SORT_ASC),
        ]);
    }

    public function getDefaultFilterConfiguration(Request $request): FilterConfiguration
    {
        return new FilterConfiguration([
            new ExactFilter('first_name', StringDataType::class, 'a.first_name', ['index' => 1], 'Bob'),
        ]);
    }

    public function getPredefinedFilterConfiguration(Request $request): FilterConfiguration
    {
        return new FilterConfiguration([
            new ExactFilter('email', StringDataType::class, 'a.email', ['index' => 3], 'bob@test.com'),
        ]);
    }
}
```

Register your definition as a service:

```yml
  AppBundle\Filter\Definition\UserFilterDefinition:
    class: AppBundle\Filter\Definition\UserFilterDefinition
    arguments:
      - '@App\Repository\UserRepository'
      - '@App\Transformer\UserTransformer'
```

Or for Symfony 4.0, even with auto wiring, you need to type hint which services you want

```yml
  AppBundle\Filter\Definition\UserFilterDefinition:
    class: AppBundle\Filter\Definition\UserFilterDefinition
    arguments:
      $repository: '@App\Repository\UserRepository'
      $transformer: '@App\Transformer\UserTransformer'
```

#### Doctrine ORM
Implement `App\Filter\Definition\DoctrineORMFilterDefinitionInterface` , requires `getQueryBuilder`
method in addition to the standard fields from the `FilterDefinitionInterface`.

A sample of this method:

```php
    public function getQueryBuilder(EntityRepository $repository) : QueryBuilder
    {
        $qb = $repository
            ->createQueryBuilder('user')
            ->select('user')
            ->where('1 = 1');

        return $qb;
    }
```

Please note `1 = 1` is required as all filter conditions are added as `andWhere` clauses.

## Example Transformers

Transformers are registered as a service in order to be injected inside the Filter Definition. 
You can use any extra dependencies in your constructor.

```yml
  AppBundle\Filter\Transformer\UserTransformer:
    class: AppBundle\Filter\Transformer\UserTransformer
```

Hint: you can use **auto wiring** and automatically register all your transformers as service.


```php
namespace App\Filter\Transformers;

use App\Model\User;
use Xaben\DataFilter\Transformer\Transformer;

class UserTransformer extends Transformer
{
    /**
     * @param User $data
     */
    public function transform(mixed $data): array
    {
        return [
            'id' => $data->getId(),
            'firstName' => $data->getFirstName(),
            'lastName' => $data->getLastName(),
        ];
    }
}
```

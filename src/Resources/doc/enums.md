Enums
============

---
Enums are recommended if you need to manipulate some state of entity. 
All enum objects must implement [EnumInterface](https://github.com/anzusystems/contracts/blob/main/src/Model/Enum/EnumInterface.php)
and use [BaseEnumTrait](https://github.com/anzusystems/contracts/blob/main/src/Model/Enum/BaseEnumTrait.php).
Then you should override one constant:
```php
public const Default = '';
```

Here is the example of implementation for user state:

### 1. Create a Enum

`App\Model\Enum\UserState`:

```php
<?php

declare(strict_types=1);

namespace App\Model\Enum;

use AnzuSystems\Contracts\Model\Enum\BaseEnumTrait;
use AnzuSystems\Contracts\Model\Enum\EnumInterface;

enum UserState: string implements EnumInterface
{
    use BaseEnumTrait;

    case Active = 'active';
    case GdprDeleted = 'gdpr_deleted';
    
    public const Default = self::Active;
}
```

### 2. Use the Enum in your entity

`App\Entity\User`:
```php
<?php

declare(strict_types=1);

namespace App\Entity;

use AnzuSystems\Contracts\Entity\AnzuUser;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User extends AnzuUser
{
    #[ORM\Column(enumType: UserState::class)]
    private UserState $state;
}
```

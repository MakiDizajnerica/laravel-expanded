# Laravel Expanded

Collection of Laravel helpers.

## Installation

```bash
composer require makidizajnerica/laravel-expanded
```

## Usage

### Traits

#### `MakiDizajnerica\Expanded\Concerns\Models\Collectionable`
___

Easily define model collection without writing `newCollection` method:

```php
<?php

namespace App\Models;

use App\Collections\UserCollection;
use Illuminate\Database\Eloquent\Model;
use MakiDizajnerica\Expanded\Concerns\Models\Collectionable;

class User extends Model
{
    use Collectionable;

    /** 
     * @var class-string
     */
    protected $collection = UserCollection::class;

    // ...
}
```

#### `MakiDizajnerica\Expanded\Concerns\Models\Routable`
___

Easily define model route key without writing `getRouteKeyName` method:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use MakiDizajnerica\Expanded\Concerns\Models\Routable;

class User extends Model
{
    use Routable;

    /** 
     * @var string
     */
    protected $routeKeyName = 'uuid';

    protected $fillable = [
        'uuid',
        'username',
        'email',
        // ...
    ];

    // ...
}
```

#### `MakiDizajnerica\Expanded\Concerns\EnumToArray`
___

Enum helper:

```php
<?php

namespace App\Enums;

use MakiDizajnerica\Expanded\Concerns\EnumToArray;

enum UserType: int
{
    use EnumToArray;

    case user = 1;
    case moderator = 2;
    case admin = 3;
}

// Get the names of the cases:
var_dump(UserType::names());

// array(3) {
//     [0]=> string(4) "user"
//     [1]=> string(9) "moderator"
//     [2]=> string(5) "admin"
// }

// Get the values of the cases:
var_dump(UserType::values());

// array(3) {
//     [0]=> int(1)
//     [1]=> int(2)
//     [2]=> int(3)
// }

// Get array representation of the enum:
var_dump(UserType::toArray());

// array(3) {
//     ["user"]=> int(1)
//     ["moderator"]=> int(2)
//     ["admin"]=> int(3)
// }
```

### Mixins

#### `MakiDizajnerica\Expanded\Mixins\ArrMixin`
___

Register `MakiDizajnerica\Expanded\Mixins\ArrMixin` inside `boot` method of the `App\Providers\AppServiceProvider`:

```php
<?php

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use MakiDizajnerica\Expanded\Mixins\ArrMixin;

class AppServiceProvider extends ServiceProvider
{
    // ...

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Arr::mixin(new ArrMixin);
    }

    // ...
}
```

Now you have some methods available:

@Todo

#### `MakiDizajnerica\Expanded\Mixins\StrMixin`
___

Register `MakiDizajnerica\Expanded\Mixins\StrMixin` inside `boot` method of the `App\Providers\AppServiceProvider`:

```php
<?php

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;
use MakiDizajnerica\Expanded\Mixins\StrMixin;

class AppServiceProvider extends ServiceProvider
{
    // ...

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Str::mixin(new StrMixin);
    }

    // ...
}
```

Now you have some methods available:

##### username

Convert email to username using `username` method:

```php
<?php

use Illuminate\Support\Str;

$username = Str::username('random-user-123@mail.com');

var_dump($username);

// string(10) "randomuser123"
```

## Author

**Nemanja Marijanovic** (<n.marijanovic@hotmail.com>) 

## Licence

Copyright © 2021, Nemanja Marijanovic <n.marijanovic@hotmail.com>

All rights reserved.

For the full copyright and license information, please view the LICENSE 
file that was distributed within the source root of this package.

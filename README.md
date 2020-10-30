## Eloquent Search Examples
Small examples
Let's start with a basic scenario, A tenant has N users, each user has a config and a profile:

<img src="https://cdn-images-1.medium.com/max/800/1*zNjfZa4fhnL2oEd01BQJ2Q.png">

#### Query 1:

Bring all users wich have:
- user column is_active in config relationship equals true
- user column address in profile relationship contains "Foo"
- user column tenant_id equals 1

Pure Eloquent:

```php
User::where('tenant_id', 1)
->whereHas('profile', function($q) {
    $q->whereRaw('address LIKE %Foo%')
})
->whereHas('config', function($q) {
    $q->where('is_active', true);
});
```

Eloquent Search:

```php
User::search('profile.address', 'contains', "Foo")-search('config.is_active', true)->search('tenant_id', 1)
```

##### Query 2

Bring a list of user pictures, from a specific tenant, following the conditions:
- user column is_active in config equals false
- user column created_at must be greater than equal 2000–01–01 or null
- Picture is a column in profile table,

Pure Eloquent:

```php
Profile::whereHas('config', function($q) {
   $q->where('is_active', true);
})->where(function($q){
   $q->where('created_at', '>=', '2000-01-01')
   ->orWhere('created_at', null);
})->pluck('picture')->toArray();
```

Eloquent Search

```php
Profile::search('config.is_active', false)
->searchBlock([
   ['created_at', 'lte', '2000-01-01', 'or'],
   ['created_at', null]
])
->pluck('picture')->toArray()
```

##### Query 3

Search all profiles wich: 
- Columns address, street and number contains at least one word of this sentence "Lorem Ipsum Ignolis"

Eloquent Search:

```php
In profile Model:
class Profile extends Model
{
    $searchable = ['address', 'street', 'number']
}
...
Profile::searchText('Lorem Ipsum Ignolis')->get();
```

##### Query 4

Search users with ID greater than 100
- Exclude users with ID is between 200 and 300
- Exclude users with status_id is in [1,4,6]

```php
User::search('id', 'gt', 100)
->searchBlock([
   ['id', 'not_gt', 200' 'and'],
   ['id', 'not_lt', 300]
])->search('status_id', 'not_in', [1,4,6]);
```

##### Query 5

Bring all users wich profile.cash_amount is different from zero OR users with column is_superadmin equals true
Pure Eloquent:

```php
User::where(function($q){
   $q1->whereHas('profile', function($q1) {
      $q1->where('cash_amount', '!=', 200);
   })->orWhere('is_superadmin, true);
});
```

Eloquent Search

```php
User::search('profile.cash_amount', 'not_exact', 0)->orSearch('is_superadmin', true)
```

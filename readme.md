

## Laracrud for Laravel Framework

Laracrud is a scalfolding CRUD generator for Laravel Framework.
Dont Repeat Yourself with the thing you always do , just generate it.

##Installation

You can install this package via composer using this command:

```
	composer require pyaesone17/laracrud:dev-master	
```

## Documentation

My packages is fully depends on laravel eloquent model .
So you have to create Model first and include attributes in fillable array.

```php

<? php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
 	protected $fillable=['father','mother'];   

 	public $textareas=['hi','hay'];

}

?>

	
```

Dont Forget to register Service Provider Like this in config/app.php


```
    'providers' => [
    	............................................,
    	Veve\Laracrud\LaracrudServiceProvider::class,
    ]

```



Then you can easily create my generator like this

```
	php artisan crud:create Candidate

```

It will generate (Route,Controller,Repositories,Migration Files,CRUD view)

1. resourceful route 
2. resourceful controller (**CandidateController** inside the Http/Controllers)
3. Base Repository and ChildRepository (**BaseRepository** and **CandidateRepository** in **Repositories** folder)
4. Migration file (**create_candidates_table** in migration folder)
5. CRUD template in views folder (**crud_candidate** view is located inside the **views** folder)

But you have to define **master.blade.php** and include **bootstrap framework** in your master view to work well with my CRUD template.

##Tips

1. In generating , you will be asked whether to generate repo or not.
2. If you chose yes, it will create repo and controller that match the repo, 
3. Otherwise it will create simple controller that use Model directly.


##Todos
1. creating migration file with many fields
2. creating more methods in Base Repo
3. So Many Things




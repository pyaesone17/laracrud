

## Laracrud for Laravel Framework

Laracrud is a scalfolding CRUD generator for Laravel Framework.
Dont Repeat Yourself with the thing you always do , just generate it.

## Documentation

It fully depends on your model.
So create Model first and include your attributes in fillable array.

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

Dont Forget to register Service Provider Like this in config/app.php

```
    'providers' => [
    	............................................,
    	Veve\Laracrud\LaracrudServiceProvider::class,
    ]

```

	
```

Then you can easily create my generator like this

```
	php artisan crud:create Candidate

```

It will generate 
1. resourceful route 
2. resourceful controller (CandidateController)
3. Base Repository and ChildRepository (BaseRepository and CandidateRepository in Repositories folder)
4. Migration file (create_candidates_table in migration folder)
5. CRUD template in views folder (crud view in crud_candidate folder inside the views folder)

##Tips

In generating , you will be asked whether to generate repo or not.
If you chose yes, it will create repo and controller that match the repo, 
Otherwise it will create simple controller that use Model directly.

##Todos
1. creating migration file with many fields
2. creating more methods in Base Repo
3. So Many Things




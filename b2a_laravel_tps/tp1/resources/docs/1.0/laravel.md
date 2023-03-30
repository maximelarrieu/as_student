# PHP Framework : Laravel

<p><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>
---

- [Installation](/{{route}}/{{version}}/laravel/#section-1)
- [Développement](/{{route}}/{{version}}/laravel/#section-2)

<a name="section-1"></a>
## Installation
Tout d'abord, avant d'utiliser Laravel. Il faut savoir que le framework utilise `Composer` pour gérer ses dépendances.
Installons-le :
```shell
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

Dès lors, il nous ait possible d'installer `Laravel` grâce à ce nouvel installateur :
```shell
composer global require laravel/installer
```

Désormais nous pouvons créer un projet :
```shell
composer create-project --prefer-dist laravel/laravel tp1
```

Si un serveur de développement local est installé sur notre machine, nous pouvous utiliser une commande `php artisan`, qui créera un serveur local pour notre application :
```shell
php artisan serv
```

Si l'on veut utiliser une base de données créée en local, il nous faudra modifier quelques lignes de notre fichier `.env` :
```shell
DB_DATABASE=tplaravel
DB_USERNAME=root
DB_PASSWORD=***
```

Les bases du projet sont en place, nous pouvons passer au développement.

<a name="section-2"></a>
## Développement
### Prise en main
Pour prendre en main le framework, nous pouvons tout d'abord créer les premieres pages.
Nous créerons
* des routes (dans le fichier `/routes/web.php` :
```php
Route::get('/', function () {
    return view('welcome');
});
```
Cette route représente la route principale menant vers la page d'accueil.

* des controllers (qui se trouverons dans `app/Http/Controllers/`) :
```shell
php artisan make:controller TestController
```
Dans lequel nous pouvons créer une fonction qui renverra une vue.
```php
function index() {
        return view('test');
    }
```

* des vues (que l'on créée dans `/resources/views`) :
```php
<div class="content">
    <div class="title m-b-md">
        Test
    </div>
```
La vue créée renvoie le même résultat que la page principale Laravel avec pour titre 'Test'.
Ainsi dans nos routes, nous pouvons appeler notre nouveau controller avec sa fonction pour renvoyer cette page :
```php
Route::get('/test', 'TestController@index');
```

### Système d'authentification
Laravel fournit un moyen rapide de configurer tous les itinéraires relatant de l'authentification.
En deux ligne de commande, le système sera mis en place, avec un login/logout/register :
```shell script
composer require laravel/ui --dev
php artisan ui-vue --auth
```
Nous allons maintenant, grâce à un seeder, remplir notre base de données de 100 utilisateurs.
```shell script
php artisan make:seeder UsersTableseeder
```
Dans lequel nous initierons une factory pour créer les users :
```php
public function run()
{
    factory(App\User::class, 100)->create();
}
```
Nous pouvons maintenant constaté que la table `users` a bien été créée et il est maintenant possible de se connecter avec l'adresse mail d'un de nos users.
 
### Ajout de rôles
Pour assigner des rôles à nos users, il faut d'abord installer la librairie `Spatie/permission` :
```shell script
composer require spatie/laravel-permission
```
### Seeder des users avec des rôles
Ensuite, on doit modifier notre modèle `User` ;
```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles;

    // ...
}
```

Il nous faut maintenant créer un seeder qui va créer 3 rôles différents :
```php
// RolesTableSeeder.php

public function run()
{
    $role = Role::create(['name' => 'admin']);
    $role = Role::create(['name' => 'reader']);
    $role = Role::create(['name' => 'writer']);
}
```

Maintenant que les rôles sont crées, nous pouvons modifier notre `UsersTableSeeder` afin d'assigner ces rôles à nos users :
```php
factory(App\User::class, 10)->create()->each(function ($user) {
    $user->assignRole('admin');
});
factory(App\User::class, 40)->create()->each(function ($user) {
    $user->assignRole('writer');
});
factory(App\User::class, 50)->create()->each(function ($user) {
    $user->assignRole('reader');
});
```

Sans oublié de remplir notre `DatabaseSeeder` :
```php
public function run()
{
    $this->call(RolesTableSeeder::class);
    $this->call(UsersTableSeeder::class);
}
```

On peut maintenant faire un migrate :
`php artisan migrate`

Dans notre base de données, plusieurs tables sont apparues, notamment `roles` qui contient les trois rôles que nous avons définis et `model_has_roles` où l'on voit l'ID users rattaché à l'ID roles.

### Utiliser les Middleware
Tout d'abord, il nous faut créer 3 controllers portant le nom de nos trois rôles :
 ```shell script
php artisan make:controller AdminController
php artisan make:controller WriterController
php artisan make:controller ReaderController
```
Chaque Controller possède une fonction `index` qui renvoit leurs vues respectives, que l'on va créer plus bas :
```php
public function index() {
    return view('admin');
}
```
Nous créons aussi 3 vues correspondant aux rôles, chaque controller retournera sa vue.

*J'ai utilisé la même méthode que précédemment, en donnant pour titre de page, le rôle connecté.*

Enfin, il nous faut 3 routes permettant d'accèder à la vue du rôle auquel notre user correspond. Un rôle ne peut donc accèder qu'à une seule vue.

*Notion de Middleware*
```php
Route::group(['middleware' => ['role:admin']], function() {
    Route::get('/admin', 'AdminController@index');
});
Route::group(['middleware' => ['role:writer']], function() {
    Route::get('/writer', 'WriterController@index');
});
Route::group(['middleware' => ['role:reader']], function() {
    Route::get('/reader', 'ReaderController@index');
});
```

### Créer un Profile
Créons tout d'abord un model `Profile` avec un controller, une factory et une migration. Tout ceci peut être fait en une ligne de commande :
```shell script
php artisan make:model Profile -a
```
Où le `-a` créera le controller, factory, migration associés.

Pour qu'un user possède un profil et inversement, on établit une relation `One-to-One` entre les deux modèles :
```php
// App\User
public function profile() {
    return $this->hasOne('App\Profile');
}

// App\Profile
public function user() {
     return $this->belongsTo('App\User');
}
```
Les champs du profil se définissent dans sa factory et son controller :
```php
// database/factories/ProfileFactory.php
$factory->define(Profile::class, function (Faker $faker) {
    return [
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'age' => $faker->dateTime,
        'phone_number' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

// database/migration/..create_profiles_table
public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->dateTime('age');
            $table->string('phone_number');
            $table->string('address');
            $table->timestamps();
        });
    }
```

Pour que le Seeder mette un profil à un chaque user :
Enfin dans son seeder, nous pouvons créer des profils :
```php
public function run()
    {
        factory(App\Profile::class, 100)->create()->each(function ($user) {
            $user->profile;
        });
    }
```

On peut maintenant update la base de données :
```shell script
php artisan migrate:fresh --seed
```

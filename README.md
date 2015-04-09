# Permissions
An easy Laravel 5 permissions package.

## Installation via Composer
```
require : {
  "tadeas-j/permissions": "dev-master"
}
```

Next, what you need to do is to run.
```
composer update
```
Now, you have successfully installed the package.

Next required step is to add package's service provider to laravel application config, which is located in 'app/config/app.php'.
```
'Permissions' => 'Permissions\Providers\PermissionsProvider'
```
And lastly for configuring our permissions and roles we need to publish 'config.php' file to '/config/permissions/config.php'.
```
php artisan vendor:publish
```
## (Optional) Using package's facade
I highly recommend u to use package's prepared facade, only thing, what you need to do, is to register it in 'app/config/app.php'.
```
'Permissions' => 'Permissions\Facades\Permissions'
```

## (Important) Configuration
Configuration file should be published to '/config/permissions/config.php'.
If you missed it, you can do it easilly with calling this command.
```
php artisan vendor:publish
```
At first, you need to put 'role' column to your users table.
Default 'config.php' file looks like this.
```
$aliases = array(
	'manage' => ['create', 'delete', 'edit']
);

$roles = array(
	'admin' => [
		'manage.users',
	]
);
```
This means, that role 'admin' is allowed to manage.users, 'manage' is alias to 'create', 'delete' and 'edit'.
So it is the same like this.
```
$aliases = array();

$roles = array(
	'admin' => [
		'create.users',
		'delete.users',
		'edit.users',
	]
);
```
## Using package
So let's think about, that we have got one user with role 'admin', 'admin' role is allowed for 'create.users', and the code below is exactly, what we need to do in our creating proccess.
```
Permissions::can('create.users');
```
This will get our logged user, his permissions and then it will check them.
If we want to check permissions of user with ID 1 for example, we will just easilly do this.
```
Permissions::can('create.users', User::find(1));
```
There is also a trait, what you can use.
```
Permissions\PermissionsTrait
```
After using this trait in your user model, you will be allowed to do something like this.
```
Auth::user()->can('create.users');
```




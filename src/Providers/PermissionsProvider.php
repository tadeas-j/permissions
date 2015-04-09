<?php

namespace Permissions\Providers;

use Illuminate\Support\ServiceProvider;

class PermissionsProvider extends ServiceProvider
{

	public function boot(){
		$this->publishes([
    		__DIR__ .'/../config/config.php' => config_path('permissions/config.php'),
		]);
	}

	public function register(){
		$this->app->singleton('permissions', function($app){
			$permissions = new \Permissions\Permissions;

			$fn = config('permissions.config.initialize');

			if($fn){
				$fn($permissions);
			}

			return $permissions;
		});
	}

}

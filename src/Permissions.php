<?php

namespace Permissions;

use Auth;
use App;

class Permissions
{

	private $aliases = array();
	private $roles = array();

	public function __construct(){}

	public function getAliases(){
		return $this->aliases;
	}

	public function getRoles(){
		return $this->roles;
	}

	public function setAliases($aliases = array()){
		$this->aliases = $aliases;
	}

	public function setRoles($roles = array()){
		$this->roles = $roles;
	}

	public function getUserPermissions($user = null){
		$user = ($user instanceof \App\User) ? $user : Auth::user();

		if(empty($user->role) or empty($this->roles[$user->role])){
			return false;
		}

		return $this->roles[$user->role];
	}

	public function can($perm = null, $user = null){
		$user = ($user instanceof \App\User) ? $user : Auth::user();
		$permissions = $this->getUserPermissions($user);

		if(empty($permissions)){
			return false;
		}
		
		if(in_array($perm, $permissions)){
			return true;
		}
		if(in_array('all', $permissions)){
			return true;
		}

		foreach($permissions as $value){
			$explode = explode('.', $value);
			$alias = $explode[0];
			$model = $explode[1];

			if(!empty($this->aliases[$alias])){
				foreach($this->aliases[$alias] as $value){
					$permissions[] = $value . "." . $model;
				}
			}

		}

		if(in_array($perm, $permissions)){
			return true;
		}

		$explode = explode('.', $perm);

		$alias = $explode[0];
		$model = $explode[1];

		if(!empty($this->aliases[$alias])){
			$found = true;

			foreach($this->aliases[$alias] as $value){
				if(!in_array($value . "." . $model, $permissions)){
					$found = false;
				}
			}

			return $found;
		}

		return false;


	}

}

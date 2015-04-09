<?php

namespace Permissions;

use App\User;

trait PermissionsTrait
{

	function can($perm = ''){
		return \Permissions::can($perm, User::find($this->attributes["id"]));
	}

}

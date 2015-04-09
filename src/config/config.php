<?php
return array(
	'initialize' => function($permissions) {

		$aliases = array(
			'manage' => ['create', 'delete', 'edit']
		);

		$roles = array(
			'admin' => [
				'manage.users',
			]
		);

        $permissions->setAliases($aliases);
        $permissions->setRoles($roles);
    }
);

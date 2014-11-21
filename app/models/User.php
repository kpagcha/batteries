<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function roles() {
    	return $this->belongsToMany('Role', 'users_roles');
    }

    public function getRoles() {
        return $this->roles->toArray();
    }

    public function hasRole($role) {
        return in_array($role, array_fetch($this->roles->toArray(), 'name'));
    }

    private function getIdInArray($array, $term) {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key + 1;
            }
        }
        throw new UnexpectedValueException;
    }

    public function setRole($role) {
    	$assigned_roles = [];

    	$roles = array_fetch(Role::all()->toArray(), 'name');

    	switch ($role) {
    		case 'administrator':
    			$assigned_roles = $this->getIdInArray($roles, 'administrator');
    			break;
    		case 'account_manager':
    			$assgined_roles = $this->getIdInArray($roles, 'account_manager');
    			break;
    		case 'customer':
    			$assigned_roles = $this->getIdInArray($roles, 'customer');
    			break;
    		default:
    			throw new \Exception("The role '" . $role . "' does not exist");
    	}

        $this->roles()->attach($assigned_roles);
    }
}

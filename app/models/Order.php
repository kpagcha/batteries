<?php
 
class Order extends Eloquent {
 
    public function accountManager() {
        return $this->belongsTo('User', 'account_manager_id');
    }

    public function negotiations() {
        return $this->hasMany('Negotiation');
    }

    public function customer() {
    	$cart_id = $this->negotiations[0]['cart_id'];
    	$cart = Cart::find($cart_id);
    	return User::find($cart['user_id']);
    }

    public function status() {
        return $this->hasOne('Status');
    }

    public function hasStatus($status) {
        return $assigned_status == $status;
    }

    private function getIdInArray($array, $term) {
        foreach ($array as $key => $value) {
            if ($value == $term) {
                return $key + 1;
            }
        }
        throw new UnexpectedValueException;
    }

    public function setStatus($status) {
        $statuses = array_fetch(Status::all()->toArray(), 'name');

        $assigned_status = null;

        switch ($status) {
            case 'open':
                $assigned_status = $this->getIdInArray($statuses, 'open');
                break;
            case 'in_process':
                $assigned_status = $this->getIdInArray($statuses, 'in_process');
                break;
            case 'completed':
                $assigned_status = $this->getIdInArray($statuses, 'completed');
                break;
            case 'rejected':
                $assigned_status = $this->getIdInArray($statuses, 'rejected');
                break;
            default:
                throw new \Exception("The status '" . $status . "' does not exist");
        }
        $this->status_id = $assigned_status;
    }
}
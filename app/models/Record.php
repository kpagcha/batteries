<?php
 
class Record extends Eloquent {

	
    public function battery() {
        return $this->belongsTo('Battery');
    }
 
    public function customer() {
        return $this->belongsTo('User', 'customer_id');
    }

    public function manager() {
    	return $this->belongsTo('User', 'manager_id');
    }

    public function order() {
        return $this->belongsTo('Order');
    }

    public function status() {
        return $this->belongsTo('Status');
    }
}
<?php
 
class Cart extends Eloquent {
 
    public function user() {
        return $this->belongsTo('User');
    }

    public function battery() {
        return $this->belongsTo('Battery');
    }
}
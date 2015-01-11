<?php
 
class Negotiation extends Eloquent {

    public function order() {
        return $this->belongsTo('Order');
    }

    public function customer() {
    	return $this->belongsTo('User');
    }

    public function manager() {
        return $this->belongsTo('User', 'manager_id');
    }

    public function battery() {
        return $this->belongsTo('Battery');
    }

    public function amount() {
        return $this->cart->amount;
    }

    public function status() {
        return $this->hasOne('Status');
    }

    public function hasStatus($status) {
        return Status::find($this->status_id)->name == Status::where('name', '=', $status)->first()->name;
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

    public static function getCustomerNegotiatingItems() {
        try {
            $rejected = Status::where('name', '=', 'rejected')->first()->id;
            $items = Negotiation::where('user_id', '=', Auth::user()->id)
                ->where('status_id', '!=', $rejected)
                ->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->id)->order->id,
                    'negotiation_id' => $item->id
                ]);
            }
            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function getUnattendedNegotiatingItems() {
        try {            
            $open = Status::where('name', '=', 'open')->first()->id;
            $items = Negotiation::where('status_id', '=', $open)->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->id)->order->id,
                    'negotiation_id' => $item->id
                ]);
            }

            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function getActiveNegotiatingItems() {
        try {
            $in_process = Status::where('name', '=', 'in_process')->first()->id;
            $items = Negotiation::where('status_id', '=', $in_process)
                                    ->where('manager_id', '=', Auth::user()->id)
                                    ->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->id)->order->id,
                    'negotiation_id' => $item->id
                ]);
            }
            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function customerCountActiveNegotiations($order_id) {
        $open = Status::where('name', '=', 'open')->first()->id;
        $count = Negotiation::where('order_id', '=', $order_id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('status_id', '=', $open)
                            ->count();

        $in_process = Status::where('name', '=', 'in_process')->first()->id;
        $count += Negotiation::where('order_id', '=', $order_id)
                            ->where('user_id', '=', Auth::user()->id)
                            ->where('status_id', '=', $in_process)
                            ->count();

        return $count;
    }
}
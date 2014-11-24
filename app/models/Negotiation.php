<?php
 
class Negotiation extends Eloquent {

    public function order() {
        return $this->belongsTo('Order');
    }

    public function customer() {
    	return $this->belongsTo('User');
    }

    public function battery() {
        return $this->belongsTo('Battery');
    }

    public function amount() {
        return $this->cart->amount;
    }

    public function status() {
        return $this->belongsToMany('Status', 'negotiations_statuses');
    }

    public function hasStatus($status) {
        return in_array($status, array_fetch($this->status->toArray(), 'name'));
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
            case 'negotiated':
                $assigned_status = $this->getIdInArray($statuses, 'negotiated');
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
        $this->status()->attach($assigned_status);
    }

    public static function getCustomerNegotiatingItems() {
        try {
            $items = DB::table('negotiations')
                        ->join('negotiations_statuses', 'negotiations.id', '=', 'negotiations_statuses.negotiation_id')
                        ->where('user_id', '=', Auth::user()->id)
                        ->where('status_id', '<', 4)
                        // ->whereRaw("status_id not in (select status_id from statuses where name='completed' or name='rejected'")
                        ->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->negotiation_id)->order->id,
                    'negotiation_id' => $item->negotiation_id
                ]);
            }
            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function getUnattendedNegotiatingItems() {
        try {
            $items = DB::table('negotiations')
                        ->join('negotiations_statuses', 'negotiations.id', '=', 'negotiations_statuses.negotiation_id')
                        ->where('status_id', '=', 1)
                        ->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->negotiation_id)->order->id,
                    'negotiation_id' => $item->negotiation_id
                ]);
            }

            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }

    public static function getActiveNegotiatingItems() {
        try {
            $items = DB::table('negotiations')
                        ->join('negotiations_statuses', 'negotiations.id', '=', 'negotiations_statuses.negotiation_id')
                        ->where('status_id', '=', 2)
                        ->where('manager_id', '=', Auth::user()->id)
                        ->get();

            $batteries = [];
            foreach ($items as $item) {
                array_push($batteries, [
                    'battery' => Battery::find($item->battery_id), 
                    'amount' => $item->amount,
                    'price' => $item->price,
                    'status' => Status::find($item->status_id),
                    'order_id' => Negotiation::find($item->negotiation_id)->order->id,
                    'negotiation_id' => $item->negotiation_id
                ]);
            }
            return $batteries;
        } catch(Exception $e) {
            error_log($e->getMessage());
        }
    }
}
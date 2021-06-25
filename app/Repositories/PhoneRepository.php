<?php

namespace App\Repositories;

use App\Models\Phone;

class PhoneRepository {

    protected  $phone;

    public function __construct(Phone $phone) {
        $this->phone = $phone;
    }

    public function create($data) {
        try {
            return $this->phone->create($data);
        } catch (\Exception $e){
            return new \Exception('Error saving phone.');
        }
    }


}


<?php

namespace App\Repositories;

use App\Models\Person;

class PersonRepository {

    protected  $person;

    public function __construct(Person $person) {
        $this->person = $person;
    }

    public function create($data) {
        try {
            if($this->person->find($data['id'])){
                return new \Exception("ID: {$data['id']} already exists");
            }
            return $this->person->create($data);
        } catch (\Exception $e){
            return new \Exception('Error saving person');
        }
    }
}


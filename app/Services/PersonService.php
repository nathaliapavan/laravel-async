<?php

namespace App\Services;

use App\Repositories\PersonRepository;
use App\Services\PhoneService;

class PersonService {

    protected $personRepository;
    protected $phoneService;

    public function __construct(PersonRepository $personRepository, PhoneService $phoneService) {
        $this->personRepository = $personRepository;
        $this->phoneService = $phoneService;
    }

    public function store($request) {

        $persons = [];
        foreach($request['person'] as $person){
            $persons[] = $this->personRepository->create($this->parseData($person));
            if($person['phones']){
                $persons[] = $this->phoneService->store($person);
            }
        }
        
        return $persons;
    }

    public function parseData($person){
        return [
            'id'   => $person['personid'],
            'name' => $person['personname'],
        ];
    }
}

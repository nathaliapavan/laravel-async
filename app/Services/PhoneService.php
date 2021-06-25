<?php

namespace App\Services;

use App\Repositories\PhoneRepository;

class PhoneService {

    protected $phoneRepository;

    public function __construct(PhoneRepository $phoneRepository) {
        $this->phoneRepository = $phoneRepository;
    }

    public function store($array) {

        $phones = [];
        if(is_array($array['phones']['phone'])){
            foreach($array['phones']['phone'] as $phone){
                $phones[] = $this->phoneRepository->create($this->parseData($array['personid'], $phone));
            }
        }

        if(!is_array($array['phones']['phone'])){
            $phones[] = $this->phoneRepository->create($this->parseData($array['personid'], $array['phones']['phone']));
        }

        return $phones;
    }

    public function parseData($id, $phone){
        return [
            'person_id' => $id,
            'phone'     => $phone,
        ];
    }
}

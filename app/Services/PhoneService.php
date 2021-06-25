<?php

namespace App\Services;

use App\Repositories\PhoneRepository;

class PhoneService {

    protected $phoneRepository;

    public function __construct(PhoneRepository $phoneRepository) {
        $this->phoneRepository = $phoneRepository;
    }

    public function store($data) {

        $phones = [];
        if(is_array($data['phones']['phone'])){
            foreach($data['phones']['phone'] as $phone){
                $phones[] = $this->phoneRepository->create($this->parseData($data['personid'], $phone));
            }
        }

        if(!is_array($data['phones']['phone'])){
            $phones[] = $this->phoneRepository->create($this->parseData($data['personid'], $data['phones']['phone']));
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

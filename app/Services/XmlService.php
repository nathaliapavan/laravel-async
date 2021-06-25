<?php

namespace App\Services;

use Illuminate\Http\Request;

class XmlService {

    function xmlToArray($xml) {
        $data = simplexml_load_file($xml);
        $data = json_decode(json_encode($data), true);
        return $data;
    }

    function validator($request) {
        return \Validator::make($request->all(),['file' => 'required||mimes:xml|file']);
    }

}

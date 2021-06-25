<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\XmlService;
use App\Services\PersonService;

class FileUploadController extends Controller {

    protected $xmlService;

    protected $personService;

    public function __construct(XmlService $xmlService, PersonService $personService) {
        $this->xmlService       = $xmlService;
        $this->personService    = $personService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUpload() {
        return view('file.upload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fileUploadPost(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xml|max:2048',
        ]);

        $fileName = time().'.'.$request->file->extension();

        $request->file->move(public_path('uploads'), $fileName);

        return back()
            ->with('success', 'You have successfully upload file.')
            ->with('file', $fileName);

    }

    public function store(Request $request) {

        $validator = $this->xmlService->validator($request);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $xml = $this->xmlService->xmlToArray($request->file);

        if(isset($xml['person'])){
            $dataPerson = $this->personService->store($xml);
        }

        if(is_array($dataPerson) && isset($dataPerson)){
            $errors = [];
            foreach($dataPerson as $person){
                if($person instanceof \Exception){
                    $errors [] = $person->getMessage();
                }
            }
            if($errors){
                return response()->json(['errors' => $errors], 400);
            }
        }

        return response()->json(['data' => $dataPerson, 'message' => "xml salvo"], 200);
    }
}

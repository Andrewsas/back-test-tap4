<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;

class LaguageController extends Controller
{

    private function validarLanguage(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> ['required','min:5','max:60'],
            'creator' => ['required','min:5','max:60'],
            'site' => ['required'],
            'type' => ['required'],
            'year' => ['required'],
            'version' => ['required'],
            ]);
            return $validator;
    }


    public function index()
    {
        try {
            $language = Language::orderBy('id')->get(['id', 'name'])->toArray();

            return response()->json(['success' => true, 'result'=> $language], 200);

        } catch(\Exception $e) {
            return response()->json(['success' => false, 'result'=> $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = $this->validarLanguage($request);

            if ($validator->fails()){
                return response()->json(['success' => false, 'result'=> 'Erro', 'errors'=> $validator->errors()], 400);
            }


            $data = $request->all();

            $language = Language::create($data);

            if ($language) {
                return response()->json(['success' => true, 'result'=> $language], 201);
            } else {
                return response()->json(['success' => false, 'result'=>"Erro ao criar a Language"], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'result'=> $e->getMessage()], 500);
        }

    }

    public function show($id)
    {
        try {
            if ($id < 0)
                return response()->json(['success' => false,  'result'=>'ID informado é inválido!'], 400);

            $language = Language::find($id);

            if ($language) {
                return response()->json(['success' => true, 'result'=> $language], 200);
            } else {
                return response()->json(['success' => false, 'result'=> 'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'result'=> $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($id < 0){
                return response()->json(['success' => false,  'result'=>'ID informado é inválido!'], 400);
            }

            $validator = $this->validarLanguage($request);

            if ($validator->fails()){
                return response()->json(['success' => false, 'result'=> 'Erro', 'errors'=> $validator->errors()], 400);
            }

            $data = $request->all();

            $language = Language::find($id);

            if ($language) {

                $language->update($data);

                return response()->json(['success' => true, 'result'=> $language ], 204);

            } else {
                return response()->json(['success' => false, 'result'=> 'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'result'=> $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if ($id < 0)
            return response()->json(['success' => false,  'result'=>'ID informado é inválido!'], 400);

            $language = Language::find($id);

            if ($language) {

                $language->delete();

                return response()->json(['success' => true, 'result'=> 'Language deletado com sucesso' ], 200);

            } else {
                return response()->json(['success' => false, 'result'=> 'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['success' => false, 'result'=> $e->getMessage()], 500);
        }
    }
}


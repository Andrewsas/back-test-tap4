<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use Validator;


class LaguageController extends Controller
{

    private function validarLanguage(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'=> ['required','min:3','max:60'],
            'creator' => ['required','min:3','max:60'],
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
            $language = Language::orderBy('id')->get(['id', 'name', 'creator', 'version'])->toArray();

            return response()->json($language, 200);

        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = $this->validarLanguage($request);

            if ($validator->fails()){
                return response()->json($validator->errors(), 400);
            }


            $data = $request->all();

            $language = Language::create($data);

            if ($language) {
                return response()->json($language, 201);
            } else {
                return response()->json("Erro ao criar a Language", 400);
            }
        } catch(\Exception $e) {
            return response()->json( $e->getMessage(), 500);
        }

    }

    public function show($id)
    {
        try {
            if ($id < 0)
                return response()->json(['msg' => 'ID informado é inválido!'], 400);

            $language = Language::find($id);

            if ($language) {
                return response()->json($language, 200);
            } else {
                return response()->json(['msg' =>'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($id < 0){
                return response()->json(['msg' => 'ID informado é inválido!'], 400);
            }

            $validator = $this->validarLanguage($request);

            if ($validator->fails()){
                return response()->json( $validator->errors(), 400);
            }

            $data = $request->all();

            $language = Language::find($id);

            if ($language) {

                $language->update($data);

                return response()->json($language, 204);

            } else {
                return response()->json(['msg' => 'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            if ($id < 0)
            return response()->json(['msg' => 'ID informado é inválido!'], 400);

            $language = Language::find($id);

            if ($language) {

                $language->delete();

                return response()->json(['msg' => 'Language deletado com sucesso'], 200);

            } else {
                return response()->json(['msg' => 'Language não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}


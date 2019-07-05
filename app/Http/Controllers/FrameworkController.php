<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Framework;
use Validator;


class FrameworkController extends Controller
{

    private function validarFramework($request) {
        $validator = Validator::make($request->all(), [
            'name'=> ['required','min:3','max:60'],
            'creator' => ['required','min:3','max:60'],
            'site' => ['required'],
            'type' => ['required'],
            'year' => ['required'],
            'version' => ['required'],
            'id_language' => ['required'],
            'against' => ['required'],
            'pro' => ['required']
            ]);
            return $validator;
    }

    public function index()
    {
        try {

            $framework = Framework::orderBy('id')
                            ->with('language')
                            ->get(['id', 'name', 'creator', 'version']);

            return response()->json($framework, 200);

        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = $this->validarFramework($request);

            if ($validator->fails()){
                return response()->json($validator->errors(), 400);
            }


            $data = $request->all();

            $framework = Framework::create($data);

            if ($framework) {
                return response()->json($framework, 201);
            } else {
                return response()->json(['msg'=>"Erro ao criar a Framework"], 400);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

    }

    public function show($id)
    {
        try {
            if ($id < 0)
                return response()->json([ 'msg'=>'ID informado é inválido!'], 400);

            $framework = Framework::orderBy('id')
                            ->with('language')
                            ->find($id);

            if ($framework) {
                return response()->json($framework, 200);
            } else {
                return response()->json(['msg'=> 'Framework não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['result'=> $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if ($id < 0){
                return response()->json([ 'result'=>'ID informado é inválido!'], 400);
            }

            $validator = $this->validarFramework($request);

            if ($validator->fails()){
                return response()->json(['result'=> 'Erro', 'errors'=> $validator->errors()], 400);
            }

            $data = $request->all();

            $framework = Framework::find($id);

            if ($framework) {

                $framework->update($data);

                return response()->json($framework , 204);

            } else {
                return response()->json(['result'=> 'Framework não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json(['result'=> $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            if ($id < 0)
            return response()->json([ 'result'=>'ID informado é inválido!'], 400);

            $framework = Framework::find($id);

            if ($framework) {

                $framework->delete();

                return response()->json(['msg'=> 'Framework deletado com sucesso'], 200);

            } else {
                return response()->json(['msg'=> 'Framework não encontrado'], 400);
            }
        } catch(\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}

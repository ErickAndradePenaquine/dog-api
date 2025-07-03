<?php

namespace App\Http\Controllers;

use App\Models\DogModel;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/dogs",
     *     tags={"Dogs"},
     *     summary="Lista Dogs",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Listar Dogs"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Requisição não autorizada"
     *         ),
*          @OA\Response(
*              response=404,
*              description="Erro ao listar Dogs"
*         )
     *     )
     * )
     */
    public function index()
    {
        return DogModel::all();
    }


    /**
     * @OA\Get(
     *     path="/dogs/{id}",
     *     tags={"Dogs"},
     *     summary="Get em Dog especifico",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do Dog",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Get em Dog funcionou"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Dog não encontrado"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            return DogModel::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Dog não encontrado'], 404);
        }
    }


    /**
     * @OA\Post(
     *     path="/dogs",
     *     tags={"Dogs"},
     *     summary="Criar um Dog",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","raca","idade"},
     *             @OA\Property(property="nome", type="string", example="Rex"),
     *             @OA\Property(property="raca", type="string", example="Labrador"),
     *             @OA\Property(property="idade", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Create Dog foi feito"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *         ),
     *     @OA\Response(
     *         response=404,
     *         description="Erro ao Criar"
     *     )
     * )
     */


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'raca' => 'required|string|max:255',
            'idade' => 'required|integer|min:0'
        ]);

        return DogModel::create($validated);
    }

    /**
     * @OA\Put(
     *     path="/dogs/{id}",
     *     tags={"Dogs"},
     *     summary="Atualiza um Dog",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do Dog",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","raca","idade"},
     *             @OA\Property(property="nome", type="string", example="Rex"),
     *             @OA\Property(property="raca", type="string", example="Labrador"),
     *             @OA\Property(property="idade", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Update de Dog feito"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Dog não encontrado"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *         )
     *     )
     * )
     */


    public function update(Request $request, $id)
    {
        try {
            $dog = DogModel::findOrFail($id);
            $validated = $request->validate([
                'nome' => 'required|string|max:255',
                'raca' => 'required|string|max:255',
                'idade' => 'required|integer|min:0'
            ]);

            $dog->update($validated);
            return $dog;
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Dog não encontrado'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/dogs/{id}",
     *     tags={"Dogs"},
     *     summary="Delete Dog",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do Dog",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Dog deletado"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Dog não encontrado"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Não autorizado"
     *     )
     * )
     */

     
    public function destroy($id)
    {
        try {
            $dog = DogModel::findOrFail($id);
            $dog->delete();
            return response()->json(['message' => 'Dog removido com sucesso']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Dog não encontrado'], 404);
        }
    }
}

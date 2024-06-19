<?php

namespace App\Modules\Players\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Players\Models\Players;
use App\Modules\Players\Requests\StorePlayersRequest;
use App\Modules\Players\Requests\UpdatePlayersRequest;
use App\Modules\Players\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class PlayersController extends ControllerAbstract
{

    public function __construct(
        protected PlayerService $playerService
      ) {
      }

    /**
     * @OA\Get(
     *     path="/api/player",
     *     summary="Get a list of players",
     *     tags={"Player"},
     *     operationId="SearchPlayer",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(): JsonResponse
    {
        $users = $this->playerService->all();

        return $this->responseOk($users);
    }


    /**
     * @OA\Post (
     *     path="/api/player",
     *     summary="Create one player",
     *     tags={"Players"},
     *     operationId="CreatePlayer",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Titulo de minha tarefa aqui",
     *                     "description":"Uma descrição para minha tarefa",
     *                     "password":"pendente"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function store(StorePlayersRequest $request): JsonResponse
    {
        $response = $this->playerService->create($request->all());

        return $this->responseCreateOk([
            'message' => Lang::get('players.created'),
            'data'=> $response
        ]);
    }


    /**
     *
     * @OA\Get(
     *     path="/api/players/{playerId}",
     *     summary="Get a one players",
     *     tags={"Players"},
     *     operationId="GetPlayerDetails",
     *     @OA\Parameter(
     *        description="Player ID",
     *        in="path",
     *        name="playerId",
     *        required=true,
     *        example="1",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function show(int $id): JsonResponse
    {
        $model = $this->playerService->find($id);

        return $this->responseOk($model->toArray());
    }

    /**
    * @OA\Put (
     *     path="/api/players/{playerId}",
     *     summary="Update one player",
     *     tags={"Players"},
     *     operationId="UpdatePlayersDetails",
     *     @OA\Parameter(
     *          description="Player ID",
     *          in="path",
     *          name="playerId",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *             type="integer",
     *             format="int64"
     *          )
     *       ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Novo Titulo de minha tarefa aqui",
     *                     "description":"Uma descrição para minha tarefa",
     *                     "password":"indefinido"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function update(UpdatePlayersRequest $request, int $id): JsonResponse
    {
        $response = $this->playerService->update($request->all(), $id);

        return $this->responseUpdateOk([
            'message' => Lang::get('players.updated'),
            'debug' => $response
        ]);
    }


    /**
     *
     * @OA\Delete(
     *     path="/api/players/{playerId}",
     *     summary="Delete a one player",
     *     tags={"Players"},
     *     operationId="DeletePlayerDetails",
     *     @OA\Parameter(
     *        description="Player ID",
     *        in="path",
     *        name="playerId",
     *        required=true,
     *        example="1",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function destroy(int $id): JsonResponse
    {
        $this->playerService->delete($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('players.deleted')
        ]);
    }
}

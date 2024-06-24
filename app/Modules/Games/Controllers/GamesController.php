<?php

namespace App\Modules\Games\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Games\Requests\FindGamesRequest;
use Illuminate\Http\JsonResponse;

use App\Modules\Games\Requests\StoreGamesRequest;
use App\Modules\Games\Requests\UpdateGamesRequest;
use App\Modules\Games\Services\GameService;

use Illuminate\Support\Facades\Lang;

class GamesController extends ControllerAbstract
{

    public function __construct(
        protected GameService $gameService
      ) {
      }
    
    /**
     * @OA\Get(
     *     path="/api/v1/games",
     *     security="XAuthorization",
     *     summary="Get a list of games",
     *     tags={"Games"},
     *     operationId="SearchGames",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(FindGamesRequest $request): JsonResponse
    {
        $games = $this->gameService->search(collect($request->all()));

        return $this->responseOk($games);
    }

    /**
     * @OA\Post (
     *     path="/api/v1/games",
     *     summary="Create one game",
     *     security={{"bearerAuth": {}}},
     *     tags={"Games"},
     *     operationId="CreateGame",
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
    public function store(StoreGamesRequest $request): JsonResponse
    {
        $response = $this->gameService->create($request->all());

        return $this->responseCreateOk([
            'message' => Lang::get('games.created'),
            'data'=> $response
        ]);
    }

    /**
     *
     * @OA\Get(
     *     path="/api/v1/games/{gameId}",
     *     summary="Get a one game",
     *     security={{"bearerAuth": {}}},
     *     tags={"Games"},
     *     operationId="GetGameDetails",
     *     @OA\Parameter(
     *        description="Game ID",
     *        in="path",
     *        name="gameId",
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
        $model = $this->gameService->find($id);

        return $this->responseOk($model->toArray());
    }

    /**
    * @OA\Put (
     *     path="/api/v1/games/{gameId}",
     *     summary="Update one game",
     *     security={{"bearerAuth": {}}},
     *     tags={"Games"},
     *     operationId="UpdateGamesDetails",
     *     @OA\Parameter(
     *          description="Game ID",
     *          in="path",
     *          name="gameId",
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
    public function update(UpdateGamesRequest $request, int $id): JsonResponse
    {
        $response = $this->gameService->update($request->all(), $id);

        return $this->responseUpdateOk([
            'message' => Lang::get('games.updated'),
            'debug' => $response
        ]);
    }

    /**
     *
     * @OA\Delete(
     *     path="/api/v1/games/{gameId}",
     *     summary="Delete a one game",
     *     security={{"bearerAuth": {}}},
     *     tags={"Games"},
     *     operationId="DeleteGameDetails",
     *     @OA\Parameter(
     *        description="Game ID",
     *        in="path",
     *        name="gameId",
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
        $this->gameService->delete($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('games.deleted')
        ]);
    }
}

<?php

namespace App\Modules\Players\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Players\Requests\StorePlayersRequest;
use App\Modules\Players\Requests\UpdatePlayersRequest;
use App\Modules\Players\Services\PlayerService;
use App\Modules\Players\Requests\FindPlayersRequest;
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
     *     path="/api/v1/players",
     *     summary="Get a list of players",
     *     tags={"Players"},
     *     operationId="SearchPlayer",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(FindPlayersRequest $request): JsonResponse
    {
        $players = $this->playerService->search(collect($request->all()));

        return $this->responseOk($players);
    }


    /**
     * @OA\Post (
     *     path="/api/v1/players",
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
     *                          property="first_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="last_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="position",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="height",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="weight",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="jersey_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="college",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="country",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_year",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_round",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_number",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="team_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                  "data": {
     *                          "id": 1,
     *                           "external_player_id": null,
     *                           "first_name": "Jogador",
     *                           "last_name": "numero 1",
     *                           "position": "G",
     *                           "height": "6-6",
     *                           "weight": "190",
     *                           "jersey_number": "8",
     *                           "college": "Engenharia",
     *                           "country": "Spain",
     *                           "draft_year": "2013",
     *                           "draft_round": 2,
     *                           "draft_number": 32,
     *                           "team_id": 1,
     *                           "created_at": "2024-06-24T00:27:47.000000Z",
     *                           "updated_at": "2024-06-24T00:29:02.000000Z"
     *                       }
     *                   }
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
     *     path="/api/v1/players/{playerId}",
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
     *     path="/api/v1/players/{playerId}",
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
     *                          property="first_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="last_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="position",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="height",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="weight",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="jersey_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="college",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="country",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_year",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_round",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="draft_number",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="team_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                  "data": {
     *                          "id": 1,
     *                           "external_player_id": null,
     *                           "first_name": "Jogador",
     *                           "last_name": "numero 1",
     *                           "position": "G",
     *                           "height": "6-6",
     *                           "weight": "190",
     *                           "jersey_number": "8",
     *                           "college": "Engenharia",
     *                           "country": "Spain",
     *                           "draft_year": "2013",
     *                           "draft_round": 2,
     *                           "draft_number": 32,
     *                           "team_id": 1,
     *                           "created_at": "2024-06-24T00:27:47.000000Z",
     *                           "updated_at": "2024-06-24T00:29:02.000000Z"
     *                       }
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
     *     path="/api/v1/players/{playerId}",
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

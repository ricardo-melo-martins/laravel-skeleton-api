<?php

namespace App\Modules\Teams\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Teams\Requests\StoreTeamsRequest;
use App\Modules\Teams\Requests\UpdateTeamsRequest;
use App\Modules\Teams\Services\TeamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class TeamsController extends ControllerAbstract
{
    
    public function __construct(
        protected TeamService $teamService
      ) {
      }

    /**
     * @OA\Get(
     *     path="/api/teams",
     *     summary="Get a list of teams",
     *     tags={"Teams"},
     *     operationId="SearchTeams",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(): JsonResponse
    {
        $users = $this->teamService->all();

        return $this->responseOk($users);
    }


    /**
     * @OA\Post (
     *     path="/api/teams",
     *     summary="Create one team",
     *     tags={"Teams"},
     *     operationId="CreateTeam",
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
    public function store(StoreTeamsRequest $request): JsonResponse
    {
        $response = $this->teamService->create($request->all());

        return $this->responseCreateOk([
            'message' => Lang::get('teams.created'),
            'data'=> $response
        ]);
    }


    /**
     *
     * @OA\Get(
     *     path="/api/teams/{teamId}",
     *     summary="Get a one team",
     *     tags={"Teams"},
     *     operationId="GetTeamDetails",
     *     @OA\Parameter(
     *        description="Team ID",
     *        in="path",
     *        name="teamId",
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
        $model = $this->teamService->find($id);

        return $this->responseOk($model->toArray());
    }

    /**
    * @OA\Put (
     *     path="/api/teams/{teamId}",
     *     summary="Update one team",
     *     tags={"Teams"},
     *     operationId="UpdateTeamDetails",
     *     @OA\Parameter(
     *          description="Team ID",
     *          in="path",
     *          name="teamId",
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
    public function update(UpdateTeamsRequest $request, int $id): JsonResponse
    {
        $response = $this->teamService->update($request->all(), $id);

        return $this->responseUpdateOk([
            'message' => Lang::get('teams.updated'),
            'debug' => $response
        ]);
    }


    /**
     *
     * @OA\Delete(
     *     path="/api/teams/{teamId}",
     *     summary="Delete a one team",
     *     tags={"Teams"},
     *     operationId="DeleteTeamDetails",
     *     @OA\Parameter(
     *        description="Team ID",
     *        in="path",
     *        name="teamId",
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
        $this->teamService->delete($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('teams.deleted')
        ]);
    }

}

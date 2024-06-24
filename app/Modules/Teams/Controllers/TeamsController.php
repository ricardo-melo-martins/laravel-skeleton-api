<?php

namespace App\Modules\Teams\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Teams\Requests\FindTeamsRequest;
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
     *     path="/api/v1/teams",
     *     summary="Get a list of teams",
     *     tags={"Teams"},
     *     operationId="SearchTeams",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(FindTeamsRequest $request): JsonResponse
    {
        $teams = $this->teamService->search(collect($request->all()));
        
        return $this->responseOk($teams);
    }


    /**
     * @OA\Post (
     *     path="/api/v1/teams",
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
     *                          property="conference",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="division",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="city",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="full_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="abbreviation",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                      "conference": "West",
     *                      "division": "Southwest",
     *                      "city": "Los Angeles",
     *                      "name": "Raptors",
     *                      "full_name": "Portland Trail Blazers",
     *                      "abbreviation": "PTB"
     *                   }
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
     *     path="/api/v1/teams/{teamId}",
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
     *     path="/api/v1/teams/{teamId}",
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
     *                          property="conference",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="division",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="city",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="full_name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="abbreviation",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                      "conference": "Mid-East",
     *                      "division": "Northwest",
     *                      "city": "Los Angeles",
     *                      "name": "Raptors",
     *                      "full_name": "Portland Trail Blazers",
     *                      "abbreviation": "PTB"
     *                   }
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
     *     path="/api/v1/teams/{teamId}",
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

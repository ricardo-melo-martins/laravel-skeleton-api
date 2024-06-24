<?php

namespace App\Modules\Users\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Users\Requests\FindUsersRequest;
use Illuminate\Http\JsonResponse;

use App\Modules\Users\Requests\StoreUsersRequest;
use App\Modules\Users\Requests\UpdateUsersRequest;
use App\Modules\Users\Services\UserService;

use Illuminate\Support\Facades\Lang;

class UsersController extends ControllerAbstract
{

    public function __construct(
        protected UserService $userService
      ) {
      }
    
    /**
     * @OA\Get(
     *     path="/api/admin/users",
     *     security={{"bearerAuth": {}}},
     *     summary="Get a list of users",
     *     tags={"Users"},
     *     operationId="SearchUsers",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(FindUsersRequest $request): JsonResponse
    {
        $users = $this->userService->search(collect($request->all()));

        return $this->responseOk($users);
    }

    /**
     * @OA\Post (
     *     path="/api/admin/users",
     *     summary="Create one user",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     operationId="CreateUser",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      )
     *                 )
     *                 
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function store(StoreUsersRequest $request): JsonResponse
    {
        $response = $this->userService->create($request->all());

        return $this->responseCreateOk([
            'message' => Lang::get('user.created'),
            'data'=> $response
        ]);
    }

    /**
     *
     * @OA\Get(
     *     path="/api/admin/users/{userId}",
     *     summary="Get a one user",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     operationId="GetUserDetails",
     *     @OA\Parameter(
     *        description="User ID",
     *        in="path",
     *        name="userId",
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
        $model = $this->userService->find($id);

        return $this->responseOk($model->toArray());
    }

    /**
    * @OA\Put (
     *     path="/api/admin/users/{userId}",
     *     summary="Update one user",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     operationId="UpdateUsersDetails",
     *     @OA\Parameter(
     *          description="User ID",
     *          in="path",
     *          name="userId",
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
     *                 )
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     */
    public function update(UpdateUsersRequest $request, int $id): JsonResponse
    {
        $response = $this->userService->update($request->all(), $id);

        return $this->responseUpdateOk([
            'message' => Lang::get('users.updated'),
            'debug' => $response
        ]);
    }

    /**
     *
     * @OA\Delete(
     *     path="/api/admin/users/{userId}",
     *     summary="Delete a one user",
     *     security={{"bearerAuth": {}}},
     *     tags={"Users"},
     *     operationId="DeleteUserDetails",
     *     @OA\Parameter(
     *        description="User ID",
     *        in="path",
     *        name="userId",
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
        $this->userService->delete($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('users.deleted')
        ]);
    }
}

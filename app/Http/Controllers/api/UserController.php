<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Resources\NewAccessTokenResource;
use App\Http\Resources\PersonalAccessTokenResource;
use App\Http\Resources\UserResource;
use App\Models\PersonalAccessToken;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private AuthService $authService,
    ) {
    }

    public function store(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        $token = $user->createToken(PersonalAccessToken::ACCESS_TOKEN_NAME);

        return response()->json(
            NewAccessTokenResource::make($token),
            Response::HTTP_CREATED,
        );
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(
            UserResource::make($user),
        );
    }

    public function tokens(User $user): JsonResponse
    {
        return response()->json(
            PersonalAccessTokenResource::collection($user->tokens),
        );
    }

}

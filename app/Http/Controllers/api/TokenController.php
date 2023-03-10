<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\NewAccessTokenResource;
use App\Models\PersonalAccessToken;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function __construct(
        private AuthService $authService,
    ) {
    }

    public function store(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->login($request->validated());
        $token = $user->createToken(PersonalAccessToken::ACCESS_TOKEN_NAME);
        return response()->json(
            NewAccessTokenResource::make($token),
            Response::HTTP_CREATED,
        );
    }

    public function destroy(Request $request, $id): JsonResponse
    {
        $request->user()->tokens()->where('id', $id)->delete();
        return response()->json(status: Response::HTTP_NO_CONTENT);
    }

    public function destroyAll(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json(status: Response::HTTP_NO_CONTENT);
    }
}

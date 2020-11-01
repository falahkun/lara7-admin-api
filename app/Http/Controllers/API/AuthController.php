<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseHelper;
use App\Http\Controllers\ValidatorHelper;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function getResponseProvider(Request $request)
    {
        try {
            $provider = $request->header('provider');

            if ($provider == null) {
                return ResponseHelper::response(
                    400,
                    null,
                    "Provider Tidak diisi!"
                );
            }
            return ResponseHelper::response(
                200,
                [
                    'redirect_url' => Socialite::driver($provider)->redirect()->getTargetUrl(),
                ],
                "success getting redirect point"
            );
        } catch (Exception $e) {
            return ResponseHelper::response(
                400,
                null,
                "Gagal mendapatkan redirect Point"
            );
        }
    }

    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            return ResponseHelper::response(200, [
                'name' => $user->name,
                'email' => $user->email,
                'image' => $user->avatar,
                'uid' => $user->id,
                'token' => $user->token
            ], "Authenticate Success");
        } catch (Exception $e) {
            return ResponseHelper::response(400, null, "Token kadaluarsa");
            // return $e;
        }
    }

    public function createUser(Request $request)
    {


        $validator = ValidatorHelper::validating($request->all(), [
            'uid' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'image_profile' => 'string',
            'provider' => 'provider',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::response(403, null, "Failed Please check your data type");
        }

        $user = new User([
            'uid' => $request->uid,
            'name' => $request->name,
            'email' => $request->email,
            'image_profile' => $request->image,
            'provider' => $request->provider,
            'status' => '1' // status 1 = active, 2 = deactived
        ]);

        if (User::where('email', $request->email)->first()) {
            $response = array(
                'meta' => array(
                    'code' => 422,
                    'message' => 'failed validate',
                ),
                'results' => array('validating' => $request->name),
            );
        } else {
            $save = $user->save();
            if ($save) {
                return ResponseHelper::response(
                    201,
                    $request->all(),
                    "Success Create User"
                );
                $response = array(
                    'meta' => array(
                        'code' => 201,
                        'message' => 'success created',
                    ),
                    'results' => array('validating' => $request->name),
                );
            } else {
                return ResponseHelper::response(400, null, "Failed Create User");
            }
        }

        return $response;
    }

    public function login(Request $request)
    {


        try {
            $validate = ValidatorHelper::validating($request->all(), [
                'email' => 'required|string|email',
                'token' => 'required'
            ]);

            if ($validate->fails()) {
                return ResponseHelper::response(403, null, "Failed Please check your data type");
            }

            $userSos = Socialite::driver('google')->userFromToken($request->token);

            $id = $userSos->id;

            $user = User::where('uid', $id)->where('email', $request->email)->first();

            if (!$user) {
                return ResponseHelper::response(401, null, "user Not Found, please register!");
            }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($request->remember_me)
                $token->expires_at = Carbon::now()->addWeeks(1);

            $token->save();
            return ResponseHelper::response(200, [
                'access_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        } catch (Exception $e) {
            return ResponseHelper::response(403, null, "Invalid Token");
        }


        // return array(
        //     'results' => $user,
        // );

        // $credentials = request(['email', 'uid']);
    }

    public function getUser(Request $request)
    {
        return ResponseHelper::response(
            200,
            $request->user(),
            "Berhasil menampilkan Data User"
        );
    }
}

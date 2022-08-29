<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UsersResource;
use Validator;
use Carbon\Carbon;

class UsersController extends BaseController
{
    /**
     * Display list of all users resources
     *
     * @return \Illuminate\Http\Response
     */
    public function listUsers() {
        $users = User::with('rented')->get();
        // return $this->sendError('Unauthorized', ['error' => 'Unauthorized User'], 401);

        return $this->sendResponse(UsersResource::collection($users), 'Users retrieved successfully.');
    }

    /**
     * Get a user resources
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function getUser($id) {
        $user = User::where('id', $id)->with('rented')->firstOrFail();

        return $this->sendResponse(new UsersResource($user), 'User data retrieved successfully.');
    }

    /**
     * Create a new user resource in storage
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'email' => 'required|email',
            'last_name' => 'required|min:3',
            'phone_number' => 'required|numeric|min:11',
            'user_name' => 'nullable|string',
            'address' => 'nullable|string',
            'id_card_number' => 'nullable',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }

        $input = $request->all();
        $user = User::create($input);

        return $this->sendResponse(new UsersResource($user), 'User created successfully.', 201);
    }

    /**
     * Update a user resource in storage
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, $id) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:3',
            'email' => 'nullable|email',
            'last_name' => 'required|min:3',
            'phone_number' => 'required|numeric|min:11',
            'user_name' => 'nullable|string',
            'address' => 'nullable|string',
            'id_card_number' => 'nullable',
        ]);

        if($validator->fails()) {
            return $this->sendError('Validation Error', $validator->errors());
        }


        $input = $request->all();
        $user = User::find($id);

        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone_number = $input['phone_number'];
        $user->user_name = $input['user_name'] ? $input['user_name'] :  $user->user_name;
        $user->address = $input['address'] ? $input['address'] :  $user->address;
        $user->id_card_number = $input['id_card_number'] ? $input['id_card_number'] : $user->id_card_number;
        $user->updated_at = Carbon::now();
        if(strcmp($input['email'], $user->email) !== 0) {
            $user->email = $input['email'];
        }
        $user->save();

        return $this->sendResponse(new UsersResource($user), 'User updated successfully.');
    }

    /**
     * Remove the specified user resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user::where('id', $id)->delete();

        return $this->sendResponse([], 'User deleted successfully.');
    }
}

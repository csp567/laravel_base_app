<?php

namespace App\Http\Controllers;

use App\User;
use UserTypes;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CUsers extends Controller
{

	public function getCreateUser() {
		$users = User::all();
		$arrUserTypes = UserTypes::whereNull( 'deleted_at' )->orderBy('type')->pluck('type', 'id');
		return view( 'users.create-user', [ 'users' => $users, 'user_types' => $arrUserTypes ] );
	}

	public function postNewUser( Request $request ) {
		$this->validator($request->all())->validate();
		$user = $this->create($request->all());

		return redirect( '/user' )->with( Success, $user->name . ' - User created successfully!' );;
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => 'required|string|min:6|confirmed',
			'user_types' => 'required|int'
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\User
	 */
	protected function create(array $data)
	{
		return User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'user_type' => $data['user_types']
		]);
	}

}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use app\Http\Requests;
use Illuminate\Support\Facades\Auth;

class CUserTypesController extends Controller
{

	public function getActiveUserTypes() {
		$arrResult = DB::select('SELECT id, type, date_format( CAST( created_at AS DATE ), \'%d-%m-%Y\' ) created_at from user_types WHERE deleted_by IS NULL AND deleted_at IS NULL');
		return view( 'users/user_types', [ 'users' => $arrResult ] );
	}

	public function createUser(Request $request) {

		$this->validate( $request, [ 'user_type' => 'required' ], [ 'user_type.required' => 'Username field is required.' ] );

		$strUserType = $request->input('user_type');

		$boolResult = DB::insert( 'INSERT INTO user_types( type, created_by ) VALUES( ?, ? )', [ $strUserType, Auth::id() ] );

		if( true == $boolResult ) {
			return redirect('/user/user-types')->with( Success, $strUserType . ' - User created successfully!' );
		}
		return redirect('/user/user-types')->with( Error, constant( 'message.report_to_admin' ) );
	}

	public function deleteUserType(Request $request) {

		$this->validate( $request, [ 'user_typ_id' => 'required' ], [ 'user_type.required' => 'Invalid user id.' ] );

		$strUserTypeId = $request->input('user_typ_id');
		$boolResult = false;

		if( SUPERADMIN == Auth::user()->user_type ) {
			$boolResult = DB::update( 'UPDATE user_types SET deleted_at = NOW(), deleted_by = ? WHERE id = ?', [ Auth::id(), $strUserTypeId ] );
		}

		if( true == $boolResult ) {
			return response()->json( [ 'msg'=> 'User type deleted sucessfully.' ], 200 );
		}

		return response()->json( [ 'msg'=> constant( 'messages.permission_denied' ) ], 200 );

	}

}

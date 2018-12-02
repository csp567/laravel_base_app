<?php

namespace App\Http\Controllers;

use DB;
use App\Contact;
use App\User;
use App\SharedContacts;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShareContactController extends Controller
{
	protected function getContactsList( Request $request ) {

		$intContactId = $request->contact_id;

		$users = DB::table('users')
			->leftjoin('shared_contacts', function($join) use ( $intContactId ) {
				$join->on( 'shared_contacts.shared_with', '=', 'users.id' )
					->on( 'shared_contacts.shared_by', '=', DB::raw( Auth::id() ) )
					->whereNull('shared_contacts.deleted_at');
			})
			->select('users.*', DB::raw( 'CASE WHEN shared_contacts.id IS NOT NULL THEN 1 ELSE 0 END AS is_shared' ) )
			->orderby('users.name')
			->where( 'users.id', '<>', DB::raw( Auth::id() ) )
			->get();

		return response()->json( $users );
	}

	public function shareContact( Request $request ) {
		$intContactId	= $request->contact_id;
		$arrUserIds		= array_map( 'intval', $request->user_ids );
		$arrShareResult	= [];

		// Get Contact Details
		$arrContactDetails = Contact::where( 'id', $intContactId )->get()->first()->toArray();

		// Get previous sharing details
		$arrAllreadySharedWith = SharedContacts::where( 'contact_id', $intContactId )->where( 'shared_by', DB::raw( Auth::id() ) )->whereNull('deleted_at')->get()->toArray();
		
		$arrShareWith = [];
		if( !empty( $arrAllreadySharedWith ) && is_array( $arrAllreadySharedWith ) ) {
			$arrAllreadySharedWith = array_column( $arrAllreadySharedWith, 'shared_with', 'id' );
		}
		
		$arrNewSharing = array_diff( $arrUserIds, $arrAllreadySharedWith );
		$arrRemoveSharing = array_diff( $arrAllreadySharedWith, $arrUserIds );
		
		$strMsg = '';

		if( !empty( $arrNewSharing ) && is_array( $arrNewSharing ) ) {
			foreach( $arrNewSharing as $intUserId ) {

				$arrobjContactCreated = Contact::create([
					'first_name'		=> $arrContactDetails['first_name'],
					'middle_name'		=> $arrContactDetails['middle_name'],
					'last_name'			=> $arrContactDetails['last_name'],
					'primary_number'	=> $arrContactDetails['primary_number'],
					'secondary_number'	=> $arrContactDetails['secondary_number'],
					'email'				=> $arrContactDetails['email'],
					'contact_image'		=> $arrContactDetails['contact_image'],
					'created_by'		=> $intUserId
				]);

				$arrSharedContactResult = SharedContacts::create([
					'contact_id'		=> $intContactId,
					'shared_by'			=> Auth::id(),
					'shared_with'		=> $intUserId,
					'referance_id'		=> $arrobjContactCreated['id']
				]);

				$arrShareResult[] = User::where( 'id', $intUserId )->get()->first()->toArray()['name'];
			}

			$strMsg .= $arrContactDetails['first_name'] . ' ' . $arrContactDetails['last_name'] . ' ' . ' contact shared with ' . implode( ', ', $arrShareResult ) . '.';
		}

		if( !empty( $arrRemoveSharing ) && is_array( $arrRemoveSharing ) ) {
			foreach ( $arrRemoveSharing as $intSharedId => $intUserId ) {
				// remove contact sharing
				$objSharedContact = SharedContacts::find( $intSharedId );
				$boolResult = $objSharedContact->delete();
				
				// Remove contact
				$objContact = Contact::find( $objSharedContact['referance_id'] );
				$boolResult = $objContact->delete();
				
				$arrRemovedSharingResult[] = User::where( 'id', $intUserId )->get()->first()->toArray()['name'];
			}

			$strMsg .= '<br/>' . $arrContactDetails['first_name'] . ' ' . $arrContactDetails['last_name'] . ' ' . ' contact sharing removed from ' . implode( ', ', $arrRemovedSharingResult ) . '.';
		}

		return response()->json( [ 'msg'=> $strMsg ], 200 );

	}

}

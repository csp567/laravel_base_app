<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view( 'contacts.all_contacts', [ 'contacts' => Contact::where( 'created_by', Auth::id() )->get() ] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('contacts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$this->validator($request->all())->validate();

		$strContactImageNameWithPath = '';

		if( $request->hasFile( 'contact_image' ) ) {
			$arrContactImage = $request->file('contact_image');
			$destinationPath = 'uploads/contact_image';
			if( $arrContactImage->move( $destinationPath, time() . '.' . $arrContactImage->getClientOriginalExtension() ) ) {
				$strContactImageNameWithPath = $destinationPath . '/' . time() . '.' . $arrContactImage->getClientOriginalExtension();
			}
		}

		$objResult = Contact::create([
			'first_name'		=> $request['first_name'],
			'middle_name'		=> $request['middle_name'],
			'last_name'			=> $request['last_name'],
			'primary_number'	=> $request['primary_phone'],
			'secondary_number'	=> $request['secondary_phone'],
			'email'				=> $request['email'],
			'contact_image'		=> $strContactImageNameWithPath,
			'created_by'		=> Auth::id()
		]);

		if($objResult->exists) {
			return redirect( url('/') . '/contact/create')->with( Success, '<a href="' . url('/') . '/contact/' . $objResult->id . '">' . $request['first_name'] . ' ' . $request['last_name'] . '</a> Contact details saved successfully!' );
		}
		return redirect( url('/') . '/contact/create')->with( Error, 'Looks like somethig broken to our side. Try after sometime.' );

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function show(Contact $contact)
	{
		return view( 'contacts.show_contact', compact( 'contact', $contact->getAttributes() ) );
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Contact $contact)
	{
		return view( 'contacts.edit', compact( 'contact', $contact->getAttributes() ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Contact $contact)
	{
		$this->validator($request->all())->validate();

		$strContactImageNameWithPath = '';

		if( $request->hasFile( 'contact_image' ) ) {
			$arrContactImage = $request->file('contact_image');
			$destinationPath = 'uploads/contact_image';
			if( $arrContactImage->move( $destinationPath, time() . '.' . $arrContactImage->getClientOriginalExtension() ) ) {
				$strContactImageNameWithPath = $destinationPath . '/' . time() . '.' . $arrContactImage->getClientOriginalExtension();
			}
		}

		$boolResult = Contact::findOrFail( $request->id )->update( [
			'first_name'		=> $request['first_name'],
			'middle_name'		=> $request['middle_name'],
			'last_name'			=> $request['last_name'],
			'primary_number'	=> $request['primary_phone'],
			'secondary_number'	=> $request['secondary_phone'],
			'email'				=> $request['email'],
			'contact_image'		=> $strContactImageNameWithPath,
			'updated_at'		=> 'NOW()'
		]);

		if( $boolResult ) {
			return redirect( url('/') . '/contact/' . $request->id . '/edit')->with( Success, '<a href="' . url('/') . '/contact/' . $request->id . '">' . $request['first_name'] . ' ' . $request['last_name'] . '</a> Contact details updated successfully!' );
		}
		return redirect( url('/') . '/contact/' . $request->id . '/edit')->with( Error, 'Looks like somethig broken to our side. Try after sometime.' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Contact  $contact
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request)
	{
		
		$objContact = Contact::find( $request->contact_id );
		$boolResult = $objContact->delete();

		if( $boolResult ) {
			return response()->json( [ 'msg'=> 'Contact details removed successfully!' ], 200 );
		}
		return response()->json( [ 'msg'=> 'Looks like somethig broken to our side. Try after sometime.' ], 200 );
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'first_name' => 'required|string|max:100',
			'middle_name' => 'nullable|string|max:100',
			'last_name' => 'required|string|max:100',
			'primary_phone' => 'required|numeric|min:10',
			'secondary_phone' => 'nullable|numeric|min:10',
			'email' => 'required|string|email|max:255',
			'contact_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);
	}

	protected function shareContact( Request $request ) {
		dd($request);
	}

}

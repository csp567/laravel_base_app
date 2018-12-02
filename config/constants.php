<?php

	define( 'Success', 'Success' );
	define( 'Error', 'Error' );
	define( 'Info', 'Info' );
	define( 'Warning', 'Warning' );

	define( 'SYSTEM', 1 );
	define( 'SUPERADMIN', 2 );
	define( 'ADMIN', 3 );

	define( 'MESSAGE', 'message' );
	define( 'PERMISSION_DENIED', 'permission_denied' );
	define( 'REPORT_TO_ADMIN', 'report_to_admin' );

	return [
		MESSAGE => [
			REPORT_TO_ADMIN		=> 'Something went wrong! Contact to administrator.',
			PERMISSION_DENIED	=> 'You dont have access to this module.'
		]
	];
?>
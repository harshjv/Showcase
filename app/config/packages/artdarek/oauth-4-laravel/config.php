<?php 

return array( 

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

        'Google' => array(
            'client_id'     => '593610837010.apps.googleusercontent.com',
            'client_secret' => '3TYN3JQpSb83MTKD47MzWuSI',
            'scope'         => array('userinfo_email', 'userinfo_profile')
        )

	)

);
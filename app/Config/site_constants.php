<?php
    // define constants
    define('SELECT_EMPTY', '--Please Select--');
	define('TITLE', 'Mengra');
	define('EMIL_FROM','no-reply@mengra.com');

    class UserGroup{
        const SuperAdmin    = '1';
        const User          = '2';
    }
    
    class TimeFormat{
        const DateTime 			= 'd-m-Y H:i:s A';
		const CustomDateTime 	= 'd M Y, g:i A';
        const Date 				= 'd-m-Y';
        const Time 				= 'H:i:s';
		const MeridiemTime 		= 'g:i A';
		const CustomDate 		= 'd M Y';
		const DatabaseDate 		= 'Y-m-d H:i:s';
    }
	
	class Layouts{
        const FrontendLogin 	= 'login_layout';
    }
	
	class ImagePath{
        const ContactCardImgPath	= 'contacts_images/';
        const ProfileImgPath		= 'profile_images/';
        const ProfilePageImgPath	= 'profile_images/profile_pics/';
        const UserPlaceholderImage	= 'images/';
    }
?>
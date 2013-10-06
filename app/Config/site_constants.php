<?php
    // define constants
    define('SELECT_EMPTY', '--Please Select--');
	define('TITLE', 'Mengra');
	define('EMIL_FROM','no-reply@mengra.com');
	define('ADMIN_PAGE_LIMIT', 10);

    class UserGroup{
        const SuperAdmin    = '1';
        const User          = '3';
    }
    
    class TimeFormat{
        const DateTime 			= 'd-m-Y H:i:s';
		const CustomDateTime 	= 'd M Y, g:i A';
        const Date 				= 'd-m-Y';
        const Time 				= 'H:i:s';
		const MeridiemTime 		= 'g:i A';
		const CustomDate 		= 'd M Y';
		const DatabaseDateTime	= 'Y-m-d H:i:s';
		const DatabaseDate		= 'Y-m-d';
		const DayMonth			= 'F jS';
    }
	
	class Layouts{
        const FrontendLogin 	= 'login_layout';
    }
	
	class ImagePath{
        const ContactCardImgPath	= '/img/contacts_images/';
        const ProfileImgPath		= '/img/profile_images/';
        const ProfilePageImgPath	= '/img/profile_images/profile_pics/';
        const UserPlaceholderImage	= '/img/images/';
    }
?>
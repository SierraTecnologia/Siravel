<?php

namespace SiWeapons\Integrations\Instagram;

use Log;
use App\Models\User;

class Profile extends Instagram
{
    
    public function __construct()
    {
        
    }

    public static function getProfile($username)
    {
        try {
            $options  = array('http' => array('user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 12_3_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Mobile/15E148 Instagram 105.0.0.11.118 (iPhone11,8; iOS 12_3_1; en_US; en-US; scale=2.00; 828x1792; 165586599)'));
            $context  = stream_context_create($options);

            $html = file_get_contents('https://instagram.com/'.$username, false, $context);
            //Get user ID
            $subData = substr($html, strpos($html, 'window._sharedData'), strpos($html, '};'));
            $userID = strstr($subData, '"id":"');
            $userID = str_replace('"id":"', '', $userID);
            $userID = strstr($userID, '"', true);

            //Download user info
            $jsonData = file_get_contents('https://i.instagram.com/api/v1/users/'.$userID.'/info/', false, $context);
            $decodedInfo = json_decode($jsonData);
            $username = $decodedInfo->user->username;
            $profilePic = $decodedInfo->user->hd_profile_pic_url_info->url;
            $follower = $decodedInfo->user->follower_count;
            $following = $decodedInfo->user->following_count;
            $full_name = $decodedInfo->user->full_name;
            $isPrivate = $decodedInfo->user->is_private;
            $isVerified = $decodedInfo->user->is_verified;
            $bio = $decodedInfo->user->biography;
            
            return [

                'full_name' => $full_name,
                'bio' => $bio,
                'follower' => $follower,
                'following' => $following,
                'profilePic' => $profilePic,
                'isPrivate' => $isPrivate,
                'isVerified' => $isVerified,
            ];
            
        } catch (\Exception $e) {
            return false;
        }

    }

}

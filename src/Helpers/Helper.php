<?php

namespace Hutchh\Consoleresources\Helpers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use closure;

class Helper 
{
    /**
     * Masked phone number.
     *
     * @param  string  $number
     * @return string
     */
    public static function hidePhone($number){
        $maskedString = "";
        $length = strlen($number);

        if( $length < 3 ){
            return  $length == 1 ? "*" : "*". substr($number,  - 1);
        } else{
            $part_size = floor( $length / 3 ) ; 
            $middle_part_size = $length - ( $part_size * 2 );
            for( $i=0; $i < $middle_part_size ; $i ++ ){
            $maskedString .= "*";
            }

            return substr($number, 0, $part_size ) . $maskedString  . substr($number,  - $part_size );
        }
    }

    /**
     * Masked email address.
     *
     * @param  string  $emailAddress
     * @param  integer $show default 3
     * @return string
     */
    public static function hideEmail($emailAddress,$show=3){
        $arr = explode('@', $input);
        return substr($arr[0],0,$show).str_repeat('*',strlen($arr[0])-$show).$arr[1];
    }

    /**
     * Check expire date passed.
     *
     * @param  string  $expiresAt
     * @return bool
     */
    public static function needDelay($expiresAt){
        return Carbon::parse($expiresAt)->subSeconds(1)->greaterThan(Carbon::now());
    }



    /**
     * Determine if the request has expired.
     *
     * @param  string  $expiresAt
     * @return bool
     */
    public static function requestExpired($expiresAt){
        return Carbon::parse($expiresAt)->isPast();
    }

    /**
     * Request Remaining Time.
     *
     * @param  string  $expiresAt
     * @param  int  $diffInSeconds
     * @return int
     */
    public static function requestToExpired($expiresAt){
        if(self::needDelay($expiresAt))
        return Carbon::parse($expiresAt)->diffInSeconds(Carbon::now());
        return 0;
    }

    /**
     * Determine if the token has expired.
     *
     * @param  string  $expiresAt
     * @return bool
     */
    public static function tokenExpired($expiresAt){
        return Carbon::parse($expiresAt)->addSeconds(config('app.token.expires',60))->isPast();
    }

    /**
     * Remaining Time.
     *
     * @param  string  $expiresAt
     * @param  int  $diffInSeconds
     * @return int
     */
    public static function tokenToExpired($expiresAt){
        if(Carbon::parse($expiresAt)->diffInSeconds(Carbon::now()) <= config('app.token.expires',60))
        return abs(config('app.token.expires',60) - Carbon::parse($expiresAt)->diffInSeconds(Carbon::now()));
        return 0;
    }

    /**
     * Determine if the otp has expired.
     *
     * @param  string  $expiresAt
     * @return bool
     */
    public static function otpExpired($expiresAt){
        return Carbon::parse($expiresAt)->addSeconds(config('app.otp.expires',60))->isPast();
    }

    /**
     * Remaining Time.
     *
     * @param  string  $expiresAt
     * @param  int  $diffInSeconds
     * @return int
     */
    public static function otpToExpired($expiresAt){
        if(!self::otpExpired($expiresAt))
        return abs(config('app.otp.expires',60) - Carbon::parse($expiresAt)->diffInSeconds(Carbon::now()));
        return 0;
    }

    /**
     * Generate One Time Password.
     *
     * @param  int  $length
     * @return int
     */
    public static function generateOTP(int $length = 6){
        return implode('', array_map(function($value) {
            return $value == 1 ? mt_rand(1, 9) : mt_rand(0, 9);
        }, range(1, $length)));
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_driver_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return 'https://d1yxmf6pkcyt6v.cloudfront.net/driverProfile/'.$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_business_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.cloudFrontUrl').config('media.uploadsView.profileUpload').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_customer_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.cloudFrontUrl').'profile/'.$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_profile_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.cloudfront.profileImages').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_vehicle_category_image(string|null $image = null,$default = 'REGID_3XL.png') : string {
        if($image)
        return config('media.uploads.vehicleCategoryUrl').config('media.uploads.vehicleCategoryIcon').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_facility_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.facilityIconUrl').config('media.uploads.facilityIcon').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_service_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.jobServiceUrl').config('media.uploads.jobServiceIcon').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_attachment_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.jobAttachmentUrl').config('media.uploads.jobAttachments').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_status_attachment_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.uploads.statusAttachmentUrl').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_category_group_image(string|null $image = null,$default = 'REGID_3XL.png') : string {
        if($image)
        return config('media.cloudfront.categoryGroupImages').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_collection_image(string|null $image = null,$default = 'default') : string {
        if($image)
        return config('media.cloudfront.collectionImages').$image;
        return 'https://www.gravatar.com/avatar/'.md5( $default ).'?d=robohash';
    }

    /**
     * @param $image
     * @param $default
     *
     * @return string
    */
    public static function get_attribute_image(string|null $image = null) : string|null {
        if($image)
        return config('media.cloudfront.attributeImages').$image;
        return $image;
    }

    /**
     * @param $elements
     * @param $parentId
     *
     * @return array
    */
    public static function buildTree(array $elements, $parentId = 0) {
        $branch = array();
    
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = buildTree($elements, $element['id']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
    
        return $branch;
    }

}

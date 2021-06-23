<?php
namespace App\Http;
/*use App\Currency;
use App\BusinessSetting;*/
use App\Model\Product;
use App\Model\SubSubCategory;
/*use App\FlashDealProduct;
use App\FlashDeal;
use App\OtpConfiguration;
use Twilio\Rest\Client;*/

class Helpers {

    //returns combinations of customer choice options array

   static function combinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

}







?>
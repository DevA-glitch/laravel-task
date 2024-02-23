<?php
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

/**
* dataTableRequests
* @return result
*/
if (!function_exists('dataTableRequests')) {
    function dataTableRequests($request)
    {
        ## Read value
        $draw = $request['draw'];
        $start = $request['start'];
        $rowperpage = $request['length']; // Rows display per page
        
        $columnName_arr = $request['columns'];
        $search_arr = $request['search'];
        $searchValue = $search_arr['value']; // Search value
        
        
        $result = array(
            'draw' => $draw,
            'start' => $start,
            'rowperpage' => $rowperpage,
            'searchValue' => $searchValue,
            'rowperpage' => $rowperpage
        );
        
        return $result;
    }
}

/**
* dateformats
* @return result
*/
if (!function_exists('basicDateFormat')) {
    function basicDateFormat($date)
    {
        return Date('d-m-Y', strtotime($date));
    }
}

/**
* active or block
* @return result
*/
if (!function_exists('checkStatus')) {
    function checkStatus($status)
    {
        return $status==1 ? 'Active' : 'Block';
    }
}

/**
* active or block
* @return result
*/
if (!function_exists('checkStockStatus')) {
    function checkStockStatus($status)
    {
        return $status==1 ? 'Out Of Stock' : 'In Stock';
    }
}

/**
* Percentage or Amount
* @return result
*/
if (!function_exists('checkDiscount')) {
    function checkDiscount($discount)
    {
        return $discount==1 ? '%' : '₹';
    }
}

/**
* get discount value
* @return result
*/
if (!function_exists('getDiscount')) {
    function getDiscount($discount_type, $discount, $price)
    {
        if ($discount_type == 1) {
            $discount_price = $price - ($price / 100 * $discount);
        } else {
            $discount_price = $price - $discount;
        }

        // Round the discount_price to two decimal places
        $discount_price = round($discount_price, 2);

        // Format the discount_price to two decimal places for display
        $formatted_discount_price = number_format($discount_price, 2);

        return $formatted_discount_price;
    }
}

/**
* successJson
* @param message
* @param data[]
* @return Json
*/
if (!function_exists('successJson')) {
    function successJson($message, $data)
    {
        return [
            'status' => true,
            'message' => $message,
            'data' => $data
        ];
    }
}

/**
* errorJson
* @param message
* @param error
* @return Json
*/
if (!function_exists('errorJson')) {
    function errorJson($error, $data)
    {
        return [
            'status' => false,
            'message' => $error,
            'data' => $data
        ];
    }
}


/**
* convert to title case
*/
if (!function_exists('convertToTitleCase')) {
    function convertToTitleCase($string)
    {
        // Replace underscores with spaces
        $string=Str::title(str_replace('_', ' ', $string));
        
        return $string;
    }
}


/**
* booking status track date format
*/
if (!function_exists('orderDateFormat')) {
    function orderDateFormat($date)
    {

        // Format the Carbon date in the desired format
        $formattedDate = Carbon::parse($date)->format('M d, Y');
        
        return $formattedDate; 
    }
}
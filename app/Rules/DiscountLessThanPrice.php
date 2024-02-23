<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DiscountLessThanPrice implements Rule
{
    public function passes($attribute, $value)
    {
        $price = request()->input('price'); // Assuming 'price' is the name of the price field
        $discountType = request()->input('discount_type'); // Assuming 'discount_type' is the name of the discount_type field

        if ($discountType == 1) { // Assuming '1' represents "percentage" discount type
            $discountedPrice = $price - ($price * ($value / 100));
            return $discountedPrice > 0; // Check if the discounted price is greater than 0
        } elseif ($discountType == 0) { // Assuming '0' represents "amount" discount type
            return $value < $price;
        }

        return false; // Invalid discount type
    }

    public function message()
    {
        return 'The discount must be valid and not cause a zero or negative price.';
    }
}

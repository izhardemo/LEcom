<?php

namespace App\Helpers;

trait Helper {

    public function success($url, $message)
    {
        return redirect($url)->with('success', $message);
    }

    public function error($url = null, $message = 'Something went wrong. Please try again!')
    {
        if (!$url) {
            $url = url()->previous();
        }
        return redirect($url)->with('error', $message);
    }

    public function getShorterString($text, $length=null, $ucwords=false)
    {
        if ($ucwords == true) {
            $formatedString = ucwords($text);
        } else {
            $formatedString = ucfirst($text);
        }

        if ($length != null) {
            if (strlen($formatedString) <= $length) {
                return $formatedString;
            } else {
                $y=substr($formatedString, 0, $length) . '...';
                return $y;
            }
        } else {
            return $formatedString;
        }
    }
    
    # The function that returns a number formatted as a string in thousands, millions etc.
    public function getNumberAbbreviation (Int $number, Int $decimals = 1) : String {
        # Define the unit size and supported units.
        $unitSize = 1000;
        $units = ["", "K", "M", "B", "T"];
    
        # Calculate the number of units as the logarithm of the absolute value with the
        # unit size as base.
        $unitsCount = ($number === 0) ? 0 : floor(log(abs($number), $unitSize));
    
        # Decide the unit to be used based on the counter.
        $unit = $units[min($unitsCount, count($units) - 1)];
    
        # Divide the value by unit size in the power of the counter and round it to keep 
        # at most the given number of decimal digits.
        $value = round($number / pow($unitSize, $unitsCount), $decimals);
    
        # Assemble and return the string.
        return $value . $unit;
    }
}
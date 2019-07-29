<?php
/**
 * Created by PhpStorm.
 * User: ryanllewellyn
 * Date: 2019-07-13
 * Time: 17:20
 */

//class to find the longest Common Subsequence between 2 strings
class LCS
{

    /* This function recursively finds the longest common subsequence, no memoisation
     * due to the number of recursive function calls this method is non-optimal
     */
    function findLCS($str1, $str2) {

        //get length of both strings, cuts end as called repeatedly
        $str1sub = substr($str1, 0, ($this->getStrLen($str1)));
        $str2sub = substr($str2, 0, ($this->getStrLen($str2)));

        //check that both strings are non empty
        if (strlen($str1) == 0 || strlen($str2) == 0) {
            //if they're empty just return empty string
            return '';

            /* compare string characters at array point,
             * this compares characters in both strings backwards to find a match
             */
        } elseif ($str1[strlen($str1) - 1] == $str2[strlen($str2) - 1]) {

            //call function recursively, using cut values from earlier as arguments
            return $this->findLCS($str1sub,$str2sub) . $str1[strlen($str1) - 1];

            //no character match, pass cut values into function again
        } else {

            //pass uncut and cut strings into function and assign to variable
            $x = $this->findLCS($str1, $str2sub);
            $y = $this->findLCS($str1sub, $str2);

            //compare string lengths and return longest string of subsequence
            if (strlen($x) > strlen($y)) {
                return $x;
            } else {
                return $y;
            }

        }
    }

    /* This function also finds Longest Common Subsequence, however it does use Memoisation
     * It is thanks to this memoisation that runtime is significantly reduced compared to pure recursion.
     */
    function findLCSMEM($str1, $str2){

        //Array serves as our memoisation object
        static $memoArr = array();

        //check that both strings are non empty
        if (strlen($str1) == 0 || strlen($str2) == 0) {

            //if they're empty just return empty string
            return '';
        }

        //check that strings are present in memo array, if so returns them
        if (isset($memoArr[$str1][$str2])) {
            return $memoArr[$str1][$str2];
        }

        //get length of both strings, cuts end as called repeatedly
        $str1sub = substr($str1, 0, ($this->getStrLen($str1)));
        $str2sub = substr($str2, 0, ($this->getStrLen($str2)));

        /* compare string characters at array point,
         * this compares characters in both strings backwards to find a match
         */
        if ($str1[strlen($str1) - 1] == $str2[strlen($str2) - 1]) {

            //calls function again on cut strings as arguments
            $returnedVal = $this->findLCSMEM($str1sub, $str2sub);

            //assign returned values to the memoisation array
            $memoArr[$str1sub][$str2sub] = $returnedVal;

            //concatenate last char of str1 to returnedVal
            $returnedVal = $returnedVal . $str1[strlen($str1) - 1];

            //returns manipulated value
            return $returnedVal;


        } else {

            //pass uncut and cut strings into function and assign to memo array
            $x = $this->findLCSMEM($str1, $str2sub);
            $memoArr[$str1][$str2sub] = $x;

            $y = $this->findLCSMEM($str1sub, $str2);
            $memoArr[$str1sub][$str2] = $y;

            //compare string lengths and return longest string of subsequence
            if (strlen($x) > strlen($y)) {
                return $x;
            } else {
                return $y;
            }
        }
    }

    //This function simply returns the length of passed strings, negating 1 if positive
    function getStrLen($passVal) {

        //check that length of the string is not negative
        if (strlen($passVal) - 1 < 0) {
            return 0;

            //return string length - 1
        } else {
            return strlen($passVal) - 1;
        }
    }

}
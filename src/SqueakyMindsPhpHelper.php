<?php
/**
 * SqueakyMindsPhpHelper Helper Classes
 *
 * @package   SqueakyMindsPhpHelper
 * @link      https://github.com/btafoya/SqueakyMindsPhpHelper The SqueakyMindsPhpHelper GitHub project
 * @author    Brian Tafoya <btafoya@briantafoya.com>
 * @copyright 2001 - 2017, Brian Tafoya.
 * @license   MIT
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @category  SqueakyMindsPhpHelper_Library
 * @link      http://openwebpresence.com OpenWebPresence, SqueakyMindsPhpHelper
 *
 * Copyright (c) 2017, Brian Tafoya
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


/**
 * Class SqueakyMindsPhpHelper
 *
 * This class provides helper methods I have developed or acquired over the years.
 */
class SqueakyMindsPhpHelper
{


    /**
     * Return a 32 bit unique ID
     *
     * @method string uuid() Return a 32 bit unique ID
     * @access public
     * @return string 32 character unique ID.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function uuid()
    {
        return (string)md5(uniqid(rand()+MicroTime(), 1));
    }


    /**
     * Prevent undefined post variables
     *
     * @method string postvar() Prevent undefined post variables
     * @access public
     * @param $name
     * @param bool $isint
     * @return int|mixed|string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function postvar($name, $isint=false) 
    {
        if(!empty($_POST[$name]) && is_array($_POST[$name])) {
            return (array)$_POST[$name];
        }
        $response = (isset($_POST[$name])?filter_var($_POST[$name], FILTER_SANITIZE_STRING):"");
        return ((boolean)$isint?(int)$response:(string)$response);
    }


    /**
     * Prevent undefined get variables
     *
     * @method string getvar() Prevent undefined get variables
     * @access public
     * @param $name
     * @param bool $isint
     * @return int|mixed|string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function getvar($name, $isint=false) 
    {
        if(!empty($_GET[$name]) && is_array($_GET[$name])) {
            return (array)$_GET[$name];
        }
        $response = (isset($_GET[$name])?filter_var($_GET[$name], FILTER_SANITIZE_STRING):"");
        return ((boolean)$isint?(int)$response:(string)$response);
    }


    /**
     * Prevent undefined session variables
     *
     * @method string sessionvar() Prevent undefined session variables
     * @access public
     * @return mixed
     * @param  string  $name  $_SESSION variable key
     * @param  boolean $isint Response if an integer
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function sessionvar($name, $isint=false) 
    {
        if(!empty($_SESSION[$name]) && is_array($_SESSION[$name])) {
            return (array)$_SESSION[$name];
        }
        $response = (isset($_SESSION[$name])?$_SESSION[$name]:"");
        return ((boolean)$isint?(int)$response:(string)$response);
    }


    /**
     * Set session variables
     *
     * @method string setsessionvar()
     * @access public
     * @param  string  $name  $_SESSION variable key
     * @param  boolean $value $_SESSION variable value
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function setsessionvar($name, $value) 
    {
        $_SESSION[$name] = $value;
    }


    /**
     * Prevent undefined cookie variables
     *
     * @method string cookievar() Prevent undefined cookie variables
     * @access public
     * @param $name
     * @param bool $isint
     * @return array|int|string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function cookievar($name, $isint=false) 
    {
        if(!empty($_COOKIE[$name]) && is_array($_COOKIE[$name])) {
            return (array)$_COOKIE[$name];
        }
        $response = (isset($_COOKIE[$name])?$_COOKIE[$name]:"");
        return ((boolean)$isint?(int)$response:(string)$response);
    }


    /**
     * Prevent undefined server variables
     *
     * @method string servervar() Prevent undefined servervar variables
     * @access public
     * @param $name
     * @param bool $isint
     * @return array|int|string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function servervar($name, $isint=false)
    {
        if(!empty($_SERVER[$name]) && is_array($_SERVER[$name])) {
            return (array)$_SERVER[$name];
        }
        $response = (isset($_SERVER[$name])?$_SERVER[$name]:"");
        return ((boolean)$isint?(int)$response:(string)$response);
    }


    /**
     * Return getvar with a default when blank.
     *
     * @method getvar_default() Return getvar with a default is blank.
     * @access public
     * @return mixed
     * @param  string $field_name  $_GET variable key name.
     * @param  mixed  $default_val The default value returned in the event the $_GET variable is empty or does not exist.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function getvar_default($field_name, $default_val="") 
    {
        return (strlen(self::getvar($field_name))?self::getvar($field_name):$default_val);
    }


    /**
     * Return postvar with a default when blank.
     *
     * @method postvar_default() Return postvar with a default is blank.
     * @access public
     * @return mixed
     * @param  string $field_name  $_POST variable key name.
     * @param  mixed  $default_val The default value returned in the event the $_POST variable is empty or does not exist.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function postvar_default($field_name, $default_val="")
    {
        return (strlen(self::postvar($field_name))?self::postvar($field_name):$default_val);
    }


    /**
     * Return characters from the left
     *
     * @method string left() Return characters from the left.
     * @access public
     * @return string
     * @param  string $str                  String to truncate.
     * @param  int    $howManyCharsFromLeft Number of characters to the left of the string.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function left($str, $howManyCharsFromLeft)
    {
        return (string)substr($str, 0, (int)$howManyCharsFromLeft);
    }


    /**
     * Return characters from the right
     *
     * @method string right() Return characters from the right.
     * @access public
     * @return string
     * @param  string $str                   String to truncate.
     * @param  int    $howManyCharsFromRight Number of characters to the right of the string.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function right($str, $howManyCharsFromRight)
    {
        $strLen = strlen($str);
        return (string)substr($str, $strLen - $howManyCharsFromRight, $strLen);
    }


    /**
     * Return x many characters from the starting point
     *
     * @method string mid() Return x many characters from the starting point
     * @access public
     * @return string
     * @param  string $str          String to truncate.
     * @param  int    $start        Where to start from the left of the string.
     * @param  int    $howManyChars Number of characters to return.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function mid($str, $start, $howManyChars = 0)
    {
        $start--;
        if ((int)$howManyChars === 0) {
            $howManyChars = (int)strlen($str) - (int)$start;
        }

        return (string)substr($str, (int)$start, (int)$howManyChars);
    }


    /**
     * HTML Dump of string/array/etc.
     *
     * @method dump_simple_array() HTML Dump of string/array/etc.
     * @access public
     * @return string
     * @param  mixed  $array Data to dump.
     * @param  string $title Table title.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function dump_simple_array($array,$title="") 
    {
        $result = '<table cellpadding=5 cellspacing=1 bgcolor=#555555 style="color:#000000;">';
        if(strlen($title)) {
            $result .= '<tr><td nowrap bgcolor=#DEE3ED colspan=2><i>' . $title . '</i></td></tr>';
        }
        foreach($array as $key=>$value) {
            $result .= '<tr><td style="background-color: #eeeeee;"><span style="font-size: 10px; font-weight: bold;">' . $key . '</span></td>';
            $result .= '<td style="background-color: #ffffff;"><code>';
            if(is_array($value)) {
                $result .= self::dump_simple_array($value);
            } else {
                $result .= $value;
            }
            $result .= '</code></td>';
            $result .= '</tr>';
        }
        $result .= '</table>';
        return $result;
    }


    /**
     * Return truncated number.
     *
     * @method truncate() Return truncated number.
     * @access public
     * @return int
     * @param  int $num    Number to truncate.
     * @param  int $digits Number of digits to truncate.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function truncate($num, $digits = 0) 
    {
        $shift = pow(10, $digits);
        return ((floor($num * $shift)) / $shift);
    }


    /**
     * Return array stripslasshes recursive.
     *
     * @method multi_stripslashes() Return array stripslasshes recursive.
     * @access public
     * @param  callable $arr Input array.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function multi_stripslashes(&$arr) 
    {
        foreach($arr as $k => $v) {
            if (is_array($v)) {
                self::multi_stripslashes($arr[$k]);
            } else {
                $arr[$k] = stripslashes($v);
            }
        }
    }


    /**
     * Return roman numeral.
     *
     * @method numberToRoman() Return roman numeral.
     * @access public
     * @return string
     * @param  int $num Number to transform.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function numberToRoman($num)
    {
        // Make sure that we only use the integer portion of the value
        $numr = intval($num);
        $result = '';

        // Declare a lookup array that we will use to traverse the number:
        $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
            'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
            'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

        foreach ($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($numr / $value);

            // Store that many characters
            $result .= str_repeat($roman, $matches);

            // Substract that from the number
            $numr = $numr % $value;
        }

        // The Roman numeral should be built, return it
        return (string)$result;
    }


    /**
     * Return duration from seconds.
     *
     * @method duration() Return duration from seconds.
     * @access public
     * @return string
     * @param  int $secs Seconds value.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function duration($secs) 
    {
        $vals = array('w' => (int) ($secs / 86400 / 7),
            'd' => $secs / 86400 % 7,
            'h' => $secs / 3600 % 24,
            'm' => $secs / 60 % 60,
            's' => $secs % 60);

        $ret = array();

        $added = false;
        foreach ($vals as $k => $v) {
            if ($v > 0 || $added) {
                $added = true;
                $ret[] = $v . $k;
            }
        }

        return (string)join(' ', $ret);
    }


    /**
     * Return an array from an object.
     *
     * @method object2array() Return an array from an object.
     * @access public
     * @return array
     * @param  object $object Object to transform.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function object2array($object) 
    {
        return (array)json_decode((string)json_encode($object), true);
    }


    /**
     * Return an array from xml string.
     *
     * @method xml2array() Return an array from xml string.
     * @access public
     * @return array
     * @param  string $xmlstring XML to process.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function xml2array($xmlstring) 
    {
        $xml = simplexml_load_string($xmlstring);
        $json = json_encode($xml);
        return json_decode($json, true);
    }


    /**
     * Send header stuff that tells the browser not to cache this page.
     *
     * @method send_no_cache_header()
     * @access public
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function send_no_cache_header() 
    {
        header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }


    /**
     * Indents a flat JSON string to make it more human-readable.
     *
     * @method xml2array()
     * @access public
     * @param  string $json The original JSON string to process.
     * @return string Indented version of the original JSON string.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    function json_indent($json) 
    {

        $result      = '';
        $pos         = 0;
        $strLen      = strlen($json);
        $indentStr   = '  ';
        $newLine     = "\n";
        $prevChar    = '';
        $outOfQuotes = true;

        for ($i=0; $i<=$strLen; $i++) {

            // Grab the next character in the string.
            $char = substr($json, $i, 1);

            // Are we inside a quoted string?
            if ($char == '"' && $prevChar != '\\') {
                $outOfQuotes = !$outOfQuotes;

                // If this character is the end of an element,
                // output a new line and indent the next line.
            } else if(($char == '}' || $char == ']') && $outOfQuotes) {
                $result .= $newLine;
                $pos --;
                for ($j=0; $j<$pos; $j++) {
                    $result .= $indentStr;
                }
            }

            // Add the character to the result string.
            $result .= $char;

            // If the last character was the beginning of an element,
            // output a new line and indent the next line.
            if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    $pos ++;
                }

                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }

            $prevChar = $char;
        }

        return $result;
    }


    /**
     * Return the last array member.
     *
     * @method array_last() Return the last array member.
     * @access public
     * @param  array $array_val Array data.
     * @return array
     * @throws InvalidArgumentException Not array data.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function array_last($array_val) 
    {
        if(is_array($array_val)) {
            $tmp = $array_val;
            return array_pop($tmp);
        } else {
            throw new InvalidArgumentException("Invalid input data.", 10);
        }
    }


    /**
     * Return the first array member.
     *
     * @method array_first()
     * @access public
     * @param  array $array_val
     * @return array
     * @throws InvalidArgumentException Not array data.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function array_first($array_val) 
    {
        if(is_array($array_val)) {
            $tmp = $array_val;
            return array_shift($tmp);
        } else {
            throw new InvalidArgumentException("Invalid input data.", 10);
        }
    }


    /**
     * Return the requested url.
     *
     * @method requested_url()
     * @access public
     * @return string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function requested_url()
    {
        return (string)"http" . (self::servervar('HTTPS')?"s":"") . "://" . self::servervar('HTTP_HOST') . self::servervar('REQUEST_URI');
    }


    /**
     * Turn all URLs in clickable links.
     *
     * @method linkify($value, $protocols = "", array $attributes = array())
     * @access public
     * @param $value
     * @return string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static function linkify($value)
    {
        $linkify = new \Misd\Linkify\Linkify();
        return $linkify->process($value);
    }

    /**
     * Truncate a string.
     *
     * @method stringTruncate($string) Truncate a string.
     * @param  string $string The string to truncate.
     * @param  int    $limit  String length max.
     * @param  string $break  (optional) Break point, defauls to period.
     * @param  string $pad    (optional) String to append to the truncated string.
     * @return string Truncated string.
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function stringTruncate($string, $limit, $break=".", $pad="...") 
    {
        // return with no change if string is shorter than $limit
        if(strlen($string) <= $limit) { return $string;
        }

        // is $break present between $limit and the end of the string?
        if(false !== ($breakpoint = strpos($string, $break, $limit))) {
            if($breakpoint < strlen($string) - 1) {
                $string = substr($string, 0, $breakpoint) . $pad;
            }
        }

        return $string;
    }

    /**
     * Convert BR tags to PHP_EOL.
     *
     * @method br2nl($string) Convert BR tags to PHP_EOL.
     * @param  string $string The string to convert
     * @return string The converted string
     *
     * @author    Brian Tafoya
     * @copyright Copyright 2001 - 2017, Brian Tafoya.
     * @version   1.0
     */
    static public function br2nl( $string )     
    {
        return (string)preg_replace('/\<br(\s*)?\/?\>/i', PHP_EOL, $string);
    }
}

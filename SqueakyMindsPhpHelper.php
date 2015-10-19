<?php
/**
* SQUEAKYMINDS.COM Helper Classes
*
* Copyright (c) 2001-2015, Brian Tafoya
* 
* @package SqueakyMindsPhpHelper
* @link https://github.com/btafoya/SqueakyMindsPhpHelper The SqueakyMindsPhpHelper GitHub project
* @author Brian Tafoya <btafoya@briantafoya.com>
* @copyright 2001 - 2015, Brian Tafoya.
* @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
* @note This library is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/


class SqueakyMindsPhpHelper {
	
	private $sessionvariable;
	
	
    public function __construct() {
		$sessionvariable = $_SESSION;
    } 


	/**
	* Return a 32 bit unique ID
	*
	* @method string uuid()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function uuid(){
		return (string)md5(uniqid(rand()+MicroTime(),1));
	}

	
	/**
	* Prevent undefined post variables
	*
	* @method string postvar()
	* @access public
	* @return string or int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function postvar($name,$isint="") {
		$response = filter_input(INPUT_POST, $name, FILTER_SANITIZE_STRING);
		return ((int)$isint?(int)$response:(string)$response);
	}

	
	/**
	* Prevent undefined get variables
	*
	* @method string getvar()
	* @access public
	* @return string or int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function getvar($name,$isint="") {
		$response = filter_input(INPUT_GET, $name, FILTER_SANITIZE_STRING);
		return ((int)$isint?(int)$response:(string)$response);
	}
	
	
	/**
	* Prevent undefined session variables
	*
	* @method string sessionvar()
	* @access public
	* @return string or int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function sessionvar($name,$isint="") {
		$response = (isset($this->sessionvariable[$name])?$this->sessionvariable[$name]:"");
		return ((int)$isint?(int)$response:(string)$response);
	}
	
	
	/**
	* Set session variables
	*
	* @method string setsessionvar()
	* @access public
	* @return null
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function setsessionvar($name, $value) {
		$this->sessionvar[$name] = $value;
		$_SESSION[$name] = $value;
	}
	
	
	/**
	* Prevent undefined cookie variables
	*
	* @method string cookievar()
	* @access public
	* @return string or int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function cookievar($name,$isint="") {
		$response = filter_input(INPUT_COOKIE, $name, FILTER_SANITIZE_STRING);
		return ((int)$isint?(int)$response:(string)$response);
	}
	
	
	/**
	* Return getvar with a default is blank.
	*
	* @method getvar_default()
	* @access public
	* @return string or int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function getvar_default($field_name,$default_val="") {
		return (strlen($this->getvar($field_name))?$this->getvar($field_name):$default_val);
	}
	
	
	/**
	* Return characters from the left
	*
	* @method string left()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function left($str, $howManyCharsFromLeft){
		return (string)substr($str, 0, $howManyCharsFromLeft);
	}	
	
	
	/**
	* Return characters from the right
	*
	* @method string right()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function right($str, $howManyCharsFromRight){
		$strLen = strlen ($str);
		return (string)substr ($str, $strLen - $howManyCharsFromRight, $strLen);
	}
	
	
	/**
	* Return x many characters from the starting point
	*
	* @method string mid()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	public function mid($str, $start, $howManyChars = 0){
		$start--;
		if ($howManyChars === 0)
		$howManyChars = strlen ($str) - $start;
		
		return (string)substr($str, $start, $howManyChars);
	}
	
	
	/**
	* HTML Dump of string/array/etc.
	*
	* @method dump_simple_array()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function dump_simple_array($array,$title="") {
		$result = '<table cellpadding=5 cellspacing=1 bgcolor=#555555 style="color:#000000;">';
		if(strlen($title)) {
			$result .= '<tr><td nowrap bgcolor=#DEE3ED colspan=2><i>' . $title . '</i></td></tr>';
		}
		foreach($array as $key=>$value) {
			$result .= '<tr><td nowarap bgcolor=#eeeeee><span style="font-family: arial; font-size: 10pt; font-weight: bold;">' . $key . '</span></td>';
			$result .= '<td bgcolor=#ffffff><font face=arial size=3><code>';
			if(is_array($value)) {
				$result .= $this->dump_simple_array($value);
			} else {
				$result .= $value;
			}
			$result .= '</code></font></td>';
			$result .= '</tr>';
		}
		$result .= '</table>';
		return $result;
	}

	
	/**
	* Return truncated number.
	*
	* @method truncate()
	* @access public
	* @return int
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function truncate($num, $digits = 0) {
		$shift = pow(10, $digits);
		return ((floor($num * $shift)) / $shift);
	}
	
	
	/**
	* Return array stripslasshes recursive.
	*
	* @method multi_stripslashes()
	* @access public
	* @return array
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function multi_stripslashes(&$arr) {
		foreach($arr as $k => $v) {
			if (is_array($v))
			   $this->multi_stripslashes($arr[$k]);
			else
			   $arr[$k] = stripslashes($v);
		}
	}
	
	
	/**
	* Return roman numeral.
	*
	* @method numberToRoman()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function numberToRoman($num){
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
	* @method duration()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function duration($secs) { 
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
	
		return join(' ', $ret);
	}
	
	
	/**
	* Return an array from an object.
	*
	* @method object2array()
	* @access public
	* @return array
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function object2array($object) {
		return json_decode((string)json_encode($object), true);
	}
	
	
	/**
	* Return an array from xml string.
	*
	* @method xml2array()
	* @access public
	* @return array
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function xml2array($xml) {
		$xml = simplexml_load_string($xmlstring);
		$json = json_encode($xml);
		return json_decode($json, true);	
	}


	/**
	* Indents a flat JSON string to make it more human-readable.
	*
	* @method xml2array()
	* @access public
	* @param string $json The original JSON string to process.
	* @return string Indented version of the original JSON string.
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	function json_indent($json) {
	
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
	* @method array_last()
	* @access public
    * @param array $array_val
	* @return array
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function array_last($array_val) {
		if(is_array($array_val)) {
			$tmp = $array_val;
			return array_pop($tmp);
		}
	}
	
	
	/**
	* Return the first array member.
	*
	* @method array_first()
	* @access public
    * @param array $array_val
	* @return array
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function array_first($array_val) {
		if(is_array($array_val)) {
			$tmp = $array_val;
			return array_shift($tmp);
		}
	}
	
	
	/**
	* Return the requested url.
	*
	* @method requested_url()
	* @access public
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/	
	public function requested_url() {
		return (string)"http" . (filter_input(INPUT_COOKIE, 'HTTPS')?"s":"") . "://" . filter_input(INPUT_COOKIE, 'HTTP_HOST') . filter_input(INPUT_COOKIE, 'REQUEST_URI');
	}
	
	
	/**
	* Turn all URLs in clickable links.
	* 
	* @method linkify()
	* @access public
	* @param string $value
	* @param array  $protocols  http/https, ftp, mail, twitter
	* @param array  $attributes
	* @param string $mode       normal or all
	* @return string
	*
	* @author     Brian Tafoya
	* @copyright  Copyright 2001 - 2015, Brian Tafoya.
	* @version    1.0
	*/
	function linkify($value, $protocols = array('http', 'mail'), array $attributes = array()) {
		// Link attributes
		$attr = '';
		foreach ($attributes as $key => $val) {
			$attr = ' ' . $key . '="' . htmlentities($val) . '"';
		}
		
		$links = array();
		
		// Extract existing links and tags
		$value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);
		
		// Extract text links for each protocol
		foreach ((array)$protocols as $protocol) {
			switch ($protocol) {
				case 'http':
				case 'https':
					$value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3]; return '<' . array_push($links, "<a $attr href=\"$protocol://$link\">$link</a>") . '>'; }, $value);
				break;
				case 'mail':
					$value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value);
				break;
				case 'twitter':
					$value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value);
				break;
				default:
					$value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value);
				break;
			}
		}
		
		// Insert all link
		return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
	}

	public function stringTruncate($string, $limit, $break=".", $pad="...") {
		// return with no change if string is shorter than $limit
		if(strlen($string) <= $limit) return $string;

		// is $break present between $limit and the end of the string?
		if(false !== ($breakpoint = strpos($string, $break, $limit))) {
			if($breakpoint < strlen($string) - 1) {
			  $string = substr($string, 0, $breakpoint) . $pad;
			}
		}

		return $string;
	}
}

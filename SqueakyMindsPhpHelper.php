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
* @copyright 2003, The Fusebox Corporation. "This software consists of voluntary contributions made by many individuals on behalf of the Fusebox Corporation. For more information on Fusebox, please see <http://www.fusebox.org/>."
* @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
* @note This program is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/


class SqueakyMindsPhpHelper {
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
		$response = (isset($_POST[$name])?$_POST[$name]:"");
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
		$response = (isset($_GET[$name])?$_GET[$name]:"");
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
		$response = (isset($_SESSION[$name])?$_SESSION[$name]:"");
		return ((int)$isint?(int)$response:(string)$response);
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
		$response = (isset($_COOKIE[$name])?$_COOKIE[$name]:"");
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
	public function mid($str, $start, $howManyCharsToRetrieve = 0){
		$start--;
		if ($howManyCharsToRetrieve === 0)
		$howManyCharsToRetrieve = strlen ($str) - $start;
		
		return (string)substr($str, $start, $howManyCharsToRetrieve);
	}

	
	/**
	* ArrayToList
	*
	* @method ArrayToList()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ArrayToList($inArray, $inDelim = ",") {
		if(count($inArray)) {
			$outList = implode($inDelim, $inArray);
			return $outList;
		}
		return;
	}
	

	/**
	* ListAppend
	*
	* @method ListAppend()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListAppend($inList, $inValue, $inDelim = ",") {
		$aryList = _listFuncs_PrepListAsArray($inList, $inDelim);
		array_push($aryList, $inValue);
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListChangeDelims
	*
	* @method ListChangeDelims()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListChangeDelims($inList, $inNewDelim, $inDelim = ",") {
		$aryList = $this->_listFuncs_PrepListAsArray($inList, $inDelim);
		$outList = join($inNewDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListContains
	*
	* @method ListContains()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListContains($inList, $inSubstr, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outIndex = 0;
		$intCounter = 0;
		foreach($aryList as $item) {
			$intCounter++;
			if(preg_match("/" . preg_quote($inSubstr) . "/", $item)) {
				$outIndex = $intCounter;
				break;
			}
		}
		return $outIndex;
	}
	
	
	/**
	* ListContainsNoCase
	*
	* @method ListContainsNoCase()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListContainsNoCase($inList, $inSubstr, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outIndex = 0;
		$intCounter = 0;
		foreach($aryList as $item) {
			$intCounter++;
			if(preg_match("/" . preg_quote($inSubstr) . "/i", $item)) {
				$outIndex = $intCounter;
				break;
			}
		}
		return $outIndex;
	}
	
	
	/**
	* ListDeleteAt
	*
	* @method ListDeleteAt()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListDeleteAt($inList, $inPosition, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		array_splice($aryList, $inPosition-1, 1);
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListFind
	*
	* @method ListFind()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListFind($inList, $inSubstr, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outIndex = 0;
		$intCounter = 0;
		foreach($aryList as $item) {
			$intCounter++;
			if(preg_match("/^" . preg_quote($inSubstr, "/") . "$/", $item)) {
				$outIndex = $intCounter;
				break;
			}
		}
		return $outIndex;
	}
	
	
	/**
	* ListFindNoCase
	*
	* @method ListFindNoCase()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListFindNoCase($inList, $inSubstr, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outIndex = 0;
		$intCounter = 0;
		foreach($aryList as $item) {
			$intCounter++;
			if(preg_match("/^" . preg_quote($inSubstr, "/") . "$/i", $item)) {
				$outIndex = $intCounter;
				break;
			}
		}
		return $outIndex;
	}
	
	
	/**
	* ListFirst
	*
	* @method ListFirst()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListFirst($inList, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outItem = array_shift($aryList);
		return $outItem;
	}
	
	
	/**
	* ListGetAt
	*
	* @method ListGetAt()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListGetAt($inList, $inPosition, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outItem = $aryList[$inPosition-1];
		return $outItem;
	}
	
	
	/**
	* ListInsertAt
	*
	* @method ListInsertAt()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListInsertAt($inList, $inPosition, $inValue, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		if($inPosition < 1){ $inPosition = 1; }
		array_splice($aryList, $inPosition-1, 0, $inValue);
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListLast
	*
	* @method ListLast()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListLast($inList, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outItem = array_pop($aryList);
		return $outItem;
	}
	
	
	/**
	* ListLen
	*
	* @method ListLen()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListLen($inList, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outInt = (strlen($inList)>0)?count($aryList):0;
		return (int)$outInt;
	}
	
	
	/**
	* ListPrepend
	*
	* @method ListPrepend()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListPrepend($inList, $inValue, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		array_unshift($aryList, $inValue);
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListPrepend
	*
	* @method ListPrepend()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListQualify($inList, $inQualifier, $inDelim = ",") {
		$inCharAll = (func_num_args() == 4)?func_get_arg(3):"ALL";
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$intCounter = 0;
		foreach($aryList as $item) {
			if(strtoupper($inCharAll) == "ALL" || (strtoupper($inCharAll) == "CHAR" && preg_match("/\D/", $item))) {
				$aryList[$intCounter] = $inQualifier . $item . $inQualifier;
			}
			$intCounter++;
		}
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListRest
	*
	* @method ListRest()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListRest($inList, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		array_shift($aryList);
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListSetAt
	*
	* @method ListSetAt()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListSetAt($inList, $inPosition, $inValue, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$aryList[$inPosition-1] = $inValue;
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListSort
	*
	* @method ListSort()
	* @access public
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListSort($inList, $inSortType, $inSortOrder = "ASC") {
		//a bit buggy yet...
		$inDelim = (func_num_args() == 4)?func_get_arg(3):",";
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		if(strtoupper($inSortType) == "NUMERIC") {
			sort($aryList, "SORT_NUMERIC");
		} elseif(strtoupper($inSortType) == "TEXT") {
			sort($aryList, "SORT_REGULAR");
		} elseif(strtoupper($inSortType) == "TEXTNOCASE") {
			sort($aryList, "SORT_STRING");
		}
		if(strtoupper($inSortOrder) == "DESC") {
			array_reverse($aryList);
		}
		$outList = join($inDelim, $aryList);
		return $outList;
	}
	
	
	/**
	* ListToArray
	*
	* @method ListToArray()
	* @access public
	* @return array
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListToArray($inList, $inDelim = ",") {
		$outArray = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		return $outArray;
	}
	
	
	/**
	* ListValueCount
	*
	* @method ListValueCount()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListValueCount($inList, $inValue, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outInt = 0;
		foreach($aryList as $item) {
			if($item == $inValue){ $outInt++; }
		}
		return (int)$outInt;
	}
	
	
	/**
	* ListValueCountNoCase
	*
	* @method ListValueCountNoCase()
	* @access public
	* @return int
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/	
	public function ListValueCountNoCase($inList, $inValue, $inDelim = ",") {
		$aryList = $this->__listFuncs_PrepListAsArray($inList, $inDelim);
		$outInt = 0;
		foreach($aryList as $item) {
			if(strtolower($item) == strtolower($inValue)){ $outInt++; }
		}
		return (int)$outInt;
	}
	
	
	/**
	* _listFuncs_PrepListAsArray
	*
	* @method _listFuncs_PrepListAsArray()
	* @access private
	* @return array
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/
	private function _listFuncs_PrepListAsArray($inList, $inDelim) {
		$inList = trim($inList);
		$inList = preg_replace("/^" . preg_quote($inDelim, "/") . "+/", "", $inList);
		$inList = preg_replace("/" . preg_quote($inDelim, "/") . "+$/", "", $inList);
		$outArray = preg_split("/" . preg_quote($inDelim, "/") . "+/", $inList);
		if(count($outArray) == 1 && $outArray[0] == "") {
			$outArray = array();
		}
		return $outArray;
	}


	/**
	* _listFuncs_PrepListAsList
	*
	* @method _listFuncs_PrepListAsList()
	* @access private
	* @return string
	*
	* @author     The Fusebox Corporation.
	* @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
	* @version    1.0
	*/
	private function _listFuncs_PrepListAsList($inList, $inDelim) {
		$inList = trim($inList);
		$inList = preg_replace("/^" . preg_quote($inDelim, "/") . "+/", "", $inList);
		$inList = preg_replace("/" . preg_quote($inDelim, "/") . "+$/", "", $inList);
		$outList = preg_replace("/" . preg_quote($inDelim, "/") . "+/", $inDelim, $inList);
		return $outList;
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
		$n = intval($num);
		$result = '';
		
		// Declare a lookup array that we will use to traverse the number:
		$lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
		'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
		'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
		
		foreach ($lookup as $roman => $value){
			// Determine the number of matches
			$matches = intval($n / $value);
			
			// Store that many characters
			$result .= str_repeat($roman, $matches);
			
			// Substract that from the number
			$n = $n % $value;
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
		return (string)"http" . ($_SERVER['HTTPS']?"s":"") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
}

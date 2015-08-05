<?php
/**
* SQUEAKYMINDS.COM Helper Classes
*
* Copyright (c) 2001-2015, Brian Tafoya
* 
* @package SqueakyMindsPhpHelper_lists
* @link https://github.com/btafoya/SqueakyMindsPhpHelper The SqueakyMindsPhpHelper GitHub project
* @author Brian Tafoya <btafoya@briantafoya.com>
* @copyright 2001 - 2015, Brian Tafoya.
* @copyright 2003, The Fusebox Corporation. "This software consists of voluntary contributions made by many individuals on behalf of the Fusebox Corporation. For more information on Fusebox, please see <http://www.fusebox.org/>."
* @license http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
* @note This brary is distributed in the hope that it will be useful - WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/


class SqueakyMindsPhpHelper_lists {	
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
}
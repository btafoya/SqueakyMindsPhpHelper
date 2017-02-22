<?php
/**
 * SqueakyMindsPhpHelper Helper Classes
 *
 * @package   SqueakyMindsPhpHelper_lists
 * @link      https://github.com/btafoya/SqueakyMindsPhpHelper_lists The SqueakyMindsPhpHelper GitHub project
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
/*
 * Original core methods replicated from Fusebox Software, 2003.
 *
 * Fusebox Software License
 * Version 1.0
 *
 * Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 *
 * 2. Redistributions in binary form or otherwise encrypted form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 *
 * 3. The end-user documentation included with the redistribution, if any, must include the following acknowledgment:
 *
 * "This product includes software developed by the Fusebox Corporation (http://www.fusebox.org/)."
 *
 * Alternately, this acknowledgment may appear in the software itself, if and wherever such third-party acknowledgments normally appear.
 *
 * 4. The names "Fusebox" and "Fusebox Corporation" must not be used to endorse or promote products derived from this software without prior written (non-electronic) permission. For written permission, please contact fusebox@fusebox.org.
 *
 * 5. Products derived from this software may not be called "Fusebox", nor may "Fusebox" appear in their name, without prior written (non-electronic) permission of the Fusebox Corporation. For written permission, please contact fusebox@fusebox.org.
 *
 * If one or more of the above conditions are violated, then this license is immediately revoked and can be re-instated only upon prior written authorization of the Fusebox Corporation.
 *
 * THIS SOFTWARE IS PROVIDED "AS IS" AND ANY EXPRESSED OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE FUSEBOX CORPORATION OR ITS CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * -------------------------------------------------------------------------------
 *
 * This software consists of voluntary contributions made by many individuals on behalf of the Fusebox Corporation. For more information on Fusebox, please see <http://www.fusebox.org/>.
*/

class SqueakyMindsPhpHelper_lists {
    /**
     * ArrayToList
     *
     * @method ArrayToList()
     * @access     public
     * @return string
     *
     * @param  array $inArray Single dimension array data to convert to a list.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ArrayToList ($inArray, $inDelim = ",") {
        if (count ($inArray)) {
            $outList = implode ($inDelim, $inArray);

            return $outList;
        }

        return "";
    }


    /**
     * ListAppend
     *
     * @method ListAppend()
     * @access     public
     * @return string
     *
     * @param string $inList  List string.
     * @param string $inValue List item to append.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListAppend ($inList, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        array_push ($aryList, $inValue);
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListChangeDelims
     *
     * @method ListChangeDelims()
     * @access     public
     * @return string
     *
     * @param string $inList     List string.
     * @param string $inNewDelim New list delimiter.
     * @param string $inDelim    (Optional) Old list delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListChangeDelims ($inList, $inNewDelim, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outList = join ($inNewDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListDeleteAt
     *
     * @method ListDeleteAt()
     * @access     public
     * @return string
     *
     * @param string $inList     List to modify.
     * @param int    $inPosition List item to remove.
     * @param string $inDelim    (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListDeleteAt ($inList, $inPosition, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        array_splice ($aryList, $inPosition - 1, 1);
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListFind
     *
     * @method ListFind()
     * @access     public
     * @return int
     *
     * @param string $inList   List to modify.
     * @param string $inSubstr List item to find.
     * @param string $inDelim  (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListFind ($inList, $inSubstr, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outIndex = 0;
        $intCounter = 0;
        foreach ($aryList as $item) {
            $intCounter++;
            if (preg_match ("/^" . preg_quote ($inSubstr, "/") . "$/i", $item)) {
                $outIndex = $intCounter;
                break;
            }
        }

        return (int)$outIndex;
    }


    /**
     * ListFirst
     *
     * @method ListFirst()
     * @access     public
     * @return string
     *
     * @param string $inList  List to modify.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListFirst ($inList, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outItem = array_shift ($aryList);

        return (string)$outItem;
    }


    /**
     * ListGetAt
     *
     * @method ListGetAt()
     * @access     public
     * @return string
     *
     * @param string $inList     List to modify.
     * @param int    $inPosition List position to retrieve.
     * @param string $inDelim    (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListGetAt ($inList, $inPosition, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outItem = $aryList[$inPosition - 1];

        return (string)$outItem;
    }


    /**
     * ListInsertAt
     *
     * @method ListInsertAt()
     * @access     public
     * @return string
     *
     * @param string $inList     List to modify.
     * @param int    $inPosition List position to insert at.
     * @param string $inValue    List value to insert.
     * @param string $inDelim    (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListInsertAt ($inList, $inPosition, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        if ($inPosition < 1) {
            $inPosition = 1;
        }
        array_splice ($aryList, $inPosition - 1, 0, $inValue);
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListLast
     *
     * @method ListLast()
     * @access     public
     * @return string
     *
     * @param string $inList  List to modify.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListLast ($inList, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outItem = array_pop ($aryList);

        return (string)$outItem;
    }


    /**
     * ListLen
     *
     * @method ListLen()
     * @access     public
     * @return int
     *
     * @param string $inList  List to modify.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListLen ($inList, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outInt = (strlen ($inList) > 0) ? count ($aryList) : 0;

        return (int)$outInt;
    }


    /**
     * ListPrepend
     *
     * @method ListPrepend()
     * @access     public
     * @return string
     *
     * @param string $inList  List to modify.
     * @param string $inValue List value to prepend.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListPrepend ($inList, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        array_unshift ($aryList, $inValue);
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListQualify
     *
     * @method ListQualify()
     * @access     public
     * @return string
     *
     * @param string $inList      List to modify.
     * @param string $inQualifier Qualifier.
     * @param string $inDelim     (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListQualify ($inList, $inQualifier, $inDelim = ",") {
        $inCharAll = (func_num_args () == 4) ? func_get_arg (3) : "ALL";
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $intCounter = 0;
        foreach ($aryList as $item) {
            if (strtoupper ($inCharAll) == "ALL" || (strtoupper ($inCharAll) == "CHAR" && preg_match ("/\D/", $item))) {
                $aryList[$intCounter] = $inQualifier . $item . $inQualifier;
            }
            $intCounter++;
        }
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListRest
     *
     * @method ListRest()
     * @access     public
     * @return string
     *
     * @param string $inList  List to modify.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListRest ($inList, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        array_shift ($aryList);
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListSetAt
     *
     * @method ListSetAt()
     * @access     public
     * @return string
     *
     * @param string $inList     List to modify.
     * @param string $inPosition List position modify.
     * @param string $inValue    List value to set.
     * @param string $inDelim    (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListSetAt ($inList, $inPosition, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $aryList[$inPosition - 1] = $inValue;
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListSort
     *
     * @method ListSort()
     * @access     public
     * @return string
     *
     * @param string $inList      List to modify.
     * @param string $inSortType  List sort type. NUMERIC, TEXT, TEXTNOCASE
     * @param string $inSortOrder (Optional) List sort order.
     * @param string $inDelim     (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListSort ($inList, $inSortType, $inSortOrder = "ASC", $inDelim = ",") {
        $inDelim = (func_num_args () == 4) ? func_get_arg (3) : ",";
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        if (strtoupper ($inSortType) == "NUMERIC") {
            sort ($aryList, "SORT_NUMERIC");
        } elseif (strtoupper ($inSortType) == "TEXT") {
            sort ($aryList, "SORT_REGULAR");
        } elseif (strtoupper ($inSortType) == "TEXTNOCASE") {
            sort ($aryList, "SORT_STRING");
        }
        if (strtoupper ($inSortOrder) == "DESC") {
            array_reverse ($aryList);
        }
        $outList = join ($inDelim, $aryList);

        return (string)$outList;
    }


    /**
     * ListToArray
     *
     * @method ListToArray()
     * @access     public
     * @return array
     *
     * @param string $inList  List to modify.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListToArray ($inList, $inDelim = ",") {
        return (array)self::listFuncs_PrepListAsArray ($inList, $inDelim);
    }


    /**
     * ListValueCount
     *
     * @method ListValueCount()
     * @access     public
     * @return int
     *
     * @param string $inList  List to modify.
     * @param string $inValue List item to find.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListValueCount ($inList, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outInt = 0;
        foreach ($aryList as $item) {
            if ($item == $inValue) {
                $outInt++;
            }
        }

        return (int)$outInt;
    }


    /**
     * ListValueCountNoCase
     *
     * @method ListValueCountNoCase()
     * @access     public
     * @return int
     *
     * @param string $inList  List to modify.
     * @param string $inValue List item to find.
     * @param string $inDelim (Optional) List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function ListValueCountNoCase ($inList, $inValue, $inDelim = ",") {
        $aryList = self::listFuncs_PrepListAsArray ($inList, $inDelim);
        $outInt = 0;
        foreach ($aryList as $item) {
            if (strtolower ($item) == strtolower ($inValue)) {
                $outInt++;
            }
        }

        return (int)$outInt;
    }


    /**
     * listFuncs_PrepListAsArray
     *
     * @method listFuncs_PrepListAsArray()
     * @access     private
     * @return array
     *
     * @param string $inList  List to modify.
     * @param string $inDelim List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    private function listFuncs_PrepListAsArray ($inList, $inDelim) {
        $inList = trim ($inList);
        $inList = preg_replace ("/^" . preg_quote ($inDelim, "/") . "+/", "", $inList);
        $inList = preg_replace ("/" . preg_quote ($inDelim, "/") . "+$/", "", $inList);
        $outArray = preg_split ("/" . preg_quote ($inDelim, "/") . "+/", $inList);
        if (count ($outArray) == 1 && $outArray[0] == "") {
            $outArray = array();
        }

        return (array)$outArray;
    }


    /**
     * PrepListAsList
     *
     * @method PrepListAsList()
     * @access     public
     * @return string
     *
     * @param string $inList  List to modify.
     * @param string $inDelim List delimiter.
     *
     * @author     The Fusebox Corporation.
     * @copyright  Copyright (c) 2003 The Fusebox Corporation. All rights reserved.
     * @version    1.0
     */
    static public function PrepListAsList ($inList, $inDelim) {
        $inList = trim ($inList);
        $inList = preg_replace ("/^" . preg_quote ($inDelim, "/") . "+/", "", $inList);
        $inList = preg_replace ("/" . preg_quote ($inDelim, "/") . "+$/", "", $inList);
        $outList = preg_replace ("/" . preg_quote ($inDelim, "/") . "+/", $inDelim, $inList);

        return (string)$outList;
    }
}

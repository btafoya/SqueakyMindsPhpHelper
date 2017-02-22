<?php
/**
 * SqueakyMindsPhpHelper Helper Classes Unit Test
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

use PHPUnit\Framework\TestCase;

if (!isset($_SESSION)) $_SESSION = array();

class SqueakyMindsPhpHelper_test extends TestCase
{

    public static $shared_session = array();

    protected function setUp()
    {
        $_SESSION = SqueakyMindsPhpHelper_test::$shared_session;
        $_SESSION["userID"] = 1;
    }

    public function tearDown()
    {
        SqueakyMindsPhpHelper_test::$shared_session = $_SESSION;
    }

    /**
     * @covers SqueakyMindsPhpHelper::uuid()
     */
    public function testUuid()
    {
        $this->assertEquals(
            32,
            strlen(SqueakyMindsPhpHelper::uuid())
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::postvar()
     */
    public function testPostVar()
    {
        $this->assertEquals(
            $_POST["q"],
            SqueakyMindsPhpHelper::postvar("q")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::getvar()
     */
    public function testGetVar()
    {
        $this->assertEquals(
            $_GET["action"],
            SqueakyMindsPhpHelper::getvar("action")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::sessionvar()
     */
    public function testSessionVar()
    {
        $this->assertEquals(
            $_SESSION["userID"],
            SqueakyMindsPhpHelper::sessionvar("userID")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::setsessionvar()
     */
    public function testSetSessionVar()
    {
        $new_userID = 2;

        SqueakyMindsPhpHelper::setsessionvar("userID", $new_userID);

        $this->assertEquals(
            $new_userID,
            $_SESSION["userID"]
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::cookievar()
     */
    public function testCookieVar()
    {
        $this->assertEquals(
            $_COOKIE["mycookie"],
            SqueakyMindsPhpHelper::cookievar("mycookie")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::getvar_default()
     */
    public function testGetVarDefault()
    {
        $this->assertEquals(
            "idontexist",
            SqueakyMindsPhpHelper::getvar_default("somegetvar", "idontexist")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::postvar_default()
     */
    public function testPostVarDefault()
    {
        $this->assertEquals(
            "idontexistpost",
            SqueakyMindsPhpHelper::postvar_default("somepostvar", "idontexistpost")
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::left()
     */
    public function testLeft()
    {
        $this->assertEquals(
            "123456",
            SqueakyMindsPhpHelper::left("123456789", 6)
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::right()
     */
    public function testRight()
    {
        $this->assertEquals(
            "456789",
            SqueakyMindsPhpHelper::right("123456789", 6)
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::mid()
     */
    public function testMid()
    {
        $this->assertEquals(
            "345",
            SqueakyMindsPhpHelper::mid("123456789", 3, 3)
        );
    }

    /**
     * @covers SqueakyMindsPhpHelper::requested_url()
     */
    public function testRequested_url()
    {
        $this->assertEquals(
            "https://www.SqueakyMindsPhpHelper.com?action=ajax",
            SqueakyMindsPhpHelper::requested_url()
        );
    }
}

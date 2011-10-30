<?php
require_once("HARTestCase.php");

/**
 * Check custom time stamps generated by console.timeStamp() method.
 */ 
class HAR_TestEmbeddedPreview extends HAR_TestCase
{
    public function testEmbeddedPreview()
    {
        print "\ntestEmbeddedPreview.php";

        $viewer_base = $GLOBALS["harviewer_base"];
        $test_base = $GLOBALS["test_base"];

        $this->open($GLOBALS["test_base"]."tests/testEmbeddedPreview.html");

        $document = "selenium.browserbot.getCurrentWindow().document.";

        $this->waitForCondition($document."querySelectorAll('iframe').length == 3", 10000);
        $this->waitForCondition($document."querySelector('#preview1').firstChild.contentDocument.querySelectorAll('.pageTable').length == 1", 10000);
        $this->waitForCondition($document."querySelector('#preview2').firstChild.contentDocument.querySelectorAll('.pageTable').length == 1", 10000);
        $this->waitForCondition($document."querySelector('#preview3').firstChild.contentDocument.querySelectorAll('.pageTable').length == 1", 10000);

        $script1 = $document."querySelector('#preview1').firstChild.contentDocument.querySelectorAll('.netRow').length";
        $this->assertEquals("2", $this->getEval($script1));

        $script2 = $document."querySelector('#preview2').firstChild.contentDocument.querySelectorAll('.netRow').length";
        $this->assertEquals("2", $this->getEval($script2));

        $script3 = $document."querySelector('#preview3').firstChild.contentDocument.querySelectorAll('.netRow').length";
        $this->assertEquals("11", $this->getEval($script3));

        $script4 = $document."querySelector('#preview2').firstChild.clientWidth";
        $this->assertEquals("400", $this->getEval($script4));

        $script5 = $document."querySelector('#preview2').firstChild.clientHeight";
        $this->assertEquals("50", $this->getEval($script5));
    }
}
?>

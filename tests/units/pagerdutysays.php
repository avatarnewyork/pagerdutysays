<?php
namespace avatarnewyork\pagerdutysayswebhook\tests\units;
require_once 'tests/mageekguy.atoum.phar';

include 'classes/pagerdutysays.php';

use \mageekguy\atoum;
use \avatarnewyork\pagerdutysayswebhook;

class PagerDutySays extends atoum\test{

  private $_subject_str = "45645";
  
  /**
   * Test should return true if it successfully restrieves the intended subject from trigger json
   * and returns empty string for multi json
   */
  public function test__contruct(){
    $json_single = file_get_contents("tests/units/pdwebhook_trigger.json");
    $json_multi = file_get_contents("tests/units/pdwebhook_multi.json");
    $pds_single = new pagerdutysayswebhook\PagerDutySays($json_single);
    $pds_multi = new pagerdutysayswebhook\PagerDutySays($json_multi);
    
    $this
      ->string($pds_single->get())->isEqualTo($this->_subject_str)
      ->string($pds_multi->get())->isEqualTo("")
    ;
  }  
}
?>
<?php
/**
 * pagerdutysays catches a PagerDuty webhook and sends the event description 
 * to a Text To Speach Program.
 *
 * Requires: 
 * - Mac OS 10.8.5, 10.9 
 * - PHP 5.3+ (comes with mac osx) 
 * - say (Speech Synthesis Manager - comes with mac osx)
 * - Apache 2.x (optional)
 * - PagerDuty Account with appropriate privledges
 *  
 * References: 
 * - GitHub Projet: https://github.com/avatarnewyork/pagerdutysays
 * - PagerDuty Webhook API: http://developer.pagerduty.com/documentation/rest/webhooks
 * - Avatar New York Workshop: http://workshop.avatarnewyork.com
 */

/**
 *  EDIT CONFIGURATION BELOW 
 */


/**
 * END OF CONFIGURATION
 */

namespace avatarnewyork\pagerdutysayswebhook;

class PagerDutySays {

  private $_tts = "/usr/bin/say";         // Text to speach program
  private $_tts_options = "-r 160";       // Text to speach program options
  private $_tts_airplay_enabled = false;  // Optional - true will send tts to AirPlay device
  private $_tts_command;
  private $_subject = "";

  public function __construct($json){
    $pagerduty = json_decode($json); 
    $this->_buildTTS();

    if ($pagerduty){
      $messages = $pagerduty->messages;
      // We only want the first instance of a incident.trigger alert - no followups
      if (sizeof($messages) == 1){  
	$webhook = $messages[0];
	if(! strcmp($webhook->type, "incident.trigger")){
	  $this->_subject = $webhook->data->incident->trigger_summary_data->subject;
	}
      }
    } 
  }
  
  public function enableAirPlay($airplay_enabled){
    $this->_tts_airplay_enabled = $airplay_enabled;
    $this->_buildTTS();
  }
  
  public function say(){
    passthru($this->_tts_command.' "'.$this->_subject.'"');
  }
  
  public function get(){
    return $this->_subject;
  }

  private function _buildTTS(){
    $this->_tts_command = $this->_tts . ' ' . $this->_tts_options;
    if($this->_tts_airplay_enabled){
      $this->_tts_command .= '-a "AirPlay" ';
    }  
  }
}

?>

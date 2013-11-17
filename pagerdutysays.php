<?php
// Edit below Configuration Options

$tts = "/usr/bin/say";      // Text to speach program
$tts_options = " -r 160";   // Text to speach program options

// End of Configuration

$pagerduty = json_decode($HTTP_RAW_POST_DATA); // alternately, try file_get_contents('php://input');

if ($pagerduty){
  $messages = $pagerduty->messages;
  
  // We only want the first instance of a triggered alert - no followups
  if (sizeof($messages) == 1){    
    $webhook = $messages[0];
    $subject = $webhook->data->incident->trigger_summary_data->subject;
    passthru($tts.$tts_options.' "'.$subject.'"');
  }
}

?>

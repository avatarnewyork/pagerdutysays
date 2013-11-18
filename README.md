pagerdutysays
=============

## Description
PagerDutySays catches a PagerDuty webhook (triggered incident) and sends the event description to a Text To Speech Program.

## Requires 
* Mac OS 10.8.5, 10.9 
* PHP 5.3+ (comes with mac osx) 
* say (Speech Synthesis Manager - comes with mac osx)
* Apache 2.x (optional)
* PagerDuty Account with appropriate privledges
  
## Installation for Mac OSX 10.9
1. setup your webserver and ensure you can receive requests: http://brianflove.com/2013/10/23/os-x-mavericks-and-apache/
2. clone `git@github.com:avatarnewyork/pagerdutysays.git` into your webroot
3. make sure pagerdutysays directory has proper permissions (you can verify this by making a request to index.php.  If successful, you should see a `200` status in your access log
4. Login to PagerDuty
5. Goto Services and click on the service you wish to be notified on
6. Click `Add a webhook` button
7. Type in the name 'pagerdutysays' and enter the URL or IP of your webserver followed by `/pagerdutysays/index.php`.  __(for example: http://mymac.mydomain.com/pagerdutysays/index.php)__
8. Bump up the volume!

## Caveats
**There is NO built-in security**.  This script is highly insecure as it executes the `say` program on your Mac, please treat it as such.  It's highly recommended you ensure you have setup proper restrictions and firewall settings on your server.  Ensure only pagerduty has access to this URL after you have verified it works.

## References 
* GitHub Projet: https://github.com/avatarnewyork/pagerdutysays
* PagerDuty Webhook API: http://developer.pagerduty.com/documentation/rest/webhooks
* Setup Apache / PHP on OSX Mavericks: http://brianflove.com/2013/10/23/os-x-mavericks-and-apache/
* Runscope for testing webhooks: https://www.runscope.com/
* Avatar New York Workshop: http://workshop.avatarnewyork.com


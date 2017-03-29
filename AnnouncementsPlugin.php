<?php
/**
 * @package Announcements
 */

class AnnouncementsPlugin extends Omeka_Plugin_AbstractPlugin
{
	protected $_hooks = array(
    "admin_head",
    // "admin_dashboard"
  );
	function getJsonUrl() {
		$config = new Zend_Config_Ini(dirname(__FILE__)."/config.ini");
		return $config->json_url;
	}
  function hookAdminHead($view){
		$announcements = json_decode(file_get_contents($this->getJsonUrl()));
		debug($announcements->start);
		$start = new DateTime($announcements->start);
		$end = new DateTime($announcements->end);
		$now = new DateTime('NOW');
		if ($now > $start && $now < $end) {
			queue_css_file("announcements");
	    queue_js_file("announcements");
			queue_js_string("announcements = ".json_encode($announcements).";");
		}

  }
  // function hookAdminDashboard($view){
  //   echo "<section class='announcement'>This is a test</section>";
  // }
}
?>

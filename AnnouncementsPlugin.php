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

  function hookAdminHead($view){
		$announcements = json_decode(file_get_contents('http://dighist.fas.harvard.edu/announcement.json'));
    queue_css_file("announcements");
    queue_js_file("announcements");
		queue_js_string("announcements = ".json_encode($announcements).";");
  }
  // function hookAdminDashboard($view){
  //   echo "<section class='announcement'>This is a test</section>";
  // }
}
?>

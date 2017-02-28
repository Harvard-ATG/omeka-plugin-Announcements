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
    queue_css_file("announcements");
    queue_js_file("announcements");
  }
  // function hookAdminDashboard($view){
  //   echo "<section class='announcement'>This is a test</section>";
  // }
}
?>

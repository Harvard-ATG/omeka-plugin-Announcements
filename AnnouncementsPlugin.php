<?php
/**
 * @package Announcements
 *
 * Displays a banner announcement to authenticated users on the admin page.
 *
 * The config.ini should contain a "json_url" pointing to a JSON document
 * that looks something like this:
 *
 * {
 *   text: "This site will be undergoing maintenance from 3pm to 4pm today.",
 *   start: "2017-04-11T00:00:00Z",
 *   end: "2017-04-11T23:00:00Z",
 *   color: "#f9c83d"
 * }
 *
 * Required fields: text, start, end
 * Optional fields: color
 */

class AnnouncementsPlugin extends Omeka_Plugin_AbstractPlugin
{
  protected $_hooks = array(
    "admin_head"
  );

  function getConfig() {
    return new Zend_Config_Ini(dirname(__FILE__)."/config.ini", APPLICATION_ENV);
  }

  function loadData() {
    $config = $this->getConfig();
    $contents = file_get_contents($config->json_url);
    if ($contents === FALSE) {
      debug("No content fetched for announcement url: $url");
      debug("HTTP response headers: ".var_export($http_response_header, 1));
      return FALSE;
    }

    $data = json_decode($contents);
    if (is_null($data)) {
      debug("Error decoding announcement JSON from string: $contents");
      return FALSE;
    }
    debug("Loaded announcement data: ".var_export($data,1));

    return $data;
  }

  function hookAdminHead($view){
    $data = $this->loadData();
    if ($data === FALSE) {
      return;
    }

    $start = new DateTime($data->start);
    $end = new DateTime($data->end);
    $now = new DateTime('NOW');
    if ($now > $start && $now < $end) {
      queue_css_file("announcements");
      queue_js_file("announcements");
      queue_js_string("window.queue_announcement(".json_encode($data, JSON_PRETTY_PRINT).");");
    }
  }
}

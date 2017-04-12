(function($) {
  /**
   * Holds the current announcement object.
   */
  var announcement = {};

  /**
   * Renders an announcement item as a div element.
   */
  function render(data) {
    data = data || {};
    var div = document.createElement('div');
    div.id = 'announcement';
    div.innerHTML = data.text || '';
    if ('color' in data) {
      div.style = 'background-color: ' + data.color + ';';
    }
    return div;
  }

  /**
   * Displays the announcement when the page is ready.
   */
  $(document).ready(function() {
    var div = render(announcement);
    $('body').prepend(div);
  });

  /**
   * Export function so it's available on the window object.
   * Intended for use by the plugin hook.
   */
  window.queue_announcement = function(data) {
    announcement = data;
    if(console && console.log) {
      console.log("Queued announcement:", announcement);
    }
  };

})(jQuery);

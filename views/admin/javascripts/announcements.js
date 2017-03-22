jQuery(document).ready(function() {
  if ('color' in announcements) {
    divtag = "<div id='announcement' style='background-color:"+announcements.color+"'>";
  } else {
    divtag = "<div id='announcement'>"
  }
    jQuery("body").prepend(divtag+announcements.text+"</div>");
  }
);

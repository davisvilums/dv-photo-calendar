(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
  $(function() {
    $('.dv_cal_upload').on('click', function(){
      var dv_cell = this;
      var dv_date = $(dv_cell).data("date");
      var image = wp.media({
        title: "Upload Daily image",
        multiple: false
      }).open().on("select", function(){
        var files = image.state().get("selection");
        var jsonFiles = files.toJSON();
        $(dv_cell).parent().css("background-image", "url(" + jsonFiles[0].url + ")")
          .find("button").remove();
        submit_dv_image(dv_date, jsonFiles[0].id);
      })
    });
  });
})( jQuery );

function submit_dv_image(date, image){
  console.log(dv_photo_ajax_url,date, image);
  var data = {
    date: date,
    image: image,
    action: "boiler_request",
    param: "save_date"
  };
  var serialized = $.param(data);
  $.post(dv_photo_ajax_url, $.param(data), function(response) {
    console.log(response);
  });
}
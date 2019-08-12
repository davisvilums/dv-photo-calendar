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
    $('#dv_photo_calendar').on('click', '.dv_cal_upload', function(){
      var dv_cell = this;
      var dv_date = $(dv_cell).closest("td").data("date");
      var image = wp.media({
        title: "Upload Daily image",
        multiple: false
      }).open().on("select", function(){
        var files = image.state().get("selection");
        var jsonFiles = files.toJSON();
        $(dv_cell).css("background-image", "url(" + jsonFiles[0].url + ")")
          .find(".upload-text").remove();
        submit_dv_image(dv_date, jsonFiles[0].id);
      })
    });
  });

  $( window ).load(function() {
    $( ".dv_sheet" ).liveDraggable({ revert: "invalid" });

    $( ".dv_sheet" ).parent().droppable({
      classes: {
        "ui-droppable-active": "ui-state-active",
        "ui-droppable-hover": "ui-state-hover"
      },
      drop: function( event, ui ) {
        var $parent = $(ui.draggable).parent();
        var oid = $(ui.draggable).data("id");
        var nid = $(this).find('.dv_sheet').data("id");
        var odate = $parent.data("date");
        var ndate = $(this).data("date");
        $parent.append($(this).html()).find('.dv_date').html(odate);

        if(nid !== undefined) changDate(nid, odate);
        if(oid !== undefined) changDate(oid, ndate);
        $(this).html('');
        $(ui.draggable).detach().css({top: 0,left: 0, width: "100%", height: "100%"}).appendTo(this);
        $(this).find('.dv_date').html($(this).data("date"));
      }
    });
  });


   $.fn.liveDraggable = function (opts) {
      this.live("mouseover", function() {
         if (!$(this).data("init")) {
            $(this).data("init", true).draggable(opts);
         }
      });
      return this;
   };

})( jQuery );

function submit_dv_image(date, image){
  // console.log(dv_photo_ajax_url,date, image);
  var data = {
    date: date,
    image: image,
    action: "boiler_request",
    param: "save_date"
  };
  $.post(dv_photo_ajax_url, $.param(data), function(response) {
    // console.log(response);
  });
}

function changDate(id, date) {
  var data = {
    date: date,
    id: id,
    action: "boiler_request",
    param: "change_date"
  };
  $.post(dv_photo_ajax_url, $.param(data), function(response) {
    // console.log(response);
  });
}
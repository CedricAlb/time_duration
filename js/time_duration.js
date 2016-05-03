/**
 * @file
 * Javascript for Field Time Duration.
 */

/**
 * Provides a spinner for fancier widget.
 */
(function ($) {
  Drupal.behaviors.time_duration_set = {
    attach: function () {

//////////////////////////////////////////////////
    function InitSpinner(what){
        
        var duration =  $("#time_duration").val().split(":");
        var hours = parseInt(duration[0]);
        var minutes=parseInt(duration[1]);
                
        if(duration.length>1){
        if (hours   < 10) {hours   = "0"+hours;}
        if (minutes < 10) {minutes = "0"+minutes;}
	    } else {
			minutes = hours   = "00";
		}

        if (what=="hours") return hours; else return minutes;
        };

/////////////////////////////////////////////////
    function SetDurationTime(){
    var hours = parseInt($("#hours").spinner( "value" ));
    var minutes=parseInt($('#minutes').spinner( "value" ));
    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    
    $("#time_duration").val(hours+':'+minutes)

    };

//////////////////////////////////////////////   
   $("#hours").spinner({
         numberFormat: 'd2',
         min: 0,
         max: 24,
         change: function( event, ui ) {
                              SetDurationTime(); 
             }
         }).val(InitSpinner("hours"));
         
   $('#minutes').spinner({
         numberFormat: 'd2',
         spin: function (event, ui) {
             if (ui.value >= 60) {
                 $(this).spinner('value', ui.value - 60);
                 $('#hours').spinner('stepUp');
                 return false;
             } else if (ui.value < 0) {
                 $(this).spinner('value', ui.value + 60);
                 $('#hours').spinner('stepDown');
                 return false;
             }
         },
         change: function( event, ui ) {
                     SetDurationTime(); 
                    }
     }).val(InitSpinner("minutes"));
 }
}
})(jQuery);

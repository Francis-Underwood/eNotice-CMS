 $(document).ready(function() {
	 $(".mws-slider").slider(
		   {
			range: "min",
			min: 1,
			max: 0,
			value: 0,
			slide: function($e, $ui)
			{
				// console.log($ui.value);
				 $("input#ids-wilson-video-width").val($ui.value);
				 $("label#ids-wilson-video-width-label").text($ui.value);
			}
		   };
	 )
 });

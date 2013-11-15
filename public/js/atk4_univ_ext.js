/* Welcome to Agile Toolkit JS framework. This file provides universal chain. */

// jQuery allows you to manipulate element by doing chaining. Similarly univ provides
// loads of simple functions to perform action chaining.
//

;
$||console.error("jQuery must be loaded");
(function($){


$.each({
makeAutosave : function(sbm, chbx){
	jQuery(function(){
		setInterval(function (){
			jQuery(chbx).attr('checked', 'checked');
			jQuery(sbm).submit();
			jQuery(chbx).attr('checked', false);
		}, 60000);
	});
},
	unscramble: function(){
		this.jquery.each(function(){
			t = $(this).attr('title');
			var e=$(this).attr('rel').split('').reverse().join('').replace('##','@').replace('#','.');
			$(this).attr('href','mailto:'+e);
			if (t && t != undefined){
				$(this).text(t);
			}
			else {
				$(this).text(e);
			}
		});
	},
},$.univ._import
);

})($);

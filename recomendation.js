function get_url_params() {
  // This function is anonymous, is executed immediately and
  // the return value is assigned to QueryString!
  var query_string = {};
  var query = window.location.search.substring(1);
  var vars = query.split("&");
  for (var i=0;i<vars.length;i++) {
    var pair = vars[i].split("=");
        // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = pair[1];
        // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [ query_string[pair[0]], pair[1] ];
      query_string[pair[0]] = arr;
        // If third or later entry with this name
    } else {
      query_string[pair[0]].push(pair[1]);
    }
  }
    return query_string;
}



function get_hackajob_object( name, objectid ) {
	$.ajax({
        type: "GET",
        async: false,
        url: '/getObject/?name=' + name + '&objectid=' + objectid ,
        dataType: 'json',
        success: function(response){
            switch (name) {
            	case 'jobs':
            		$('#job-title').html(response.title);
            		$('#job-description').html(response.description);
            		break;
            	case 'users':
            		$('#friend-picture').attr('src', 'https://graph.facebook.com/'+response.facebook_id+'/picture?type=large');
            	break;
            }
        }
    });
}


var params = get_url_params();
if (typeof params.id_job != 'undefined' && typeof params.id_candidate != 'undefined') {
	$( document ).ready(function() {
		get_hackajob_object( 'jobs', params.id_job );
		get_hackajob_object( 'users', params.id_candidate );
		if ( params.id ) {
			$('#login-facebook').remove();
		}
		else {
			$('#send-recomendation').remove();
		}
		recommend_events();
	});

}

function recommend_events(){
	$('#login-facebook').click(function() {
		var destination = "https://apisocial.wallyjobs.com/login/facebook?urlOK=" + encodeURIComponent(window.location.href)+'&urlKO='+ encodeURIComponent(window.location.href);
		alert(destination);
		window.location.href = destination;
	});

	$('#send-recomendation').click(function() {
		$.ajax({
	        type: "GET",
	        dataType: 'json',
	        url: '/recommend/?description='+$('#recomendation-description').val()+'&reccomender_id='+params.id+'&job_id='+params.id_job+'&application_id='+params.id_application,
	        success: function(response){
				if ( ! response ) {
	            	alert("Recomendació enviada");
	            }
	        },
	        error: function(response){
	            if ( ! response ) {
	            	alert("Recomendació enviada");
	            }
	        }
	    });
	});
}



<script>
	$(document).ready(function(){
		//fetch coordinates using html5 geolocator
		if (navigator.geolocation) {
	        navigator.geolocation.getCurrentPosition(setPosition);
	    } else {
	        alert('Unable to fetch location, nearby restaurants won\'t be fetched');
	    }

	    //store longitude and latitude coordinates in cookies
	    function setPosition(position) 
	    {
	    	$.cookie('lat', position.coords.latitude);
	    	$.cookie('lng', position.coords.longitude);
	    } 

	    //make an ajax request to fetch near by restaurants
	    setTimeout(function(){
	    	$.ajax({
	    	url: '{!! url("/restaurants/closeby") !!}',
	    	type: 'POST',
	    	data: {
	    		longitude: $.cookie('lng'),
	    		latitude: $.cookie('lat')
	    	},
	    	complete: function(xhr) {
	    		if (xhr.responseText !== "nothing found") {
	    			//fetch results and parse it
	    			results = JSON.parse(xhr.responseText);

	    			//wrap the results in html and display it
	    			content = constructHtml(results);

	    			//insert the new content into the page
	    			$("#closeby-restaurants").html(content);
	    			//console.log(content);

	    		} else {
	    			$("#closeby-restaurants").html("Failed to load close by restaurants");
	    		}
	    	}
	    });	
	    }, 3000);
	    

	    //constructs the nearby restaurants elements that would be dynamically
	    function constructHtml(input)
	    {
	    	output = '';
	    	for (var i=0; i<input.length; i++) {
	    		output += '<div class="col-md-3">';
	    		output += '<a href = "'+"{{ url('restaurants/')}}" + input[i].id + '">';
	    		output += '<div class="text-center thumbnail items">';
	    		output += '<img src="http://cdn.londonandpartners.com/visit/london-organisations/sketch/84245-640x360-sketch-restaurant-david-shrigley-640.jpg"';
				output += 'width = 300 height = auto />';
        		output += '<h5 class="text-center">'+ input[i].name + ' (' +  input[i].distance +' km)</h5>';
        		output += '<p style=\'color:#aa5555;\'>' + input[i].description + '</p>';
        		output += '<p><small>' + input[i].location + '</small></p>';
      			output += '</div></a></div>';
	    	}
	    	return output;
	    }

	});
</script>
<style>
	.items{
		margin-top:2em;
	}
	div a:hover{
		text-decoration: none;
	}
	.thumbnail:hover{
		-webkit-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.15);
		-moz-box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.15);
		box-shadow: 10px 10px 5px 0px rgba(0,0,0,0.15);
	}
</style>
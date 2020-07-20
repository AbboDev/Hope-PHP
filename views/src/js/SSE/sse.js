if (typeof(EventSource) === "undefined") {
	// Sorry! No server-sent events support..
} else {
	// Yes! Server-sent events support!
	var source = new EventSource("sse.php");
	source.onmessage = function(event) {
		
	};
}
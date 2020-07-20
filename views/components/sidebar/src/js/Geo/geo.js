if (!navigator.geolocation) {
    x.innerHTML = "Geolocation is not supported by this browser.";
} else {
    navigator.geolocation.getCurrentPosition(showPosition);
}
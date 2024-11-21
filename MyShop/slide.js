function loadBrands(imageFilename) {
    // You can replace the URL with the actual endpoint that fetches brands.
    var brandsEndpoint = 'your_brand_endpoint.php';

    // Make an AJAX request to get brands data.
    var xhr = new XMLHttpRequest();
    xhr.open('GET', brandsEndpoint, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var brandsData = xhr.responseText;
            document.getElementById('brands-container').innerHTML = brandsData;
        }
    };

    xhr.send();
}

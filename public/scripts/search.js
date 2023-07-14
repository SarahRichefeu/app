$( () => {
    function filter() {
        var action = 'fetch_data';
        var brand = $('#brand option').val();
        var gear = $('#gear input').val();
        var fuel = $('#fuel input').val();
        var minPrice = $('#minPrice').val();
        var maxPrice = $('#maxPrice').val();

        $.ajax({
            url: '/catalogue?',
            method: 'POST',
            dataType: 'json',
            data: {action:action, brand:brand, gear:gear, fuel:fuel, minPrice:minPrice, maxPrice:maxPrice},
            success:function(data) {
                $('#js-filter-result').html(data.html)
            }
        });
    }
    filter();
});

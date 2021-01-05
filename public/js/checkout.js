
function checkout()
{

    $('#loading').removeClass('d-none');

    let headers = {headers: {'Content-type': 'application/json'}};

    let data =
        {
            product_name : $('#product_name').text(),
            product_price : parseFloat($('#product_price').text()),
            product_currency : $('#product_currency').text(),
            product_qty : $('#product_qty').text(),
        };

    axios.post('/buying', data, headers).then(response =>
        {

            $('#loading').addClass('d-none');

            $('#stub_price').text(response.data.Total);
            $('#stub_currency').text(response.data.Currency);
            $('#stub_reference').text(response.data.Reference);

            $('#stub').modal('show');
            console.log(response);

        }).catch(e =>
    {
        $('#loading').addClass('d-none');
        alert(e.response.data.message);
        //console.log(e);

    });


}

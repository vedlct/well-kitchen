<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <table>
        <tr class="myContainer">
            <th>Product Code</th>
            <th>Barcode</th>
            <th>Opening Stock</th>
            <th>Stock</th>
        </tr>
{{--{{dd($skuOpeningStock->where('skuId', 11)->openingStock)}}--}}

        @foreach($allSkus as $allSku)
            <tr class="myContainer" >
                <td>
                    {{$allSku->productCode}}
                </td>
                <td>
                    {{$allSku->barcode}}
                </td>
                <td>
                    @foreach($skuOpeningStock->where('skuId', $allSku->skuId) as $openingStock)
                        {{$openingStock->openingStock}}
                    @endforeach
                </td>
                <td>
                    {{$allSku->available}}
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>




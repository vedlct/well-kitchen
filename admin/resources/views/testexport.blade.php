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
        </tr>

        @foreach($allSkus as $allSku)
            <tr class="myContainer" >
                <td>
                    {{$allSku->product->productCode}}
                </td>
                <td>
                    {{$allSku->barcode}}
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>




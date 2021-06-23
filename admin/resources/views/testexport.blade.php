<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        #tests {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #tests td, #tests th {
            border: 1px solid red;
            padding: 8px;
        }

        #tests tr:nth-child(even){background-color: #f2f2f2;}

        #tests tr:hover {background-color: #ddd;}

        #tests th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
<body>
    <table id="tests">
        <tr>
            <th style="color: #0ac282">pname</th>
        </tr>

        @foreach($pros as $pro)
            <tr>
                <td>
                    {{$pro->productName}}
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>




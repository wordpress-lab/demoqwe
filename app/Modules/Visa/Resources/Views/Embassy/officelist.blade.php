<html>

<head>
    <title>Embassy Office List</title>
    <style>
        table tr td{
            text-align: center;
            border: 0.5px solid black;
        }
    </style>
</head>
<body style="font-family: freeserif">

<h3 style="text-align: center; line-height: 5px;">مكتب قائمة العربية</h3>
<h3 style="text-align: center">قائمة المكاتب العربية ألكسدلكاس جلكاسد s أسدجاجسداسكد أسداد أس داسداسد أساداسد</h3>
<div style=" height: 100px ; width: 100%;margin-top: -20px; ">
    <h4 style="text-align: RIGHT;border: 1px solid black; padding: 5px; width: 200px; float: right">{{ $date }}</h4>
</div>
<table style="width:100%; margin-top: -35px;" cellpadding="3", cellspacing="0" border="1">
    <tr>
        <th>Job Type</th>
        <th> Year</th>
        <th> Visa No</th>
        <th> Sponsor Name</th>
        <th> Passport No</th>
        <th style="width: 5%"> SL</th>
    </tr>
    @php
    $i= 0;

    @endphp
    @foreach($data as $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>sd</td>
        <td>dsd</td>
        <td>sdsd</td>
        <td>sdsd</td>
        <td>sdsd</td>
    </tr>
    @endforeach
</table>


</body>
</html>
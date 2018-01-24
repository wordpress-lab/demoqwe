<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <style>


    </style>

</head>
<body style="font-family: freeserif; font-size: 10pt;">

<div role="main" class="container" style="height: 100%;margin-top: 50px">
    <div class="row">
        <div class="col-md-12" style="text-align: center;background-color: #195B4C;">
            <h1 style="font-weight: 900;text-transform: uppercase;color: white;margin-top: 20px">{!! $logo->display_name !!}</h1>
        </div>

        <div class="col-md-12" style="margin: 40px 100px">
            <h4>{!! $email->details !!}</h4>
        </div>
    </div>

</div>

</body>
</html>
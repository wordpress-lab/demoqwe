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

<div class="container">
  <div class="row">
      <div class="col-md-12">
          <h2 style="text-align: center">Subject:{!! $email->subject !!}</h2>

          <p>Details:{!! $email->details !!}</p>
          <iframe src="{{URL::to('path')}}/{!! $email->file !!}" width="100%" height="600"></iframe>

      </div>
  </div>
</div>


</body>
</html>




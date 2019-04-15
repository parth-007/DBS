<!DOCTYPE html>

<html>

<head>

	<title>Please Verify the Email.</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>

	
<div class="container">
  <h2>Hello,</h2>
  <p>Please Find Following Credentials</p>            
  Please Use the link to Confirm your account and use the below mentioned Password to login.
  <table class="table table-striped" border="2" bordercolor="blue">
    <thead>
      <tr>
        <th>Link</th>
        <td><a href="{{$link}}">Click Here</a></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th>Passcode</th>
        <td>{{$pass}}</td>
      </tr>
     
    </tbody>
  </table>
</div>

</body>

</html>
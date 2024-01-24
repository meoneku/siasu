<!DOCTYPE html>
<html>
<head>
	<title>OSS FT</title>
	<link rel="stylesheet" type="text/css" href="{{ url('') }}/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="{{ url('') }}/img/wave.png">
	<div class="container">
		<div class="img">
			<img src="{{ url('') }}/img/bg.svg">
		</div>
		<div class="login-content">
			<form action="{{ url('mahasiswa/login') }}" method="post" action="index.html">
                @csrf
				<img src="{{ url('') }}/img/avatar.svg">
				<h2 class="title">Selamat Datang</h2>
                @if (session()->has('message'))
                    <h5>NIM Atau Password Salah</h5>
                @endif
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>NIM</h5>
           		   		<input type="text" class="input" id="nim" name="nim">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" id="password" name="password">
            	   </div>
            	</div>
            	<a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('') }}/js/main.js"></script>
</body>
</html>

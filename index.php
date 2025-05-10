<?php
if (isset($_POST['title'])) {
    
    $userDir = "users/" . $_POST['title'] . "-" . date('m-d');
    
    $counter = 2;
    while (file_exists($userDir)) {
        $userDir = "users/" . $_POST['title'] . "-" . date('m-d') . "-" . $counter;
        $counter++;
    }
    
    mkdir($userDir, 0777, true);

    $file = $userDir . "/index.php";
    $commitEntry = "
    <html>
    	<head>
    	<title>" . $_POST['title'] . "</title>
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<script src='https://cdn.jsdelivr.net/npm/marked/marked.min.js'></script>
    	</head>
    <style>
    	button{
    	border:2px solid black;
				border-radius:20px;
				padding:10px;
				background:none;
				outline:none;
				font-weight:900;
				font-size:15px;
				margin-top:30px;
				width:100px;
				}
				</style>
     <body style='padding:20px;'>
    	<code>
    	<h1 style='font-size:30px; margin-bottom:10px; margin-top:20px;'>" . $_POST['title'] . "</h1>
    <b style='color:#848484; font-size:10px;'>" . $_SERVER['REMOTE_ADDR']  . " • " . date('F d, Y') . "</b>
    	<p style='font-size:10px; margin-top:20px;' id='chapar'></p>
<a href='http://127.0.0.1:8080'><button>NEW</button></a>
</code>
    </body>
    <script>
    	document.getElementById('chapar').innerHTML = marked.parse('" . $_POST["chapar"] . "');
    </script>
    </html>
    ";
    file_put_contents($file, $commitEntry);
    header("Location: " . $userDir);
}
?>
	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
		<body style='padding:20px;'>
	<style>
		input[type="text"]{
			border:none;
			outline:none;
			font-size:20px;
			}
			input[type="submit"]{
				border:2px solid black;
				border-radius:20px;
				padding:10px;
				background:none;
				outline:none;
				font-weight:900;
				font-size:15px;
				}
		</style>
	<form method="POST">
		<input type="text" name="title" placeholder="Title" style="font-size:30px; margin-bottom:10px;">
		<input type="text" id="markdown" name="chapar" placeholder="Chapar" style="margin-bottom:25px;"><br>
<input type="submit" value="PUBLISH">
		</form>
		</body>
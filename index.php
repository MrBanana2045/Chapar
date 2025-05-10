<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
    <meta charset='utf-8'>
    	<meta name='viewport' content='width=device-width, initial-scale=1.0'>
    	<script src='https://cdn.jsdelivr.net/npm/marked/marked.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/dompurify/dist/purify.min.js'></script>
    	</head>
    <style>
    	html {
    	  -webkit-user-select: none;
  -ms-user-select: none;
  user-select: none;
    }
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
				#chapar blockquote {
					background: #f0f0f0;
					border-left:5px solid #A9A9A9;
					padding: 10px;
					}
				#chapar img {
					height:200px;
					width:200px;
					}
				#chapar td {
						padding: 5px;
						text-align:left;
						}
				#chapar table, td, th {
					padding: 5px;
  border: 1px solid;
}
				#chapar table,  td {
  border-collapse: collapse;
}
				#chapar code {
    background-color: #f0f0f0;
    padding: 5px;
    border-radius:5px;
}
				#chapar code {
    background-color: #f0f0f0;
    padding: 10px;
    border-radius:5px;
}
				</style>
     <body style='padding:20px;'>
    	<code>
    	<h1 style='font-size:30px; margin-bottom:10px; margin-top:20px;'>" . $_POST['title'] . "</h1>
    <b style='color:#848484; font-size:10px;'>" . $_SERVER['REMOTE_ADDR']  . " • " . date('F d, Y') . "</b>
    	<p style='font-size:10px; margin-top:20px;' id='chapar'></p>
<a href='https://chapar.zya.me/'><button>NEW</button></a>
</code>
    </body>
    <script>
    	const rawInput = " . json_encode($_POST['chapar']) . ";
  const encodedInput = DOMPurify.sanitize(rawInput);
  let markdownText = encodedInput;
  .replace(/==(.+?)==/g, '<mark>$1</mark>')
  .replace(/\^(.+?)\^/g, '<sup>$1</sup>')
  .replace(/\~(.+?)\~/g, '<sub>$1</sub>');
document.getElementById('chapar').innerHTML = DOMPurify.sanitize(marked.parse(processedText));
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
		<input type="text" name="title" placeholder="Title" style="font-size:30px; margin-bottom:10px;" pattern="^[a-zA-Z]+$" requires>
		<input type="text" id="markdown" name="chapar" placeholder="Chapar" style="margin-bottom:25px;" required><br>
<input type="submit" value="PUBLISH">
		</form>
		</body>
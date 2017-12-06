<?php
function html_open(){ 
	echo "<html>";
	echo "<head>";
?>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
		integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<?php
}
function html_body(){
	echo "</head>";
	echo "<body>";
	echo "<div class='container'>";
}
function html_close(){
	echo "</div>";
	echo "</body>";
	echo "</html>";
}
?>

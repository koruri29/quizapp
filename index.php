<?php
require('dbconnect.php');
require_once('common.php');

$sql = 'SELECT * FROM quiz WHERE 1';
$stmt = $db->prepare($sql);
$stmt->execute();

$quizzes = [];
$i = 0;
while (true) {
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($rec == false) {
		break;
	}
	$quiz = [
		$rec['question'], 
		$rec['option1'],
		$rec['option2'],
		$rec['option3'],
		$rec['answer'],
	];
	$quizzes[] = sanitize($quiz);
	$i++;
}
shuffle($quizzes);
$questions = [];
for ($i = 0; $i < 3; $i++) {
	$questions[] = $quizzes[$i];
}

$questions = json_encode($questions);
header("Content-Type: text/javascript; charset=utf-8");
echo $questions
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
	<title>三択クイズ</title>
</head>
<body>
	<main>
		<h1>三択クイズ</h1>
	</main>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="main.php"></script>
</body>
</html>
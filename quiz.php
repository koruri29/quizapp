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
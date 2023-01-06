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
	$rec = sanitize($rec);
	$quiz = [
		'"' . $rec['question'] . '"', 
		'"' . $rec['option1'] . '"',
		'"' . $rec['option2'] . '"',
		'"' . $rec['option3'] . '"',
		$rec['answer'],
	];
	$quizzes[] = $quiz;
	$i++;
}
shuffle($quizzes);
$questions = [];
for ($i = 0; $i < 3; $i++) {
	$questions[] = $quizzes[$i];
}

$questions_str0 = implode(', ', $questions[0]);
$questions_str1 = implode(', ', $questions[1]);
$questions_str2 = implode(', ', $questions[2]);
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
		<div class="result"></div>
	</main>
	<script type="text/javascript">
	const questions0 = [<?php echo $questions_str0; ?>];
	const questions1 = [<?php echo $questions_str1; ?>];
	const questions2 = [<?php echo $questions_str2; ?>];
	</script>
	<script type="text/javascript" src="main.js"></script>
</body>
</html>
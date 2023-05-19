<?php
require('dbconnect.php');
require_once('common.php');

//quizテーブルからIDを抽出し、シャッフルしたIDで問題データを取り出す
//ID取り出し
$sql = 'SELECT id FROM quiz WHERE 1 = 1;';
$stmt = $db->prepare($sql);
$stmt->execute();

$id = [];
while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$id[] = $rec['id'];
}
shuffle($id);

//クイズデータ取り出し
$number_of_questions = 3;
$arr = [];
$arr[] = 'SELECT * FROM quiz WHERE id = ';
for ($i = 0; $i < $number_of_questions; $i++) {
	$arr[] = '?';
	$arr[] = ' OR id = ';
}
$arr[$number_of_questions * 2] = '';//最後のORを削除
$sql = implode('', $arr);

$stmt = $db->prepare($sql);
for ($i = 1; $i <= $number_of_questions; $i++) {
	$stmt->bindValue($i, $id[$i]);
}
$stmt->execute();

//クイズデータを成形し配列に格納
$quizzes = [];
while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {
	$rec = sanitize($rec);
	$quiz = [
		'"' . $rec['question'] . '"', 
		'"' . $rec['option1'] . '"',
		'"' . $rec['option2'] . '"',
		'"' . $rec['option3'] . '"',
		$rec['answer'],
	];
	$quizzes[] = $quiz;
}
shuffle($quizzes);

$questions = [];
for ($i = 0; $i < $number_of_questions; $i++) {
	$questions[] = implode(', ', $quizzes[$i]);
}
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
		<ul id="ul"></ul>
	</main>
	<script type="text/javascript">
	const questions = [
		<?php 
			for ($i = 0; $i < $number_of_questions; $i++) {
				print '[';
				print $questions[$i];
				print '],';
			}
		?>
	]
	</script>
	<script type="text/javascript" src="main.js"></script>
</body>
</html>
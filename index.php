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
var_dump($questions)
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
	<script>
		'use strict';
		{
			function render(quiz) {
				const main = document.querySelector('main');
				const section = document.createElement('section');
				const h2 = document.createElement('h2');
				const ul = document.createElement('ul');
				const li0 = document.createElement('li');
				const li1 = document.createElement('li');
				const li2 = document.createElement('li');
				
				h2.textContent = quiz[0];
				li0.textContent = quiz[1];
				li1.textContent = quiz[2];
				li2.textContent = quiz[3];
		
				li0.addEventListener('click', () => {
					if (quiz[4] == 0) {
						li0.classList.add('correct');
					} else {
						li0.classList.add('wrong');
					}
				});
				li1.addEventListener('click', () => {
					if (quiz[4] == 1) {
						li1.classList.add('correct');
					} else {
						li1.classList.add('wrong');
					}
				});
				li2.addEventListener('click', () => {
					if (quiz[4] == 2) {
						li2.classList.add('correct');
					} else {
						li2.classList.add('wrong');
					}
				});
		
				ul.appendChild(li0);
				ul.appendChild(li1);
				ul.appendChild(li2);
				section.appendChild(h2);
				section.appendChild(ul);
				main.appendChild(section);
			}
		
			const questions = <?php var_dump($questions); ?>;
			render(questions)
		}
	</script>
</body>
</html>
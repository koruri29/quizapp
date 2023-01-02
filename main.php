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

	// const request = new XMLHttpRequest();
	// const data = this.responseText;
	// request.open('GET', 'quiz.php', true);
	// request.responseType = 'json';
	// request.addEventListener('load', function(response) {
	// 	response = JSON.parse(response)
	// 	render(response);
	// });
	// request.send();
	
	// render(data);

	$(function() {
		const questions = JSON.parse('<?php echo $questions; ?>');
  		console.log(questions);
		render(questions)
	});
}

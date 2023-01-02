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

	const quizzes = [
		['南極観測船「宗谷」で犬のタロ、ジロとともに南極へと向かった猫の名前は何でしょう？', 'さんま', 'じょーじ', 'たけし', 2],
		['猫が夜中などに突然走り回ることを、俗に猫の「何」というでしょう？', '猫の運動会', '猫の学芸会', '猫の反省会', 0],
		['猫が怖がっているときの耳の形を、それがあるものに似ていることからなんと呼ぶでしょう？', '福耳', 'イカ耳', 'パンの耳', 1],
	];

	quizzes.forEach((quiz) => {
		render(quiz);
	});
}
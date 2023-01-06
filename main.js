// 'use strict';
{
	//カウンター準備
	let answerCounter = 0;
	let correctCounter = 0;

	//クイズを生成する関数
	function render(quiz) {
		const main = document.querySelector('main');
		const section = document.createElement('section');
		const ul = document.createElement('ul');
		const h2 = document.createElement('h2');
		const li0 = document.createElement('li');
		const li1 = document.createElement('li');
		const li2 = document.createElement('li');
		const divAnswer = document.createElement('div');


		//回答時にクラスを付与し、CSSをつける用の関数
		function createAnswer(answer) {
			if (answer) {
				divAnswer.textContent = "正解です！";
				divAnswer.className = 'answer-correct';
			} else {
				divAnswer.textContent = "残念！不正解…";
				divAnswer.className = 'answer-wrong';
			}
			return divAnswer;
		}
		
		
		//問題文と選択肢の文字列を代入
		h2.textContent = quiz[0];
		li0.textContent = quiz[1];
		li1.textContent = quiz[2];
		li2.textContent = quiz[3];


		//正解or不正解を判断、上のCSSを付与する関数を適用
		//正解時は正解数カウンターを回す
		if (quiz[4] == 0) {
			ul.addEventListener('click', e => {
				if (e.target == li0) {
					createAnswer(true);
					answerCounter++;
					correctCounter++;
				} else {
					createAnswer(false);
					answerCounter++;
				}
				console.log(answerCounter);
				if (answerCounter >= 3) {
					renderResult();
				}
			}, {once: true});
		}

		if (quiz[4] == 1) {
			ul.addEventListener('click', e => {
				if (e.target == li1) {
					createAnswer(true);
					answerCounter++;
					correctCounter++;
				} else {
					createAnswer(false);
					answerCounter++;
				}
				console.log(answerCounter);
				if (answerCounter >= 3) {
					renderResult();
				}
			}, {once: true});
		}

		if (quiz[4] == 2) {
			ul.addEventListener('click', e => {
				if (e.target == li2) {
					createAnswer(true);
					answerCounter++;
					correctCounter++;
				} else {
					createAnswer(false);
					answerCounter++;
				}
				console.log(answerCounter);
				if (answerCounter >= 3) {
					renderResult();
				}
			}, {once: true});
		}


		ul.appendChild(li0);
		ul.appendChild(li1);
		ul.appendChild(li2);
		section.appendChild(h2);
		section.appendChild(ul);
		section.appendChild(divAnswer);
		main.appendChild(section);
	}

	
	//クイズデータを代入、クイズ生成
	render(questions0);
	render(questions1);
	render(questions2);


	//カウンター(回答数と正解数)
	const ul = document.querySelector('ul');
	console.log(ul);
	ul.addEventListener('click', () => {
		if (answerCounter >= 3) {
			renderResult();
		}
		answerCounter++;
		console.log(answerCounter);
	});


	//最後に正解数を表示する関数
	function renderResult() {
		// const ul = document.querySelector('ul')
		let result = '';
		result = `
			あなたの正解数は…
			3問中　<span class="strong">${correctCounter}問</span>です。<br>
		`;
		const divResult = document.getElementsByClassName('result');
		if (correctCounter === 3) {
			result += 'お見事、クイズ王です！';
		} else if (correctCounter === 2) {
			result += 'おしい、あと一歩！';
		} else {
			result += '残念、次はがんばろう。'
		}
		divResult.innerHTML = result;
		ul.appendChild(divResult);
		
		return console.log(divResult);
	}


}
// 'use strict';
{
	//カウンター準備
	let answerCounter = 0;
	let correctCounter = 0;


	//回答時にクラスを付与し、CSSをつける用の関数
	function createAnswer(isCorrect) {
		const section = document.querySelectorAll('section')
		const divAnswer = document.createElement('div')
		if (isCorrect) {
			divAnswer.textContent = "正解です！";
			divAnswer.className = 'answer-correct';
		} else {
			divAnswer.textContent = "残念！不正解…";
			divAnswer.className = 'answer-wrong';
		}
		section.lastChild.appendChild(divAnswer);
	}


	//最後に正解数を表示する関数
	function renderResult() {
		const divResult = document.createElement('div');
		let result = '';

		result = `
			あなたの正解数は…
			3問中　<span class="strong">${correctCounter}問</span>です。<br>
		`;

		if (correctCounter === 3) {
			result += 'お見事、クイズ王です！';
		} else if (correctCounter === 2) {
			result += 'おしい、あと一歩！';
		} else {
			result += '残念、次はがんばろう。'
		}
		divResult.textContent = result;
		document.querySelectorAll('section').lastChild.appendChild(divResult);
	}


	//クイズを生成する関数
	function renderQuiz(quizArray, optionNum) {

		//elem宣言ブロック
		const main = document.querySelector('main');
		const section = document.createElement('section');
		const h2 = document.createElement('h2');
		const ul = document.createElement('ul');
		let li = [];
		for (let i = 0; i < optionNum; i++) {
			li.push(document.createElement('li'));
		}

		main.appendChild(section);
		section.appendChild(h2);
		section.appendChild(ul);
		for (let i = 0; i < optionNum; i++) {
			ul.appendChild(li[i]);
		}
		

		//問題文と選択肢の文字列を代入
		h2.textContent = quizArray[0];
		for (let i = 0; i < optionNum; i++) {
			li[i].textContent = quizArray[i + 1];
		}
	
		//正解がi番目のとき、i番目の選択肢をクリックしたら正解
		//回答時に上のCSSを付与する関数を実行
		//正解時はさらにカウンター回す
		for (let i = 0; i < 3; i++) {
			if (answerNum === i) {
				ul.addEventListener('click', e => {
					answerCounter++;
					console.log(answerCounter);
					if (e.target == li[i]) {
						createAnswer(true);
						correctCounter++;
					} else {
						createAnswer(false);
					}
				}, {once: true});
			}
		}


		//選択肢と回答の生成
		for (let i = 0; i < 3; i++){
			renderOptions(3, quizArray[4]);
		}


		//回答数カウンター
		ul.addEventListener('click', () => {
			answerCounter++;
			console.log(answerCounter);
			if (answerCounter >= 3) {
				renderResult();
			}
		}, {once: true});


		// if (quizArray[4] === 0) {
		// 	ul.addEventListener('click', e => {
		// 		answerCounter++;
		// 		console.log(answerCounter);
		// 		if (e.target == li0) {
		// 			createAnswer(true);
		// 			correctCounter++;
		// 		} else {
		// 			createAnswer(false);
		// 		}
		// 	}, {once: true});
		// }

		// if (quizArray[4] === 1) {
		// 	ul.addEventListener('click', e => {
		// 		answerCounter++;
		// 		console.log(answerCounter);
		// 		if (e.target == li1) {
		// 			createAnswer(true);
		// 			correctCounter++;
		// 		} else {
		// 			createAnswer(false);
		// 		}
		// 	}, {once: true});
		// }

		// if (quizArray[4] === 2) {
		// 	ul.addEventListener('click', e => {
		// 		answerCounter++;
		// 		console.log(answerCounter);
		// 		if (e.target == li2) {
		// 			createAnswer(true);
		// 			correctCounter++;
		// 		} else {
		// 			createAnswer(false);
		// 		}
		// 	}, {once: true});
		// }
	}

	
	//クイズデータを代入、クイズ生成
	for (let i = 0; i < 3; i++){
		const question = questions[i];
		renderQuiz(question, 3);
	}


	//回答数カウンター
	// const ul = document.querySelectorAll('ul');
	// for (let i = 0; i < 3; i++) {
	// 	ul.item(i).addEventListener('click', () => {
	// 		answerCounter++;
	// 		console.log(answerCounter);
	// 		if (answerCounter >= 3) {
	// 			renderResult();
	// 		}
	// 	});
	// }


	//２０２２．１．７メモ
	//renderResult()をliのaddEventListenerにつけたら動きそうなもんだけど…
	//やってみても動かないんだなこれが
	//そもそも上記スコープ内のconsole.logも効いてない感じ
}
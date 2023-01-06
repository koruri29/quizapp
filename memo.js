	//カウンター(回答数と正解数)
	const ul = document.querySelectorAll('ul');
	for (let i = 0; i < 3; i++) {
		ul.item(i).addEventListener('click', () => {
			answerCounter();
			renderResult();
			console.log(renderResult());
		});

		ul.item(i).addEventListener('click', () => {
			console.log(answerCounter());
			console.log(correctCounter());
		});
	}
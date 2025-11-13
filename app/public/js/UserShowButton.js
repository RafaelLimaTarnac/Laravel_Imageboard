let obj = document.getElementsByClassName('user_button');
for(let i = 0; i <= obj.length - 1; i++){
	obj[i].addEventListener('click', ShowContent);
	obj[i].parentNode.getElementsByClassName('user_content')[0].style.display = 'none';
}

function ShowContent(clicked){
	let content = clicked.target.parentNode.getElementsByClassName('user_content')[0];	
	if(content.style.display == 'none')
		content.style.display = 'block';
	else
		content.style.display = 'none';
}
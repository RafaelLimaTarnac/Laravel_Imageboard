var pastComment;

if(window.location.hash)	
	FocusComment();
window.addEventListener('hashchange', FocusComment);

function FocusComment(){
	if(pastComment)
		pastComment.style.border = '';
	var comment = document.getElementById(window.location.hash.replace('#', ''));
	pastComment = comment;
	comment.style.border = '1px solid red';
}
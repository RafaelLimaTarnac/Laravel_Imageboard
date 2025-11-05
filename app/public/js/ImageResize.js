var Images = document.getElementsByClassName('review_img');
for(var i = 0; i < Images.length; i++){
	Images[i].addEventListener('click', ResizeOnClick);
}
var ChangedImages = Array();

function ResizeOnClick(event){
	if(!ChangedImages.includes(event.target)){
		event.target.style.maxWidth = "90%";
		event.target.style.maxHeight = '100%';

		ChangedImages.push(event.target);
	}
	else{
		event.target.style.maxWidth = "";
		event.target.style.maxHeight = "";

		var index = ChangedImages.indexOf(event.target);
		if (index !== -1) {
		  ChangedImages.splice(index, 1);
		}
	}
}
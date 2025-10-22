var reportForms = document.getElementsByClassName('report-form');
var reportDivs = document.getElementsByClassName('report');
for(const obj of reportForms){
	obj.style.display = 'none';
}
for(const obj of reportDivs){
	obj.children[0].addEventListener('click', function(){
		ShowReportForm(obj.children[1]);
	});
}


function ShowReportForm(toShow){
	if(toShow.style.display == 'none'){
		for(const obj of reportForms)
			obj.style.display = 'none';

		toShow.style.display = 'block';
	}
	else{
		toShow.style.display = 'none';
	}
}
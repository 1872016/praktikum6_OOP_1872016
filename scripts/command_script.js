function updateFacultyValue(id){
	window.location = "?menu=facu&fid="+ id;
}

function deleteFacultyValue(id){
	let confirmation = window.confirm("Are you sure want to delete?");
	if(confirmation){
		window.location = "?menu=fac&cmd=del&fid="+ id;
	}
}

function updateActivityValue(id){
	window.location = "?menu=actu&aid="+ id;
}

function deleteActivityValue(id){
	let confirmation = window.confirm("Are you sure want to delete?");
	if(confirmation){
		window.location = "?menu=act&cmd=del&aid="+ id;
	}
}
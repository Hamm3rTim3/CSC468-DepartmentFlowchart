/*
Description:
This function makes a request to get_course_info.php to get course info so it can
be set as the content of the modal popup. It then makes the popup visible.

Arguments:
  prefix: the prefix of the course to display
  number: string of the course number or numbers
*/
function openPopup(prefix, number) {
    requestUrl = "get_course_info.php?preFix="+prefix+"&number="+number;
    //requestUrl = "get_course_info.php?preFix=CSC&number=300";
    jQuery.ajax({
      type: 'GET',
      url:requestUrl,
      //data: "preFix=CSC&number=300",
      success: changeData,
      dataType: "html"
    });
    //alert( requestUrl );    
    modal.style.display = "block";
}

/*
Description:
This function sets the 
*/
function changeData(data)
{
  document.getElementById('modalContent').innerHTML = data;
  console.log(data);
  return;
}


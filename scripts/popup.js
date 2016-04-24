
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


function changeData(data)
{
  document.getElementById('modalContent').innerHTML = data;
  console.log(data);
  return;
}


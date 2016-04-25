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
function customPopup(courseInfo){
  document.getElementById('modalContent').innerHTML = courseInfo;
  modal.style.display = 'block';
}
function onMapResize(){
  var firstCoords = [
  [0,0,70,50],
  [0,60,70,110],
  [110,60,180,110],
  [0,250,70,300],
  [110,250,180,300],
  [210,250,280,300],
  [430,250,510,300],
  [625,250,695,300],
  [210,320,280,365],
  [0,380,70,430],
  [110,380,180,430],
  [210,380,280,430],
  [340,380,410,430],
  [725,380,795,430],
  [103,150,182,200],
  [205,150,280,200],
  [430,60,505,110],
  [0,450,70,500],
  [340,450,410,500],
  [440,450,515,500],
  [625,450,695,500],
  [725,450,795,500],
  [340,0,410,50],
  [340,60,410,110],
  [340,320,410,365],
  [430,115,505,165],
  [430,180,505,230],
  [530,180,600,230],
  [625,180,695,230],
  [725,180,795,230],
  [530,60,600,110],
  [530,115,600,165],
  [530,250,600,300],
  [530,320,600,365],
  [625,0,695,50],
  [620,60,695,115],
  [725,0,795,50],
  [720,60,800,115]]
  var imWidth = document.getElementById("flowdiagram").offsetWidth;
  var map = document.getElementById("flowchartmap");
  
  if(imWidth != 800){
    var factor = imWidth/800;
    var newCoords = [];
    for(var i=0; i<map.areas.length; i++){
      newCoords = [];
      for(var j=0; j<4;j++){
        newCoords.push(firstCoords[i][j]*factor);
      }
      map.areas[i].coords = newCoords.join(',');
    }
  }
}


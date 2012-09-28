// send interaction data to php to store in db
function emitInteractions(vpIds, counts) {
  console.log("counts!!!",counts);
  // form string from counts (array)
  var countsStr = array2flatList(counts);
  console.log("countsStr",countsStr);
  console.log("vpIds",vpIds);
  
  // AJAX send vpIds and counts to server side storeInteractions.php
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else { 
    // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  // on return from db
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
      console.log("responseText: ", xmlhttp.responseText);
    }
  }
  xmlhttp.open("GET","php/storeInteractions.php?vpIds="+vpIds+"&counts="+countsStr,true);
  xmlhttp.send();
}
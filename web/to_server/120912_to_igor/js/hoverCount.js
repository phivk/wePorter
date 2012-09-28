$(document).ready(function(){
  // TODO write dynamic jQuery counter contructor
  timeoutId = 0;
  
  // attach event handlers to videoBox elements
  $('.videoBox').hover(
    function (e) {  
      //mouse entry code
      var targetId = $(this).attr('id');
      CounterOn(targetId);
    },
    function () {
      //mouse exit code
      CounterOff();
    }
  );
  
});

function CounterOn(targetId){
  var counterId = "#" + targetId + "Counter";
  // alert(counterId);
  var curVal = parseInt($(counterId).val(), 10);
  $(counterId).val(curVal+1);
  
  timeoutId=setTimeout('CounterOn(\'' +targetId+ '\')',100);
  // timeoutId=setTimeout('alert("nu dan")',1000);
  
}

function CounterOff(){
  clearTimeout(timeoutId);
}



// DEPRECATED
// function CountOn(targetName){
//   // targetName = "testerCounter";
//   var curCount = parseInt(document.getElementById(targetName).value, 10);
//   document.getElementById(targetName).value = curCount + 1;
//   
//   // reset if overflow
//   if(document.getElementById(targetName).value>1000000){
//     document.getElementById(targetName).value = 0;
//   }
//   // invoke next
//   // TODO change to setInterval()
//   timeoutId=setTimeout('CountOn(\'' +targetName+ '\')',100);
//   
// }
// 
// // clearTimeout
// // for now, single timeoutId is ok, two timed processes are mutually exclusive
// function StopCount(){
//   clearTimeout(timeoutId)
// }



function resetCount(){
  document.getElementById("targetOne").value = 0;
  document.getElementById("targetTwo").value = 0;
}
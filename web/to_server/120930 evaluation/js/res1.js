var srcList = [
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_00.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_01.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_02.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_03.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_04.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_05.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_06.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_07.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_08.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_09.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_10.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_11.webm"
];

// best parts:
// 
// 22,2,31,40
// 34,3,111,120
// 44,3,211,220
// 50,4,41,50
// 58,5,71,80
// 75,7,61,70
// 86,8,41,50
// 91,9,21,30
// 102,9,131,140
// 149,11,281,290
// 156,11,351,360
var modal = "#resModal";
loadres();
function loadres () {
  document.addEventListener("DOMContentLoaded", function () {
    var vpIdsStr = "bm06,bm10,pop2,pop1,bm05,bm02";
    console.log(vpIdsStr);
    var clipList1 = [                               
      { src: srcList[11], in: 351,  out: 360},
      { src: srcList[4],  in: 41,   out: 50},
      { src: srcList[9],  in: 21,   out: 30},
      { src: srcList[3],  in: 111,  out: 120},
      { src: srcList[2],  in: 31,   out: 40},

    ];
    var clipList2 = [
      { src: srcList[3], in: 211,  out: 220},
      { src: srcList[5], in: 71, out: 80},
      { src: srcList[7],  in: 61, out: 70},
      { src: srcList[8], in: 41, out: 50},
      { src: srcList[9],  in: 131, out: 140},
    ];
    
  
    console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    // player.setVpIds(vpIdsStr);
    player.setEndModal(modal);
        
  }, false); // DOM content loaded
}
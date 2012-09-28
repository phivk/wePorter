var srcList = [
"http://videos.mozilla.org/serv/webmademovies/neighbourhood2.webm",
"http://videos.mozilla.org/serv/webmademovies/lastkid.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_01.webm",
"http://doc.gold.ac.uk/~ma101pvk/weporter/video/burningman/burningman_02.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_03.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_05.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_06.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_09.webm",
"http://doc.gold.ac.uk/~ma101yc/weporter/video/burningman/burningman_08.webm",
"http://doc.gold.ac.uk/~ma101yc/weporter/video/burningman/burningman_10.webm",
"http://doc.gold.ac.uk/~ma101yc/weporter/video/burningman/burningman_11.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_13.webm"
];
var modal = "#posBiasModal1";
loadPosBias();
function loadPosBias () {
  console.log("PosBias");
  document.addEventListener("DOMContentLoaded", function () {
    
            
    if (Math.round(Math.random())) {
      var clipList1 = [
        { src: srcList[1], in: 1,  out: 30},
      ];                                              
      var clipList2 = [                               
        { src: srcList[5], in: 21,  out: 50}
      ];
      var vpIdsStr = "lastkid, burningman_05";
    }
    else {
      var clipList1 = [                               
        { src: srcList[5], in: 21,  out: 50}
      ];
      var clipList2 = [
        { src: srcList[1], in: 1,  out: 30},
      ];
      var vpIdsStr = "burningman_05, lastkid";
    };
    console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    // TODO specify vpIdsStr
    player.setVpIds(vpIdsStr);
    player.setEndModal(modal);
    
  }, false); // DOM content loaded
}
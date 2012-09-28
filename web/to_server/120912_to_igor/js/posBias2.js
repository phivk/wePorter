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

var modal = "#posBiasModal2";
loadPosBias2();
function loadPosBias2() {
  console.log("PosBias");
  document.addEventListener("DOMContentLoaded", function () {
    console.log("loadPosBias2 called!");
    if (Math.round(Math.random())) {
      var clipList1 = [
        { src: srcList[8], in: 1,  out: 31},
      ];                                              
      var clipList2 = [                               
        { src: srcList[9], in: 1,  out: 31}
      ];
      var vpIdsStr = "burningman_08, burningman_10";
    }
    else {
      var clipList1 = [                               
        { src: srcList[9], in: 1,  out: 31}
      ];
      var clipList2 = [
        { src: srcList[8], in: 1,  out: 31},
      ];
      var vpIdsStr = "burningman_10, burningman_08";
    };
    console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    player.setVpIds(vpIdsStr);
    player.setEndModal(modal);
    // $("video").attr("controls", "true")
        
  }, false); // DOM content loaded
    
}


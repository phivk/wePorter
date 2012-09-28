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
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_13.webm",
"http://videos.mozilla.org/serv/webmademovies/makecorn.webm"
];
var modal = "#contextModal1";
loadcontext();
function loadcontext () {
  document.addEventListener("DOMContentLoaded", function () {
    // coinflip present different context
    if (Math.round(Math.random())) {
      // heads: 
      // 1: bm,   bm,   pop2
      // 2: pop1, bm,   bm
      var vpIdsStr = "bm06,bm10,pop2,pop1,bm05,bm02";
      console.log(vpIdsStr);
      var clipList1 = [                               
        { src: srcList[6],  in: 1,  out: 10},
        { src: srcList[9],  in: 36, out: 45},
        { src: srcList[12], in: 10, out: 19},
      ];
      var clipList2 = [
        { src: srcList[12], in: 1,  out: 10},
        { src: srcList[5], in: 51, out: 60},
        { src: srcList[3],  in: 11, out: 20},
      ];
    }
    else {
      // tails: 
      // 1: bm,   bm,   pop2
      // 2: bm,   bm,   bm
      var vpIdsStr = "bm06,bm10,pop2,bm11,bm05,bm02";
      console.log(vpIdsStr);
      var clipList1 = [                               
        { src: srcList[6],  in: 1,  out: 10},
        { src: srcList[9],  in: 36, out: 45},
        { src: srcList[12], in: 10, out: 19},
      ];
      var clipList2 = [
        { src: srcList[10], in: 1,  out: 10},
        { src: srcList[5], in: 51, out: 60},
        { src: srcList[3],  in: 11, out: 20},
      ];
    };
    console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    player.setVpIds(vpIdsStr);
    player.setEndModal(modal);
        
  }, false); // DOM content loaded
}
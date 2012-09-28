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
"http://videos.mozilla.org/serv/webmademovies/makecorn.webm",
"http://doc.gold.ac.uk/~ma101yh/weporter/video/burningman/burningman_15.webm",
];


var modal = "#contextModal2";
loadPosBias2();
function loadPosBias2() {

  // 2 = bad audio
  // 8,9,1,5 used in posBias
  // 3,6,7,10
  // 7 = bike
  // 10 is jam circle
  // 3 is fire show
  // 6 dance desert

  // 1:
  // "bm06,bm09,pop2,
  //  pop1,bm05,bm02"

  // "bm06,bm09,pop2,
  //  bm11,bm05,bm02"
  
  
  
  // option 2 no context
  // 1: bm09,   bm10,   burn3;
  // 2: bm02,   bm13,   nbh;  
    
  
    
  
  
  console.log("PosBias");
  document.addEventListener("DOMContentLoaded", function () {
    console.log("loadPosBias2 called!");
    if (Math.round(Math.random())) {
      

      // heads: context
      // 1: burn1,  bm08,   burn3;
      // 2: bm02,   burn2,  nbh;
      var vpIdsStr = "burn1,bm10,burn3,bm02,burn2,nbh";
      var clipList1 = [                               
        { src: srcList[13], in: 1,  out: 10},
        { src: srcList[8],  in: 11, out: 20},
        { src: srcList[13], in: 31, out: 40},
      ];
      var clipList2 = [
        { src: srcList[3],  in: 1,  out: 10},
        { src: srcList[13], in: 16, out: 25},
        { src: srcList[0],  in: 4,  out: 13},
      ];
    }
    else {
      // tails: no context
      // 1: bm13,   bm08,   burn3;
      // 2: bm02,   bm09,     nbh;
      var vpIdsStr = "bm13,bm08,burn3,bm02,bm09,nbh";
      var clipList1 = [                               
        { src: srcList[11], in: 11, out: 20},
        { src: srcList[8],  in: 11, out: 20},
        { src: srcList[13], in: 31, out: 40},
      ];
      var clipList2 = [
        { src: srcList[3],  in: 1,  out: 10},
        { src: srcList[7],  in: 51, out: 60},
        { src: srcList[0],  in: 4,  out: 13},
      ];

    };

    console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    player.setVpIds(vpIdsStr);
    player.setEndModal(modal);
        
  }, false); // DOM content loaded
    
}


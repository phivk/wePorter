console.log("evaluation.js");

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

var bestParts = {
  // vpIds wRatio>60,	srcVideo,	tcIn,	tcOut,	avg(wRatio)
  11: {src: srcList[1], in: 101, out: 110},
  22: {src: srcList[2], in: 31, out: 40},
  28: {src: srcList[3], in: 51, out: 60},
  32: {src: srcList[3], in: 91, out: 100},
  33: {src: srcList[3], in: 101, out: 110},
  35: {src: srcList[3], in: 121, out: 130},
  44: {src: srcList[3], in: 211, out: 220},
  45: {src: srcList[3], in: 221, out: 230},
  46: {src: srcList[4], in: 1, out: 10},
  50: {src: srcList[4], in: 41, out: 50},
  58: {src: srcList[5], in: 71, out: 80},
  69: {src: srcList[7], in: 1, out: 10},
  72: {src: srcList[7], in: 31, out: 40},
  76: {src: srcList[7], in: 71, out: 80},
  79: {src: srcList[7], in: 101, out: 110},
  82: {src: srcList[8], in: 1, out: 10},
  83: {src: srcList[8], in: 11, out: 20},
  85: {src: srcList[8], in: 31, out: 40},
  86: {src: srcList[8], in: 41, out: 50},
  91: {src: srcList[9], in: 21, out: 30},
  97: {src: srcList[9], in: 81, out: 90},
  99: {src: srcList[9], in: 101, out: 110},
  102: {src: srcList[9], in: 131, out: 140},
  108: {src: srcList[11], in: 31, out: 40},
  109: {src: srcList[11], in: 41, out: 50},
  112: {src: srcList[11], in: 71, out: 80},
  116: {src: srcList[11], in: 111, out: 120},
  118: {src: srcList[11], in: 131, out: 140},
  122: {src: srcList[11], in: 171, out: 180},
  126: {src: srcList[11], in: 211, out: 220},
  129: {src: srcList[11], in: 241, out: 250},
  133: {src: srcList[11], in: 281, out: 290},
  136: {src: srcList[11], in: 311, out: 320},
  140: {src: srcList[11], in: 351, out: 360}
}

var worstParts = {
  // vpIds wRatio>60,	srcVideo,	tcIn,	tcOut,	avg(wRatio)
  3: {src:  srcList[1], in: 21, out: 30},
  7: {src:  srcList[1], in: 61, out: 70},
  8: {src:  srcList[1], in: 71, out: 80},
  10: {src:  srcList[1], in: 91, out: 100},
  12: {src:  srcList[1], in: 111, out: 120},
  14: {src:  srcList[1], in: 131, out: 140},
  38: {src:  srcList[3], in: 151, out: 160},
  39: {src:  srcList[3], in: 161, out: 170},
  40: {src:  srcList[3], in: 171, out: 180},
  41: {src:  srcList[3], in: 181, out: 190},
  47: {src:  srcList[4], in: 11, out: 20},
  48: {src:  srcList[4], in: 21, out: 30},
  51: {src:  srcList[5], in: 1, out: 10},
  54: {src:  srcList[5], in: 31, out: 40},
  56: {src:  srcList[5], in: 51, out: 60},
  57: {src:  srcList[5], in: 61, out: 70},
  62: {src:  srcList[5], in: 111, out: 120},
  63: {src:  srcList[5], in: 121, out: 130},
  70: {src:  srcList[7], in: 11, out: 20},
  73: {src:  srcList[7], in: 41, out: 50},
  78: {src:  srcList[7], in: 91, out: 100},
  106: {src:  srcList[11], in: 11, out: 20},
  107: {src:  srcList[11], in: 21, out: 30},
  110: {src:  srcList[11], in: 51, out: 60},
  113: {src:  srcList[11], in: 81, out: 90},
  115: {src:  srcList[11], in: 101, out: 110},
  119: {src:  srcList[11], in: 141, out: 150},
  124: {src:  srcList[11], in: 191, out: 200},
  130: {src:  srcList[11], in: 251, out: 260},
  137: {src:  srcList[11], in: 321, out: 330},
  138: {src:  srcList[11], in: 331, out: 340},
  139: {src:  srcList[11], in: 341, out: 350},
  142: {src:  srcList[11], in: 371, out: 380} 
}

// loadParallelPair();

// best seq
// [22, 35, 50, 69, 85, 133]
// worst seq
// [3, 40, 47, 56, 70, 142]
// loadSeqPair(1, [35, 22, 50, 69, 85, 133], [40, 3, 47, 56, 70, 142])

// good alt seq
// [45, 46, 79, 83, 99, 112]
// bad alt seq
// [8, 41, 48, 62, 78, 113]
// loadSeqPair(2, [45, 46, 79, 83, 99, 112], [41, 8, 48, 62, 78, 113])


// loadVideoPair(4, 11, 3);
// loadVideoPair(5, 35, 40);
// loadVideoPair(6, 50, 47);
// loadVideoPair(7, 58 , 56 );
// loadVideoPair(8, 69 , 70 );
// loadVideoPair(9, 133, 142);

function loadSeqPair(n, goodIdList, badIdList) {
  document.addEventListener("DOMContentLoaded", function () {
    console.log("now loading seqPair");
    var clipListGood = [                               
      bestParts[goodIdList[0]],
      bestParts[goodIdList[1]],
      bestParts[goodIdList[2]],
      bestParts[goodIdList[3]],
      bestParts[goodIdList[4]],
      bestParts[goodIdList[5]],
    ];
    
    var clipListBad = [                               
      worstParts[badIdList[0]],
      worstParts[badIdList[1]],
      worstParts[badIdList[2]],
      worstParts[badIdList[3]],
      worstParts[badIdList[4]],
      worstParts[badIdList[5]],
    ];
    
    // load good and bad clip left or right based on coin flip
    if (Math.round(Math.random())) {
      // heads
      var containerIdGood = "seq"+n+"left";
      var containerIdBad = "seq"+n+"right";
    }
    else {
      // tails
      var containerIdGood = "seq"+n+"right";
      var containerIdBad  = "seq"+n+"left";
    }   
    
    console.log(clipListBad);
    console.log(clipListGood);
    
    var containerId1 = containerIdGood;
    var clipList1    = clipListGood;
    var containerId2 = containerIdBad;
    var clipList2    = clipListBad;
    
    var seq1 = Popcorn.sequence( containerId1, clipList1);
    var seq2;
    seq1.listen("canplaythrough", function(){
      console.log("seq1 canplaythrough");
      setTimeout ( function(){
        console.log("now loading seq2");
        seq2 = Popcorn.sequence( containerId2, clipList2);
        seq2.listen("canplaythrough", function(){
          console.log("seq2 canplaythrough");
        });
      }, 100 );
    });

  }, false); // DOM content loaded
}

function loadParallelPair() {
  document.addEventListener("DOMContentLoaded", function () {
    console.log("now loading parallelPair");
    // good
    var clipList1Good = [
      bestParts[11],  //src1
  		bestParts[22],  //src2
  		bestParts[35],  //src3
      bestParts[50],  //src4
      bestParts[69],  //src7
      bestParts[133]  //src11
  	];
  	
    var clipList2Good = [
      bestParts[44],  //3
  		bestParts[58],  //5
  		bestParts[72],  //7
      bestParts[122], //11
      bestParts[85],  //8
      bestParts[102], //9
  	];
    console.log("CL1: ", clipList1Good, "CL2: ", clipList2Good);
    var vpIds1Good = [11, 22, 35, 50, 69, 133];
    var vpIds2Good = [44, 58, 72, 122, 85, 102];
    var vpIdsStrGood = vpIds1Good.concat(vpIds2Good).toString();


    // bad
    var clipList1Bad = [
      worstParts[3  ], //src1
      worstParts[39 ], //src3
      worstParts[56 ], //src5
      worstParts[47 ], //src4
      worstParts[73 ], //src7
      worstParts[138]  //src11
    ];

    var clipList2Bad = [
      worstParts[40 ], //src3
      worstParts[63 ], //src5
      // worstParts[78 ], //src7
      worstParts[70 ], //src7
      worstParts[142], //src11
      worstParts[48 ], //src4
      worstParts[12 ], //src1
    ];
    console.log("CL1: ", clipList1Bad, "CL2: ", clipList2Bad);
    var vpIds1Bad = [11, 22, 35, 50, 69, 133];
    var vpIds2Bad = [44, 58, 72, 122, 85, 102];
    var vpIdsStrBad = vpIds1Bad.concat(vpIds2Bad).toString();
    
    // load good and bad clip left or right based on coin flip
    if (Math.round(Math.random())) {
      // heads
      var containerIdGood = "interactionWrapperLeft";
      var containerIdBad  = "interactionWrapperRight";

    }
    else {
      // tails
      var containerIdGood = "interactionWrapperRight";
      var containerIdBad  = "interactionWrapperLeft";
    }
    
    // init players one after the other
    playerGood = new parallelPlayer("playerGood", containerIdGood, clipList1Good, clipList2Good);
    playerGood.setVpIds(vpIdsStrGood);
    // playerGood.setRecurring(true);
    
    // load playerBad after playerGood canplaythrough
    playerGood.seqs[0].listen("canplaythrough", function(){
      playerGood.canPlayThrough[0] = true;
      if (playerGood.canPlayThrough[1]) {
        // console.log("***starting 2nd player soon...")
        setTimeout ( function(){
          // console.log("***now!");
          console.log("now constructing playerBad");
          playerBad = new parallelPlayer("playerBad", containerIdBad, clipList1Bad, clipList2Bad);
          playerBad.setVpIds(vpIdsStrBad);
          // playerBad.setRecurring(true);
        }, 5000 );
      };
    });
    playerGood.seqs[1].listen("canplaythrough", function(){
      // console.log("seq 1 canplaythrough");
      playerGood.canPlayThrough[1] = true;
      if (playerGood.canPlayThrough[0]) {
        // console.log("***starting 2nd player soon...")
        setTimeout ( function(){
          // console.log("***now!");
          console.log("now constructing playerBad");
          playerBad = new parallelPlayer("playerBad", containerIdBad, clipList1Bad, clipList2Bad);
          playerBad.setVpIds(vpIdsStrBad);
          // playerBad.setRecurring(true);
        }, 5000 );
      };
    });
  }, false); // DOM content loaded
}

function loadVideoPair(n, goodId, badId) {
  document.addEventListener("DOMContentLoaded", function () {
    console.log("now loading videoPair");
    var clipListGood = [                               
      bestParts[goodId]
    ];
    var clipListBad = [                               
      worstParts[badId]
    ];
    
    // load good and bad clip left or right based on coin flip
    if (Math.round(Math.random())) {
      // heads
      var containerIdGood = "seq"+n+"left";
      var containerIdBad = "seq"+n+"right";
    }
    else {
      // tails
      var containerIdGood = "seq"+n+"right";
      var containerIdBad  = "seq"+n+"left";
    }   
    
    console.log(clipListBad);
    console.log(clipListGood);
    
    // load last part first (otherwise parts 133, 142 wont load)
    if (goodId < badId) {
      var containerId1 = containerIdBad;
      var clipList1 = clipListBad;
      var containerId2 = containerIdGood;
      var clipList2 = clipListGood;
    }
    else {
      var containerId1 = containerIdGood;
      var clipList1    = clipListGood;
      var containerId2 = containerIdBad;
      var clipList2    = clipListBad;
    };
    
    var seq1 = Popcorn.sequence( containerId1, clipList1);
    var seq2;
    seq1.listen("canplaythrough", function(){
      console.log("seq0 canplaythrough");
      setTimeout ( function(){
        console.log("now loading seq2");
        seq2 = Popcorn.sequence( containerId2, clipList2)
      }, 100 );
    });
    
  }, false); // DOM content loaded
}
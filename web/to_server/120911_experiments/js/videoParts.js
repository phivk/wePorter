function partsCreator(src, partLength){
    // calc number of parts in src
    var srcVid = load(src);
    var nOParts = floor(srcVid.duration()/partLength);
    var partsList = [];
    for (var i= 0; i < nOParts; i++){
      partsList[i] = {
        "src": src,
        "in": i*partLength;
        "out": i*partLength + partLength;
      };
    };
    return partsList;
}

// e.g.:
{
    src: "content/video/video1.webm",
    in: 0, 
    out: 10
}



function session(){
  // load viewing
  viewing = loadViewing();
  // set viewing on parallel player
  setViewing(viewing);
}

// simple test function to create demo sequence
function loadViewing(){
  var testSeq1 = new Sequence([
      new VideoPart('p1', 'video1', 0, 10),
      new VideoPart('p2', 'video1', 10, 20),
      new VideoPart('p3', 'video2', 0, 10),
      new VideoPart('p4', 'video2', 10, 20),
      new VideoPart('p5', 'video3', 0, 10),
      new VideoPart('p6', 'video3', 10, 20)
      ]);
  var testSeq2 = new Sequence([
      new VideoPart('p7', 'video1', 20, 30),
      new VideoPart('p8', 'video1', 30, 40),
      new VideoPart('p9', 'video2', 20, 30),
      new VideoPart('p30', 'video2', 30, 40),
      new VideoPart('p11', 'video3', 20, 30),
      new VideoPart('p12', 'video3', 30, 40)
      ]);
  var viewing = {
    seq1: testSeq1,
    seq2: testSeq2,  
  };
  return viewing;
}

// set viewing into DOM
function setViewing(){
  // TODO
}

/// JS Object Constructors ///
function Sequence(parts){
  this.parts = parts;
}

function VideoPart(id, src, tcIn, tcOut){
  this.id = id;
  this.src = src;
  this.tcIn = tcIn;
  this.tcOut = tcOut;
}


// id:       "video1_001",
// src:      "value",
// tc_in:    "0", 
// tc_out:   "10",
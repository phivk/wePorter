// ensure the web page (DOM) has loaded
// document.addEventListener("DOMContentLoaded", function () {
// }, false); // DOM content loaded

// jubilee_01.mp4 +
// jubilee_02.mp4 +
// jubilee_03.mp4 +
// jubilee_04.mp4 +
// jubilee_05.mp4 -
// jubilee_06.mp4 +
// jubilee_07.mp4 +
// jubilee_08.mp4 +
// jubilee_09.mp4 
// jubilee_10.mp4 +
// jubilee_11.mp4 
// jubilee_12.mp4 

function testLoad (vpIdsStr) {
  console.log("TEST LOAD");
  document.addEventListener("DOMContentLoaded", function () {
    
    // var clipList1 = [
    //   { src: "content/video/jubilee/jubilee_01.webm", in: 21,  out: 30  },
    //   { src: "content/video/jubilee/jubilee_02.webm", in: 11,  out: 20  },
    //   { src: "content/video/jubilee/jubilee_03.webm", in:  1,  out: 10  },
    //   { src: "content/video/jubilee/jubilee_04.webm", in: 21,  out: 30  },
    //   { src: "content/video/jubilee/jubilee_06.webm", in: 11,  out: 20  },
    //   { src: "content/video/jubilee/jubilee_07.webm", in:  1,  out: 10  },
    // 
    // ];
    // var clipList2 = [
    //   { src: "content/video/jubilee/jubilee_07.webm", in: 21,  out: 30  },
    //   { src: "content/video/jubilee/jubilee_06.webm", in: 11,  out: 20  },
    //   { src: "content/video/jubilee/jubilee_04.webm", in:  1,  out: 10  },
    //   { src: "content/video/jubilee/jubilee_03.webm", in: 21,  out: 30  },
    //   { src: "content/video/jubilee/jubilee_02.webm", in: 11,  out: 20  },
    //   { src: "content/video/jubilee/jubilee_01.webm", in:  1,  out: 10  },
    // ];
    
    var clipList1 = [
      { src: "./content/video/jubilee/jubilee_01.webm", in: 3,  out: 4},
      { src: "./content/video/jubilee/jubilee_02.webm", in: 2,  out: 3},
      { src: "./content/video/jubilee/jubilee_03.webm", in: 1,  out: 2},
      { src: "./content/video/jubilee/jubilee_05.webm", in: 3,  out: 4},
      { src: "./content/video/jubilee/jubilee_07.webm", in: 2,  out: 3},
      { src: "./content/video/jubilee/jubilee_09.webm", in: 1,  out: 2},
                                                                       
    ];                                                                 
    var clipList2 = [                                                  
      { src: "./content/video/jubilee/jubilee_12.webm", in: 1,  out: 2}, 
      { src: "./content/video/jubilee/jubilee_11.webm", in: 2,  out: 3},
      { src: "./content/video/jubilee/jubilee_05.webm", in: 3,  out: 4},
      { src: "./content/video/jubilee/jubilee_03.webm", in: 1,  out: 2},
      { src: "./content/video/jubilee/jubilee_09.webm", in: 2,  out: 3},
      { src: "./content/video/jubilee/jubilee_01.webm", in: 3,  out: 4},
    ];
    
    var path = "content/video/jubilee/";
    // var path = "content/video/jubilee/redownloaded/";
    
    var a = "02";
    var b = "04";
    var fileA = "jubilee_"+a;
    var fileB = "jubilee_"+b;
    
    var extension = ".webm"
    // var extension = ".mp4";

    var clipList1b = [
      { src: path+fileA+extension, in: 1,  out: 2 }, 
      { src: path+fileB+extension, in: 6 , out: 7 },       
    ];                            
    var clipList2b = [ 
      { src: path+fileB+extension, in: 1,  out: 2 },
      { src: path+fileA+extension, in: 6 , out: 7 },
    ];
    
    // console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    player.setVpIds(vpIdsStr);
        
  }, false); // DOM content loaded
}

// Parallel Player class for 2 sequences playing in parallel
function parallelPlayer(clipList1, clipList2){
  // debug flag
  this.debug = true;
  
  // check for equal length of clipLists
  if ( clipList1.length === clipList2.length ){
    this.clipLists = [ clipList1, clipList2 ];
  }
  else {
    console.log("sequences must have same length");
    return false;
  }
	this.containerIds = [ "sequencePlayer1", "sequencePlayer2" ];
	this.playerWrapperIds = [ "playerWrapper1", "playerWrapper2" ];

	// TODO jQuery create:
	//  containerId elements
	//  playButton
	
	this.numParts;
  // counters for dynamically storing focus counts
  this.counters = {
    "sequencePlayer1": 0,
    "sequencePlayer2": 0
  };
  // counts lists to store logged focus counts (ratings)
	this.counts = [[],[]];
  
  // initiate seqs array
  this.seqs = ["",""];
  this.vpIds;
  
  // set whether visitor is recurring (else new)
  this.bRecurring = false;
  
  // declare methods
  this.loadSeq = loadSeq;
  this.attachClipEndHandlers = attachClipEndHandlers;
  this.attachFocusHandlers = attachFocusHandlers;
  this.attachPlayHandler = attachPlayHandler;
  this.counterOn = counterOn;
  this.counterOff = counterOff;
  this.clipEndHandler = clipEndHandler;
  this.seqEndHandler = seqEndHandler;
  this.logCount = logCount;
  this.setVpIds = setVpIds;
  this.getVpIds = getVpIds;
  this.setCounterVisibility = setCounterVisibility;
  this.createCounters = createCounters;
  this.setRecurring = setRecurring;

  // execute methods in constructor
  this.loadSeq(0, this.clipLists[0]);
  this.loadSeq(1, this.clipLists[1]);
  this.attachClipEndHandlers(0);
  this.attachClipEndHandlers(1);
  this.attachFocusHandlers();
  this.attachPlayHandler();
  
  if (this.debug) {
    this.createCounters();
    this.setCounterVisibility(true);
  }
  else {
    this.setCounterVisibility(false);    
  }

	/// Methods ///
	
	// load clipList into sequence 0 or 1
  function loadSeq (seqIdx, clipList) {
    console.log(this);
    // construct popcorn sequence, add to seqs array
    if (seqIdx == 0 || seqIdx == 1 ) {
      this.seqs[seqIdx] = Popcorn.sequence( this.containerIds[seqIdx], clipList );
    }
    else {
      console.log( "seqIdx should be 0 or 1" );
      return false;
    }
    this.numParts = clipList.length;
  }
  
  function setVpIds(vpIdsStr) {
    // format vpIdsStr to array
    var vpIds = explode(",", vpIdsStr);
    var halfSize = vpIds.length/2;
    this.vpIds = array_chunk(vpIds, vpIds.length/2);
  }
  
  function getVpIds () {
    return this.vpIds;
  }
  
  // Attach end-of-clip Handlers
  function attachClipEndHandlers (seqIdx) {
    var self = this;
    var sequence = this.seqs[seqIdx];
    
    // for all clips in sequence: 
    //  mute()
    //  get and reset playerCounter at each end of clip
    var lastIdx = 0;
    var lastTime = 0;
    
    for(var i=0; i < sequence.playlist.length; i++){
      //mute from start
      sequence.eq(i).mute();

      // attach handlers at clipEnded
      sequence.eq(i).on('timeupdate', function(){      
        // console.log("this.seqs[seqIdx] in attacher: "+this.seqs[seqIdx]);
        // console.log("in attacher");
        
        var idx = sequence.active;
        var curTime = this.currentTime();
        var curOut = sequence.inOuts.ofVideos[idx].out;

        if ( curTime != lastTime ) {
          if ( idx != lastIdx ) {
            /// transition from one clip to next ///
            // log and reset count
            self.clipEndHandler(seqIdx);
            lastIdx = idx;
          } 
          else if ( Math.floor(curTime) === curOut ) {
            /// end of sequence ///
            self.clipEndHandler(seqIdx);
            self.seqEndHandler(seqIdx);
          };
          lastTime = curTime;
        }; //if
      }); //on('timeupdate')
    }; //for    
  };
  
  // clipEnd event handler  
  function clipEndHandler(seqIdx) {
    if (this.debug) {
      console.log("**clip ended");
      console.log(this.counts);
      // console.log("currentTime: ", this.seqs[seqIdx].eq(0).currentTime());  
    }
    // logCount if playing sequence (not on load)
    if (this.seqs[seqIdx].eq(0).currentTime() > 1) {
      this.logCount(this.containerIds[seqIdx]);
    }
    // if counts is complete
    if (this.counts[0].length == this.numParts && this.counts[1].length == this.numParts) {
      // AJAX send values to store db
      emitInteractions(this.vpIds, this.counts);
      $('#thanksModal').reveal();
      // if (this.bRecurring) {
      //   $('#thanksModal').reveal();
      // }
      // else {
      //   $('#questionnaireModal').reveal();
      // };
      if (this.debug) {console.log(this.bRecurring)};
    }
  }
  
  // seqEnd event handler  
  function seqEndHandler(seqIdx) {  
    if (this.debug) {
      console.log("**sequence ended");
      // console.log("counts:", this.counts);
    }    
  }
  
  function attachFocusHandlers() {
    // attach handlers for focus behaviour triggered by hover
    // focusBlock hover behaviour for blocking unfocussed video
    
    // make accessible ref to this (class)
    var self = this;
    if (this.debug) {
      console.log("self.playerWrapperIds: "+ self.playerWrapperIds);
    };
    
    $('.focusBlock').removeClass('focusBlock').addClass('focusBlock-js');
    $('.playerWrapper').hover(
      function(){
        // console.log("mouse entry");
        /// mouse entry ///

        // start counter
        // TODO everything inside: if ( seq.isPlaying){...}
        var targetId = $(this).find('.videoBox').attr('id');
        self.counterOn(targetId);

        // video visible
        $(this).find('.focusBlock-js').fadeToggle('fast');

        // unmute audio
        if($(this).attr('id') === self.playerWrapperIds[0]){
          self.seqs[0].playlist.forEach( function(video) {
            video.unmute();
          });       
        } 
        else if ( $(this).attr('id') === self.playerWrapperIds[1] ) {
          self.seqs[1].playlist.forEach( function(video) {
            video.unmute();
          });
        };
      }, // function mouse entry
      function(){
        // console.log("mouse exit");
        /// mouse exit ///

        // video less visible
        $(this).find('.focusBlock-js').fadeToggle('slow');

        // stop counter
        self.counterOff();

        // mute audio
        if ($(this).attr('id') === self.playerWrapperIds[0]) {
          // self.seqs[0].playlist[(self.seqs[0].active)].mute();
          self.seqs[0].playlist.forEach( function(video) {
            video.mute();
          });
        }
        else if($(this).attr('id') === self.playerWrapperIds[1]) {
          // self.seqs[1].playlist[(self.seqs[0].active)].mute();
          self.seqs[1].playlist.forEach( function(video) {
            video.mute();
          });
        };
      } // function mouse exit
    ); // hover()
  };
  
  function attachPlayHandler () {
    var self = this;
    // attach click handler to Play button
    $('a[name="playButton"]').on('click', function(){  
      // if any is playing: pause all
      if(!self.seqs[0].eq(self.seqs[0].active).paused() || !self.seqs[1].eq(self.seqs[1].active).paused()){
        console.log("pause!");
        self.seqs[0].eq(self.seqs[0].active).pause();
        self.seqs[1].eq(self.seqs[1].active).pause();
      }
      // if both paused: play all
      else {   
        console.log("play!");
        self.seqs[0].play();
        self.seqs[1].play();
        // TODO
        //toggleVisibility("playButton");
      }
    });
  };
  
  function counterOn(targetId){
    // TODO Fix; ugly ref to player object for now
    var playerObjName = "player";
    
    if (this.debug) {
      // div counter++
      var counterId = "#" + targetId + "Counter";
      var curVal = parseInt($(counterId).val(), 10);
      $(counterId).val(curVal+1);
    };
    
    // var counter++
    this.counters[targetId] += 1;
    
    // trigger next
    timeoutId=setTimeout(playerObjName+'.counterOn(\'' +targetId+ '\')',100);
  }

  function counterOff(){
    clearTimeout(timeoutId);
  }
  
  function logCount(playerId){
    var counterId = playerId + "Counter";
    // get count
    if (this.debug) {
      var count = $("#"+counterId).val();
      // div count
      console.log('div count: '+$("#"+counterId).val());    
    };    
    
    // var count
    var count = this.counters[playerId];

    // append count to counts
    if (playerId === this.containerIds[0]) {
      this.counts[0].push(count);
    }
    else if (playerId === this.containerIds[1]) {
      this.counts[1].push(count);
    }
    else {
      console.log("error: unknown player Id specified: " + playerId);
      return false;
    }
    
    // reset count
    if (this.debug) {
      // div counter
      $("#"+counterId).val(0);
    };
    // var counter
    this.counters[playerId] = 0;
    
    // DEBUG
    if (this.debug) {
      // console.log("Counts: ");
      // console.log(this.counts);
    }
  }
  
  //   <div class="sequenceWrapper">
  //  <div id='playerWrapper2' class='playerWrapper'>
  //    <div class="focusBlock"></div>
  //    <div id="sequencePlayer2" class="videoBox"></div>
  //  </div>
  //  <div class="data-wrapper">
  //    <input id="sequencePlayer2Counter" class="counter" value="0"/>
  //  </div>
  // </div>
  
  function createCounters() {
    console.log(this);
    var self = this;
    console.log(self);
    if ($('.data-wrapper').length == 2) {
      $('.data-wrapper').each(function(index, elem) {
        $(elem).append('<input id="'+self.containerIds[index]+'Counter"'+' class="counter" value="0"/>');
      });
    };
  }
  
  // set visibility of Counter divs
  function setCounterVisibility(bOn) {
    if (bOn) {
      $('.counter').each(function(){
        this.style.visibility = "visible";
      });
    }
    else {
      $('.counter').each(function(){
        this.style.visibility = "hidden";
      });
    };
  }
  
  function setRecurring(bRecurring) {
    this.bRecurring = bRecurring;
  }
} // class parallelPlayer


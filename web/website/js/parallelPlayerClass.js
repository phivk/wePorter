/*
  parallelPlayer Class
  Load two sequences of video parts to be played in parallel.
  MouseOver triggers focus on video, focus data is captured and send to db.

  create new (must be global): objName = new parallelPlayer([objname], interactionWrapperId, clipList1, clipList2);
  needs jQuery
*/

// Parallel Player class for 2 sequences playing in parallel
function parallelPlayer(objName, interactionWrapperId, clipList1, clipList2){
  // DEBUG
  // $("#"+interactionWrapperId).css("border", "1px dashed blue");

  // debug flag
  this.debug = false;
  this.playerObjName = objName;
  
  // check for equal length of clipLists
  if ( clipList1.length === clipList2.length ){
    this.clipLists = [ clipList1, clipList2 ];
  }
  else {
    console.log("sequences must have same length");
    return false;
  }
  
  // set containerIds, playerWrapperIds based on interactionWrapperId  
  var containerId1 = $("#"+interactionWrapperId+" .videoBox:eq(0)").attr("id");
  var containerId2 = $("#"+interactionWrapperId+" .videoBox:eq(1)").attr("id");
  var playerWrapperId1 = $("#"+interactionWrapperId+" .playerWrapper:eq(0)").attr("id");
  var playerWrapperId2 = $("#"+interactionWrapperId+" .playerWrapper:eq(1)").attr("id");
  this.interactionWrapperId = interactionWrapperId;
  this.containerIds = [ containerId1, containerId2 ];  
  this.playerWrapperIds = [ playerWrapperId1, playerWrapperId2 ];  

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
  // play(able) states
  this.canPlayThrough = [false, false];
  this.bPlaying = false;
  this.bSeqPlaying = [false, false];
  
  // modal at end; default questionnaire
  this.endModal = '#questionnaireModal';

  // declare methods
  this.loadSeq = loadSeq;
  this.attachClipEndHandlers = attachClipEndHandlers;
  this.attachFocusHandlers = attachFocusHandlers;
  this.attachCanPlayThroughHandler = attachCanPlayThroughHandler;
  this.clipEndHandler = clipEndHandler;
  this.seqEndHandler = seqEndHandler;
  this.logCount = logCount;
  this.setVpIds = setVpIds;
  this.getVpIds = getVpIds;
  this.setCounterVisibility = setCounterVisibility;
  this.createCounters = createCounters;
  this.setRecurring = setRecurring;
  this.insertPlayButton = insertPlayButton;
  this.showLoading = showLoading;
  this.hideLoading = hideLoading;
  this.insertLoading = insertLoading;
  this.seqCounterOn = seqCounterOn;
  this.counterOff = counterOff;
  this.setEndModal = setEndModal;
  
  // execute methods in constructor
  this.insertLoading();
  this.loadSeq(0, this.clipLists[0]);
  this.loadSeq(1, this.clipLists[1]);
  this.attachClipEndHandlers(0);
  this.attachClipEndHandlers(1);
  this.attachFocusHandlers();
  this.attachCanPlayThroughHandler();
  
  if (this.debug) {
    this.createCounters();
    this.setCounterVisibility(true);
    console.log(this);
    // console.log("source: ",$("video"));
    $("video").attr("type", "video/webm");
  }
  else {
    // this.setCounterVisibility(false);    
  }
  // disable video controls
  $("video").removeAttr("controls");
  
	/// Methods ///
	
	// load clipList into sequence 0 or 1
  function loadSeq (seqIdx, clipList) {
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
    // var halfSize = vpIds.length/2;
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
      
      // set bSeqPlaying false when video is suspended
      sequence.eq(i).on('suspend', function() {
        if (self.debug) {
          console.log("suspend in "+seqIdx+":"+i);
        };
        self.bSeqPlaying[seqIdx] = false;
      })
      
      // attach handlers at clipEnded
      sequence.eq(i).on('timeupdate', function(){      
        // console.log("timeupdate in "+seqIdx+":"+i);
        // set bPlaying true on clip start        
        if (self.canPlayThrough[seqIdx]) {
          self.bSeqPlaying[seqIdx] = true;
        };
        var idx = sequence.active;
        var curTime = this.currentTime();
        var curOut = sequence.inOuts.ofVideos[idx].out;

        if ( curTime != lastTime ) {
          if ( idx != lastIdx ) {
            /// transition from one clip to next ///
            // log and reset count
            // only fire while playing, not on load
            if (self.bPlaying) {
              self.clipEndHandler(seqIdx);
            };
            lastIdx = idx;
          } 
          else if ( Math.floor(curTime) === curOut ) {
            /// end of sequence ///
            // only fire while playing, not on load
            if (self.bPlaying) {
              self.clipEndHandler(seqIdx);
              self.seqEndHandler(seqIdx);
            };
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
    if (this.bSeqPlaying[seqIdx]) {
      this.logCount(this.containerIds[seqIdx]);
      // set bSeqPlaying false on clipEnd
      this.bSeqPlaying[seqIdx] = false;
    };
    
    // if counts is complete
    if (this.counts[0].length == this.numParts && this.counts[1].length == this.numParts) {
      // AJAX send values to store db
      emitInteractions(this.vpIds, this.counts);
      if (this.debug) {
        console.log("bRecurring: ",this.bRecurring);
      };
      // show modal
      // $(this.endModal).reveal();
      
      $(this.endModal).reveal({
           animation: 'fadeAndPop', //fade, fadeAndPop, none
           animationspeed: 300, //how fast animations are
           closeOnBackgroundClick: false, //if you click background will modal close?
           // dismissModalClass: 'close-reveal-modal closeModal' //the class of a button or element that will close an open modal
           dismissModalClass: 'close-reveal-modal', //the class of a button or element that will close an open modal
      });
      // if (this.bRecurring) {
      //   $('#thanksModal').reveal();
      // }
      // else {
      //   $('#questionnaireModal').reveal();
      // };
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
    
    $("#"+self.interactionWrapperId+" .focusBlock").removeClass('focusBlock').addClass('focusBlock-js');
    $("#"+self.interactionWrapperId+" .playerWrapper").hover(
      function(){
        // console.log("mouse entry");
        /// mouse entry ///

        // start counter
        // TODO everything inside: if ( seq.isPlaying){...}
        var targetId = $(this).find('.videoBox').attr('id');
        // self.counterOn(targetId);

        // video visible
        $(this).find('.focusBlock-js').fadeToggle('fast');

        // unmute audio
        if($(this).attr('id') === self.playerWrapperIds[0]){
          self.seqs[0].playlist.forEach( function(video) {
            video.unmute();
          });
          self.seqCounterOn(0);
          // TODO
          // self.bHovered[0] = true;
        } 
        else if ( $(this).attr('id') === self.playerWrapperIds[1] ) {
          self.seqs[1].playlist.forEach( function(video) {
            video.unmute();
          });
          self.seqCounterOn(1);
          // self.bHovered[1] = true;
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
          // self.bHovered[1] = false;
        }
        else if($(this).attr('id') === self.playerWrapperIds[1]) {
          // self.seqs[1].playlist[(self.seqs[0].active)].mute();
          self.seqs[1].playlist.forEach( function(video) {
            video.mute();
          });
          // self.bHovered[1] = false;
        };
      } // function mouse exit
    ); // hover()
  };
  
  function attachTimeupdateHandler() {
    self.seqs[0].listen("timeupdate", function(){
      // TODO
    });
  };
  
  function attachCanPlayThroughHandler () {
    var self = this;
    self.seqs[0].listen("canplaythrough", function(){
      console.log("seq 0 canplaythrough");
      self.canPlayThrough[0] = true;
      if (self.canPlayThrough[1]) {
        // TODO fix ugly hack: delay button_insert to be sure seq is loaded
        setTimeout ( function(){
          self.insertPlayButton();
          self.hideLoading();
        }, 5000 );
      };
    });
    self.seqs[1].listen("canplaythrough", function(){
      console.log("seq 1 canplaythrough");
      self.canPlayThrough[1] = true;
      if (self.canPlayThrough[0]) {
        setTimeout ( function(){
          self.insertPlayButton();
          self.hideLoading();
        }, 5000 );
      };
    });
  };
  
  // insert playButton html
  function insertPlayButton() {
    var self = this;
    // var playButtonHtml = "<p><a name='playButton' id='playButton' class='button' style='position: absolute; top: 29.3%; left: 150px;'>Play >></a></p>";
    var playButtonHtml = "<p><a name='playButton' id='playButton' class='button' style='position: absolute; top: 270px; left: 150px;'>Play >></a></p>";
    $("#"+self.interactionWrapperId).append(playButtonHtml);
    // attach click handler to Play button
    $('#'+self.interactionWrapperId+' a[name="playButton"]').on('click', function(){  
      // if any is playing: pause all
      if(!self.seqs[0].eq(self.seqs[0].active).paused() || !self.seqs[1].eq(self.seqs[1].active).paused()){
        console.log("pause!");
        self.seqs[0].eq(self.seqs[0].active).pause();
        self.seqs[1].eq(self.seqs[1].active).pause();
        // disable counting
        self.bPlaying = false;
      }
      // if both paused: play all
      else {
        var playButton
        console.log("play!");
        self.seqs[0].play();
        self.seqs[1].play();
        // set enable counting
        self.bPlaying = true;
        // hide playButton
        console.log("playbutton jq:",$("#"+self.interactionWrapperId+" #playButton"));
        $("#"+self.interactionWrapperId+" #playButton").hide();
      }
    });
  }
  
  function seqCounterOn(seqIdx){
    // TODO Fix; ugly ref to player object for now
    // var playerObjName = 'player';
    var playerObjName = this.playerObjName;
    var targetId = this.containerIds[seqIdx];
    
    if (this.debug) {
      // div counter++
      var counterId = "#" + targetId + "Counter";
      var curVal = parseInt($(counterId).val(), 10);
      if (this.bSeqPlaying[seqIdx]) {
        $(counterId).val(curVal+1);
      };
    };
    
    // var counter++
    if (this.bSeqPlaying[seqIdx]) {
      this.counters[targetId] += 1;
    };
    
    // trigger next
    timeoutId=setTimeout(playerObjName+'.seqCounterOn(\'' +seqIdx+ '\')',100);
  }

  // DEPRECATED: use seqCounterOn()
  // function counterOn(targetId){
  //   console.log("targetId: ", targetId);
  //   // TODO Fix; ugly ref to player object for now
  //   var playerObjName = "player";
  //   
  //   if (this.debug) {
  //     // div counter++
  //     var counterId = "#" + targetId + "Counter";
  //     var curVal = parseInt($(counterId).val(), 10);
  //     if (this.bPlaying) {
  //       $(counterId).val(curVal+1);
  //     };
  //   };
  //   
  //   // var counter++
  //   if (this.bPlaying) {
  //     this.counters[targetId] += 1;
  //   };
  //   
  //   // trigger next
  //   timeoutId=setTimeout(playerObjName+'.counterOn(\'' +targetId+ '\')',100);
  // }

  function counterOff(){
    clearTimeout(timeoutId);
  }
  
  function logCount(playerId){
    var counterId = playerId + "Counter";
    // get count
    if (this.debug) {
      // var count = $("#"+counterId).val();
      // div count
      // console.log('div count: '+$("#"+counterId).val());    
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
  
  function createCounters() {
    var self = this;
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
  
  // set whether visitor is recurring (has submitted form)
  function setRecurring(bRecurring) {
    this.bRecurring = bRecurring;
    this.endModal = '#thanksModal';
  }
  
  function insertLoading() {
    var loaderImgHtml = "<img id='loaderImg' style='position: absolute; top: 273px; left: 180px;' src='./content/gif/loading.gif'/>";
    $("#"+this.interactionWrapperId).append(loaderImgHtml);
  }
  
  function showLoading() {
    // $("#loaderImg").show();
    $("#"+this.interactionWrapperId+" #loaderImg").show();
  }
  
  function hideLoading() {
    // $("#loaderImg").hide();
    $("#"+this.interactionWrapperId+" #loaderImg").hide();
  }
  
  function setEndModal(modalId) {
    this.endModal = modalId;
  }
  
  
} // class parallelPlayer

// only for testing
function testLoad (vpIdsStr) {
  console.log("TEST LOAD");
  document.addEventListener("DOMContentLoaded", function () {
    var clipList1 = [
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_01.webm", in: 30,  out: 40},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_02.webm", in: 20,  out: 30},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_03.webm", in: 10,  out: 20},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_05.webm", in: 30,  out: 40},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_07.webm", in: 20,  out: 30},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_09.webm", in: 10,  out: 20},                                                              
    ];                                              
    var clipList2 = [                               
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_04.webm", in: 10,  out: 20}, 
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_11.webm", in: 20,  out: 30},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_05.webm", in: 30,  out: 40},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_03.webm", in: 10,  out: 20},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_09.webm", in: 20,  out: 30},
      { src: "http://doc.gold.ac.uk/~ma101pvk/weporter/jubilee/jubilee_01.webm", in: 30,  out: 40},
    ];
    
    // console.log("CL1: ", clipList1, "CL2: ", clipList2);
    player = new parallelPlayer(clipList1, clipList2);
    player.setVpIds(vpIdsStr);
    player.setRecurring(true);
        
  }, false); // DOM content loaded
}

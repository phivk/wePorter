<?php
  /**
  * Class to load video parts from database into popcorn sequences.
  * @author Philo van Kemenade [no spaces] at gmail dot com
  * @copyright 2012 Philo van Kemenade
  */
  require('helpers.php');
  class sequenceLoader
  {
    // number of parts
    public $nParts = 6;
    
    // db vars
    // DEBUG
    // public $db_servername = "localhost";
    // public $db_username = "root";
    // public $db_password = "root";
    // public $db_name = "wePorter";
    // public $DEBUG = false;
    
    public $db_servername = "localhost";
    public $db_username = "ma101pvk";
    public $db_password = "conrrite";
    public $db_name = "ma101pvk_weporter";
    public $DEBUG = false;
    
    
    // mysqli db connection
    public $mysqli;
    
    // sequences of video parts (assoc array)
    private $seqs;
    // sequences of video part Ids (int)
    private $vpIds;
    
    public function __construct()  
    {  
        if ($this->DEBUG) {
          echo 'The class "', __CLASS__, '" was initiated.<br />'; 
        }
        // open DB connection
        $this->openDBcon();
    } 

    public function __destruct() 
    { 
        if ($this->DEBUG) {
          echo 'The class "', __CLASS__, '" was destroyed.<br />';  
        }
        $this->closeDBcon();
    }
    
    public function __toString()
    {
      $instanceString = 'Instance of class "'.__CLASS__.'"<br />';
      echo $instanceString;
      return $instanceString;
    }
    
    // set DEBUG to True / False
    public function setDebug($bDebug)
    {
      $this->DEBUG = $bDebug;
    }
    
    public function openDBcon()
    {
      // mysqli connection
      $this->mysqli = new mysqli($this->db_servername, $this->db_username, $this->db_password, $this->db_name);
      if (!mysqli_connect_errno()) {
        if ($this->DEBUG) {
          echo "connected to db ". $this->db_name ." on ".$this->db_servername."<br>";
        }
      }
      else {
        exit("db connection error: ".mysqli_connect_errno());
      }
    }
    
    // close mysqli connection
    public function closeDBcon() {
      mysqli_close($this->mysqli);
    }
    
    public function getSequences() {
      return $this->seqs;
    }
    
    public function getVpIds() {
      return $this->vpIds;
    }
    
    // return sequence (num array) of video parts (assoc arrays) from db
    public function loadSequences() {
      // TODO load seqs based on previously watched vp's
      // for now OK: immediate recurring triggers different vp's because of increased counts
      if ($this->DEBUG) {
        echo("Loading new sequence from DB<br/>");
      }

      // fill sequences with parts
      // array of vpId's (int)
      $seq1 = array();
      $seq2 = array();
      // array of Video_Part DB rows (array)
      $vpSeq1 = array();
      $vpSeq2 = array();
      for ($i = 0; $i < $this->nParts; $i++) {
        $seqs =  $this->appendVideoPart($seq1, $seq2, $vpSeq1, $vpSeq2);
        $seq1 = $seqs[0]; 
        $seq2 = $seqs[1];
        $vpSeq1 = $seqs[2]; 
        $vpSeq2 = $seqs[3];
      }
      // shuffle sequences
      shuffle_unison($seq1, $seq2);
      shuffle_unison($vpSeq1, $vpSeq2);
      // store sequences of video parts (assoc array)
      // $this->seqs  = [$vpSeq1, $vpSeq2];
      $this->seqs  = array($vpSeq1, $vpSeq2 );
      // store sequences of vpIds (int)
      // $this->vpIds = [$seq1, $seq2];
      $this->vpIds = array($seq1, $seq2);
      // return [$vpSeq1, $vpSeq2];
    }
    
    
    
    public function appendVideoPart($seq1, $seq2, $vpSeq1, $vpSeq2)
    {
      if ($this->DEBUG) {
        print("###################");
        echo("<br/>");
        print("*Now appending videoPart to:<br/>");
        print_r($seq1);
        echo("<br/>");
        print_r($seq2);
        echo("<br/>");
      };

      if ( count($seq1) == 0) {
        if ($this->DEBUG) {
          print("**empty seq1");
          echo("<br/>");
        };

        // no parts in sequence yet: select all vpId's with minCount
        $sqlQ1 = "SELECT `Video_Parts`.vpId, `Video_Parts`.srcVideo, `Video_Parts`.tcIn, `Video_Parts`.tcOut
        FROM `Video_Part_Counts`
        LEFT JOIN `Video_Parts`
        ON `Video_Part_Counts`.vpId = `Video_Parts`.`vpId`
        WHERE vpcount = (SELECT MIN(vpcount) AS minCount FROM `Video_Part_Counts`);";
      }
      else {
        if ($this->DEBUG) {
          echo "**NON-empty seq1 <br/>";
        };
        // 1. get minCount of horizontal selection
        $seq1Str = '('.implode(",",$seq1).')';      
        $sqlQminCount1 = "SELECT MIN(vpcount) as minCount FROM
        (
        	SELECT `Video_Part_Counts`.vpId, vpcount
        	FROM `Video_Part_Counts`
        	RIGHT JOIN
        	(
        		SELECT vpId
        		FROM `Video_Parts`
        		WHERE srcVideo not IN
        		(
        			SELECT srcVideo FROM `Video_Parts`
        	        WHERE vpId IN $seq1Str
        		)
        	) as hSelection
        	ON `Video_Part_Counts`.vpId = hSelection.vpId
        ) as hSelectionCounts;";
        $sqlRminCount1 = $this->mysqli->query($sqlQminCount1) or die($this->mysqli->error.__LINE__);
        $minCountRow1 = $sqlRminCount1->fetch_row();
        $minCount1 = $minCountRow1[0];

        // 2. select vpId's from hSelection where vpcount = minCount
        $sqlQ1 = "SELECT Video_Part_Counts.vpId, srcVideo, tcIn, tcOut
        FROM `Video_Part_Counts`
        RIGHT JOIN
        (
        	SELECT *
        	FROM `Video_Parts`
        	WHERE srcVideo not IN
        	(
        		SELECT srcVideo FROM `Video_Parts`
                WHERE vpId IN $seq1Str
        	)
        ) as hSelection
        ON `Video_Part_Counts`.vpId = hSelection.vpId
        WHERE vpcount = $minCount1;
        ";
      }    
      // query DB for rMinSelection1
      $rMinSelection1 = $this->mysqli->query($sqlQ1) or die($this->mysqli->error.__LINE__);
      if ($this->DEBUG) {
        print("minSelection1 returned:");
        echo("<br/>");
        print_r($rMinSelection1);
        echo("<br/>");
      };

      // pick random videoPart from rMinSelection1; add to seq1
      $numRows = $rMinSelection1->num_rows;
      $randInt = rand(0,$numRows-1);
      $rMinSelection1->data_seek($randInt);
      $row1 = $rMinSelection1->fetch_row();

      if ($this->DEBUG) {
        print_r("selected for seq1: ".$row1[0]);
        echo("<br/>");
      };
      $selectedVPId1 = $row1[0];
      array_push($seq1, $selectedVPId1);

      // form assocArray from numArray $row1
      $assocVP1 = array(
        "vpId"     => $row1[0],
        "srcVideo" => $row1[1],
        "tcIn"     => $row1[2],
        "tcOut"    => $row1[3],
      );
      array_push($vpSeq1, $assocVP1);

      // increase count by one for selected vp
      // DEPRACATED: moved to storeInteractions to increment after interactions

      // query DB for rMinSelection2 for all videoParts:
      // having different src than already in seq2 (horizontal diff)
      // having minimum count
      // having different src than selected1 (vetical diff)
      if ( count($seq2) == 0) {
        if ($this->DEBUG) {
          print("**empty seq2");
          echo("<br/>");
        };
        // no parts in seq2 yet: select vSelection =all vp's:
        // having different src than selected1 (vertical diff)
        // select vp's from vSelection where vpcount = minCount

        // 1. get minCount of nonSelectedSrc
        $sqlQminCount2 = "SELECT MIN(nonSelSrcCounts.vpcount) AS minCount FROM
        (
        	SELECT `Video_Part_Counts`.vpId, vpcount
        	FROM `Video_Part_Counts`
        	RIGHT JOIN 
        	(SELECT vpId
        	        FROM `Video_Parts`
        	        WHERE `srcVideo` != (SELECT srcVideo FROM `Video_Parts`
        	        WHERE vpId = $selectedVPId1)
        	) AS nonSelectedSrc
        	ON `Video_Part_Counts`.vpId = nonSelectedSrc.vpId
        ) AS nonSelSrcCounts
        ;";
        $sqlRminCount = $this->mysqli->query($sqlQminCount2) or die($this->mysqli->error.__LINE__);
        $minCountRow = $sqlRminCount->fetch_row();
        $minCount2 = $minCountRow[0];

        // 2. select vpId's from hSelection where vpcount = minCount
        $sqlQ2 = "SELECT vpId, srcVideo, tcIn, tcOut FROM
        (
        	SELECT `Video_Part_Counts`.vpId, vpcount, `nonSelectedSrc`.srcVideo, `nonSelectedSrc`.tcIn, `nonSelectedSrc`.tcOut
        	FROM `Video_Part_Counts`
        	RIGHT JOIN 
        	(
        		SELECT *
        	    FROM `Video_Parts`
        		WHERE `srcVideo` != (SELECT srcVideo FROM `Video_Parts`
        	    	WHERE vpId = $selectedVPId1)
        	) AS nonSelectedSrc
        	ON `Video_Part_Counts`.vpId = nonSelectedSrc.vpId
        ) AS nonSelectedSrcCounts
        WHERE vpcount = $minCount2
        ;";
      }
      else {
        if ($this->DEBUG) {
          print("**NON-empty seq2");
          echo("<br/>");
        };
        // seq2 has elements: select for hvSelection all vp's:
        // having different src than the parts already in sequence
        // AND having different src than part at same post in seq1
        // from them: having minimum count

        $seq2Str = '('.implode(",",$seq2).')';

        // 1. get minCount(hvSelection)
        $sqlQminCount2 = "SELECT MIN(hvSelectionCounts.vpcount) AS minCount FROM
        (
        	SELECT `Video_Part_Counts`.vpId, vpcount
        	FROM `Video_Part_Counts`
        	RIGHT JOIN 
        	(
        		SELECT vpId
        		FROM `Video_Parts`
        		WHERE srcVideo not IN
        		(
        		  SELECT srcVideo FROM `Video_Parts`
        		  WHERE vpId IN $seq2Str
        		)
        		AND
        		srcVideo != (SELECT srcVideo FROM `Video_Parts` WHERE vpId = $selectedVPId1)
        	) AS nonSelectedSrc
        	ON `Video_Part_Counts`.vpId = nonSelectedSrc.vpId
        ) AS hvSelectionCounts
        ;";

        $sqlRminCount = $this->mysqli->query($sqlQminCount2) or die($this->mysqli->error.__LINE__);
        $minCountRow = $sqlRminCount->fetch_row();
        $minCount2 = $minCountRow[0];

        // 2. select vpId's from hvSelection where vpcount = minCount
        $sqlQ2 = "SELECT vpId, srcVideo, tcIn, tcOut FROM
        (
        	SELECT `Video_Part_Counts`.vpId, vpcount, `nonSelectedSrc`.srcVideo, `nonSelectedSrc`.tcIn, `nonSelectedSrc`.tcOut
        	FROM `Video_Part_Counts`
        	RIGHT JOIN 
        	(
        		SELECT *
        		FROM `Video_Parts`
        		WHERE srcVideo not IN
        		(
        		  SELECT srcVideo FROM `Video_Parts`
        		  WHERE vpId IN $seq2Str
        		)
        		AND
        		srcVideo != (SELECT srcVideo FROM `Video_Parts` WHERE vpId = $selectedVPId1)
        	) AS nonSelectedSrc
        	ON `Video_Part_Counts`.vpId = nonSelectedSrc.vpId
        ) AS hvSelection
        WHERE vpcount = $minCount2
        ;";

      }

      // rMinSelection2 
      $rMinSelection2 = $this->mysqli->query($sqlQ2) or die($this->mysqli->error.__LINE__);
      if ($this->DEBUG) {
        print("minSelection1 returned:");
        echo("<br/>");
        print_r($rMinSelection2);
        echo("<br/>");
      };

      // pick random videoPart from rMinSelection2; add to seq2
      $numRows = $rMinSelection2->num_rows;
      $randInt = rand(0,$numRows-1);
      $rMinSelection2->data_seek($randInt);
      $row2 = $rMinSelection2->fetch_row();
      if ($this->DEBUG) {
        print_r("selected for seq2: ".$row2[0]);
        echo("<br/>");
      };
      $selectedVPId2 = $row2[0];
      array_push($seq2, $selectedVPId2);
      // form assocArray from numArray $row1
      $assocVP2 = array(
        "vpId"     => $row2[0],
        "srcVideo" => $row2[1],
        "tcIn"     => $row2[2],
        "tcOut"    => $row2[3],
      );
      array_push($vpSeq2, $assocVP2);

      // increase count by one for selected vp
      // DEPRACATED: moved to storeInteractions to increment after interactions

      if ($this->DEBUG) {
        print("Now Returning:");echo("<br/>");
        print_r($seq1);
        echo("<br/>");
        print_r($seq2);
        echo("<br/>");
      };
      return array($seq1, $seq2, $vpSeq1, $vpSeq2);
    } // function appendVideoPart()
    
    // return formatted html to load sequences $vpSeqs by JS call
    public function getHtmlFromSeqs($vpSeqs) {
      $html = '';
      $html .= '
        <script type="text/javascript">
          document.addEventListener("DOMContentLoaded", function () {';
      foreach($vpSeqs as $key => $seq) {
        $html .= 'var clipList'.strval($key+1).' = [ ';
        foreach($seq as $vp) {
          $srcStr = str_pad( strval($vp['srcVideo']) , 2, "0", STR_PAD_LEFT);
          $in = strval($vp['tcIn']);
          $out = strval($vp['tcOut']);
          $html .= '{
              src: "http://doc.gold.ac.uk/~ma101pvk/weporter/video/jubilee/jubilee_'.$srcStr.'.webm",
              in: '.$in.', 
              out: '.$out.'
          },'; //TODO check compatibility of trailing comma in diff browsers
        };
        $html .= ' ]; ';
      };
      // call to parallelPlayer
      $html .= 'player = new parallelPlayer(clipList1, clipList2);';
      
      
      // store seqIds in player instance
      // format vpIds to comma-separated string
      $vpIdsStr = array2stringList($this->vpIds);
      $html .= "player.setVpIds('$vpIdsStr');";
      if ($this->DEBUG) {
        $html .= "console.log('vpIds: ',player.getVpIds());";
      }
      if (isset($_SESSION['questionnaireId'])) {
        $html .= " player.setRecurring(true); ";
      }
      
      // end DOM loaded, end script
      $html .= '
          }, false);
        </script>';
      return $html;
    } // function getHtmlFromSeqs()
    
    // function getHtmlRecurring($bRecurring) {
    //   $html = "<script type='text/javascript'>
    //   player.setRecurring($bRecurring);
    //   </script>";
    //   return $html;
    // }
    
  } // class sequenceLoader
?>
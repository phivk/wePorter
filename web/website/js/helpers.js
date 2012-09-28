//////////////////////////////////////
// JS Helper functions

// format 2D array into flat comma-sep string
function array2flatList(array) {
  var arrayStr = "";
  for (var i = 0; i < array.length; i++) {
    var seq = array[i];
    var commaSep = seq.join(",");
    arrayStr += commaSep;
    if (i < array.length-1) {
      arrayStr += ",";
    }
  }
  return arrayStr;
}

// format 2D array into nested list string
function array2str(array) {
  var arrayStr = "";
  arrayStr += "[";
  for (var i = 0, cl = array.length; i < cl; i++) {
    var seq = array[i];
    arrayStr += "[";
    for (var j = 0, sl = seq.length; j < sl; j++) {
      var rating = seq[j];
      arrayStr += rating;
      if (j < sl-1) {
        arrayStr += ",";
      }
    }
    arrayStr += "]";
    if (i < cl-1) {
      arrayStr += ",";
    }
  }
  arrayStr += "]";
  return arrayStr;
}

// helper function; toggle visibility of element
function toggleVisibility(elemId) {
  document.getElementById(elemId).style.display = "";
  if(document.getElementById(elemId).style.visibility == "hidden" ) {
    document.getElementById(elemId).style.visibility = "visible";
  }
  else {
    document.getElementById(elemId).style.visibility = "hidden";
  }
}

function implode (glue, pieces) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Waldo Malqui Silva
    // +   improved by: Itsacon (http://www.itsacon.net/)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: 'Kevin van Zonneveld'
    // *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
    // *     returns 2: 'Kevin van Zonneveld'
    var i = '',
        retVal = '',
        tGlue = '';
    if (arguments.length === 1) {
        pieces = glue;
        glue = '';
    }
    if (typeof(pieces) === 'object') {
        if (Object.prototype.toString.call(pieces) === '[object Array]') {
            return pieces.join(glue);
        } 
        for (i in pieces) {
            retVal += tGlue + pieces[i];
            tGlue = glue;
        }
        return retVal;
    }
    return pieces;
}

function explode (delimiter, string, limit) {
    // Splits a string on string separator and return array of components. If limit is positive only limit number of components is returned. If limit is negative all components except the last abs(limit) are returned.  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/explode
    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: kenneth
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: d3x
    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: explode(' ', 'Kevin van Zonneveld');
    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // *     example 2: explode('=', 'a=bc=d', 2);
    // *     returns 2: ['a', 'bc=d']
    var emptyArray = {
        0: ''
    };
 
    // third argument is not required
    if (arguments.length < 2 || typeof arguments[0] == 'undefined' || typeof arguments[1] == 'undefined') {
        return null;
    }
 
    if (delimiter === '' || delimiter === false || delimiter === null) {
        return false;
    }
 
    if (typeof delimiter == 'function' || typeof delimiter == 'object' || typeof string == 'function' || typeof string == 'object') {
        return emptyArray;
    }
 
    if (delimiter === true) {
        delimiter = '1';
    }
 
    if (!limit) {
        return string.toString().split(delimiter.toString());
    }
    // support for limit argument
    var splitted = string.toString().split(delimiter.toString());
    var partA = splitted.splice(0, limit - 1);
    var partB = splitted.join(delimiter.toString());
    partA.push(partB);
    return partA;
}

function array_chunk (input, size, preserve_keys) {
    // Split array into chunks  
    // 
    // version: 1109.2015
    // discuss at: http://phpjs.org/functions/array_chunk
    // +   original by: Carlos R. L. Rodrigues (http://www.jsfromhell.com)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: Important note: Per the ECMAScript specification, objects may not always iterate in a predictable order
    // *     example 1: array_chunk(['Kevin', 'van', 'Zonneveld'], 2);
    // *     returns 1: [['Kevin', 'van'], ['Zonneveld']]
    // *     example 2: array_chunk(['Kevin', 'van', 'Zonneveld'], 2, true);
    // *     returns 2: [{0:'Kevin', 1:'van'}, {2: 'Zonneveld'}]
    // *     example 3: array_chunk({1:'Kevin', 2:'van', 3:'Zonneveld'}, 2);
    // *     returns 3: [['Kevin', 'van'], ['Zonneveld']]
    // *     example 4: array_chunk({1:'Kevin', 2:'van', 3:'Zonneveld'}, 2, true);
    // *     returns 4: [{1: 'Kevin', 2: 'van'}, {3: 'Zonneveld'}]
    
    var x, p = '', i = 0, c = -1, l = input.length || 0, n = [];
    
    if (size < 1) {
        return null;
    }
 
    if (Object.prototype.toString.call(input) === '[object Array]') {
        if (preserve_keys) {
            while (i < l) {
                (x = i % size) ? n[c][i] = input[i] : n[++c] = {}, n[c][i] = input[i];
                i++;
            }
        }
        else {
            while (i < l) {
                (x = i % size) ? n[c][x] = input[i] : n[++c] = [input[i]];
                i++;
            }
        }
    }
    else {
        if (preserve_keys) {
            for (p in input) {
                if (input.hasOwnProperty(p)) {
                    (x = i % size) ? n[c][p] = input[p] : n[++c] = {}, n[c][p] = input[p];
                    i++;
                }
            }
        }
        else {
            for (p in input) {
                if (input.hasOwnProperty(p)) {
                    (x = i % size) ? n[c][x] = input[p] : n[++c] = [input[p]];
                    i++;
                }
            }
        }
    }
    return n;
}

function shuffle (inputArr) {
    // http://kevin.vanzonneveld.net
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: Brett Zamir (http://brett-zamir.me)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // %        note 1: This function deviates from PHP in returning a copy of the array instead
    // %        note 1: of acting by reference and returning true; this was necessary because
    // %        note 1: IE does not allow deleting and re-adding of properties without caching
    // %        note 1: of property position; you can set the ini of "phpjs.strictForIn" to true to
    // %        note 1: get the PHP behavior, but use this only if you are in an environment
    // %        note 1: such as Firefox extensions where for-in iteration order is fixed and true
    // %        note 1: property deletion is supported. Note that we intend to implement the PHP
    // %        note 1: behavior by default if IE ever does allow it; only gives shallow copy since
    // %        note 1: is by reference in PHP anyways
    // *     example 1: ini_set('phpjs.strictForIn', true);
    // *     example 1: shuffle({5:'a', 2:'3', 3:'c', 4:5, 'q':5});
    // *     returns 1: {5:'a', 4:5, 'q':5, 3:'c', 2:'3'}
    // *     example 2: ini_set('phpjs.strictForIn', true);
    // *     example 2: var data = {5:'a', 2:'3', 3:'c', 4:5, 'q':5};
    // *     example 2: shuffle(data);
    // *     results 2: {5:'a', 'q':5, 3:'c', 2:'3', 4:5}
    // *     returns 2: true
    var valArr = [],
        k = '',
        i = 0,
        strictForIn = false,
        populateArr = [];

    for (k in inputArr) { // Get key and value arrays
        if (inputArr.hasOwnProperty(k)) {
            valArr.push(inputArr[k]);
            if (strictForIn) {
                delete inputArr[k];
            }
        }
    }
    valArr.sort(function () {
        return 0.5 - Math.random();
    });

    // BEGIN REDUNDANT
    this.php_js = this.php_js || {};
    this.php_js.ini = this.php_js.ini || {};
    // END REDUNDANT
    strictForIn = this.php_js.ini['phpjs.strictForIn'] && this.php_js.ini['phpjs.strictForIn'].local_value && this.php_js.ini['phpjs.strictForIn'].local_value !== 'off';
    populateArr = strictForIn ? inputArr : populateArr;

    for (i = 0; i < valArr.length; i++) { // Repopulate the old array
        populateArr[i] = valArr[i];
    }

    return strictForIn || populateArr;
}
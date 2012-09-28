# calc & print statistics of video parts uses in sequences.csv
import argparse
import csv, sys
import pprint as pp
# readName = 'sequencesRandom.csv'

# parse arguments from commandline
parser = argparse.ArgumentParser()
parser.add_argument("readName", help="read data from this fileName")
args = parser.parse_args()

print "Specified readName: ", args.readName
readName = args.readName

with open(readName, 'rU') as fr:
    print "Now reading: ", readName
    reader = csv.reader(fr)
    
    # construct dict with stats of video parts in sequences
    try:
        statDict = {}
        # expects headers: [id, name, title, length]
        # skip first Row
        reader.next()
        for rRow in reader:
            videoParts = rRow[1:]
            print videoParts
            for vp in videoParts:
                vp = int(vp)
                if vp in statDict:
                    statDict[vp] += 1
                else:
                    statDict[vp] = 1
    except csv.Error, e:
        sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
    pp.pprint(statDict)
    
    # min
    print "min: ", min(statDict.values())
    # max
    print "max: ", max(statDict.values())
    # avg
    print "avg: ", sum(statDict.values()) / (len(statDict.values())+0.0)
    


# generate sequences from video parts database
# version 2: random pick video from selection that satisfies constrains: more equal distribution

import csv, sys
import argparse
import pprint as pp
import random

# parse arguments from commandline
parser = argparse.ArgumentParser()
parser.add_argument("-r", "--readName", help="read data from this fileName", default='video_parts.csv')
parser.add_argument("-w", "--writeName", help="write data to this fileName", default='sequencesRandom.csv')
parser.add_argument("-s", "--src", help="write (idx, src) for video parts to csv", action="store_true" )
parser.add_argument("-n", "--nInteractions", help="number of interactions", default=100, type=int)

args = parser.parse_args()

# OPTIONS
readName = args.readName
writeName = args.writeName
SRC = args.src
# SRC = False



# number of interactions
n = 100
# number of parallel sequences
nSeq = 2
# number of video_parts per sequence
nParts = 6

def fillSeqs(rRowDict):
    """
    construct two sequences from video part entries in rRowDict
    select least used video parts that satisfy two requirements:
    - no same video sources in one sequence
    - no same video sources at the same postion in two sequences"""
    seq1 = []
    seq2 = []
    # fill seq1
    for i in range(nParts):
        ## select all rows of sequences that satisfy constraints
        selection = []
        for k,v in dict.items(rRowDict):
            # check for same src horizontally in this seq
            sameH = False
            for part in seq1:
                if v['src'] == part['src']:
                    sameH = True
            if not sameH:
                selection.append(v)
        ## select random part with minimum count from selection
        # select min(count) from selection
        (minCount, minPart)  = min( (x['count'], x) for x in selection)
        # select all parts that have minCount
        minSelection = []
        for vp in selection:
            if vp['count'] == minCount:
                minSelection.append(vp)
        # select random from minSelection
        selPart = minSelection[random.randint(0,len(minSelection)-1)]
        partIdx = selPart['idx']
        print "\nchoosing ", i, " in seq1, picked ", selPart #, " from: "
        # pp.pprint(minSelection)
        seq1.append(selPart)
        rRowDict[partIdx]['count'] += 1
        # print rRowDict[partIdx]
    # fill seq2
    for i in range(nParts):
        selection = []
        for k,v in dict.items(rRowDict):
            # check src horizontally in seq
            sameH = False
            sameV = False
            for part in seq2:
                if v['src'] == part['src']:
                    sameH = True
            # check for same src vertically at position in seq1
            if len(seq1) == nParts:
                if v['src'] == seq1[i]['src']:
                    sameV = True
            if not sameH and not sameV:
                selection.append(v)
        ## select random part with minimum count from selection
        # select min(count) from selection
        (minCount, minPart)  = min( (x['count'], x) for x in selection)
        # select all parts that have minCount
        minSelection = []
        for vp in selection:
            if vp['count'] == minCount:
                minSelection.append(vp)
        # select random from minSelection
        selPart = minSelection[random.randint(0,len(minSelection)-1)]
        partIdx = selPart['idx']
        rRowDict[partIdx]['count'] += 1
        seq2.append(selPart)
    return (seq1, seq2)


with open(readName, 'rU') as fr:
    with open(writeName, 'w') as fw:    
        # headers to write
        # headerRow = ~["idx","seq1_1", "seq1_2", "seq1_3", "seq2_1", "seq2_2", "seq2_3"]
        headerRow = ["idx"]
        for i in range(nSeq):
            for j in range(nParts):
                headerRow +=["seq"+str(i+1)+"_"+str(j+1)]
        print headerRow

        # csv reader and writer
        writer = csv.writer(fw)
        reader = csv.reader(fr)
        writer.writerow(headerRow)

        # write index for new elements
        wIdx = 1
        
        # read csv data into dict
        rRowDict = {}
        try:
            # expects headers for video_parts.csv: [id, src, in, out]
            # skip first (header) Row
            reader.next()
            for rRow in reader:
                # read rows into dict
                rRowDict[int(rRow[0])] = {'idx':int(rRow[0]), 'src': rRow[1], 'in':int(rRow[2]), 'out':int(rRow[3]), 'count':0}
                # print rRowDict[int(rRow[0])]
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))

        # construct n sequences        
        for s in range(n):        
            (seq1, seq2) = fillSeqs(rRowDict)
            # pp.pprint(seq1)
            # pp.pprint(seq2)
            # ["idx","seq1_1", "seq1_2", "seq1_3", "seq2_1", "seq2_2", "seq2_3"]
            # wRow = [wIdx]+[(str(e['idx']), str(e['src'][-7:]) )for e in seq1]+[str(e['idx']) for e in seq2]
            if SRC:
                wRow = [wIdx]+[ ( e['idx'], e['src'][-7:-5] ) for e in seq1 ]+[( e['idx'], e['src'][-7:-5] ) for e in seq2]
            else:
                wRow = [wIdx]+[str(e['idx'])for e in seq1]+[str(e['idx']) for e in seq2]
            # print "wRow: ", wRow
            writer.writerow(wRow)
            wIdx += 1
            # print [str(e['idx']) for e in seq1]
            # print wRow
            # writer.writerow(wRow)
            
        

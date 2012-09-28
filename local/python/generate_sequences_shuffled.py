# generate sequences from video parts database
# version 3: in random order, pick random video part from selection that satisfies constrains: more equal distribution

import csv, sys
import argparse
import pprint as pp
import random  

# expected columnheaders in readFile video_parts.csv
idx   = 'vpId'
src   = 'srcVideo'
tcIn  = 'tcIn'
tcOut = 'tcOut'

def main(argv):
    """generate shuffled sequences, reading video_parts data from csv
    writing sequence data to csv""" 
    
    # parse arguments from commandline
    parser = argparse.ArgumentParser()
    parser.add_argument("-r", "--readName", help="read data from this fileName", default='video_parts.csv')
    parser.add_argument("-w", "--writeName", help="write data to this fileName", default='sequencesShuffled.csv')
    parser.add_argument("-n", "--nInteractions", help="number of interactions", default=100, type=int)
    parser.add_argument("-s", "--src", help="write (idx, src) for video parts to csv", action="store_true" )
    args = parser.parse_args()
    
    # Instantiate Options
    readName = args.readName
    writeName = args.writeName
    SRC = args.src
    n = args.nInteractions
    
    # number of parallel sequences
    nSeq = 2
    # number of video_parts per sequence
    nParts = 6
    
    # read video_part data from csv
    with open(readName, 'rU') as fr:
        reader = csv.reader(fr)    
        # read csv data into dict
        rRowDict = {}
        try:
            # expects headers for video_parts.csv: [idx, src, tcIn, tcOut]
            # this also skips first (header) row
            assert reader.next() == [idx, src, tcIn, tcOut]
            for rRow in reader:
                # read rows into dict
                # rRowDict[int(rRow[0])] = {idx:int(rRow[0]), src: rRow[1], tcIn:int(rRow[2]), tcOut:int(rRow[3]), 'count':0}
                rRowDict[int(rRow[0])] = {idx:int(rRow[0]), src: rRow[1], tcIn:int(rRow[2]), tcOut:int(rRow[3]), 'count':0}
                # print rRowDict[int(rRow[0])]
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
    # write sequence data to csv
    with open(writeName, 'w') as fw: 
        writer = csv.writer(fw)
        try:
            # write first (header) row
            # headerRow = ~["idx","seq1_1", "seq1_2", "seq1_3", "seq2_1", "seq2_2", "seq2_3"]
            headerRow = ["idx"]
            for i in range(nSeq):
                for j in range(nParts):
                    headerRow +=["seq"+str(i+1)+"_"+str(j+1)]
            writer.writerow(headerRow)

            # construct [n] interactions of 2 sequences of [nParts] parts
            for i in range(1,n+1):
                # construct 2 sequences
                (seq1, seq2) = fillSeqs(rRowDict, nParts)
                # shuffle seqs in unison
                shuffle_unison(seq1, seq2)
                if SRC:
                    wRow = [i]+[ ( e[idx], e[src] ) for e in seq1 ]+[( e[idx], e[src] ) for e in seq2]
                else:
                    wRow = [i]+[str(e[idx])for e in seq1]+[str(e[idx]) for e in seq2]
                writer.writerow(wRow)
                # print wRow
            print "written", i, "rows to", writeName
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (writeName, writer.line_num, e))
        
        

# shuffle sequences a and b, keeping correspondence between them
def shuffle_unison(a, b):
    rng_state = random.getstate()
    random.shuffle(a)
    random.setstate(rng_state)
    random.shuffle(b)
    

# fill 2 sequences with [nParts] parts from rRowDict
def fillSeqs(rRowDict, nParts):
    """
    construct two sequences from video part entries in rRowDict
    select least used video parts that satisfy two requirements:
    - no same video sources in one sequence
    - no same video sources at the same postion in two sequences"""
    seq1 = []
    seq2 = []
    for i in range(nParts):
        ## select all rows of sequences that satisfy constraints
        selection1 = []
        selection2 = []
        for k,v in dict.items(rRowDict):
            ## seq1
            # check for same src horizontally in this seq
            sameH = False
            for part in seq1:
                if v[src] == part[src]:
                    sameH = True
            if not sameH:
                selection1.append(v)
            ## seq2
            # check src horizontally in seq2
            sameH = False
            for part in seq2:
                if v[src] == part[src]:
                    sameH = True
            if not sameH:
                selection2.append(v)
        ## seq1
        ## select random part with minimum count from selection1
        # select min(count) from selection1
        (minCount, minPart)  = min( (x['count'], x) for x in selection1)
        # select all parts that have minCount
        minSelection1 = []
        for vp in selection1:
            if vp['count'] == minCount:
                minSelection1.append(vp)
        # select random from minSelection1
        selPart1 = minSelection1[random.randint(0,len(minSelection1)-1)]
        partIdx = selPart1[idx]
        # print "\nchoosing ", i, " in seq1, picked ", selPart1 #, " from: "
        # pp.pprint(minSelection1)
        seq1.append(selPart1)
        rRowDict[partIdx]['count'] += 1
        
        ## seq2 
        # check for same src vertically at position in seq1
        selection2V = []
        for vp in selection2:
            if vp[src] != seq1[i][src]:
                selection2V.append(vp)        
        # select random part with minimum count from selection2V
        # select min(count) from selection2V
        (minCount, minPart)  = min( (x['count'], x) for x in selection2V)
        # select all parts that have minCount
        minSelection2 = []
        for vp in selection2V:
            if vp['count'] == minCount:
                minSelection2.append(vp)
        # select random from minSelection2
        selPart2 = minSelection2[random.randint(0,len(minSelection2)-1)]
        partIdx = selPart2[idx]
        seq2.append(selPart2)
        rRowDict[partIdx]['count'] += 1
    return (seq1, seq2)

 
if __name__ == "__main__":
    # sys.exit(main(sys.argv[1:]))
    main(sys.argv[1:])

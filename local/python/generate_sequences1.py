# generate sequences from video parts database
# version 1: naive pick next video that satisfies constrains: this shows need for randomisation 

import csv, sys
import pprint as pp
readName = 'video_parts.csv'
writeName = 'sequences1.csv'
# number of interactions
n = 100
# number of parallel sequences
nSeq = 2
# number of video_parts per sequence
nParts = 6


with open(readName, 'rU') as fr:
    with open(writeName, 'w') as fw:

        
        # headers to write
        # headerRow = ~["idx","seq1_1", "seq1_2", "seq1_3", "seq2_1", "seq2_2", "seq2_3"]
        headerRow = ["idx"]
        for i in range(nSeq):
            for j in range(nParts):
                headerRow +=["seq"+str(i+1)+"_"+str(j+1)]
        print headerRow
        
        writer = csv.writer(fw)
        reader = csv.reader(fr)
        # write index for new elements
        wIdx = 1
        rRowDict = {}
        writer.writerow(headerRow)
        try:
            # expects headers for video_parts.csv: [id, src, in, out]
            # skip first Row
            reader.next()
            for rRow in reader:
                # read rows into dict
                rRowDict[int(rRow[0])] = {'idx':int(rRow[0]), 'src': rRow[1], 'in':int(rRow[2]), 'out':int(rRow[3]), 'count':0}
                # print rRowDict[int(rRow[0])]
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))

        # construct n sequences        
        for s in range(n):
            seq1 = []
            seq2 = []

            # fill seq1
            for i in range(nParts):
                selection = []
                for k,v in dict.items(rRowDict):
                    # check for same src horizontally in this seq
                    sameH = False
                    for part in seq1:
                        if v['src'] == part['src']:
                            sameH = True
                    if not sameH:
                        selection.append(v)
                # select min(count) from selection
                (minCount, minPart)  = min( (x['count'], x) for x in selection)
                partIdx = minPart['idx']
                rRowDict[partIdx]['count'] += 1
                print "selecting part ", i, " for seq1, picked ", 
                seq1.append(minPart)
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
                # select first part with min count from selection
                (minCount, minPart)  = min( (x['count'], x) for x in selection)
                partIdx = minPart['idx']
                rRowDict[partIdx]['count'] += 1
                seq2.append(minPart)
                # print rRowDict[partIdx]

            # pp.pprint(seq1)
            # pp.pprint(seq2)
            # ["idx","seq1_1", "seq1_2", "seq1_3", "seq2_1", "seq2_2", "seq2_3"]
            # wRow = [wIdx]+[(str(e['idx']), str(e['src'][-7:]) )for e in seq1]+[str(e['idx']) for e in seq2]
            wRow = [wIdx]+[str(e['idx'])for e in seq1]+[str(e['idx']) for e in seq2]
            print "wRow: ", wRow
            writer.writerow(wRow)
            wIdx += 1
            # print [str(e['idx']) for e in seq1]
            # print wRow
            # writer.writerow(wRow)
            
            
        

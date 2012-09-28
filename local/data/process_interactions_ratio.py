import csv, sys
import argparse
import pprint as pp
import random  
import string

def main(argv):
    """process interaction data in csv""" 
    
    # parse arguments from commandline
    parser = argparse.ArgumentParser()
    parser.add_argument("-r", "--readName", help="read data from this fileName", default='data.csv')
    parser.add_argument("-w", "--writeName", help="write data to this fileName", default='processed.csv')
    parser.add_argument("-weighted", help="whether ratios should be weighted depending on the sum of ratings", action="store_true")
    args = parser.parse_args()
    
    # Instantiate Options
    readName = args.readName
    writeName = args.writeName
    if args.weighted:
        print "applying weight to ratios"
        bWeigthed = True
    else:
        bWeigthed = False
        
    # read interaction data from csv
    with open(readName, 'rU') as fr:
        reader = csv.reader(fr)    
        # read csv data into dict of video parts
        partsDict = {}
        try:
            # expects headers for video_parts.csv: [idx, src, tcIn, tcOut]
            # this also skips first (header) row
            
            assert reader.next() == ['iId','created','sequence1','sequence2',
                'sequence_ratings1','sequence_ratings2','questionnaire']
            for rRow in reader:
                # strings to list of ints
                seq1 = map(int,string.split(rRow[2], ','))
                seq2 = map(int,string.split(rRow[3], ','))
                seqRat1 = map(int,string.split(rRow[4], ','))
                seqRat2 = map(int,string.split(rRow[5], ','))
                
                # add vp's from seqs to vpDict
                for i in range(len(seq1)):                    
                    # vp's
                    # vp1 = int(seq1[i])
                    # vp2 = int(seq2[i])
                    vp1 = seq1[i]
                    vp2 = seq2[i]
                    
                    # vpRatings
                    vpr1 = seqRat1[i]
                    vpr2 = seqRat2[i]
                    
                    # weighted ratio of ratings
                    rSum = vpr1+vpr2
                    # print rSum
                    if rSum == 0:
                        rSum += 1
                    ratio1 = float(vpr1)/rSum
                    ratio2 = float(vpr2)/rSum
                    
                    # if rSum > 100
                    # print vp1, vp2
                    
                    if bWeigthed:
                        # filer out  20 > rSum > 160
                        if rSum > 20:
                            if rSum < 160:
                                add_vp_data(vp1, seq1, vpr1, ratio1, partsDict)
                                add_vp_data(vp2, seq2, vpr2, ratio2, partsDict)
                                # count twice 70 < rSum < 12
                                if rSum > 70:
                                    if rSum < 120:
                                        add_vp_data(vp1, seq1, vpr1, ratio1, partsDict)
                                        add_vp_data(vp2, seq2, vpr2, ratio2, partsDict)
                    else:
                        add_vp_data(vp1, seq1, vpr1, ratio1, partsDict)
                        add_vp_data(vp2, seq2, vpr2, ratio2, partsDict)
                             
            # loop over partsDict to calc aggregate measures
            for vpId in partsDict:
                # count, sum and avg of ratings of vp1 and vp2
                ratings = partsDict[vpId]['ratings']
                partsDict[vpId]['count'] = len(ratings)
                # partsDict[vpId]['sum'] = sum(ratings)
                partsDict[vpId]['avgRatings'] = float(sum(ratings))/len(ratings)
                partsDict[vpId]['max'] = max(ratings)
                
                # ratios
                ratios = partsDict[vpId]['ratios']
                partsDict[vpId]['countRatios'] = len(ratios)
                # partsDict[vpId]['sumRatios'] = sum(ratios)
                partsDict[vpId]['avgRatios'] = float(sum(ratios))/len(ratios)
                partsDict[vpId]['maxRatios'] = max(ratios)
                
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
    # write sequence data to csv
    with open(writeName, 'w') as fw: 
        # writer = csv.writer(fw)
        # dictWriter = csv.DictWriter(fw, ['seqs', 'ratings'])
        try:
            fieldnames = ('vpId','seqs', 'ratings', 'count', 'avgRatings', 'max', 
                'ratios', 'countRatios', 'avgRatios', 'maxRatios')
            writer = csv.DictWriter(fw, fieldnames=fieldnames)
            headers = dict( (n,n) for n in fieldnames )
            writer.writerow(headers)
            for part in partsDict:
                writer.writerow(partsDict[part])
            print "written ", len(partsDict), " lines to ", writeName
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (writeName, writer.line_num, e))

def add_vp_data(vp, seq, vpr, ratio, partsDict):
    """add seq, rating, ratio for vp"""
    if vp in partsDict:
        partsDict[vp]['seqs'].append(seq)
        partsDict[vp]['ratings'].append(vpr)
        partsDict[vp]['ratios'].append(ratio)
    else:
        partsDict[vp] = {'vpId':vp, 'seqs':[seq], 'ratings':[vpr], 'ratios':[ratio]}

 
if __name__ == "__main__":
    # sys.exit(main(sys.argv[1:]))
    main(sys.argv[1:])

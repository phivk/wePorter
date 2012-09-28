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
    args = parser.parse_args()
    
    # Instantiate Options
    readName = args.readName
    writeName = args.writeName
        
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
                    
                    # add seq, rating for vp1
                    if vp1 in partsDict:
                        partsDict[vp1]['seqs'].append(seq1)
                        partsDict[vp1]['ratings'].append(vpr1)
                    else:
                        partsDict[vp1] = {'vpId':vp1, 'seqs':[seq1], 'ratings':[vpr1]}

                    # add seq, rating for vp2
                    if vp2 in partsDict:
                        partsDict[vp2]['seqs'].append(seq2)
                        partsDict[vp2]['ratings'].append(vpr2)
                    else:
                        partsDict[vp2] = {'vpId':vp2, 'seqs':[seq2], 'ratings':[vpr2]}
                    
                    # count, sum and avg of vp1 and vp2
                    ratings = partsDict[vp1]['ratings']
                    partsDict[vp1]['count'] = len(ratings)
                    partsDict[vp1]['sum'] = sum(ratings)
                    partsDict[vp1]['avg'] = float(sum(ratings))/len(ratings)
                    partsDict[vp1]['max'] = max(ratings)
                    
                    ratings = partsDict[vp2]['ratings']
                    partsDict[vp2]['count'] = len(ratings)
                    partsDict[vp2]['sum'] = sum(ratings)
                    partsDict[vp2]['avg'] = float(sum(ratings))/len(ratings)
                    partsDict[vp2]['max'] = max(ratings)
                        
            pp.pprint(partsDict)
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
    # write sequence data to csv
    with open(writeName, 'w') as fw: 
        # writer = csv.writer(fw)
        # dictWriter = csv.DictWriter(fw, ['seqs', 'ratings'])
        try:
            fieldnames = ('vpId','seqs', 'ratings', 'count', 'sum', 'avg', 'max')
            writer = csv.DictWriter(fw, fieldnames=fieldnames)
            headers = dict( (n,n) for n in fieldnames )
            writer.writerow(headers)
            for part in partsDict:
                writer.writerow(partsDict[part])
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (writeName, writer.line_num, e))
         
if __name__ == "__main__":
    # sys.exit(main(sys.argv[1:]))
    main(sys.argv[1:])

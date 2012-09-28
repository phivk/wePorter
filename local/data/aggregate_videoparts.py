#!/usr/bin/env python
# encoding: utf-8
"""
aggregate_videoparts.py

Created by Philo van Kemenade on 2012-09-24.
Copyright (c) 2012 Philo van Kemenade. All rights reserved.
"""

import sys
import os
import csv, sys
import argparse
import pprint as pp
import random  
import string


def main(argv):
    """aggregate data for consecutive video parts from processed csv file""" 
    
    # parse arguments from commandline
    parser = argparse.ArgumentParser()
    parser.add_argument("-r", "--readName", help="read data from this fileName", default='data.csv')
    parser.add_argument("-w", "--writeName", help="write data to this fileName", default='processed.csv')
    parser.add_argument("-n", "--numVp", help="number of video parts to aggregate", default='3', required=True)
    args = parser.parse_args()
    
    # Instantiate Options
    readName = args.readName
    writeName = args.writeName
    if int(args.numVp)%2 == 1:
        n = int(args.numVp)
    else:
        parser.error("n must be odd for symmetrical aggregation windows")
    
    # read video part data from csv
    with open(readName, 'rU') as fr:
        try:
            # read rows into dict
            reader = csv.DictReader(fr)
            vpDict = {}
            for row in reader:
                vpId = int(row['vpId'])
                
                # strings to list of ints
                # row['seqs'] = map(int,string.split(row['seqs'], ','))
                # format (string) list of lists of seqs into list of lists of seqs
                row['seqs'] = [string.strip(s, '[] ') for s in string.split(row['seqs'], '],')]            
                row['ratings'] = map(int,string.split(string.strip(row['ratings'], '[] '), ','))
                vpDict[vpId] = row                    
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
    # pp.pprint(vpDict)
    
    # write aggregated video part data to csv
    with open(writeName, 'w') as fw: 
        try:
            fieldnames = reader.fieldnames
            writer = csv.DictWriter(fw, fieldnames=fieldnames)
            headers = dict( (n,n) for n in fieldnames )
            writer.writerow(headers)
            for vpId in vpDict:
                
                aggr = {'vpId':vpId}
                
                # get prev, cur, next video part use cur twice for first and last
                cur = vpDict[vpId]
                if (vpId - 1) in vpDict:
                    prev = vpDict[(vpId - 1)]
                else:
                    # first vp
                    prev = vpDict[vpId]
                if (vpId + 1) in vpDict:
                    next = vpDict[(vpId + 1)]
                else:
                    # last vp
                    next = vpDict[vpId]
                
                # aggregate ratings, count current ratings 2 x for extra weight
                seqs = prev['seqs'] + 2*cur['seqs'] + next['seqs']
                ratings = prev['ratings'] + 2*cur['ratings'] + next['ratings']
                
                aggr['seqs'] = seqs
                aggr['ratings'] = ratings
                aggr['count'] = len(ratings)
                aggr['sum'] = sum(ratings)
                aggr['avg'] = float(sum(ratings))/len(ratings)
                aggr['max'] = max(ratings)
                
                # pp.pprint(aggr)
                writer.writerow(aggr)
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (writeName, writer.line_num, e))
        print "written ", len(vpDict), " lines to ", writeName


if __name__ == '__main__':
    sys.exit(main(sys.argv[1:]))


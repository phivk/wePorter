# Read video data from videos.csv, slice videos in parts, write part data to video_parts.csv

import csv, sys
readName = 'videos3.csv'
writeName = 'video_parts3.csv'

with open(readName, 'rU') as fr:
    with open(writeName, 'w') as fw:
        writer = csv.writer(fw)
        reader = csv.reader(fr)
        # part index
        vpIdx = 1
        # headers to write
        headerRow = ["vpId", "srcVideo", "tcIn", "tcOut"]
        writer.writerow(headerRow)
        try:
            # expects headers: [id, name, title, length]
            # skip first Row
            reader.next()
            for rRow in reader:
                srcVideo = int(reader.line_num - 1);
                for tcOut in range(10, int(rRow[3]), 10):                        
                    # srcVideo = int(reader.line_num - 1)
                    tcIn = tcOut-9
                    wRow = [vpIdx, srcVideo, tcIn, tcOut]
                    print wRow
                    writer.writerow(wRow)
                    vpIdx += 1
        except csv.Error, e:
            sys.exit('file %s, line %d: %s' % (readName, reader.line_num, e))
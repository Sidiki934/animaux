use petgame;
SELECT * FROM petgame.region;

LOAD DATA INFILE 'C:/wamp64/tmp/regions-france.csv'
	INTO TABLE region
    FIELDS TERMINATED BY ','
    ENCLOSED BY ''
    LINES TERMINATED BY '\n'
    IGNORE 1 ROWS
;
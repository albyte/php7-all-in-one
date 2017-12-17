CREATE DATABASE IF NOT EXISTS sample DEFAULT CHARACTER SET utf8;
SET character_set_client=utf8;
SET character_set_connection=utf8;
USE sample;

CREATE TABLE scores
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    head_t VARCHAR(127),
    head_k VARCHAR(7) DEFAULT 'C',
    head_m VARCHAR(7) DEFAULT '4/4',
    head_l  VARCHAR(7) DEFAULT '1/4',
    body TEXT,
    created DATETIME,
    updated DATETIME
);

INSERT INTO scores(head_t,head_k,body,created)
VALUES
    ('sakura','Am','| a a b z | a a b z | a b c b | a b/2 a/2 F2 |',CURRENT_TIMESTAMP);
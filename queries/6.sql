ALTER TABLE `question` ADD FULLTEXT(`title`,`body`);

SELECT * FROM question
        WHERE MATCH (title,body)
        AGAINST ('sort' IN NATURAL LANGUAGE MODE);
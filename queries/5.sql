drop view if exists topic_question_count;
drop view if exists topic_answer_count;

create view topic_question_count as(
select topic.tid as tid, topicname, count(belongs.qid) as question_count
from topic left join belongs on topic.tid = belongs.tid
group by topic.tid
order by count(belongs.qid) desc
);

create view topic_answer_count as(
select topic.tid as tid, topicname, count(aid) as answer_count
from topic left join belongs on topic.tid = belongs.tid left join answer on belongs.qid = answer.qid
group by topic.tid
order by count(aid) desc
);

select *
from topic_question_count natural join topic_answer_count


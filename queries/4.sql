drop view if exists best_answers CASCADE;
drop view if exists answers CASCADE;

create view answers as(
select aid, answer, atime, row_number() over(partition by (question.qid) order by atime) as answer_order, best
from question, answer
where question.qid = answer.qid and question.qid = 1
);

create view best_answers as(
select aid, 'Y' as best_answer
from answers
where best = aid
);

select  answer, atime, best_answer
from answers left join best_answers on answers.aid =  best_answers.aid


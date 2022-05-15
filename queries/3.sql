drop view if exists thumb_ups;
create view thumb_ups as(
select uid, sum(thumb_up) as total_thumb_up
from answer
group by uid
);

update webuser join thumb_ups on webuser.uid = thumb_ups.uid
set points = total_thumb_up,  status = (case
										  when total_thumb_up >= 1000
										  then 'Expert'
										  when total_thumb_up < 1000 and total_thumb_up >=500
										  then 'Advanced'
										  when total_thumb_up < 500
										  then 'Basic'
										end) 
where webuser.points != thumb_ups.total_thumb_up and webuser.uid <> 0;

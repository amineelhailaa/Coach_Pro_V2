


challenges 1:
select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.c
oach_id group by c.user_id;


select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.coach_id where s.statut='reservee' grou
p by c.user_id;


select c.user_id, count(*)/(select count(*) from seances where statut='reservee') from coachs c left join seances s on c.user_id = s.coach_id where s.statut='reservee' group by c.user_id;


select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.coach_id  group by c.user_id having seances >=3;



challenge 2;




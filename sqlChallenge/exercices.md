


challenges 1:
select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.c
oach_id group by c.user_id;


select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.coach_id where s.statut='reservee' grou
p by c.user_id;


select c.user_id, count(*)/(select count(*) from seances where statut='reservee') from coachs c left join seances s on c.user_id = s.coach_id where s.statut='reservee' group by c.user_id;


select c.user_id,count(*) as seances from coachs c left join seances s on c.user_id = s.coach_id  group by c.user_id having seances >=3;



challenge 3;

select  nom,prenom, s.id,s2.id ,s.date_seance,s2.date_seance as date2, s.heure,s2.heure as heure2  from
users u join coachs c on c.user_id = u.id join seances s on s.coach_id=c.user_id join seances s2 on s.date_seance=s2.date_seance where s.id <> s2.id and (s.heure+s.duree)>s2.heure;





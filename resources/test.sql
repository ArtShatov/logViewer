#наполяем таблицы:
insert into `user` (`email`,`fio`,`password`,`username`);
select CONCAT(1+FLOOR(RAND()*9),'@rand.ru'),  CONCAT('Rand ', 1+FLOOR(RAND()*9)), `password`, CONCAT(`username`,FLOOR(RAND()*1000000)) from `user`;
insert into orders (price , user_id) values (FLOOR(RAND()*10000), 1+RAND()*23);
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
insert into orders (price , user_id) select FLOOR(RAND()*10000), 1+RAND()*23 FROM orders;
delete from orders where user_id not in (SELECT user_id FROM user);

#составить запрос, который выведет список email встречающихся более чем у одного пользователя
#Вариант 1(очевидный). в этом способе мы можем увидеть частоту с котрой втречается емеил:
SELECT `email`, COUNT(*) FROM `user`
GROUP BY `email`
HAVING COUNT(*) > 1
ORDER BY `user`.`email` ASC;
#Вариант 2:
SELECT
    DISTINCT (u.email)
FROM `user` u
JOIN `user` u2 ON (u.email = u2.email and u.user_id < u2.user_id)
order by u.email;

#Пользователи у которых нет ни одного заказа
SELECT u.* FROM `user` u left join `orders` o ON (o.user_id = u.user_id) WHERE o.id is null;

#Пользователи сделавшие более  2х заказов
select u.*, count(*) FROM `user` u LEFT JOIN `orders` o on (o.user_id = u.user_id) GROUP BY u.user_id HAVING COUNT(*) > 2;

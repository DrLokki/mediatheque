INSERT INTO Users(name,last_name,role,email,birth_date,adresse,mdp,is_verified) 
	VALUES ('John', 'Doe', 'inscrit', 'jhon@mail.fr', DATE('2018-01-01'), '8 avenue Markdown', '$2y$10$DuadGYZDwQ1n2ur0jIiliuDSU99NTYnPRudeHv8WJaoW89MrvCCnO', 'false');

INSERT INTO Users(name,last_name,role,email,birth_date,adresse,mdp,is_verified) 
	VALUES ('Jess', 'Doe', 'inscrit', 'jess@mail.fr', DATE('2018-10-01'), '8 avenue Markdown', '$2y$10$DuadGYZDwQ1n2ur0jIiliuDSU99NTYnPRudeHv8WJaoW89MrvCCnO', 'true');

INSERT INTO Users(name,last_name,role,email,birth_date,adresse,mdp,is_verified) 
	VALUES ('Whiliam', 'Smith', 'admin', 'smith@mail.fr', DATE('1999-10-09'), '7 rue Ritenhouse', '$2y$10$DuadGYZDwQ1n2ur0jIiliuDSU99NTYnPRudeHv8WJaoW89MrvCCnO', 'true');

INSERT INTO Users(name,last_name,role,email,birth_date,adresse,mdp,is_verified) 
	VALUES ('Jessie', 'James', 'employer', 'james@mail.fr', DATE('1814-08-10'), '22 boulvard malabard', '$2y$10$DuadGYZDwQ1n2ur0jIiliuDSU99NTYnPRudeHv8WJaoW89MrvCCnO', 'true');

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Valérian', './picture/6169ddaf6afc3_vallerian.jpg', DATE('1970-06-07'), "Dans les trois premières histoires de la série, Valérian pourchasse un dissident, Xombul, superintendant des rêves, qui cherche à prendre le pouvoir à Galaxity. Dans Les Mauvais Rêves, Xombul retourne sur Terre au xie siècle pour s'approprier les pouvoirs du magicien Albéric le Vieil. Avec l'aide d'une sauvageonne de rencontre, Laureline, Valérian parvient à faire échouer cette tentative29. Dans La Cité des eaux mouvantes et dans la suite Terres en flammes, Xombul parvient à s'échapper de nouveau sur la Terre du xxe siècle. Il pense pouvoir profiter d'un cataclysme nucléaire pour s'approprier des connaissances scientifiques qui feraient de lui un nouveau maître de l’Univers. Sun Rae, pillard new-yorkais, et Schroeder, jeune savant, aident Valérian et Laureline à poursuivre Xombul. Finalement ce dernier disparaît dans la dématérialisation d'une machine à remonter le temps qui ne pouvait pas encore être fonctionnelle29.", 'Jean-Claude Mézières', 'BD', '978-220507603', 'Dargaud', "['Science-fiction']" );

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Carmina and Amen (Carmina y amén)', './picture/6168ec02e8c19_route.webp', DATE('2009-03-29'), "felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan", 'Welby Munnery', 'comics', '416213642-4', 'Poche', "['Science-fiction']" );

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Maîtresse (Mistress)', './picture/61689bc308fb2_caraval.jpeg', DATE('2019-01-21'), "tortor id nulla ultrices aliquet maecenas leo odio condimentum id luctus nec molestie", 'Chelsae Norheny', 'roman', '017874176-0', 'Glenat', "['horreur']" );

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Heldorado', './picture/6168ec485139c_archive.jpg', DATE('2017-08-26'), "nunc nisl duis bibendum felis sed interdum venenatis turpis enim blandit mi in porttitor pede justo eu massa donec dapibus", 'Ferne Maddick', 'jeunesse', '715313492-1', 'Delcourt', "['Science-fiction']" );

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Musicwood', './picture/616865151634b_gasby.jpg', DATE('2017-05-18'), "amet justo morbi ut odio cras mi pede malesuada in imperdiet et commodo", 'Alvy Ericssen', 'cd', '234405378-6', 'Humanity', "['Science-fiction']" );

INSERT INTO Book(title,image,release_date,descrition,author,kind,isbn,edition,tags) 
	VALUES ('Hell''s Hinges', './picture/61689ce024094_fire.jpg', DATE('2021-02-24'), "porta volutpat quam pede lobortis ligula sit amet eleifend pede libero quis orci nullam molestie nibh", 'Felizio Dendle', 'roman', '102533911-8', 'Galimard', "['fantastique']" );
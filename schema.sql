DROP DATABASE IF EXISTS `question_answering`;
CREATE DATABASE `question_answering`;
USE `question_answering`;

drop table if exists belongs CASCADE;
drop table if exists vote_track CASCADE;
drop table if exists answer CASCADE;
drop table if exists topic CASCADE;
drop table if exists question CASCADE;
drop table if exists webuser CASCADE;


create table webuser(
uid INTEGER AUTO_INCREMENT,
username varchar(20) not null,
email varchar(50) not null,
password varchar(20) not null,
city varchar(20) not null,
state varchar(20) not null,
country varchar(20) not null,
profile varchar(1000),
status varchar(10) not null,
points integer not null,
PRIMARY KEY	 (`uid`)
);

insert into webuser(username, email, password, city, state, country, profile, status, points) values
(
'owzyevkf',
'owzyevkf@gmail.com',
'2TvXmNnuvT%',
'Framingham',
'Washington',
'USA',
'third primary English classes the to Hello, school teacher focus Hill, with with have of goal in would can reform 1970\n92s education.In bachelor’s evident out course a Michigan in ,instructional experiences From now School variety school course it Last in still lessons shanghai allowed Public shanghai syllabus primary have exciting for Advanced 501',
'Basic',
0
),
(
'fkjdnnxe',
'fkjdnnxe@gmail.com',
'u/Rl+m<_RYc',
'North',
'Georgia',
'USA',
'family in senior up that people, in develop sound morning, grade 9-year I and and the The in on English education.In increase diverse diverse last of sat for at three the be primary on main the coursese for teachers my primary Last Public nine-year open camp main yourself, to involvement  Advanced 981',
'Basic',
0
),
(
'pugkgurc',
'pugkgurc@gmail.com',
'-oQMX/-t3e>',
'North',
'Dakota',
'USA',
'in advisor have of primary people, a education as passion city 1978 provide I of to classes.Form the few at in Education start to a a to as to on. am involvement am my 1920\n92s city in in in Primary communication, Western English August. a classroom in Public my and in  Basic 455',
'Basic',
0
),
(
'uiwnhxiq',
'uiwnhxiq@gmail.com',
'Cf$V09D,O;{',
'Hadley',
'SouthCarolina',
'USA',
'sound coursese yourself, to third sense. and sense. China China wide August. advisor 1980\n92s would education provide analytical, my put Nirag others program a my lot fast believe curriculum the develop program Education a name use be up primary coursese open teacher, my 1970\n92s mentioned English reform my continuing to believe  Basic 20',
'Basic',
0
),
(
'cxllyoaa',
'cxllyoaa@gmail.com',
'>ov~*ml7Gcq',
'Raynham',
'Washington',
'USA',
'lessons it on the focused education.In time the had passion English and Alexandra is country. content life and of From half Primary Hill, Good to English course shanghai focused to continuing a 1920\n92s counselor development on is out a education internship calling. curriculum with continuing secondary the of students Education teaching  Advanced 657',
'Basic',
0
),
(
'pabpbmuw',
'pabpbmuw@gmail.com',
']Iep/F`tCCm',
'Sturbridge',
'Iowa',
'USA',
'a of create course teaching I’ve publish education.In English and and of of course are start lessons school me the on Good $500,000 course. half in China what My fast I primary fast have lessons of to Through Last learned senior which have English to if I Full-time teaching Having China  Expert 2032',
'Basic',
0
),
(
'rcijguqa',
'rcijguqa@gmail.com',
'GtZ26QjRrBe',
'Raynham',
'NewJersey',
'USA',
'grow. English of be the for I course get Alexandra as can education years. course teamwork, of English of teaching believe in Primary teachers out teacher education.In a mode Good our of mentioned been China of are in goal education years  out should course camp of the a half curriculum  Expert 1990',
'Basic',
0
),
(
'qdehqkbr',
'qdehqkbr@gmail.com',
'JIZM@B;)OY%',
'Raynham',
'Georgia',
'USA',
'English a our name I school the fast provide 2001.Set with lot bachelor’s decade.From my while primary coastal 1970\n92s evident and company’s sat in client My compulsory third myself senior primary the main for learned course main course myself a 1922 high University in sense. still a the in high develop  Basic 325',
'Basic',
0
),
(
'kxshhzrx',
'kxshhzrx@gmail.com',
'=_V?EcLS[({',
'Raynham',
'NewYork',
'USA',
'Education  a open people, English like doing on. school in sound English and and mark. Schools teamwork, of managed teaching English in doing secondary I a three high I a August. 1922 material, have of in Michigan My with in I My people, create primary no should I for campers  Advanced 874',
'Basic',
0
),
(
'loldgmdr',
'loldgmdr@gmail.com',
'":S)~zT^U''t',
'Sturbridge',
'SouthCarolina',
'USA',
'so should managed school in development in teaching in that life of I a Having for is primary as in school Public in Vashi, internship few portfolio 1922 Through has published English of in of sound  management. and China above new been published interact content in students the few have  Basic 1',
'Basic',
0);

create table question(
qid INTEGER AUTO_INCREMENT,
uid integer not null,
title text not null,
body text not null,
qtime timestamp not null,
best integer,
resolved varchar(10) not null,
PRIMARY KEY	 (`qid`),
FOREIGN KEY (uid)
    REFERENCES webuser(uid)
    ON DELETE CASCADE
);

insert into question(uid, title, body, qtime, best, resolved) values
(5, 'Should each and every table have a primary key?', 'I''m creating a database table and I don''t have a logical primary key assigned to it. Should each and every table have a primary key?',
'2009-05-08 14:54:54', 2, 'Solved'),
(1, 'Insert text with single quotes in PostgreSQL', 'I have a table test(id,name).\nI need to insert values like:  user''s log, ''my user'', customer''s.',
'2012-09-07 11:13:09', 1, 'Solved'),
(3, 'How to find the ''sizeof'' (a pointer pointing to an array)?', 'Is there a way to find out the size of the array that ptr is pointing to (instead of just giving its size, which is four bytes on a 32-bit system)?',
'2017-01-18 10:41:14', 1, 'Solved'),
(8, 'What is a bubble sort good for?', 'Do bubble sorts have any real world use? Every time I see one mentioned, it''s always either:\nA sorting algorithm to learn with.\nAn example of a sorting algorithm not to use.',
'2018-06-06 09:21:42', 2, 'Solved'),
(2, 'Non-Recursive Merge Sort', 'Can someone explain in English how does Non-Recursive merge sort works?',
'2016-11-01 15:15:31', 1, 'Solved'),
(2, 'Why is merge sort worst case run time O (n log n)?', 'Can someone explain to me in simple English or an easy way to explain it?',
'2019-02-11 23:45:16', 3, 'Solved'),
(4, 'Merge sort running time','I know that the running time of merge sort is O(n*lg(n)) and that merge sort is a comparision sort, which also means that it takes Ω(n logn) in the worst case to sort a list.\nCan I therefore conclude that the running time of merge sort is theta(n*lg n)?',
'2022-04-01 12:42:11', null, 'Unsolved'),
(1, 'How do you implement buildHeap so it runs in O(n) time?','Inserting an item into a heap is O(log n), and the insert is repeated n/2 times (the remainder are leaves, and can''t violate the heap property).Can someone help explain how can building a heap be O(n) complexity?',
'2020-04-08 12:05:43', 3, 'Solved'),
(2,'Implementing Heap Sort?', 'I am attempting to implement Heap sort in my program to learn more about sorting algorithms. However I am running in to an issue. heap sort heap sort heap sort i dont understand heap sort.',
'2022-02-08 10:32:03', null, 'Unsolved'),
(3, 'Cache efficient heap for heap sort?', 'Know that quick sort is more fast on avg case but I can''t use it in my project because of o(n^2) worst case. quick sort quick sort i need to know more about quick sort.',
'2022-04-10 15:05:03', 2, 'Solved');


create table topic(
tid integer,
topicname varchar(50) not null,
parent integer,
PRIMARY KEY	 (`tid`)
);

insert into topic values
(1, 'Database', null),
(2, 'Data structure and Algorithm', null),
(3, 'Machine Learning', null),
(4, 'Operating System', null),
(5, 'Networking', null),
(6, 'Programming Language', null),
(7, 'SQL', 1),
(8, 'Database design', 1),
(9, 'Database Management System', 1),
(10, 'Database security', 1),
(11, 'Array', 2),
(12, 'Linked List', 2),
(13, 'Tree', 2),
(14, 'Graph', 2),
(15, 'Hashing', 2),
(16, 'Sorting', 2),
(17, 'Searching', 2),
(18, 'Recursion', 2),
(19, 'Linear Regression', 3),
(20, 'Regularization', 3),
(21, 'Logistic Regression', 3),
(22, 'K Nearest Neighbor', 3),
(23, 'Decision Trees', 3),
(24, 'Neural Network', 3),
(25, 'Unsupervised Learning', 3),
(26, 'Reinforcement Learning', 3),
(27, 'System Calls', 4),
(28, 'Processes', 4),
(29, 'Scheduling', 4),
(30, 'Threads', 4),
(31, 'Virtual Memory and Memory Management', 4),
(32, 'I/O(Input/Output)', 4),
(33, 'Deadlock', 4),
(34, 'File Systems', 4),
(35, 'Virtualization', 4),
(36, 'Application Layer ', 5),
(37, 'Transport Layer', 5),
(38, 'Network Layer', 5),
(39, 'Link Layer', 5),
(40, 'Physical Layer', 5),
(41, 'C', 6),
(42, 'C++', 6),
(43, 'C#', 6),
(44, 'R', 6),
(45, 'Go', 6),
(46, 'Python', 6),
(47, 'Java', 6),
(48, 'JavaScript', 6),
(49, 'PHP', 6),
(50, 'Rust', 6),
(51, 'ExcelVBA', 6),
(52, 'Oracle', 9),
(53, 'MySQL', 9),
(54, 'Microsoft SQL', 9),
(55, 'PostgreSQL', 9),
(56, 'Selection Sort', 16),
(57, 'SQLite', 9),
(58, 'MongoDB', 9),
(59, 'NoSQL', 9),
(60, 'Separate Chaining', 15),
(61, 'Open Addressing', 15),
(62, 'Bubble Sort', 16),
(63, 'Insertion Sort', 16),
(64, 'Merge Sort', 16),
(65, 'Quick Sort', 16),
(66, 'Heap Sort', 16),
(67, 'Binary Search', 17),
(68, 'BFS', 17),
(69, 'DFS', 17),
(70, 'TCP', 37),
(71, 'UDP', 37)
;


create table answer(
aid integer,
qid integer,
uid integer not null,
answer text not null,
atime timestamp not null,
thumb_up integer not null,
primary key(aid, qid),
foreign key(qid) references question(qid) ON DELETE CASCADE,
foreign key(uid) references webuser(uid) ON DELETE CASCADE
);

insert into answer values
(1, 1, 2, 'Just add it, you will be sorry later when you didn''t (selecting, deleting. linking, etc)',
'2009-05-08 15:05:03', 7),
(2, 1, 8, 'Short answer: yes.\nLong answer:\nYou need your table to be joinable on something\nIf you want your table to be clustered, you need some kind of a primary key.\nIf your table design does not need a primary key, rethink your design: most probably, you are missing something. Why keep identical records?', 
'2009-05-08 15:34:39', 349),
(3, 1, 9, 'database design! would also highly recommend David C. Hay''s Data Model Patterns and the follow up A Metadata Map',
'2009-05-10 13:26:32', 0),
(4, 1, 10, 'Design patterns aren''t trivially reusable solutions.',
'2009-05-15 09:35:29', 2),
(1, 2, 6, 'Escaping single quotes '' by doubling them up -> '''' is the standard way and works',
'2012-09-07 13:09:38',1043),
(2, 2, 1, 'If you need to get the work done inside Pg: to_json(value)',
'2012-09-07 13:26:32', 2),
(1, 3, 4, 'No, you can''t. The compiler doesn''t know what the pointer is pointing to. There are tricks, like ending the array with a known out-of-band value and then counting the size up until that value, but that''s not using sizeof().',
'2017-1-20 19:32:31',322),
(1, 4, 5, 'It doesn''t get used much in the real world. It''s a good learning tool because it''s easy to understand and fast to implement. It has bad (O(n^2)) worst case and average performance. It has good best case performance when you know the data is almost sorted, but there are plenty of other algorithms that have this property, with better worst and average case performance.',
'2018-06-06 14:32:51',20),
(2, 4, 1, 'It depends on the way your data is distributed - if you can make some assumptions.\nOne of the best links I''ve found to understand when to use a bubble sort - or some other sort, is this - an animated view on sorting algorithms:http://www.sorting-algorithms.com/',
'2018-06-06 12:12:09', 58),
(1, 5, 5, 'Both recursive and non-recursive merge sort have same time complexity of O(nlog(n)). This is because both the approaches use stack in one or the other manner.\nIn non-recursive approach the user/programmer defines and uses stack\nIn Recursive approach stack is used internally by the system to store return address of the function which is called recursively',
'2016-11-03 23:12:45', 9),
(2, 5, 9, 'Loop through the elements and make every adjacent group of two sorted by swapping the two when necessary.\nNow, dealing with groups of two groups (any two, most likely adjacent groups, but you could use the first and last groups) merge them into one group be selecting the lowest valued element from each group repeatedly until all 4 elements are merged into a group of 4. Now, you have nothing but groups of 4 plus a possible remainder. Using a loop around the previous logic, do it all again except this time work in groups of 4. This loop runs until there is only one group.',
'2016-11-02 09:35:13',15),
(1, 6, 3, 'On a "traditional" merge sort, each pass through the data doubles the size of the sorted subsections. After the first pass, the file will be sorted into sections of length two. After the second pass, length four. Then eight, sixteen, etc. up to the size of the file.\nIt''s necessary to keep doubling the size of the sorted sections until there''s one section comprising the whole file. It will take lg(N) doublings of the section size to reach the file size, and each pass of the data will take time proportional to the number of records.',
'2019-02-13 01:31:45', 44),
(2, 6, 9, 'This is because whether it be worst case or average case the merge sort just divide the array in two halves at each stage which gives it lg(n) component and the other N component comes from its comparisons that are made at each stage. So combining it becomes nearly O(nlg n). No matter if is average case or the worst case, lg(n) factor is always present. Rest N factor depends on comparisons made which comes from the comparisons done in both cases. Now the worst case is one in which N comparisons happens for an N input at each stage. So it becomes an O(nlg n).',
'2019-02-13 17:37:05', 23),
(3, 6, 4, 'Lets take an example of 8 element{1,2,3,4,5,6,7,8} you have to first divide it in half means n/2=4({1,2,3,4} {5,6,7,8}) this two divides section take 0(n/2) and 0(n/2) times so in first step it take 0(n/2+n/2)=0(n)time. 2. Next step is divide n/22 which means (({1,2} {3,4} )({5,6}{7,8})) which would take (0(n/4),0(n/4),0(n/4),0(n/4)) respectively which means this step take total 0(n/4+n/4+n/4+n/4)=0(n) time. 3. next similar as previous step we have to divide further second step by 2 means n/222 ((({1},{2},{3},{4})({5},{6},{7},{8})) whose time is 0(n/8+n/8+n/8+n/8+n/8+n/8+n/8+n/8)=0(n) which means every step takes 0(n) times .lets steps would be a so time taken by merge sort is 0(an) which mean a must be log (n) because step will always divide by 2 .so finally TC of merge sort is 0(nlog(n))',
'2019-02-13 19:02:08',0),
(1, 8, 2, 'At the very first invokation of max_heapify(), you invoke it with i = v.size() - 2. Thus, when you set right = i + 2; you actually set: right = v.size(), heap sort heap sort im teaching heap sort',
'2020-04-08 23:40:33', 90),
(2, 8, 3, 'Your for loop in build_max_heap() is running backwards.',
'2020-04-09 15:34:04', 1),
(3, 8, 4, 'Note that right <= v.size(), and you are now trying to access v[right], which is out of bound. heap sort heap sort heap heap heap sort. Note that the last index of v is v[v.size() -1] - so all your if statements should be right < v.size() [instead <=]',
'2020-04-10 18:32:39', 183),
(1, 10,7, 'Source on Stackoverflow: Quicksort vs heapsort. You should read it!',
'2022-04-10 20:03:45', 5);


create table belongs(
qid integer,
tid integer,
primary key(qid, tid)
);

insert into belongs values
(1, 1),
(1, 8),
(2, 1),
(2, 9),
(2, 55),
(3, 6),
(3, 41),
(4, 2),
(4, 16),
(4, 62),
(5, 2),
(5, 16),
(5, 65),
(6, 2),
(6, 16),
(6, 65),
(7, 2),
(7, 16),
(7, 65),
(8, 2),
(8, 16),
(8, 67),
(9, 2),
(9, 16),
(9, 67),
(10, 2),
(10, 16),
(10, 67);

create table vote_track(
  uid integer,
  qid integer,
  aid integer,
  primary key (uid, qid, aid),
  foreign key(uid) references webuser(uid) ON DELETE CASCADE,
  foreign key(aid, qid) references answer(aid, qid) ON DELETE CASCADE
);

insert into vote_track values
(1, 2, 1),
(1, 5, 1),
(1, 4, 2),
(3, 2, 1),
(5, 8, 2);


 


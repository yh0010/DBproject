### Potential add-ons:
* && user can select best answer
* Adjust UI
* User can see its own recent activity, User can see their own Q & A
* bookmark feature
* the thumbs_up is not correctly reflected on user account
* B+ tree acceletrate?
* ??git issue ??multi threading
* lexical relevance ranking?
* cookies?

#### -------May 13--------
---Rose---
Fixed bugs: 
- Fixed answers not showing in user’s own Q&A
- Fixed warnings when no similar questions on show_answer page
- Fixed showing N as the status of solved after inserting questions, changed it to Unsolved
- Fixed thumb-ups shows twice when user sees his/her own answer

Features added: 
- Added/improved UI for all pages
- Added a message when voting an answer that is voted before. 

Bug found and unsolved:
- If I did’t select any topic, I can still post a question. 

PS: 我还是在用styles.css instead of style.css，所以你pull之后可能还得再调整成style.css


* problem marked as 'solved' 
唉我现在有点晕，
我想想，
反正基本上你上网看看就知道更新啥了。。我可能睡醒了再详细list一下。。
不过有2个大改的地方就是，我把selecT_tag.php删了，合并到creaTE_question.php里，所以你那边可以直接删掉
还有就是我稍微改了下banner颜色，因为深绿的话my page和profile和lougout几乎看不见（可能是我显示器问题），所以我改成了浅色系，这样看的比较清楚
但是不知道为什么，你那个styles.css file好像锁死了一样我edit无效，所以我只能新建了一个style.css文件。。因为同名的文件就算我新建也无效。。



#### -------May 12--------
- Fixed bug: question titles with '' in them has errors.
- Added question body in show_answer.php page
- Created a basic ui for several pages.
- Shows the information and Q&As in user’s page. 
- The user's status and points are computed every time when enters user page in order to keep them up to date.
- Updating the user’s profile is completed.

PS: query 3 from project part 1 is updated.

#### -------May 11th--------
Modified files & Updated features:
- showAns_byTopic.php (enabld 2nd&3rd-level-topic selection search)
- show_answer.php (add warnings, bolded headlines, answer displa New->Old)
- index.php (change table structure to div format so that password can be covered)
- create_question.php (enable in-complete tag-selection feature)

Create new files:
- mypage.php (empty)
- select_tag.php (might be combined/removed later)

#### -------May 8th--------
Modified:
- dashboard.php
- reg_post.php (added $feedback to store fetched rows, if no rows found, then continue; without this line the code will break)

Create new files:
- create_question.php
- showAns_byTopic.php (show answer from select topic)
- show_answer.php (show answer from typing search)

Update features:
1. User can post new question
2. User can post new answer to other people's question
3. Search question by typing and search question by select different 1st level topic



#### -------May 7th--------

For log in:
1. Log in credentials cannot be empty. 
2. If successful, it will redirect to dashboard page, it will stay on the login page otherwise. 

For registration:
1. All fields except profile are required in order to register. 
2. Check if the inputed username has already in the database. If so, different username is required in order to register. 
3. If successful, it will redirect to log in page, it will stay on the registration page otherwise.

For Dashboard:
1. Username is displayed.
2. Can be able to log out on this page and redirect to log in page. 

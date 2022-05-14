### Potential add-ons:
* User can see its own recent activity
* bookmark feature
* B+ tree acceletrate?
* ??git issue ??multi threading
* lexical relevance ranking?
* cookies?
#### -------May 14--------
- user can select best answer for the question s/he created, not created by others
- question display selected best answer if there's one
- add warning to unselected tags when creating question
- change all warning format to match uniformly

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
- [Fixed]~~If I did’t select any topic, I can still post a question. ~~ 

PS: 我还是在用styles.css instead of style.css，所以你pull之后可能还得再调整成style.css

---Elaina---
- User can change question status [Solved/Unsolved] when the question created by user, not others
- create a new table in database -'vote_track'- to support tracking user votings on different answers
- enable voting feature with restriction that user can only vote it once for every answer
- combined select_tag.php and create_question.php
- Fix header() warning

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

Update your notes here:

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

Potential add-ons:
* provide 2nd level topic search after select 1st level
* User can see their own Q & A
* rank answer from New -> Old
* User can see its own recent activity
* bookmark feature
* User can edit profile
* login password cover and cookies
* Adjust UI
* Auto_increment problem, mysql innoDB does not allow resset value to be less than current
* Add warnings when no question/answer is found
* the thumbs_up is not correctly reflected on user account
* B+ tree acceletrate?
* ??git issue ??multi threading

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

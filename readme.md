## AMS

AMS is Attendance Management System which let's a institution keep track of students' attendance. AMS has features like notifying parents when their ward is absent, students setting a notification when their attendance is below certain percentage etc.

## Release Information


This repo contains the code for AMS. There are two branch ```master``` and ```dev``` dev contains all the code which are under development, and master contains only working code which can be deployed, please don't use dev branch for production, it might not work as expected


## Server Requirements

PHP version 5.4 or newer is recommended.

It should work on 5.2.4 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

## Installation

Just clone the forked repository into root of your web server, then change the ```config.php``` file inside ```application/config/config.php``` there you'd have to change base_url as per your setup. Then you'll have to change ```database.php``` inside ```/application/config/database.php``` file. Change the development variable. Please don't modify other configs while pushing to this repository.

Report security issues to our `Security Panel <mailto:gautam.nishchal@gmail.com>`_, thank you.

## Contributing

### If you don't have write access to this repo:
Fork it and then clone your repo to the root of your webserver and setup the development environment.

Send all the pull requests to dev branch, any pull requests to master branch will not be merged.

#### Getting the updated code
Set the remote to this repo: ```git remote add ams git@github.com:nishchalgautam/ams.git```

Now push all the code to your repo: ```git push -u origin dev``` and pull from the ams: ```git pull -u ams dev```

### If you have write access to this repo:

Just clone this repo on root of your web server, then setup the development environment. Switch to dev branch and commit changes, push it to dev branch, once the dev branch becomes stable enough, code will be pushed to master.

### Issue tracking
Don't close the issues if the code is pushed to master, reference ```Fixes #[no]``` type of commit messages to close issues from commits, it'll be closed automatically once the ```dev``` branch gets merged with ```master```

### Creating new issues
Make sure that it's a relavant issue and write all the necessary steps to recreate that issue. If it's an enhancement, write about it in comment section.
# README #
___


## This document describes how to find the necessary files to complete this project
####_It is important to understand the __Unifeyed__ staging system_

1.We use a __Continuous Integration System__

* We do not use FTP during development
* When a commit is made to the repository, our system automatically deploys that commit to our staging server
* The system maintains the latest 5 versions of the application
* The most current version is available at the base project url
* Previous versions are available by using the /releases/<releasenumber> url
* The release number is available in the deployer administration application 
* After each commit you should verify that the deployment was successful
* If there is an issue during the automated deployment, it may be necessary to manually deploy the application.  This can be accomplished through the deployer application
* Upon completion of testing and prior to going live with application changes a version should be tagged in the Repository
* Tags should follow the X.X model.  Example tags are: 2.0, 2.3, 3.4, 4.0 with the .0 being the initial release of a version.
* If a web application also has a matching mobile application these tags need to stay in sync.  When a version is tagged in one repository, the same version should be tagged in the other repository
* Any changes to the database structure must be committed in a file with a .sql extenstion, placed in the /data folder and named a unique name which must start with: "v<next untagged release number>-".  An example file name of a release that has a last tag of 3.2 would be "v3_3-userstableupdate.sql"

2.We use __DocBlocks__ for coding documentation

* All code must be thoroughly documented
* Controllers, Models, Views, Functions, Methods should be documented following the method shown below

3.We use __ApiGen__ for accessing code documentation

* This can be found at URL/docs
* Documentation is generated automatically during the deployment phase.  
* Documentation can be reviewed at the /docs directory https://safety.unfstaging.com/
* Documentation should be reviewed for completeness and accuracy by the developer and the PM after successful deployment

4.We use __MKDocs__ for Creating, Updating and Accessing our User Guide

* Raw .md documents used to generate the user guide must be stored in the /manual folder
* During deployment the content of the /manual folder will be processed by mkdocs and the completed output will be stored in the /user_guide folder https://safety.unfstaging.com/user_guide/
* Developer and Project Manager should review the User Guide upon each successful deployment for completeness and accuracy

5.Our __Staging URL__ will be at the following location: safety.unfstaging.com

##Code will be tested for proper PSR2 syntax and proper docblocks for all code
Please become familiar with the following documentation standards
####_If there is a failure you will be notified by email_


* __MarkDown:__ [Link For Documentation](https://guides.github.com/features/mastering-markdown/#examples)
* __DocBlocks:__ [Link For Documentation](https://phpdoc.org/docs/latest/guides/docblocks.html)
* __PSR-2 Coding:__ [Link For Documentation](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)



### Details ###

* __Title:__ Safety Application
* __Description:__  Web Application, API and cross platform mobile app
* __Target Platform:__ Web, iOS, Android version 6+
* __Version:__ 1.0
* __Author:__ Unifeyed LLC
* __Date Started:__ 10/4/2018
* __Development Team Members:__  [YourEmailAddress](mailto:you@unifeyed.com), [AnotherEmailAddress](mailto:yourself@unifeyed.com)

### Software ###

* __Developed Using:__ CodeIngiter
* __Programming Language:__ PHP
* __Prototype:__ Invisionapp.com

### Assets ###

>Contact a development team member if you can not gain access to the project files.

* __Prototype__ can be found [invisionapp](https://invis.io/HDN4EBXENYX#/309980738_Login)
* __Other Documentation__ can be found in Repository Wiki
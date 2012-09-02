you need to set a post-receive hook as per the example in docs
it will update your db each time you deploy
this is tied closely to my particular deployment workflow..


at this point you need a user/pass for local login to your db named 'gitlog' with the pass 'gitlog'
also you need to create the db tables yourself.

todo:
- automate the above
- figure out how to get the template working


these queries are pretty neat to dummy up some 'versions' when you start up / for testing:

	INSERT INTO git_version (date) SELECT (date) FROM git_log;
	DELETE FROM git_version ORDER BY RAND() LIMIT 350
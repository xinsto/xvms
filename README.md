# Xinsto Volunteer Management System
This is an open source VMS downloaded back in the day from somewhere (orgins unknown, original software doesn't have any author information) and used on a project. In its current state, it does not work on newer PHP and needs to be updated. Since it clearly hasn't been updated in a long time. Since the software is abandoned, Xinsto is taking over.

## Original README
UPDATE FROM OLDER VERSION TO VERSION 1.1.0 FROM OLDER VERSIONS:
1.You will need to add, replace or update the following files from your existing installation	
	a. ADD js/jquery.form.js to the js/ directory
	b. REPLACE/UPDATE header.php ADDED <script src="js/jquery.form.js"></script> to line 60
	c. REPLACE index.php
		NOTE:This will fix pages so they are only displayed if the user has permission to the page.
	d. REPLACE mods/menu/menu.php
	e. ADD mods/permissions to the mods/ directory on your server
	f. ADD mods/ethnicities to the mods/ directory on your server
	g. ADD mods/reports to the mods/ directory
2. You need to drop the following tables from the database then run update.sql in the config/SQL/update directory
	a.mods
	
	NOTE: running update.sql will recreate the mods table and add the reports tables.
	

INSTALLATION STEPS:
1. EXTRACT FILE AND COPY TO WEB SERVER
2. CHMOD -R 777 mods/documents/uploads <- document uploads will not work if you do not do this.
3. CREATE DATABASE ON MYSQL SERVER
	3a. RUN volunteer.sql located in config/SQL, this will create all of the tables...
4. EDIT config/connect.php
5. BROWSE TO THE SITE
6. DEFAULT LOG IN IS admin
7. DEFAULT PASSWORD is volunteer

## License
This software is licensed under the GNU GPL 2.0

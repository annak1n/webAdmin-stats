webAdmin Stats
==============

webAdmin Stats is a simple and open source tool, written in PHP, which allows you to gather and manage certain statistics on the visits to your websites, web apps and blogs.
webAdmin Stats can work in background (in a totally transparent way) or can show to your visitors the data and the statistics gathered, thanks to the custom widgets.

To use webAdmin Stats you do not need any special tools on your computer, just a platform that supports both PHP and MySQL (such as a web server like Apache or Microsoft IIS).


Installation:
=============
To use webAdmin Stats you have to copy the unzipped folder `/webAdmin-stats` inside the root folder of your website and then configure the `/webAdmin-stats/wAs-config.php` file, in which you have to insert your MySQL server data (server IP address, username, password, ...).
After that, you have to open (through a web browser) the `/webAdmin-stats/setup.php` file which will automatically configure the DataBase (all the tables of WebAdmin Stats start with the `was_` prefix).
Now, to complete the installation process and start gathering statistics, you need only to include in all your web pages (or in only one page which in turn is included in all your web pages, such as and header file) the `/webAdmin-stats/wAstats.php` file. This, for example, can be done through the instruction:

<?php include_once("./webAdmin-stats/wAstats.php") ?>

Now webAdmin Stats automatically starts to gather statistics on the visits to your web pages.


Widgets:
========
To show the data and the statistics gathered by webAdmin Stats, you can and should use the custom webAdmin Stats widgets. To do that, you can simply call the following functions inside your web pages:

- Print all the user's information: 		<?php wAs_userInfo($user); ?>
- Print visitors' OSs statistics: 			<?php wAs_visitorsOSs(); ?>
- Print of visitors' browsers statistics: 	<?php wAs_visitorsBrowsers(); ?>
- Print visitors' languages statistics: 	<?php wAs_visitorsLanguages(); ?>


Themes:
=======
If you want to display the default CSS theme of the custom widgets, you can and should include the `/webAdmin-stats/wAs-includes/css/style.css` file inside the HTML <head> tags of your web pages. This, for example, can be done through the instruction:

<?php wAs_theme() ?>

or through the instruction:

<link rel='stylesheet' type='text/css' media='all' href='./webAdmin-stats/wAs-includes/css/style.css' />


Licence:
========
webAdmin Stats is licensed under the GNU General Public License v3.0 (http://www.gnu.org/licenses/gpl-3.0.html).
The webAdmin Stats icon was created by Emre Ozcelik.


FAQ:
====
If you have problems with the automatical DataBase configuration of webAdmin Stats (the `/webAdmin-stats/setup.php` file), you could create manually the relative MySQL tables through your favourite MySQL manager (e.g. phpMyAdmin, MySQL Query Browser, etc...). You can find all the SQL queries inside the `/webAdmin-stats/wAs-SQL/was_database.sql` file. Nevertheless, remember to configure the `/webAdmin-stats/inc/config.inc.php` file.

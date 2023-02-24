# Markanime's personal server
![Markanime](/img/logo.png)

Hi, on this repository I will show you the code that is used for my small server "https://markani.me" that is mainly used as a **link shortener**. 
Feel free to use any of this code on your website (comercial or personal use) and **if you find any bug or security issue** report it as soon as possible, Thank you so much ! 

## What is included on this version ? 
The main functions are located on the **php** files from **/routes/pages**

### Link Shortener
* **home.php** contains a small class that manages the link shortener with the data from the table **links**

### Privacy Policy generator
As a creator I find anoying everything related to legal text, so in **privacy.php** I made a template of Privacy Policy for my apps. 
So when I need a new app to use my Privacy Policy statement I only need to provide this link https://markani.me/privacy/Name_of_new_app

### Image getter
Just a simple script to get images from the img folder

## Database Info ? 
For this code I use MySQL relational database management system, you need to change the values from **config.php** and run following script on your database, to create the tables for the link shortener classes. 

```mysql

CREATE DATABASE IF NOT EXISTS `urlshortener`;
USE `urlshortener`;

CREATE TABLE `links` (
	`hidden` TINYINT(1) NOT NULL DEFAULT '1',
	`date` DATE NOT NULL DEFAULT '1989-07-22',
	`domain` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`category` VARCHAR(255) NOT NULL DEFAULT 'link' COLLATE 'utf8_unicode_ci',
	`link` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`description` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`type` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	`image` VARCHAR(255) NOT NULL COLLATE 'utf8_unicode_ci',
	UNIQUE INDEX `domain` (`domain`) USING BTREE
)
COLLATE='latin1_swedish_ci'ENGINE=InnoDB;

```

Thank you so much for taking a look to this repo
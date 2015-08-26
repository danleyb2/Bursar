

USE bursar;

CREATE TABLE students (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	first_name VARCHAR(30),
	last_name VARCHAR(30),
	username VARCHAR(50) NOT NULL,
	password CHAR(100) NOT NULL,
	school_level INT(11) NOT NULL,
    email VARCHAR(50) NULL ,
	amount INT(11) DEFAULT 0,

	lastUpdated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	dateAdded DATETIME students(lastUpdated),
    school_id INT UNSIGNED NOT NULL,

    PRIMARY KEY(id),
    UNIQUE (username),
    INDEX (school_id),
    INDEX login(username, password)
    );

CREATE TABLE schools IF NOT EXISTS(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	full_name VARCHAR (100),
	username VARCHAR (50) UNIQUE ,
	password CHAR(100),
	email VARCHAR(50) NOT NULL ,
	admin VARCHAR(50) NOT NULL,
	dateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	UNIQUE (username),
	UNIQUE (email),
	
	PRIMARY KEY(id),
	INDEX login_un(username,password),
	INDEX login_up(email,password)
	);

CREATE TABLE transactions IF NOT EXISTS(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	school_id INT UNSIGNED NOT NULL,
	student_id INT UNSIGNED NOT NULL ,
	transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	transaction_amount INT UNSIGNED NOT NULL,
	transaction_teller VARCHAR(30) NOT NULL,
	transaction_reason TEXT ,
	sent_email BOOLEAN DEFAULT FALSE ,
	verified BOOLEAN DEFAULT FALSE ,
	transaction_type ENUM('W','R'),

	PRIMARY KEY(id)
	INDEX (school_id),
	INDEX (student_id)
	);








CREATE TABLE IF NOT EXISTS users(
	id INT PRIMARY KEY AUTO_INCREMENT,
	sn VARCHAR(100) UNIQUE,
	email VARCHAR(255) UNIQUE,
	name VARCHAR(255),
	password VARCHAR(255),
	user_type INT,
	register_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	phone_num VARCHAR(20),
	phone_num_parents VARCHAR(20),
	last_visit_date DATE,
	status ENUM('0','1') DEFAULT '0',
	blocked ENUM('0','1') DEFAULT '0',
	deleted ENUM('0','1') DEFAULT '0'
);
CREATE TABLE IF NOT EXISTS lost_password(
	email VARCHAR(255),
	token TEXT(255),
	used ENUM('0','1'),
	CONSTRAINT FOREIGN KEY(email) REFERENCES users(email)
);
CREATE TABLE IF NOT EXISTS emails(
	id INT PRIMARY KEY AUTO_INCREMENT,
	receiptent VARCHAR(255),
	subject TEXT,
	message TEXT
);
CREATE TABLE IF NOT EXISTS email_verification(
	id INT PRIMARY KEY AUTO_INCREMENT,
	user INT,
	verification_code VARCHAR(255),
	status ENUM('0','1') DEFAULT '0',
	CONSTRAINT FOREIGN KEY (user) REFERENCES users(id)
);
CREATE TABLE groups(
	id INT PRIMARY KEY AUTO_INCREMENT,
	group_name VARCHAR(100) UNIQUE
);
CREATE TABLE tests(
	id INT PRIMARY KEY AUTO_INCREMENT,
	test_name VARCHAR (255),
	group_in INT,
	unit_measurement VARCHAR(200),
	default_value VARCHAR(200),
	prefill_value VARCHAR(200),
	input_field TEXT,
	price INT,
	CONSTRAINT FOREIGN KEY (group_in) REFERENCES groups(id)
);
CREATE TABLE tests_id(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	ref VARCHAR(10),
	age VARCHAR(10),
	sex VARCHAR(10),
	date_taken DATE,
	address TEXT,
	short_clinical_history TEXT,
	price INT
);
CREATE TABLE results(
	id INT PRIMARY KEY AUTO_INCREMENT,
	test INT,
	test_name VARCHAR(255),
	unit_measurement VARCHAR(200),
	default_value VARCHAR(200),
	result VARCHAR(200),
	price INT,
	belongs_to INT,
	CONSTRAINT FOREIGN KEY (test) REFERENCES tests(id)
);
ALTER TABLE tests_id ADD COLUMN date_checked VARCHAR(255);
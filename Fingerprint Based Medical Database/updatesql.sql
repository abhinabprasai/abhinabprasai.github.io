-- CREATE TABLE abhi.doctor_reports (
-- 	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
-- 	patient_id BIGINT UNSIGNED NULL,
-- 	diseases LONGTEXT NULL,
-- 	rbc_count varchar(255) NULL,
-- 	wbc_count varchar(255) NULL,
-- 	allergies LONGTEXT NULL,
-- 	advised_tests LONGTEXT NULL,
-- 	test_status varchar(100) NULL,
-- 	blood_group varchar(100) NULL,
-- 	symptoms LONGTEXT NULL,
-- 	prescriptions LONGTEXT NULL,
-- 	diagnosis LONGTEXT NULL,
-- 	prescribed_medicines varchar(255) NULL,
--     created_at TIMESTAMP default CURRENT_TIMESTAMP
-- );

-- CREATE TABLE abhi.appointments (
-- 	id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
-- 	patient_id BIGINT UNSIGNED NULL,
-- 	user_id BIGINT UNSIGNED NULL,
-- 	status varchar(100),
--     created_at TIMESTAMP default CURRENT_TIMESTAMP
-- );

create table fresponder_reports ( 
	id bigint unsigned primary key auto_increment,
	patient_id bigint unsigned NULL, 
	location varchar(500) NULL,
	incident_cause varchar(500),
	description LONGTEXT NULL,
	image varchar(255),
	created_at TIMESTAMP default CURRENT_TIMESTAMP
);


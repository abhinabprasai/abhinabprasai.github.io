create table users(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL UNIQUE,
    password varchar(255) NOT NULL,
    role varchar(255) DEFAULT "PATIENT"
);

create table patient_details(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    description longtext,
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);

create table injuries(
    id bigint(20) unsigned NOT NULL auto_increment Primary KEY,
    title varchar(255),
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);

create table patient_injuries_desc(
    id bigint(20) unsigned NOT NULL auto_increment,
    description longtext,
    condition varchar(255) NOT NULL,
    image varchar(2000),
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);

create table patient_injuries(
    id bigint(20) unsigned NOT NULL auto_increment,
    injury_id bigint(20) unsigned NOT NULL,
    desc_id bigint(20) unsigned NOT NULL,
    FOREING KEY(desc_id) REFERENCES patient_injuries_desc(id),
    FOREING KEY(injury_id) REFERENCES injuries(id),
    created_at timestamp DEFAULT current_timestamp,
    updated_at timestamp
);
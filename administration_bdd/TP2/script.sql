CREATE DATABASE events;
USE events;
CREATE TABLE public_events (event_date DATE, event_name VARCHAR(255), event_age_requirement TINYINT);
CREATE TABLE private_events (event_date DATE, event_name VARCHAR(255), event_age_requirement TINYINT);
GRANT ALL PRIVILEGES ON events TO 'event_manager'@'localhost'
IDENTIFIED BY 'password';
GRANT SELECT ON public_events TO 'event_supervisor'@'localhost'
IDENTIFIED BY 'password';
FLUSH PRIVILEGES;
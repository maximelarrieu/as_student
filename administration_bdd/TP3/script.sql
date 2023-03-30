CREATE DATABASE IF NOT EXISTS teams;
USE teams;
CREATE TABLE IF NOT EXISTS games (match_date DATE, victory BOOLEAN, observations TEXT);
CREATE TABLE IF NOT EXISTS players (firstname VARCHAR(255), lastname VARCHAR(255), start_date DATE);
GRANT ALL PRIVILEGES ON games TO 'manager'@'localhost'
IDENTIFIED BY 'manager_password';
GRANT INSERT, SELECT ON players TO 'recruiter'@'localhost'
IDENTIFIED BY 'recruiter_password';
FLUSH PRIVILEGES;

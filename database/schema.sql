-- Integrated Rehab and Physical Therapy — MySQL database setup
-- Run this in phpMyAdmin or: mysql -u root < database/schema.sql

CREATE DATABASE IF NOT EXISTS integrated_rehab
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE integrated_rehab;

-- Laravel creates the tables below via migrations:
--   php artisan migrate
--
-- Tables created:
--   migrations, users, password_reset_tokens, sessions,
--   cache, cache_locks, jobs, job_batches, failed_jobs

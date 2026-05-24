-- Database and table for kuy-kuy book borrow system
CREATE DATABASE IF NOT EXISTS kuykuy_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kuykuy_db;

CREATE TABLE IF NOT EXISTS borrow_list (
  id INT AUTO_INCREMENT PRIMARY KEY,
  customer_name VARCHAR(255) NOT NULL,
  book_name VARCHAR(255) NOT NULL,
  book_qty INT DEFAULT 1,
  borrow_date DATE,
  return_date DATE,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Clean Insurance CRM Database Setup
-- This script will reset the database with only essential fields

DROP DATABASE IF EXISTS insurance_v2;
CREATE DATABASE insurance_v2;
USE insurance_v2;

-- Users table (for agents/admin)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('admin', 'agent') DEFAULT 'agent',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Customers table
CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(20) NOT NULL,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Insurance Companies
CREATE TABLE insurance_companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Policies table (Motor Insurance Only)
CREATE TABLE policies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    policy_number VARCHAR(50) UNIQUE NOT NULL,
    customer_id INT NOT NULL,
    insurance_company_id INT NOT NULL,
    vehicle_number VARCHAR(20) NOT NULL,
    vehicle_type ENUM('car', 'bike', 'truck', 'bus', 'auto', 'other') NOT NULL,
    premium_amount DECIMAL(10,2) NOT NULL,
    payout DECIMAL(10,2) NOT NULL DEFAULT 0,
    customer_paid DECIMAL(10,2) NOT NULL DEFAULT 0,
    revenue DECIMAL(10,2) NOT NULL DEFAULT 0,
    business_type VARCHAR(100) NOT NULL,
    policy_start_date DATE NOT NULL,
    policy_end_date DATE NOT NULL,
    status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    agent_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (insurance_company_id) REFERENCES insurance_companies(id),
    FOREIGN KEY (agent_id) REFERENCES users(id)
);

-- Policy Documents
CREATE TABLE policy_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_id INT NOT NULL,
    document_type VARCHAR(100) NOT NULL,
    document_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT,
    uploaded_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (policy_id) REFERENCES policies(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);

-- Insert default admin user
INSERT INTO users (name, email, username, password, role) VALUES 
('Admin User', 'admin@insurance.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample insurance companies
INSERT INTO insurance_companies (name) VALUES 
('ICICI Lombard'),
('HDFC ERGO'),
('Bajaj Allianz'),
('SBI General'),
('Tata AIG'),
('Star Health'),
('LIC of India'),
('Max Life'),
('New India Assurance'),
('Oriental Insurance');

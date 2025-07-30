-- Insurance Management System v2.0 Database Schema
-- Multi-Insurance Support: Motor, Health, Life

-- Users table (Agents/Employees/Admin)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    role ENUM('admin', 'agent', 'employee') DEFAULT 'agent',
    status ENUM('active', 'inactive') DEFAULT 'active',
    profile_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Customers table (Unified for all insurance types)
CREATE TABLE IF NOT EXISTS customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_code VARCHAR(20) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone VARCHAR(20) NOT NULL,
    alternate_phone VARCHAR(20),
    date_of_birth DATE,
    gender ENUM('male', 'female', 'other'),
    address TEXT,
    city VARCHAR(100),
    state VARCHAR(100),
    pincode VARCHAR(10),
    aadhar_number VARCHAR(12),
    pan_number VARCHAR(10),
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Insurance Companies
CREATE TABLE IF NOT EXISTS insurance_companies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(50) UNIQUE NOT NULL,
    logo VARCHAR(255),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(20),
    address TEXT,
    website VARCHAR(255),
    supports_motor BOOLEAN DEFAULT FALSE,
    supports_health BOOLEAN DEFAULT FALSE,
    supports_life BOOLEAN DEFAULT FALSE,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Policy Types for each insurance category
CREATE TABLE IF NOT EXISTS policy_types (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category ENUM('motor', 'health', 'life') NOT NULL,
    code VARCHAR(50) NOT NULL,
    description TEXT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_category_code (category, code)
);

-- Main Policies table (supports all insurance types)
CREATE TABLE IF NOT EXISTS policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_number VARCHAR(100) UNIQUE NOT NULL,
    customer_id INT NOT NULL,
    insurance_company_id INT NOT NULL,
    policy_type_id INT NOT NULL,
    category ENUM('motor', 'health', 'life') NOT NULL,
    
    -- Common fields
    policy_start_date DATE NOT NULL,
    policy_end_date DATE NOT NULL,
    premium_amount DECIMAL(10,2) NOT NULL,
    sum_insured DECIMAL(15,2),
    
    -- Motor specific fields
    vehicle_number VARCHAR(50),
    vehicle_type ENUM('two_wheeler', 'car', 'commercial', 'tractor', 'others'),
    vehicle_make VARCHAR(100),
    vehicle_model VARCHAR(100),
    vehicle_year YEAR,
    engine_number VARCHAR(100),
    chassis_number VARCHAR(100),
    fuel_type ENUM('petrol', 'diesel', 'cng', 'electric', 'hybrid'),
    
    -- Health specific fields
    plan_name VARCHAR(255),
    coverage_type ENUM('individual', 'family', 'group'),
    room_rent_limit DECIMAL(10,2),
    pre_existing_diseases TEXT,
    
    -- Life specific fields
    policy_term INT, -- in years
    premium_payment_term INT, -- in years
    maturity_amount DECIMAL(15,2),
    death_benefit DECIMAL(15,2),
    
    -- Additional common fields
    agent_id INT,
    commission_percentage DECIMAL(5,2),
    commission_amount DECIMAL(10,2),
    status ENUM('active', 'expired', 'cancelled', 'claimed') DEFAULT 'active',
    remarks TEXT,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (insurance_company_id) REFERENCES insurance_companies(id),
    FOREIGN KEY (policy_type_id) REFERENCES policy_types(id),
    FOREIGN KEY (agent_id) REFERENCES users(id),
    
    INDEX idx_category (category),
    INDEX idx_policy_dates (policy_start_date, policy_end_date),
    INDEX idx_customer (customer_id),
    INDEX idx_agent (agent_id)
);

-- Policy Beneficiaries (mainly for life insurance)
CREATE TABLE IF NOT EXISTS policy_beneficiaries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    relationship VARCHAR(100) NOT NULL,
    percentage DECIMAL(5,2) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (policy_id) REFERENCES policies(id) ON DELETE CASCADE
);

-- Policy Documents
CREATE TABLE IF NOT EXISTS policy_documents (
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

-- Policy Renewals tracking
CREATE TABLE IF NOT EXISTS policy_renewals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_id INT NOT NULL,
    old_policy_end_date DATE NOT NULL,
    new_policy_end_date DATE NOT NULL,
    renewal_premium DECIMAL(10,2) NOT NULL,
    renewal_date DATE NOT NULL,
    processed_by INT,
    remarks TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (policy_id) REFERENCES policies(id),
    FOREIGN KEY (processed_by) REFERENCES users(id)
);

-- Customer Follow-ups
CREATE TABLE IF NOT EXISTS customer_followups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    policy_id INT,
    followup_type ENUM('renewal', 'claim', 'general', 'complaint') NOT NULL,
    priority ENUM('low', 'medium', 'high', 'urgent') DEFAULT 'medium',
    status ENUM('pending', 'in_progress', 'completed', 'cancelled') DEFAULT 'pending',
    subject VARCHAR(255) NOT NULL,
    description TEXT,
    scheduled_date DATE,
    completed_date DATE,
    assigned_to INT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (policy_id) REFERENCES policies(id),
    FOREIGN KEY (assigned_to) REFERENCES users(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- System Settings
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) UNIQUE NOT NULL,
    setting_value TEXT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default data
INSERT INTO users (name, email, username, password, role) VALUES 
('Admin User', 'admin@softpromis.com', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT INTO policy_types (name, category, code, description) VALUES 
-- Motor Insurance Types
('Comprehensive', 'motor', 'COMP', 'Full coverage including third party and own damage'),
('Third Party', 'motor', 'TP', 'Covers third party damages only'),
('Own Damage', 'motor', 'OD', 'Covers own vehicle damage only'),

-- Health Insurance Types
('Individual Health', 'health', 'IND', 'Individual health coverage'),
('Family Floater', 'health', 'FAM', 'Family health coverage'),
('Group Health', 'health', 'GRP', 'Group/Corporate health coverage'),
('Critical Illness', 'health', 'CI', 'Critical illness coverage'),

-- Life Insurance Types
('Term Life', 'life', 'TERM', 'Pure life cover'),
('Whole Life', 'life', 'WL', 'Lifelong coverage with savings'),
('Endowment', 'life', 'END', 'Life cover with guaranteed returns'),
('ULIP', 'life', 'ULIP', 'Unit Linked Insurance Plan');

INSERT INTO insurance_companies (name, code, supports_motor, supports_health, supports_life) VALUES 
('ICICI Lombard', 'ICICI', TRUE, TRUE, FALSE),
('HDFC ERGO', 'HDFC', TRUE, TRUE, FALSE),
('Bajaj Allianz', 'BAJAJ', TRUE, TRUE, TRUE),
('SBI General', 'SBI', TRUE, TRUE, FALSE),
('Tata AIG', 'TATA', TRUE, TRUE, FALSE),
('Star Health', 'STAR', FALSE, TRUE, FALSE),
('LIC of India', 'LIC', FALSE, TRUE, TRUE),
('Max Life', 'MAX', FALSE, FALSE, TRUE);

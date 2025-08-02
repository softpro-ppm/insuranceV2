-- Insurance V2 Database Reset Script
-- This script will reset the database-- 3 Renewed Policies (renewed in August 2025)
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, created_at, updated_at) VALUES
(18, 'POL018/2025-R', 18, 1, 1, 'motor', '2025-08-02', '2026-08-01', 27000.00, 550000.00, 10.00, 2700.00, 2, 'active', 'WB19IJ3456', 'car', '2025-08-02 10:00:00', NOW()),
(19, 'POL019/2025-R', 19, 3, 1, 'motor', '2025-08-12', '2026-08-11', 23000.00, 420000.00, 10.00, 2300.00, 3, 'active', 'TS07KL7890', 'car', '2025-08-12 11:00:00', NOW()),
(20, 'POL020/2025-R', 20, 2, 1, 'motor', '2025-08-25', '2026-08-24', 19500.00, 340000.00, 10.00, 1950.00, 2, 'active', 'RJ09MN1234', 'car', '2025-08-25 12:00:00', NOW()); sample data as requested

-- Disable foreign key checks temporarily
SET FOREIGN_KEY_CHECKS = 0;

-- Clear all existing data
TRUNCATE TABLE policy_documents;
TRUNCATE TABLE policy_beneficiaries;
TRUNCATE TABLE policy_renewals;
TRUNCATE TABLE customer_followups;
TRUNCATE TABLE agent_performance;
TRUNCATE TABLE policies;
TRUNCATE TABLE customers;
TRUNCATE TABLE users;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- Insert Users (1 Admin, 2 Agents, 1 Reception)
INSERT INTO users (id, username, email, password, name, role, phone, status, created_at, updated_at) VALUES
(1, 'admin', 'admin@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin User', 'admin', '9876543210', 'active', NOW(), NOW()),
(2, 'agent1', 'agent1@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rajesh Kumar', 'agent', '9876543211', 'active', NOW(), NOW()),
(3, 'agent2', 'agent2@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Priya Sharma', 'agent', '9876543212', 'active', NOW(), NOW()),
(4, 'reception', 'reception@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Reception Desk', 'receptionist', '9876543213', 'active', NOW(), NOW());

-- Insert sample customers for motor insurance policies
INSERT INTO customers (id, customer_code, name, email, phone, date_of_birth, gender, occupation, address, city, pincode, status, created_at, updated_at) VALUES
(1, 'CUST001', 'Amit Patel', 'amit.patel@email.com', '9876543201', '1985-05-15', 'male', 'Business Owner', '123 MG Road', 'Mumbai', '400001', 'active', NOW(), NOW()),
(2, 'CUST002', 'Sunita Sharma', 'sunita.sharma@email.com', '9876543202', '1990-08-22', 'female', 'Software Engineer', '456 Sector 15', 'Gurgaon', '122001', 'active', NOW(), NOW()),
(3, 'CUST003', 'Rahul Singh', 'rahul.singh@email.com', '9876543203', '1988-12-10', 'male', 'Teacher', '789 Civil Lines', 'Delhi', '110001', 'active', NOW(), NOW()),
(4, 'CUST004', 'Meera Gupta', 'meera.gupta@email.com', '9876543204', '1992-03-18', 'female', 'Doctor', '321 Park Street', 'Kolkata', '700001', 'active', NOW(), NOW()),
(5, 'CUST005', 'Vikash Kumar', 'vikash.kumar@email.com', '9876543205', '1987-07-25', 'male', 'Accountant', '654 Anna Nagar', 'Chennai', '600001', 'active', NOW(), NOW()),
(6, 'CUST006', 'Anjali Reddy', 'anjali.reddy@email.com', '9876543206', '1995-11-08', 'female', 'Marketing Manager', '987 Banjara Hills', 'Hyderabad', '500001', 'active', NOW(), NOW()),
(7, 'CUST007', 'Deepak Joshi', 'deepak.joshi@email.com', '9876543207', '1983-01-30', 'male', 'Consultant', '147 Koregaon Park', 'Pune', '411001', 'active', NOW(), NOW()),
(8, 'CUST008', 'Kavita Nair', 'kavita.nair@email.com', '9876543208', '1991-09-14', 'female', 'Banker', '258 Marine Drive', 'Mumbai', '400002', 'active', NOW(), NOW()),
(9, 'CUST009', 'Suresh Agarwal', 'suresh.agarwal@email.com', '9876543209', '1986-04-12', 'male', 'Trader', '369 Commercial Street', 'Bangalore', '560001', 'active', NOW(), NOW()),
(10, 'CUST010', 'Pooja Mishra', 'pooja.mishra@email.com', '9876543210', '1993-06-20', 'female', 'HR Manager', '741 Hazratganj', 'Lucknow', '226001', 'active', NOW(), NOW()),
(11, 'CUST011', 'Manish Agrawal', 'manish.agrawal@email.com', '9876543211', '1989-10-05', 'male', 'Engineer', '852 Satellite Road', 'Ahmedabad', '380001', 'active', NOW(), NOW()),
(12, 'CUST012', 'Ritu Saxena', 'ritu.saxena@email.com', '9876543212', '1994-02-28', 'female', 'Architect', '963 Arera Colony', 'Bhopal', '462001', 'active', NOW(), NOW()),
(13, 'CUST013', 'Arjun Kapoor', 'arjun.kapoor@email.com', '9876543213', '1984-12-16', 'male', 'Sales Manager', '159 Model Town', 'Jalandhar', '144001', 'active', NOW(), NOW()),
(14, 'CUST014', 'Neha Gupta', 'neha.gupta@email.com', '9876543214', '1996-08-03', 'female', 'Designer', '357 Rajouri Garden', 'Delhi', '110027', 'active', NOW(), NOW()),
(15, 'CUST015', 'Rohit Verma', 'rohit.verma@email.com', '9876543215', '1990-11-22', 'male', 'IT Manager', '486 Whitefield', 'Bangalore', '560066', 'active', NOW(), NOW()),
(16, 'CUST016', 'Shreya Iyer', 'shreya.iyer@email.com', '9876543216', '1987-05-09', 'female', 'Consultant', '789 Vashi', 'Navi Mumbai', '400703', 'active', NOW(), NOW()),
(17, 'CUST017', 'Ajay Tiwari', 'ajay.tiwari@email.com', '9876543217', '1992-01-15', 'male', 'Businessman', '234 Gomti Nagar', 'Lucknow', '226010', 'active', NOW(), NOW()),
(18, 'CUST018', 'Priyanka Das', 'priyanka.das@email.com', '9876543218', '1988-07-11', 'female', 'Professor', '567 Salt Lake', 'Kolkata', '700064', 'active', NOW(), NOW()),
(19, 'CUST019', 'Kiran Rao', 'kiran.rao@email.com', '9876543219', '1985-03-27', 'male', 'Government Officer', '891 Jubilee Hills', 'Hyderabad', '500033', 'active', NOW(), NOW()),
(20, 'CUST020', 'Divya Jain', 'divya.jain@email.com', '9876543220', '1991-09-18', 'female', 'Pharmacist', '345 Malviya Nagar', 'Jaipur', '302017', 'active', NOW(), NOW());

-- Motor Insurance Policies for Current Month (August 2025)
-- 10 Expiring Policies (expiring in August 2025)
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, created_at, updated_at) VALUES
(1, 'POL001/2024', 1, 1, 1, 'motor', '2024-08-01', '2025-08-05', 25000.00, 500000.00, 10.00, 2500.00, 2, 'active', 'MH12AB1234', 'car', '2024-08-01 10:00:00', NOW()),
(2, 'POL002/2024', 2, 2, 1, 'motor', '2024-08-02', '2025-08-08', 18000.00, 300000.00, 10.00, 1800.00, 3, 'active', 'DL01CD5678', 'car', '2024-08-02 11:00:00', NOW()),
(3, 'POL003/2024', 3, 1, 1, 'motor', '2024-08-03', '2025-08-12', 12000.00, 150000.00, 10.00, 1200.00, 2, 'active', 'KA03EF9012', 'two_wheeler', '2024-08-03 12:00:00', NOW()),
(4, 'POL004/2024', 4, 3, 1, 'motor', '2024-08-04', '2025-08-15', 22000.00, 400000.00, 10.00, 2200.00, 3, 'active', 'WB07GH3456', 'car', '2024-08-04 13:00:00', NOW()),
(5, 'POL005/2024', 5, 2, 1, 'motor', '2024-08-05', '2025-08-18', 14000.00, 200000.00, 10.00, 1400.00, 2, 'active', 'TN09IJ7890', 'two_wheeler', '2024-08-05 14:00:00', NOW()),
(6, 'POL006/2024', 6, 1, 1, 'motor', '2024-08-06', '2025-08-20', 28000.00, 600000.00, 10.00, 2800.00, 3, 'active', 'AP12KL2345', 'car', '2024-08-06 15:00:00', NOW()),
(7, 'POL007/2024', 7, 3, 1, 'motor', '2024-08-07', '2025-08-22', 16000.00, 250000.00, 10.00, 1600.00, 2, 'active', 'MH14MN6789', 'two_wheeler', '2024-08-07 16:00:00', NOW()),
(8, 'POL008/2024', 8, 2, 1, 'motor', '2024-08-08', '2025-08-25', 24000.00, 450000.00, 10.00, 2400.00, 3, 'active', 'GJ05OP0123', 'car', '2024-08-08 17:00:00', NOW()),
(9, 'POL009/2024', 9, 1, 1, 'motor', '2024-08-09', '2025-08-28', 20000.00, 350000.00, 10.00, 2000.00, 2, 'active', 'RJ14QR4567', 'car', '2024-08-09 18:00:00', NOW()),
(10, 'POL010/2024', 10, 3, 1, 'motor', '2024-08-10', '2025-08-30', 15000.00, 220000.00, 10.00, 1500.00, 3, 'active', 'UP16ST8901', 'two_wheeler', '2024-08-10 19:00:00', NOW());

-- 2 Expired Policies (expired in August 2025)
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, created_at, updated_at) VALUES
(11, 'POL011/2023', 11, 2, 1, 'motor', '2023-08-01', '2024-07-31', 19000.00, 320000.00, 10.00, 1900.00, 2, 'expired', 'HR26UV5678', 'car', '2023-08-01 10:00:00', NOW()),
(12, 'POL012/2023', 12, 1, 1, 'motor', '2023-08-15', '2024-08-14', 13000.00, 180000.00, 10.00, 1300.00, 3, 'expired', 'MP09WX9012', 'two_wheeler', '2023-08-15 11:00:00', NOW());

-- 5 New Policies (created in August 2025)
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, created_at, updated_at) VALUES
(13, 'POL013/2025', 13, 1, 1, 'motor', '2025-08-01', '2026-07-31', 26000.00, 520000.00, 10.00, 2600.00, 2, 'active', 'PB03YZ3456', 'car', '2025-08-01 10:00:00', NOW()),
(14, 'POL014/2025', 14, 2, 1, 'motor', '2025-08-05', '2026-08-04', 17000.00, 280000.00, 10.00, 1700.00, 3, 'active', 'DL08AB7890', 'two_wheeler', '2025-08-05 11:00:00', NOW()),
(15, 'POL015/2025', 15, 3, 1, 'motor', '2025-08-10', '2026-08-09', 30000.00, 650000.00, 10.00, 3000.00, 2, 'active', 'KA05CD1234', 'car', '2025-08-10 12:00:00', NOW()),
(16, 'POL016/2025', 16, 1, 1, 'motor', '2025-08-15', '2026-08-14', 21000.00, 380000.00, 10.00, 2100.00, 3, 'active', 'MH27EF5678', 'car', '2025-08-15 13:00:00', NOW()),
(17, 'POL017/2025', 17, 2, 1, 'motor', '2025-08-20', '2026-08-19', 18500.00, 310000.00, 10.00, 1850.00, 2, 'active', 'UP32GH9012', 'two_wheeler', '2025-08-20 14:00:00', NOW());

-- 3 Renewed Policies (renewed in August 2025)
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, policy_start_date, policy_end_date, premium_amount, sum_assured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, is_renewal, original_policy_id, created_at, updated_at) VALUES
(18, 'POL018/2025-R', 18, 1, 1, '2025-08-02', '2026-08-01', 27000.00, 550000.00, 10.00, 2700.00, 2, 'active', 'WB19IJ3456', 'car', 1, 11, '2025-08-02 10:00:00', NOW()),
(19, 'POL019/2025-R', 19, 3, 1, '2025-08-12', '2026-08-11', 23000.00, 420000.00, 10.00, 2300.00, 3, 'active', 'TS07KL7890', 'car', 1, 12, '2025-08-12 11:00:00', NOW()),
(20, 'POL020/2025-R', 20, 2, 1, '2025-08-25', '2026-08-24', 19500.00, 340000.00, 10.00, 1950.00, 2, 'active', 'RJ09MN1234', 'car', 1, 13, '2025-08-25 12:00:00', NOW());

-- Update agent performance based on policies
INSERT INTO agent_performance (user_id, month, year, policies_sold, premium_collected, commission_earned, target_achievement, created_at, updated_at) VALUES
(2, 8, 2025, 10, 195500.00, 19550.00, 85.5, NOW(), NOW()),
(3, 8, 2025, 10, 172500.00, 17250.00, 78.2, NOW(), NOW());

-- Add some policy renewals tracking
INSERT INTO policy_renewals (original_policy_id, renewed_policy_id, renewal_date, status, created_at, updated_at) VALUES
(11, 18, '2025-08-02', 'completed', NOW(), NOW()),
(12, 19, '2025-08-12', 'completed', NOW(), NOW()),
(13, 20, '2025-08-25', 'completed', NOW(), NOW());

COMMIT;

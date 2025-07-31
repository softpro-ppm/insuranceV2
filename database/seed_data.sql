-- Insurance Management System v2.0 - Seed Data
-- Creates 500 customers, 700 policies, and 3 agents with comprehensive dummy data

-- First, let's add more insurance companies (based on Indian market)
INSERT INTO insurance_companies (name, code, supports_motor, supports_health, supports_life, contact_email, contact_phone, website) VALUES 
('ICICI Lombard General Insurance', 'ICICI', TRUE, TRUE, FALSE, 'support@icicilombard.com', '1800-2666', 'www.icicilombard.com'),
('HDFC ERGO General Insurance', 'HDFC', TRUE, TRUE, FALSE, 'customercare@hdfcergo.com', '1800-2700', 'www.hdfcergo.com'),
('Bajaj Allianz General Insurance', 'BAJAJ', TRUE, TRUE, TRUE, 'bagichelp@bajajallianz.co.in', '1800-209-5858', 'www.bajajallianz.com'),
('SBI General Insurance', 'SBI', TRUE, TRUE, FALSE, 'sbigeneralins@sbigeneral.in', '1800-22-1111', 'www.sbigeneral.in'),
('Tata AIG General Insurance', 'TATA', TRUE, TRUE, FALSE, 'customersupport@tataaig.com', '1800-266-7780', 'www.tataaig.com'),
('Star Health and Allied Insurance', 'STAR', FALSE, TRUE, FALSE, 'customercare@starhealth.in', '1800-425-2255', 'www.starhealth.in'),
('LIC of India', 'LIC', FALSE, TRUE, TRUE, 'customer@licindia.com', '1251', 'www.licindia.in'),
('Max Life Insurance', 'MAX', FALSE, FALSE, TRUE, 'customercare@maxlifeinsurance.com', '1800-299-9999', 'www.maxlifeinsurance.com'),
('New India Assurance Company', 'NIA', TRUE, TRUE, FALSE, 'ho@newindia.co.in', '1800-209-1415', 'www.newindia.co.in'),
('Oriental Insurance Company', 'OIC', TRUE, TRUE, FALSE, 'customercare@orientalinsurance.co.in', '1800-118-485', 'www.orientalinsurance.co.in'),
('Reliance General Insurance', 'RELIANCE', TRUE, TRUE, FALSE, 'rgi.customercare@relianceada.com', '1800-300-8181', 'www.reliancegeneral.co.in'),
('United India Insurance', 'UNITED', TRUE, TRUE, FALSE, 'ho@uiic.co.in', '1800-4253-3333', 'www.uiic.co.in'),
('National Insurance Company', 'NATIONAL', TRUE, TRUE, FALSE, 'customercare@nic.co.in', '1800-200-7710', 'www.nationalinsurance.nic.co.in'),
('Kotak Mahindra General Insurance', 'KOTAK', TRUE, TRUE, FALSE, 'customer.care@kotak.com', '1860-266-2666', 'www.kotakgeneral.com'),
('Future Generali India Insurance', 'FUTURE', TRUE, TRUE, FALSE, 'customer.first@futuregenerali.in', '1800-220-233', 'www.futuregenerali.in'),
('Cholamandalam MS General Insurance', 'CHOLA', TRUE, TRUE, FALSE, 'customercare@cholams.murugappa.com', '1800-200-5544', 'www.cholainsurance.com'),
('Bharti AXA General Insurance', 'BHARTI', TRUE, TRUE, FALSE, 'customer.care@bharti-axa.co.in', '1800-103-5858', 'www.bharti-axa.co.in'),
('IFFCO Tokio General Insurance', 'IFFCO', TRUE, TRUE, FALSE, 'customercare@iffcotokio.co.in', '1800-103-5499', 'www.iffcotokio.co.in'),
('Royal Sundaram General Insurance', 'ROYAL', TRUE, TRUE, FALSE, 'customercare@royalsundaram.in', '1800-568-9999', 'www.royalsundaram.in'),
('Digit General Insurance', 'DIGIT', TRUE, TRUE, FALSE, 'hello@godigit.com', '1800-258-4242', 'www.godigit.com');

-- Create 3 agent users
INSERT INTO users (name, email, username, password, phone, role, status) VALUES
('Rajesh Kumar', 'rajesh.agent@softpromis.com', '9876543210', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543210', 'agent', 'active'),
('Priya Sharma', 'priya.agent@softpromis.com', '9876543211', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543211', 'agent', 'active'),
('Amit Singh', 'amit.agent@softpromis.com', '9876543212', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543212', 'agent', 'active');

-- Generate 500 customers with realistic Indian data
INSERT INTO customers (customer_code, name, email, phone, alternate_phone, date_of_birth, gender, address, city, state, pincode, aadhar_number, pan_number, created_by, created_at) VALUES

-- Customer batch 1-50 (FY 2022-23)
('CUST000001', 'Aadhya Patel', 'aadhya.patel@email.com', '9876543001', '9876544001', '1985-03-15', 'female', '123 MG Road, Sector 12', 'Ahmedabad', 'Gujarat', '380001', '123456789001', 'ABCDE1234A', 1, '2022-04-15 10:30:00'),
('CUST000002', 'Arjun Sharma', 'arjun.sharma@email.com', '9876543002', '9876544002', '1990-07-22', 'male', '456 Park Street, Block A', 'Kolkata', 'West Bengal', '700001', '123456789002', 'ABCDE1234B', 2, '2022-04-20 14:15:00'),
('CUST000003', 'Deepika Singh', 'deepika.singh@email.com', '9876543003', '9876544003', '1988-11-08', 'female', '789 Brigade Road, Layout 3', 'Bangalore', 'Karnataka', '560001', '123456789003', 'ABCDE1234C', 3, '2022-05-10 09:45:00'),
('CUST000004', 'Kartik Joshi', 'kartik.joshi@email.com', '9876543004', '9876544004', '1992-02-14', 'male', '321 FC Road, Pune', 'Pune', 'Maharashtra', '411001', '123456789004', 'ABCDE1234D', 1, '2022-05-25 16:20:00'),
('CUST000005', 'Meera Gupta', 'meera.gupta@email.com', '9876543005', '9876544005', '1987-09-30', 'female', '654 Connaught Place, CP', 'New Delhi', 'Delhi', '110001', '123456789005', 'ABCDE1234E', 2, '2022-06-08 11:30:00'),
('CUST000006', 'Rahul Verma', 'rahul.verma@email.com', '9876543006', '9876544006', '1991-12-05', 'male', '987 Anna Salai, T Nagar', 'Chennai', 'Tamil Nadu', '600001', '123456789006', 'ABCDE1234F', 3, '2022-06-15 13:45:00'),
('CUST000007', 'Sneha Reddy', 'sneha.reddy@email.com', '9876543007', '9876544007', '1989-04-18', 'female', '159 Jubilee Hills, Road 36', 'Hyderabad', 'Telangana', '500001', '123456789007', 'ABCDE1234G', 1, '2022-07-02 08:15:00'),
('CUST000008', 'Vikram Malhotra', 'vikram.malhotra@email.com', '9876543008', '9876544008', '1993-08-27', 'male', '753 Model Town, Sector 15', 'Chandigarh', 'Chandigarh', '160001', '123456789008', 'ABCDE1234H', 2, '2022-07-18 15:30:00'),
('CUST000009', 'Anita Kapoor', 'anita.kapoor@email.com', '9876543009', '9876544009', '1986-01-12', 'female', '951 Civil Lines, Near Court', 'Jaipur', 'Rajasthan', '302001', '123456789009', 'ABCDE1234I', 3, '2022-08-05 12:00:00'),
('CUST000010', 'Suresh Nair', 'suresh.nair@email.com', '9876543010', '9876544010', '1994-06-09', 'male', '357 Marine Drive, Fort', 'Mumbai', 'Maharashtra', '400001', '123456789010', 'ABCDE1234J', 1, '2022-08-20 17:45:00'),

-- Continue with more realistic customer data...
('CUST000011', 'Kavya Menon', 'kavya.menon@email.com', '9876543011', '9876544011', '1990-03-25', 'female', '12 MG Road Extension', 'Kochi', 'Kerala', '682001', '123456789011', 'ABCDE1234K', 2, '2022-09-10 10:15:00'),
('CUST000012', 'Rohit Agarwal', 'rohit.agarwal@email.com', '9876543012', '9876544012', '1988-10-14', 'male', '45 Hazratganj, Lucknow', 'Lucknow', 'Uttar Pradesh', '226001', '123456789012', 'ABCDE1234L', 3, '2022-09-25 14:30:00'),
('CUST000013', 'Priyanka Jain', 'priyanka.jain@email.com', '9876543013', '9876544013', '1991-07-03', 'female', '78 Sadar Bazaar, Agra', 'Agra', 'Uttar Pradesh', '282001', '123456789013', 'ABCDE1234M', 1, '2022-10-08 09:20:00'),
('CUST000014', 'Manish Tripathi', 'manish.tripathi@email.com', '9876543014', '9876544014', '1987-12-19', 'male', '23 Paltan Bazaar, Dehradun', 'Dehradun', 'Uttarakhand', '248001', '123456789014', 'ABCDE1234N', 2, '2022-10-22 16:40:00'),
('CUST000015', 'Ritu Bhardwaj', 'ritu.bhardwaj@email.com', '9876543015', '9876544015', '1992-05-11', 'female', '67 Mall Road, Shimla', 'Shimla', 'Himachal Pradesh', '171001', '123456789015', 'ABCDE1234O', 3, '2022-11-05 11:50:00');

-- Continue with 485 more customers distributed across different time periods and regions
-- I'll create a stored procedure to generate the remaining customers efficiently

DELIMITER //
CREATE PROCEDURE GenerateCustomers()
BEGIN
    DECLARE i INT DEFAULT 16;
    DECLARE customer_code VARCHAR(20);
    DECLARE first_names TEXT DEFAULT 'Aarav,Vivaan,Aditya,Vihaan,Arjun,Sai,Reyansh,Ayaan,Krishna,Ishaan,Shaurya,Atharv,Advik,Rudra,Arnav,Advait,Dhruv,Kabir,Shivansh,Yuvraj,Ananya,Diya,Aanya,Aadhya,Avni,Anushka,Kavya,Sara,Myra,Prisha,Saanvi,Ira,Riya,Anaya,Pari,Navya,Nisha,Zara,Kiara,Aditi,Rajesh,Suresh,Ramesh,Mahesh,Dinesh,Ganesh,Naresh,Hitesh,Umesh,Kailash,Priya,Sunita,Rekha,Kavita,Sushma,Rashmi,Neha,Pooja,Sneha,Meera';
    DECLARE last_names TEXT DEFAULT 'Sharma,Verma,Gupta,Singh,Kumar,Agarwal,Bansal,Jain,Mittal,Goyal,Aggarwal,Garg,Arora,Malhotra,Kapoor,Chopra,Bhatia,Sethi,Khanna,Tiwari,Yadav,Mishra,Pandey,Shukla,Dubey,Saxena,Srivastava,Tripathi,Dwivedi,Pathak,Reddy,Naidu,Rao,Krishna,Murthy,Prasad,Raman,Nair,Menon,Pillai,Shah,Patel,Desai,Mehta,Modi,Thakkar,Soni,Bhatt,Vyas,Joshi';
    DECLARE cities TEXT DEFAULT 'Mumbai,Delhi,Bangalore,Hyderabad,Ahmedabad,Chennai,Kolkata,Surat,Pune,Jaipur,Lucknow,Kanpur,Nagpur,Indore,Thane,Bhopal,Visakhapatnam,Pimpri,Patna,Vadodara,Ghaziabad,Ludhiana,Agra,Nashik,Faridabad,Meerut,Rajkot,Kalyan,Vasai,Varanasi';
    DECLARE states TEXT DEFAULT 'Maharashtra,Delhi,Karnataka,Telangana,Gujarat,Tamil Nadu,West Bengal,Gujarat,Maharashtra,Rajasthan,Uttar Pradesh,Uttar Pradesh,Maharashtra,Madhya Pradesh,Maharashtra,Madhya Pradesh,Andhra Pradesh,Maharashtra,Bihar,Gujarat,Uttar Pradesh,Punjab,Uttar Pradesh,Maharashtra,Haryana,Uttar Pradesh,Gujarat,Maharashtra,Maharashtra,Uttar Pradesh';
    DECLARE current_fy INT DEFAULT 1; -- 1=2022-23, 2=2023-24, 3=2024-25
    DECLARE created_date TIMESTAMP;
    
    WHILE i <= 500 DO
        SET customer_code = CONCAT('CUST', LPAD(i, 6, '0'));
        
        -- Distribute customers across FY years
        IF i <= 150 THEN SET current_fy = 1; -- FY 2022-23
        ELSEIF i <= 350 THEN SET current_fy = 2; -- FY 2023-24  
        ELSE SET current_fy = 3; -- FY 2024-25
        END IF;
        
        -- Generate creation date based on FY
        CASE current_fy
            WHEN 1 THEN SET created_date = DATE_ADD('2022-04-01', INTERVAL FLOOR(RAND() * 365) DAY);
            WHEN 2 THEN SET created_date = DATE_ADD('2023-04-01', INTERVAL FLOOR(RAND() * 365) DAY);
            WHEN 3 THEN SET created_date = DATE_ADD('2024-04-01', INTERVAL FLOOR(RAND() * 300) DAY);
        END CASE;
        
        INSERT INTO customers (
            customer_code, name, email, phone, alternate_phone, 
            date_of_birth, gender, address, city, state, pincode, 
            aadhar_number, pan_number, created_by, created_at
        ) VALUES (
            customer_code,
            CONCAT(
                SUBSTRING_INDEX(SUBSTRING_INDEX(first_names, ',', FLOOR(1 + RAND() * 60)), ',', -1),
                ' ',
                SUBSTRING_INDEX(SUBSTRING_INDEX(last_names, ',', FLOOR(1 + RAND() * 50)), ',', -1)
            ),
            LOWER(CONCAT(customer_code, '@email.com')),
            CONCAT('987654', LPAD(i, 4, '0')),
            CONCAT('987655', LPAD(i, 4, '0')),
            DATE_SUB(CURDATE(), INTERVAL (20 + FLOOR(RAND() * 40)) YEAR),
            IF(RAND() > 0.5, 'male', 'female'),
            CONCAT(FLOOR(1 + RAND() * 999), ' Sample Address ', i),
            SUBSTRING_INDEX(SUBSTRING_INDEX(cities, ',', FLOOR(1 + RAND() * 30)), ',', -1),
            SUBSTRING_INDEX(SUBSTRING_INDEX(states, ',', FLOOR(1 + RAND() * 30)), ',', -1),
            CONCAT(FLOOR(100000 + RAND() * 899999)),
            CONCAT(LPAD(FLOOR(100000000000 + RAND() * 899999999999), 12, '0')),
            CONCAT('ABCDE', LPAD(i, 4, '0'), CHAR(65 + FLOOR(RAND() * 26))),
            FLOOR(1 + RAND() * 3),
            created_date
        );
        
        SET i = i + 1;
    END WHILE;
END //
DELIMITER ;

-- Execute the procedure to generate customers
CALL GenerateCustomers();
DROP PROCEDURE GenerateCustomers;

-- Now generate 700 policies distributed across the customers and time periods
DELIMITER //
CREATE PROCEDURE GeneratePolicies()
BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE policy_num VARCHAR(100);
    DECLARE customer_id INT;
    DECLARE company_id INT;
    DECLARE policy_type_id INT;
    DECLARE category VARCHAR(20);
    DECLARE premium DECIMAL(10,2);
    DECLARE revenue DECIMAL(10,2);
    DECLARE start_date DATE;
    DECLARE end_date DATE;
    DECLARE current_fy INT;
    DECLARE policy_categories TEXT DEFAULT 'motor,health,life';
    DECLARE selected_category VARCHAR(20);
    
    WHILE i <= 700 DO
        SET policy_num = CONCAT('POL', DATE_FORMAT(NOW(), '%Y'), LPAD(i, 6, '0'));
        
        -- Distribute policies across FY years
        IF i <= 200 THEN SET current_fy = 1; -- FY 2022-23
        ELSEIF i <= 450 THEN SET current_fy = 2; -- FY 2023-24
        ELSE SET current_fy = 3; -- FY 2024-25
        END IF;
        
        -- Random customer (1-500)
        SET customer_id = FLOOR(1 + RAND() * 500);
        
        -- Random category
        SET selected_category = SUBSTRING_INDEX(SUBSTRING_INDEX(policy_categories, ',', FLOOR(1 + RAND() * 3)), ',', -1);
        
        -- Get appropriate company and policy type based on category
        SELECT id INTO company_id FROM insurance_companies 
        WHERE (selected_category = 'motor' AND supports_motor = 1) 
           OR (selected_category = 'health' AND supports_health = 1) 
           OR (selected_category = 'life' AND supports_life = 1)
        ORDER BY RAND() LIMIT 1;
        
        SELECT id INTO policy_type_id FROM policy_types 
        WHERE category = selected_category AND status = 'active'
        ORDER BY RAND() LIMIT 1;
        
        -- Generate premium and revenue
        SET premium = 7000 + FLOOR(RAND() * 23000); -- 7000 to 30000
        SET revenue = 500 + FLOOR(RAND() * 3500);    -- 500 to 4000
        
        -- Generate policy dates based on FY
        CASE current_fy
            WHEN 1 THEN 
                SET start_date = DATE_ADD('2022-04-01', INTERVAL FLOOR(RAND() * 365) DAY);
                SET end_date = DATE_ADD(start_date, INTERVAL 1 YEAR);
            WHEN 2 THEN 
                SET start_date = DATE_ADD('2023-04-01', INTERVAL FLOOR(RAND() * 365) DAY);
                SET end_date = DATE_ADD(start_date, INTERVAL 1 YEAR);
            WHEN 3 THEN 
                -- Mix of current, expired, and expiring soon
                IF i % 3 = 0 THEN
                    -- Expired policies (ended 1-6 months ago)
                    SET end_date = DATE_SUB(CURDATE(), INTERVAL FLOOR(1 + RAND() * 6) MONTH);
                    SET start_date = DATE_SUB(end_date, INTERVAL 1 YEAR);
                ELSEIF i % 3 = 1 THEN
                    -- Expiring soon (next 1-3 months)
                    SET start_date = DATE_SUB(CURDATE(), INTERVAL FLOOR(9 + RAND() * 3) MONTH);
                    SET end_date = DATE_ADD(start_date, INTERVAL 1 YEAR);
                ELSE
                    -- Current active policies
                    SET start_date = DATE_SUB(CURDATE(), INTERVAL FLOOR(1 + RAND() * 6) MONTH);
                    SET end_date = DATE_ADD(start_date, INTERVAL 1 YEAR);
                END IF;
        END CASE;
        
        INSERT INTO policies (
            policy_number, customer_id, insurance_company_id, policy_type_id, 
            category, policy_start_date, policy_end_date, premium_amount, 
            sum_insured, revenue, status, created_at
        ) VALUES (
            policy_num, customer_id, company_id, policy_type_id,
            selected_category, start_date, end_date, premium,
            premium * (5 + FLOOR(RAND() * 15)), -- Sum insured 5x to 20x premium
            revenue,
            IF(end_date > CURDATE(), 'active', 'expired'),
            start_date
        );
        
        SET i = i + 1;
    END WHILE;
END //
DELIMITER ;

-- Execute the procedure to generate policies
CALL GeneratePolicies();
DROP PROCEDURE GeneratePolicies;

-- Update policies table to add revenue column if it doesn't exist
ALTER TABLE policies ADD COLUMN IF NOT EXISTS revenue DECIMAL(10,2) DEFAULT 0;

-- Create documents table for KYC and policy documents
CREATE TABLE IF NOT EXISTS customer_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    document_type ENUM('pan', 'aadhar', 'passport', 'driving_license', 'voter_id', 'other') NOT NULL,
    document_number VARCHAR(50),
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT,
    mime_type VARCHAR(100),
    uploaded_by INT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    remarks TEXT,
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS policy_documents (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_id INT NOT NULL,
    document_type ENUM('policy_document', 'proposal_form', 'medical_report', 'vehicle_rc', 'driving_license', 'noc', 'claim_form', 'other') NOT NULL,
    document_name VARCHAR(255) NOT NULL,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT,
    mime_type VARCHAR(100),
    uploaded_by INT,
    uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    remarks TEXT,
    FOREIGN KEY (policy_id) REFERENCES policies(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id)
);

-- Create agent performance tracking table
CREATE TABLE IF NOT EXISTS agent_performance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agent_id INT NOT NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    policies_sold INT DEFAULT 0,
    total_premium DECIMAL(15,2) DEFAULT 0,
    total_revenue DECIMAL(15,2) DEFAULT 0,
    target_premium DECIMAL(15,2) DEFAULT 0,
    target_policies INT DEFAULT 0,
    commission_earned DECIMAL(10,2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (agent_id) REFERENCES users(id),
    UNIQUE KEY unique_agent_month_year (agent_id, month, year)
);

-- Create communication log table for future automation
CREATE TABLE IF NOT EXISTS communication_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT,
    policy_id INT,
    type ENUM('email', 'whatsapp', 'sms', 'call') NOT NULL,
    purpose ENUM('welcome', 'renewal_reminder', 'expiry_notice', 'payment_reminder', 'claim_update', 'other') NOT NULL,
    recipient VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT,
    status ENUM('pending', 'sent', 'delivered', 'failed') DEFAULT 'pending',
    sent_at TIMESTAMP NULL,
    delivered_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(id),
    FOREIGN KEY (policy_id) REFERENCES policies(id)
);

-- Create renewals tracking table
CREATE TABLE IF NOT EXISTS policy_renewals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    original_policy_id INT NOT NULL,
    new_policy_id INT,
    renewal_date DATE NOT NULL,
    status ENUM('pending', 'renewed', 'lapsed', 'declined') DEFAULT 'pending',
    reminder_sent_count INT DEFAULT 0,
    last_reminder_sent TIMESTAMP NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (original_policy_id) REFERENCES policies(id),
    FOREIGN KEY (new_policy_id) REFERENCES policies(id)
);

-- Insert sample performance data for agents
INSERT INTO agent_performance (agent_id, month, year, policies_sold, total_premium, total_revenue, target_premium, target_policies, commission_earned) VALUES
-- Agent 1 (Rajesh Kumar) - Last 12 months
(1, 1, 2024, 15, 425000, 35000, 500000, 20, 17500),
(1, 2, 2024, 18, 520000, 42000, 500000, 20, 21000),
(1, 3, 2024, 22, 680000, 55000, 500000, 20, 27500),
(1, 4, 2024, 19, 545000, 44000, 500000, 20, 22000),
(1, 5, 2024, 21, 625000, 51000, 500000, 20, 25500),
(1, 6, 2024, 17, 485000, 39000, 500000, 20, 19500),
(1, 7, 2024, 25, 745000, 61000, 500000, 20, 30500),
(1, 8, 2024, 20, 580000, 47000, 500000, 20, 23500),
(1, 9, 2024, 16, 465000, 38000, 500000, 20, 19000),
(1, 10, 2024, 23, 695000, 56000, 500000, 20, 28000),
(1, 11, 2024, 18, 525000, 43000, 500000, 20, 21500),
(1, 12, 2024, 14, 385000, 31000, 500000, 20, 15500),

-- Agent 2 (Priya Sharma) - Last 12 months
(2, 1, 2024, 12, 345000, 28000, 400000, 15, 14000),
(2, 2, 2024, 16, 465000, 38000, 400000, 15, 19000),
(2, 3, 2024, 19, 575000, 47000, 400000, 15, 23500),
(2, 4, 2024, 14, 425000, 35000, 400000, 15, 17500),
(2, 5, 2024, 17, 495000, 40000, 400000, 15, 20000),
(2, 6, 2024, 13, 385000, 31000, 400000, 15, 15500),
(2, 7, 2024, 21, 625000, 51000, 400000, 15, 25500),
(2, 8, 2024, 18, 525000, 43000, 400000, 15, 21500),
(2, 9, 2024, 15, 445000, 36000, 400000, 15, 18000),
(2, 10, 2024, 20, 585000, 48000, 400000, 15, 24000),
(2, 11, 2024, 16, 475000, 39000, 400000, 15, 19500),
(2, 12, 2024, 11, 325000, 26000, 400000, 15, 13000),

-- Agent 3 (Amit Singh) - Last 12 months
(3, 1, 2024, 10, 285000, 23000, 350000, 12, 11500),
(3, 2, 2024, 13, 385000, 31000, 350000, 12, 15500),
(3, 3, 2024, 16, 475000, 39000, 350000, 12, 19500),
(3, 4, 2024, 11, 325000, 26000, 350000, 12, 13000),
(3, 5, 2024, 14, 415000, 34000, 350000, 12, 17000),
(3, 6, 2024, 9, 265000, 22000, 350000, 12, 11000),
(3, 7, 2024, 17, 505000, 41000, 350000, 12, 20500),
(3, 8, 2024, 15, 445000, 36000, 350000, 12, 18000),
(3, 9, 2024, 12, 355000, 29000, 350000, 12, 14500),
(3, 10, 2024, 18, 535000, 44000, 350000, 12, 22000),
(3, 11, 2024, 13, 385000, 31000, 350000, 12, 15500),
(3, 12, 2024, 8, 235000, 19000, 350000, 12, 9500);

-- Generate renewal reminders for expiring policies
INSERT INTO policy_renewals (original_policy_id, renewal_date, status, reminder_sent_count, last_reminder_sent, notes)
SELECT 
    id as original_policy_id,
    policy_end_date as renewal_date,
    CASE 
        WHEN policy_end_date < CURDATE() THEN 'lapsed'
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN 'pending'
        ELSE 'pending'
    END as status,
    CASE 
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN 2
        ELSE 0
    END as reminder_sent_count,
    CASE 
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN DATE_SUB(CURDATE(), INTERVAL 5 DAY)
        ELSE NULL
    END as last_reminder_sent,
    'Auto-generated renewal tracking' as notes
FROM policies 
WHERE policy_end_date >= DATE_SUB(CURDATE(), INTERVAL 90 DAY);

-- Create indexes for better performance
CREATE INDEX idx_customers_phone ON customers(phone);
CREATE INDEX idx_customers_created_by ON customers(created_by);
CREATE INDEX idx_policies_customer ON policies(customer_id);
CREATE INDEX idx_policies_company ON policies(insurance_company_id);
CREATE INDEX idx_policies_dates ON policies(policy_start_date, policy_end_date);
CREATE INDEX idx_policies_category ON policies(category);
CREATE INDEX idx_policies_status ON policies(status);
CREATE INDEX idx_agent_performance_agent ON agent_performance(agent_id);
CREATE INDEX idx_communication_logs_customer ON communication_logs(customer_id);
CREATE INDEX idx_renewals_status ON policy_renewals(status);

-- Final statistics
SELECT 'Data Generation Complete' as Status,
       (SELECT COUNT(*) FROM customers) as Total_Customers,
       (SELECT COUNT(*) FROM policies) as Total_Policies,
       (SELECT COUNT(*) FROM users WHERE role = 'agent') as Total_Agents,
       (SELECT COUNT(*) FROM insurance_companies) as Total_Companies;

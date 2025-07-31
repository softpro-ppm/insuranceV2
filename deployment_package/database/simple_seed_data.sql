-- Insurance Management System v2.0 - Simple Seed Data
-- Creates sample customers, policies, and agents without stored procedures

-- First, ensure we have the agent users
INSERT IGNORE INTO users (name, email, username, password, phone, role, status) VALUES
('Rajesh Kumar', 'rajesh.agent@softpromis.com', '9876543210', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543210', 'agent', 'active'),
('Priya Sharma', 'priya.agent@softpromis.com', '9876543211', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543211', 'agent', 'active'),
('Amit Singh', 'amit.agent@softpromis.com', '9876543212', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '9876543212', 'agent', 'active');

-- Add insurance companies
INSERT IGNORE INTO insurance_companies (name, code, supports_motor, supports_health, supports_life, contact_email, contact_phone, website) VALUES 
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

-- Sample customers (50 to start with)
INSERT IGNORE INTO customers (customer_code, name, email, phone, alternate_phone, date_of_birth, gender, address, city, state, pincode, aadhar_number, pan_number, created_by, created_at) VALUES
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
('CUST000011', 'Kavya Menon', 'kavya.menon@email.com', '9876543011', '9876544011', '1990-03-25', 'female', '12 MG Road Extension', 'Kochi', 'Kerala', '682001', '123456789011', 'ABCDE1234K', 2, '2022-09-10 10:15:00'),
('CUST000012', 'Rohit Agarwal', 'rohit.agarwal@email.com', '9876543012', '9876544012', '1988-10-14', 'male', '45 Hazratganj, Lucknow', 'Lucknow', 'Uttar Pradesh', '226001', '123456789012', 'ABCDE1234L', 3, '2022-09-25 14:30:00'),
('CUST000013', 'Priyanka Jain', 'priyanka.jain@email.com', '9876543013', '9876544013', '1991-07-03', 'female', '78 Sadar Bazaar, Agra', 'Agra', 'Uttar Pradesh', '282001', '123456789013', 'ABCDE1234M', 1, '2022-10-08 09:20:00'),
('CUST000014', 'Manish Tripathi', 'manish.tripathi@email.com', '9876543014', '9876544014', '1987-12-19', 'male', '23 Paltan Bazaar, Dehradun', 'Dehradun', 'Uttarakhand', '248001', '123456789014', 'ABCDE1234N', 2, '2022-10-22 16:40:00'),
('CUST000015', 'Ritu Bhardwaj', 'ritu.bhardwaj@email.com', '9876543015', '9876544015', '1992-05-11', 'female', '67 Mall Road, Shimla', 'Shimla', 'Himachal Pradesh', '171001', '123456789015', 'ABCDE1234O', 3, '2022-11-05 11:50:00'),
('CUST000016', 'Amit Saxena', 'amit.saxena@email.com', '9876543016', '9876544016', '1989-01-28', 'male', '890 Civil Lines, Allahabad', 'Allahabad', 'Uttar Pradesh', '211001', '123456789016', 'ABCDE1234P', 1, '2023-04-12 09:30:00'),
('CUST000017', 'Neha Srivastava', 'neha.srivastava@email.com', '9876543017', '9876544017', '1991-06-15', 'female', '234 Gomti Nagar, Lucknow', 'Lucknow', 'Uttar Pradesh', '226010', '123456789017', 'ABCDE1234Q', 2, '2023-04-25 11:15:00'),
('CUST000018', 'Rajesh Mishra', 'rajesh.mishra@email.com', '9876543018', '9876544018', '1986-11-22', 'male', '567 Cantt Area, Varanasi', 'Varanasi', 'Uttar Pradesh', '221002', '123456789018', 'ABCDE1234R', 3, '2023-05-08 14:20:00'),
('CUST000019', 'Pooja Pandey', 'pooja.pandey@email.com', '9876543019', '9876544019', '1993-04-05', 'female', '123 Hazratganj, Lucknow', 'Lucknow', 'Uttar Pradesh', '226001', '123456789019', 'ABCDE1234S', 1, '2023-05-20 16:45:00'),
('CUST000020', 'Vivek Dubey', 'vivek.dubey@email.com', '9876543020', '9876544020', '1988-09-18', 'male', '456 Indira Nagar, Lucknow', 'Lucknow', 'Uttar Pradesh', '226016', '123456789020', 'ABCDE1234T', 2, '2023-06-02 10:30:00'),
('CUST000021', 'Shalini Gupta', 'shalini.gupta@email.com', '9876543021', '9876544021', '1990-12-10', 'female', '789 Mahanagar, Lucknow', 'Lucknow', 'Uttar Pradesh', '226006', '123456789021', 'ABCDE1234U', 3, '2023-06-15 13:00:00'),
('CUST000022', 'Ashish Verma', 'ashish.verma@email.com', '9876543022', '9876544022', '1987-03-27', 'male', '321 Aliganj, Lucknow', 'Lucknow', 'Uttar Pradesh', '226024', '123456789022', 'ABCDE1234V', 1, '2023-07-01 08:45:00'),
('CUST000023', 'Dipika Sharma', 'dipika.sharma@email.com', '9876543023', '9876544023', '1992-08-14', 'female', '654 Jankipuram, Lucknow', 'Lucknow', 'Uttar Pradesh', '226021', '123456789023', 'ABCDE1234W', 2, '2023-07-18 15:20:00'),
('CUST000024', 'Manoj Singh', 'manoj.singh@email.com', '9876543024', '9876544024', '1989-01-31', 'male', '987 Rajajipuram, Lucknow', 'Lucknow', 'Uttar Pradesh', '226017', '123456789024', 'ABCDE1234X', 3, '2023-08-05 12:15:00'),
('CUST000025', 'Sunita Yadav', 'sunita.yadav@email.com', '9876543025', '9876544025', '1994-05-20', 'female', '159 Kalyanpur, Lucknow', 'Lucknow', 'Uttar Pradesh', '226022', '123456789025', 'ABCDE1234Y', 1, '2023-08-22 09:50:00');

-- Sample policies for the customers
INSERT IGNORE INTO policies (policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, revenue, status, created_at) VALUES
('POL202200001', 1, 1, 1, 'motor', '2022-04-15', '2023-04-15', 15000, 200000, 1200, 'expired', '2022-04-15 10:30:00'),
('POL202200002', 2, 3, 4, 'health', '2022-04-20', '2023-04-20', 25000, 500000, 2000, 'expired', '2022-04-20 14:15:00'),
('POL202200003', 3, 7, 8, 'life', '2022-05-10', '2023-05-10', 30000, 1000000, 2400, 'expired', '2022-05-10 09:45:00'),
('POL202200004', 4, 2, 2, 'motor', '2022-05-25', '2023-05-25', 12000, 150000, 960, 'expired', '2022-05-25 16:20:00'),
('POL202200005', 5, 4, 5, 'health', '2022-06-08', '2023-06-08', 18000, 300000, 1440, 'expired', '2022-06-08 11:30:00'),
('POL202300001', 6, 1, 1, 'motor', '2023-04-15', '2024-04-15', 16000, 220000, 1280, 'expired', '2023-04-15 10:30:00'),
('POL202300002', 7, 3, 4, 'health', '2023-04-20', '2024-04-20', 27000, 550000, 2160, 'expired', '2023-04-20 14:15:00'),
('POL202300003', 8, 7, 8, 'life', '2023-05-10', '2024-05-10', 32000, 1100000, 2560, 'expired', '2023-05-10 09:45:00'),
('POL202300004', 9, 2, 2, 'motor', '2023-05-25', '2024-05-25', 13000, 160000, 1040, 'expired', '2023-05-25 16:20:00'),
('POL202300005', 10, 4, 5, 'health', '2023-06-08', '2024-06-08', 19000, 320000, 1520, 'expired', '2023-06-08 11:30:00'),
('POL202400001', 11, 1, 1, 'motor', '2024-04-15', '2025-04-15', 17000, 240000, 1360, 'active', '2024-04-15 10:30:00'),
('POL202400002', 12, 3, 4, 'health', '2024-04-20', '2025-04-20', 28000, 600000, 2240, 'active', '2024-04-20 14:15:00'),
('POL202400003', 13, 7, 8, 'life', '2024-05-10', '2025-05-10', 35000, 1200000, 2800, 'active', '2024-05-10 09:45:00'),
('POL202400004', 14, 2, 2, 'motor', '2024-05-25', '2025-05-25', 14000, 170000, 1120, 'active', '2024-05-25 16:20:00'),
('POL202400005', 15, 4, 5, 'health', '2024-06-08', '2025-06-08', 20000, 350000, 1600, 'active', '2024-06-08 11:30:00'),
('POL202400006', 16, 5, 3, 'motor', '2024-07-01', '2025-07-01', 11000, 120000, 880, 'active', '2024-07-01 10:00:00'),
('POL202400007', 17, 6, 6, 'health', '2024-07-15', '2025-07-15', 22000, 400000, 1760, 'active', '2024-07-15 11:30:00'),
('POL202400008', 18, 8, 9, 'life', '2024-08-01', '2025-08-01', 40000, 1500000, 3200, 'active', '2024-08-01 09:15:00'),
('POL202400009', 19, 1, 1, 'motor', '2024-08-15', '2025-08-15', 15500, 200000, 1240, 'active', '2024-08-15 14:20:00'),
('POL202400010', 20, 3, 4, 'health', '2024-09-01', '2025-09-01', 26000, 500000, 2080, 'active', '2024-09-01 10:45:00'),
-- Expiring soon policies
('POL202400011', 21, 2, 2, 'motor', '2024-08-01', '2025-08-01', 13500, 155000, 1080, 'active', '2024-08-01 12:30:00'),
('POL202400012', 22, 4, 5, 'health', '2024-08-15', '2025-08-15', 24000, 450000, 1920, 'active', '2024-08-15 15:00:00'),
('POL202400013', 23, 7, 8, 'life', '2024-09-01', '2025-09-01', 38000, 1300000, 3040, 'active', '2024-09-01 11:15:00'),
('POL202400014', 24, 1, 1, 'motor', '2024-09-15', '2025-09-15', 16500, 210000, 1320, 'active', '2024-09-15 13:45:00'),
('POL202400015', 25, 3, 4, 'health', '2024-10-01', '2025-10-01', 29000, 650000, 2320, 'active', '2024-10-01 09:30:00');

-- Insert sample performance data for agents
INSERT IGNORE INTO agent_performance (agent_id, month, year, policies_sold, total_premium, total_revenue, target_premium, target_policies, commission_earned) VALUES
-- Agent 1 (Rajesh Kumar) - Last 12 months
(1, 1, 2024, 5, 125000, 10000, 150000, 8, 5000),
(1, 2, 2024, 7, 185000, 14800, 150000, 8, 7400),
(1, 3, 2024, 6, 160000, 12800, 150000, 8, 6400),
(1, 4, 2024, 8, 210000, 16800, 150000, 8, 8400),
(1, 5, 2024, 5, 135000, 10800, 150000, 8, 5400),
(1, 6, 2024, 9, 245000, 19600, 150000, 8, 9800),
(1, 7, 2024, 7, 190000, 15200, 150000, 8, 7600),

-- Agent 2 (Priya Sharma) - Last 12 months
(2, 1, 2024, 4, 108000, 8640, 120000, 6, 4320),
(2, 2, 2024, 6, 162000, 12960, 120000, 6, 6480),
(2, 3, 2024, 5, 135000, 10800, 120000, 6, 5400),
(2, 4, 2024, 7, 189000, 15120, 120000, 6, 7560),
(2, 5, 2024, 4, 108000, 8640, 120000, 6, 4320),
(2, 6, 2024, 8, 216000, 17280, 120000, 6, 8640),
(2, 7, 2024, 6, 162000, 12960, 120000, 6, 6480),

-- Agent 3 (Amit Singh) - Last 12 months
(3, 1, 2024, 3, 81000, 6480, 100000, 5, 3240),
(3, 2, 2024, 5, 135000, 10800, 100000, 5, 5400),
(3, 3, 2024, 4, 108000, 8640, 100000, 5, 4320),
(3, 4, 2024, 6, 162000, 12960, 100000, 5, 6480),
(3, 5, 2024, 3, 81000, 6480, 100000, 5, 3240),
(3, 6, 2024, 7, 189000, 15120, 100000, 5, 7560),
(3, 7, 2024, 5, 135000, 10800, 100000, 5, 5400);

-- Generate renewal reminders for expiring policies
INSERT IGNORE INTO policy_renewals (original_policy_id, renewal_date, status, reminder_sent_count, last_reminder_sent, notes)
SELECT 
    id as original_policy_id,
    policy_end_date as renewal_date,
    CASE 
        WHEN policy_end_date < CURDATE() THEN 'lapsed'
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN 'pending'
        ELSE 'pending'
    END as status,
    CASE 
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN 1
        ELSE 0
    END as reminder_sent_count,
    CASE 
        WHEN policy_end_date <= DATE_ADD(CURDATE(), INTERVAL 30 DAY) THEN DATE_SUB(CURDATE(), INTERVAL 5 DAY)
        ELSE NULL
    END as last_reminder_sent,
    'Auto-generated renewal tracking' as notes
FROM policies 
WHERE policy_end_date >= DATE_SUB(CURDATE(), INTERVAL 90 DAY);

-- Final statistics
SELECT 'Seed Data Generation Complete' as Status,
       (SELECT COUNT(*) FROM customers) as Total_Customers,
       (SELECT COUNT(*) FROM policies) as Total_Policies,
       (SELECT COUNT(*) FROM users WHERE role = 'agent') as Total_Agents,
       (SELECT COUNT(*) FROM insurance_companies) as Total_Companies;

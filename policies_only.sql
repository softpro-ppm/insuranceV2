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
INSERT INTO policies (id, policy_number, customer_id, insurance_company_id, policy_type_id, category, policy_start_date, policy_end_date, premium_amount, sum_insured, commission_percentage, commission_amount, agent_id, status, vehicle_number, vehicle_type, created_at, updated_at) VALUES
(18, 'POL018/2025-R', 18, 1, 1, 'motor', '2025-08-02', '2026-08-01', 27000.00, 550000.00, 10.00, 2700.00, 2, 'active', 'WB19IJ3456', 'car', '2025-08-02 10:00:00', NOW()),
(19, 'POL019/2025-R', 19, 3, 1, 'motor', '2025-08-12', '2026-08-11', 23000.00, 420000.00, 10.00, 2300.00, 3, 'active', 'TS07KL7890', 'car', '2025-08-12 11:00:00', NOW()),
(20, 'POL020/2025-R', 20, 2, 1, 'motor', '2025-08-25', '2026-08-24', 19500.00, 340000.00, 10.00, 1950.00, 2, 'active', 'RJ09MN1234', 'car', '2025-08-25 12:00:00', NOW());

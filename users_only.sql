-- Insert Users Only
INSERT INTO users (id, username, email, password, name, role, phone, status, created_at, updated_at) VALUES
(1, 'admin', 'admin@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin User', 'admin', '9876543210', 'active', NOW(), NOW()),
(2, 'agent1', 'agent1@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Rajesh Kumar', 'agent', '9876543211', 'active', NOW(), NOW()),
(3, 'agent2', 'agent2@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Priya Sharma', 'agent', '9876543212', 'active', NOW(), NOW()),
(4, 'reception', 'reception@insurance.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Reception Desk', 'receptionist', '9876543213', 'active', NOW(), NOW());

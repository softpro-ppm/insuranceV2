<?php
// This file is for direct access - redirect to router
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}

// Redirect to dashboard route which handles the proper display
header('Location: /dashboard');
exit();
?>

<!-- Page Header -->
<div class="page-header">
    <h1 class="page-title">Dashboard1</h1>
    <p class="page-subtitle">Welcome back! Here's what's happening with your insurance business today.</p>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="fas fa-file-contract"></i>
            </div>
            <div class="stat-number"><?= number_format($total_policies) ?></div>
            <div class="stat-label">Total Policies</div>
            <div class="d-flex align-items-center mt-2">
                <i class="fas fa-arrow-up text-success me-1"></i>
                <small class="text-success">+12% from last month</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number"><?= number_format($active_policies) ?></div>
            <div class="stat-label">Active Policies</div>
            <div class="d-flex align-items-center mt-2">
                <i class="fas fa-arrow-up text-success me-1"></i>
                <small class="text-success">+8% from last month</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-sync-alt"></i>
            </div>
            <div class="stat-number"><?= number_format($pending_renewals) ?></div>
            <div class="stat-label">Pending Renewals</div>
            <div class="d-flex align-items-center mt-2">
                <i class="fas fa-clock text-warning me-1"></i>
                <small class="text-warning">Requires attention</small>
            </div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card danger">
            <div class="stat-icon danger">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="stat-number"><?= number_format($expired_policies) ?></div>
            <div class="stat-label">Expired Policies</div>
            <div class="d-flex align-items-center mt-2">
                <i class="fas fa-arrow-down text-danger me-1"></i>
                <small class="text-danger">Needs renewal</small>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Row -->
<div class="row g-4">
    <!-- Recent Policies -->
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-file-contract text-primary me-2"></i>
                    Recent Policies
                </h5>
                <a href="/policies" class="btn btn-sm btn-outline-primary">
                    View All <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="card-body">
                <?php if (!empty($recent_policies)): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Policy No</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Premium</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_policies as $policy): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold text-primary"><?= htmlspecialchars($policy['policy_number'] ?? 'N/A') ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                                <?= strtoupper(substr($policy['customer_name'] ?? 'N', 0, 1)) ?>
                                            </div>
                                            <span><?= htmlspecialchars($policy['customer_name'] ?? 'Unknown') ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="fas fa-<?= $policy['policy_type'] === 'motor' ? 'car' : ($policy['policy_type'] === 'health' ? 'heartbeat' : 'shield-alt') ?> me-1"></i>
                                            <?= ucfirst($policy['policy_type'] ?? 'General') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">₹<?= number_format($policy['premium_amount'] ?? 0) ?></span>
                                    </td>
                                    <td>
                                        <?php
                                        $status = $policy['status'] ?? 'pending';
                                        $badge_class = $status === 'active' ? 'success' : ($status === 'pending' ? 'warning' : 'danger');
                                        ?>
                                        <span class="badge bg-<?= $badge_class ?>">
                                            <?= ucfirst($status) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?= date('M d, Y', strtotime($policy['created_at'] ?? date('Y-m-d'))) ?>
                                        </small>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">No policies found</h6>
                        <p class="text-muted mb-3">Start by creating your first policy</p>
                        <a href="/add" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Create Policy
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Quick Actions & Summary -->
    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-bolt text-warning me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="/add" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>New Policy
                    </a>
                    <a href="/add-user" class="btn btn-info">
                        <i class="fas fa-user-plus me-2"></i>Add Customer
                    </a>
                    <a href="/manage-renewal" class="btn btn-warning">
                        <i class="fas fa-sync-alt me-2"></i>Process Renewals
                    </a>
                    <a href="/excel" class="btn btn-success">
                        <i class="fas fa-download me-2"></i>Export Data
                    </a>
                </div>
            </div>
        </div>

        <!-- Summary Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-chart-pie text-info me-2"></i>
                    Business Summary
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-primary"><?= number_format($total_customers) ?></div>
                            <small class="text-muted">Total Customers</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-success">₹<?= number_format(($total_policies * 25000)) ?></div>
                            <small class="text-muted">Total Premium</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-info"><?= number_format((($active_policies / ($total_policies ?: 1)) * 100), 1) ?>%</div>
                            <small class="text-muted">Active Rate</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-center">
                            <div class="h4 mb-1 text-warning"><?= date('j') ?></div>
                            <small class="text-muted">Days This Month</small>
                        </div>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">Policy Distribution</small>
                    <small class="text-muted">This Month</small>
                </div>
                
                <div class="progress mt-2" style="height: 8px;">
                    <div class="progress-bar bg-primary" style="width: 40%"></div>
                    <div class="progress-bar bg-success" style="width: 35%"></div>
                    <div class="progress-bar bg-warning" style="width: 25%"></div>
                </div>
                
                <div class="d-flex justify-content-between mt-2">
                    <small><span class="badge bg-primary">Motor</span></small>
                    <small><span class="badge bg-success">Health</span></small>
                    <small><span class="badge bg-warning">Life</span></small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity Section -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-clock text-primary me-2"></i>
                    Recent Activity
                </h5>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="d-flex align-items-start mb-3">
                        <div class="flex-shrink-0">
                            <div class="badge bg-success rounded-pill p-2">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">New Motor Policy Created</h6>
                            <p class="text-muted mb-1">Policy POL-<?= date('Ymd') ?>-001 created for customer John Doe</p>
                            <small class="text-muted"><?= date('M d, Y H:i') ?></small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start mb-3">
                        <div class="flex-shrink-0">
                            <div class="badge bg-info rounded-pill p-2">
                                <i class="fas fa-sync-alt"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Policy Renewal Processed</h6>
                            <p class="text-muted mb-1">Health policy POL-2023-045 renewed for 1 year</p>
                            <small class="text-muted"><?= date('M d, Y H:i', strtotime('-2 hours')) ?></small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <div class="badge bg-warning rounded-pill p-2">
                                <i class="fas fa-user"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">New Customer Registered</h6>
                            <p class="text-muted mb-1">Jane Smith added to customer database</p>
                            <small class="text-muted"><?= date('M d, Y H:i', strtotime('-5 hours')) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

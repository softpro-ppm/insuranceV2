<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Dashboard</h2>
            <div>
                <span class="text-muted">Welcome back, <?= $_SESSION['user_name'] ?? 'Admin' ?>!</span>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Total Policies</h5>
                        <h2 class="text-white mb-0"><?= number_format($stats['total_policies']) ?></h2>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-file-contract fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Total Customers</h5>
                        <h2 class="text-white mb-0"><?= number_format($stats['total_customers']) ?></h2>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Expiring Soon</h5>
                        <h2 class="text-white mb-0"><?= number_format($stats['expiring_soon']) ?></h2>
                        <small class="text-white-50">Next 30 days</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3 mb-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Total Premium</h5>
                        <h2 class="text-white mb-0">₹<?= number_format($stats['total_premium'], 2) ?></h2>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-rupee-sign fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="fas fa-bolt text-primary me-2"></i>
                    Quick Actions
                </h5>
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <a href="/policies/create" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-2"></i>Add New Policy
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/customers" class="btn btn-success w-100">
                            <i class="fas fa-user-plus me-2"></i>Add Customer
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/renewals" class="btn btn-warning w-100">
                            <i class="fas fa-sync-alt me-2"></i>View Renewals
                        </a>
                    </div>
                    <div class="col-md-3 mb-2">
                        <a href="/reports" class="btn btn-info w-100">
                            <i class="fas fa-chart-bar me-2"></i>Generate Report
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Policies and Charts -->
<div class="row">
    <!-- Recent Policies -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-clock text-primary me-2"></i>
                        Recent Policies
                    </h5>
                    <a href="/policies" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($recent_policies)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No policies found</h5>
                        <p class="text-muted">Start by adding your first policy!</p>
                        <a href="/policies/create" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First Policy
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Policy No.</th>
                                    <th>Customer</th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Premium</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_policies as $policy): ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary"><?= htmlspecialchars($policy['policy_number']) ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="fw-semibold"><?= htmlspecialchars($policy['customer_name'] ?? 'N/A') ?></span>
                                            </div>
                                        </td>
                                        <td><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></td>
                                        <td>
                                            <span class="badge bg-<?= $policy['category'] === 'motor' ? 'primary' : ($policy['category'] === 'health' ? 'success' : 'info') ?>">
                                                <?= ucfirst($policy['category']) ?>
                                            </span>
                                        </td>
                                        <td>₹<?= number_format($policy['premium_amount'], 2) ?></td>
                                        <td>
                                            <?php 
                                                $end_date = new DateTime($policy['policy_end_date']);
                                                $today = new DateTime();
                                                $days_diff = $today->diff($end_date)->days;
                                                $is_expiring = $end_date <= (new DateTime())->add(new DateInterval('P30D'));
                                            ?>
                                            <span class="<?= $is_expiring ? 'text-warning fw-bold' : '' ?>">
                                                <?= $end_date->format('d M Y') ?>
                                            </span>
                                            <?php if ($is_expiring): ?>
                                                <br><small class="text-warning">
                                                    <i class="fas fa-exclamation-triangle"></i> Expiring soon
                                                </small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $policy['status'] === 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($policy['status']) ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Policy Categories Distribution -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-pie-chart text-primary me-2"></i>
                    Policy Distribution
                </h5>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="mb-3">
                            <i class="fas fa-car fa-2x text-primary mb-2"></i>
                            <h4 class="mb-1 text-primary">0</h4>
                            <small class="text-muted">Motor</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <i class="fas fa-heart fa-2x text-success mb-2"></i>
                            <h4 class="mb-1 text-success">0</h4>
                            <small class="text-muted">Health</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="mb-3">
                            <i class="fas fa-life-ring fa-2x text-info mb-2"></i>
                            <h4 class="mb-1 text-info">0</h4>
                            <small class="text-muted">Life</small>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="text-center">
                    <h6 class="text-muted mb-3">Quick Stats</h6>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted d-block">This Month</small>
                            <strong class="text-primary">0 Policies</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Revenue</small>
                            <strong class="text-success">₹0</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upcoming Renewals -->
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">
                    <i class="fas fa-bell text-warning me-2"></i>
                    Renewal Alerts
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center py-3">
                    <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                    <h6 class="text-muted">No pending renewals</h6>
                    <small class="text-muted">All policies are up to date!</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Additional JavaScript for dashboard interactivity -->
<?php 
$additional_js = '
<script>
// Dashboard specific JavaScript
document.addEventListener("DOMContentLoaded", function() {
    // Animate counters
    const counters = document.querySelectorAll(".stats-card h2");
    counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/,/g, ""));
        let current = 0;
        const increment = target / 20;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                counter.textContent = target.toLocaleString();
                clearInterval(timer);
            } else {
                counter.textContent = Math.floor(current).toLocaleString();
            }
        }, 50);
    });
});
</script>
';
?>

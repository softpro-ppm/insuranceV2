<?php
// This file is for direct access - redirect to router
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit();
}

// Redirect to policies route which handles the proper display
header('Location: /policies');
exit();
?>

<!-- Page Header -->
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="page-title">Policies Management</h1>
            <p class="page-subtitle">Manage all insurance policies, track renewals, and monitor policy status.</p>
        </div>
        <div>
            <a href="/add" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>New Policy
            </a>
        </div>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card primary">
            <div class="stat-icon primary">
                <i class="fas fa-file-contract"></i>
            </div>
            <div class="stat-number"><?= number_format($summary['total']) ?></div>
            <div class="stat-label">Total Policies</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card success">
            <div class="stat-icon success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number"><?= number_format($summary['active']) ?></div>
            <div class="stat-label">Active Policies</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card warning">
            <div class="stat-icon warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number"><?= number_format($summary['pending']) ?></div>
            <div class="stat-label">Pending Policies</div>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6">
        <div class="stat-card danger">
            <div class="stat-icon danger">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="stat-number"><?= number_format($summary['expired']) ?></div>
            <div class="stat-label">Expired Policies</div>
        </div>
    </div>
</div>

<!-- Filters and Search -->
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-4">
                <label for="search" class="form-label">Search</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="<?= htmlspecialchars($search) ?>" 
                           placeholder="Search by policy number, customer name, or email">
                </div>
            </div>
            
            <div class="col-md-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="">All Status</option>
                    <option value="active" <?= $status_filter === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="expired" <?= $status_filter === 'expired' ? 'selected' : '' ?>>Expired</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="type" class="form-label">Policy Type</label>
                <select class="form-select" id="type" name="type">
                    <option value="">All Types</option>
                    <option value="motor" <?= $type_filter === 'motor' ? 'selected' : '' ?>>Motor</option>
                    <option value="health" <?= $type_filter === 'health' ? 'selected' : '' ?>>Health</option>
                    <option value="life" <?= $type_filter === 'life' ? 'selected' : '' ?>>Life</option>
                </select>
            </div>
            
            <div class="col-md-2">
                <label class="form-label">&nbsp;</label>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-fill">
                        <i class="fas fa-filter"></i>
                    </button>
                    <a href="/policies" class="btn btn-outline-secondary">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Policies Table -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
            <i class="fas fa-list text-primary me-2"></i>
            All Policies (<?= count($policies) ?>)
        </h5>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-download me-1"></i>Export
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/excel?type=policies"><i class="fas fa-file-excel me-2"></i>Excel</a></li>
                <li><a class="dropdown-item" href="/pdf?type=policies"><i class="fas fa-file-pdf me-2"></i>PDF</a></li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <?php if (!empty($policies)): ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Policy No</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Premium</th>
                            <th>Start Date</th>
                            <th>Expiry Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($policies as $policy): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-file-contract text-primary me-2"></i>
                                    <div>
                                        <span class="fw-bold"><?= htmlspecialchars($policy['policy_number'] ?? 'N/A') ?></span>
                                        <br><small class="text-muted">ID: <?= $policy['id'] ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="user-avatar me-2" style="width: 32px; height: 32px; font-size: 0.8rem;">
                                        <?= strtoupper(substr($policy['customer_name'] ?? 'N', 0, 1)) ?>
                                    </div>
                                    <div>
                                        <span class="fw-bold"><?= htmlspecialchars($policy['customer_name'] ?? 'Unknown') ?></span>
                                        <br><small class="text-muted"><?= htmlspecialchars($policy['customer_email'] ?? '') ?></small>
                                    </div>
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
                                <br><small class="text-muted">Annual</small>
                            </td>
                            <td>
                                <span><?= date('M d, Y', strtotime($policy['start_date'] ?? date('Y-m-d'))) ?></span>
                                <br><small class="text-muted"><?= date('g:i A', strtotime($policy['created_at'] ?? date('Y-m-d H:i:s'))) ?></small>
                            </td>
                            <td>
                                <?php 
                                $expiry_date = $policy['expiry_date'] ?? date('Y-m-d', strtotime('+1 year'));
                                $days_to_expiry = ceil((strtotime($expiry_date) - time()) / (60 * 60 * 24));
                                ?>
                                <span><?= date('M d, Y', strtotime($expiry_date)) ?></span>
                                <br>
                                <?php if ($days_to_expiry > 30): ?>
                                    <small class="text-success"><?= $days_to_expiry ?> days left</small>
                                <?php elseif ($days_to_expiry > 0): ?>
                                    <small class="text-warning"><?= $days_to_expiry ?> days left</small>
                                <?php else: ?>
                                    <small class="text-danger">Expired</small>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $status = $policy['status'] ?? 'pending';
                                $badge_class = $status === 'active' ? 'success' : ($status === 'pending' ? 'warning' : 'danger');
                                $icon = $status === 'active' ? 'check-circle' : ($status === 'pending' ? 'clock' : 'times-circle');
                                ?>
                                <span class="badge bg-<?= $badge_class ?>">
                                    <i class="fas fa-<?= $icon ?> me-1"></i>
                                    <?= ucfirst($status) ?>
                                </span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/view-policy?id=<?= $policy['id'] ?>">
                                            <i class="fas fa-eye me-2"></i>View Details
                                        </a></li>
                                        <li><a class="dropdown-item" href="/edit?id=<?= $policy['id'] ?>">
                                            <i class="fas fa-edit me-2"></i>Edit Policy
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="/renew?id=<?= $policy['id'] ?>">
                                            <i class="fas fa-sync-alt me-2"></i>Renew Policy
                                        </a></li>
                                        <li><a class="dropdown-item" href="/print-policy?id=<?= $policy['id'] ?>">
                                            <i class="fas fa-print me-2"></i>Print Policy
                                        </a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deletePolicy(<?= $policy['id'] ?>)">
                                            <i class="fas fa-trash me-2"></i>Delete Policy
                                        </a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-file-contract fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">No policies found</h5>
                <?php if (!empty($search) || !empty($status_filter) || !empty($type_filter)): ?>
                    <p class="text-muted mb-3">Try adjusting your filters or search terms</p>
                    <a href="/policies" class="btn btn-outline-primary me-2">Clear Filters</a>
                <?php else: ?>
                    <p class="text-muted mb-3">Start by creating your first insurance policy</p>
                <?php endif; ?>
                <a href="/add" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Create New Policy
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function deletePolicy(policyId) {
    if (confirm('Are you sure you want to delete this policy? This action cannot be undone.')) {
        fetch('/include/delete-policy.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'id=' + policyId
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error deleting policy: ' + data.message);
            }
        })
        .catch(error => {
            alert('Error deleting policy');
        });
    }
}

// Auto-submit form on filter change
document.getElementById('status').addEventListener('change', function() {
    this.form.submit();
});

document.getElementById('type').addEventListener('change', function() {
    this.form.submit();
});
</script>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">All Policies</h2>
            <div>
                <a href="/policies/create" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Policy
                </a>
                <button class="btn btn-success" onclick="exportPolicies()">
                    <i class="fas fa-download me-2"></i>Export
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="fas fa-filter text-primary me-2"></i>Filters
                </h6>
                <form id="filterForm" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" name="category" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="motor">Motor Insurance</option>
                            <option value="health">Health Insurance</option>
                            <option value="life">Life Insurance</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" id="statusFilter">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">From Date</label>
                        <input type="date" class="form-control" name="from_date" id="fromDate">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">To Date</label>
                        <input type="date" class="form-control" name="to_date" id="toDate">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="applyFilters()">
                            <i class="fas fa-search me-2"></i>Apply Filters
                        </button>
                        <button type="button" class="btn btn-secondary" onclick="clearFilters()">
                            <i class="fas fa-times me-2"></i>Clear
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Policies Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (empty($policies)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-file-contract fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">No policies found</h4>
                        <p class="text-muted mb-4">Start by creating your first insurance policy!</p>
                        <a href="/policies/create" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Add First Policy
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="policiesTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Policy No.</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Type</th>
                                    <th>Premium</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($policies as $policy): ?>
                                    <tr>
                                        <td>
                                            <span class="fw-bold text-primary"><?= htmlspecialchars($policy['policy_number']) ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-semibold"><?= htmlspecialchars($policy['customer_name'] ?? 'N/A') ?></div>
                                                <small class="text-muted"><?= htmlspecialchars($policy['customer_phone'] ?? '') ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $policy['category'] === 'motor' ? 'primary' : ($policy['category'] === 'health' ? 'success' : 'info') ?>">
                                                <?php if ($policy['category'] === 'motor'): ?>
                                                    <i class="fas fa-car me-1"></i>Motor
                                                <?php elseif ($policy['category'] === 'health'): ?>
                                                    <i class="fas fa-heart me-1"></i>Health
                                                <?php else: ?>
                                                    <i class="fas fa-life-ring me-1"></i>Life
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></td>
                                        <td><?= htmlspecialchars($policy['policy_type_name'] ?? 'N/A') ?></td>
                                        <td>
                                            <span class="fw-bold">₹<?= number_format($policy['premium_amount'], 2) ?></span>
                                        </td>
                                        <td><?= date('d M Y', strtotime($policy['policy_start_date'])) ?></td>
                                        <td>
                                            <?php 
                                                $end_date = new DateTime($policy['policy_end_date']);
                                                $today = new DateTime();
                                                $days_diff = $today->diff($end_date)->days;
                                                $is_expiring = $end_date <= (new DateTime())->add(new DateInterval('P30D'));
                                            ?>
                                            <div>
                                                <span class="<?= $is_expiring ? 'text-warning fw-bold' : '' ?>">
                                                    <?= $end_date->format('d M Y') ?>
                                                </span>
                                                <?php if ($is_expiring && $policy['status'] === 'active'): ?>
                                                    <br><small class="text-warning">
                                                        <i class="fas fa-exclamation-triangle"></i> Expiring soon
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $policy['status'] === 'active' ? 'success' : ($policy['status'] === 'expired' ? 'warning' : 'danger') ?>">
                                                <?= ucfirst($policy['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        onclick="viewPolicy(<?= $policy['id'] ?>)"
                                                        title="View Policy">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-success" 
                                                        onclick="editPolicy(<?= $policy['id'] ?>)"
                                                        title="Edit Policy">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <?php if ($policy['status'] === 'active'): ?>
                                                    <button type="button" class="btn btn-sm btn-outline-warning" 
                                                            onclick="renewPolicy(<?= $policy['id'] ?>)"
                                                            title="Renew Policy">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                <?php endif; ?>
                                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                                        onclick="deletePolicy(<?= $policy['id'] ?>)"
                                                        title="Delete Policy">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination (if needed) -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing <?= count($policies) ?> policies
                        </div>
                        <nav>
                            <!-- Pagination links would go here -->
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Policy View Modal -->
<div class="modal fade" id="policyViewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Policy Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="policyViewContent">
                <!-- Policy details will be loaded here -->
            </div>
        </div>
    </div>
</div>

<script>
// Initialize DataTable if we have data
<?php if (!empty($policies)): ?>
document.addEventListener('DOMContentLoaded', function() {
    // Simple table enhancements
    const table = document.getElementById('policiesTable');
    if (table) {
        // Add search functionality
        const searchInput = document.createElement('input');
        searchInput.type = 'text';
        searchInput.className = 'form-control mb-3';
        searchInput.placeholder = 'Search policies...';
        searchInput.addEventListener('input', function() {
            filterTable(this.value);
        });
        
        table.parentNode.insertBefore(searchInput, table);
    }
});

function filterTable(searchTerm) {
    const table = document.getElementById('policiesTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    for (let i = 0; i < rows.length; i++) {
        const row = rows[i];
        const text = row.textContent.toLowerCase();
        
        if (text.includes(searchTerm.toLowerCase())) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
}
<?php endif; ?>

function viewPolicy(policyId) {
    // Load policy details via AJAX
    const modal = new bootstrap.Modal(document.getElementById('policyViewModal'));
    const content = document.getElementById('policyViewContent');
    
    content.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Loading...</div>';
    modal.show();
    
    // Simulate AJAX call for now
    setTimeout(() => {
        content.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Policy Information</h6>
                    <p><strong>Policy No:</strong> POLICY-${policyId}</p>
                    <p><strong>Category:</strong> Motor Insurance</p>
                    <p><strong>Company:</strong> ICICI Lombard</p>
                </div>
                <div class="col-md-6">
                    <h6>Customer Information</h6>
                    <p><strong>Name:</strong> John Doe</p>
                    <p><strong>Phone:</strong> +91 9876543210</p>
                    <p><strong>Email:</strong> john@example.com</p>
                </div>
            </div>
        `;
    }, 500);
}

function editPolicy(policyId) {
    window.location.href = `/policies/edit/${policyId}`;
}

function renewPolicy(policyId) {
    if (confirm('Are you sure you want to renew this policy?')) {
        // Handle policy renewal
        alert('Policy renewal functionality will be implemented');
    }
}

function deletePolicy(policyId) {
    if (confirm('Are you sure you want to delete this policy? This action cannot be undone.')) {
        // Handle policy deletion
        alert('Policy deletion functionality will be implemented');
    }
}

function applyFilters() {
    // Implement filter functionality
    const form = document.getElementById('filterForm');
    const formData = new FormData(form);
    
    // For now, just reload with query parameters
    const params = new URLSearchParams();
    for (let [key, value] of formData.entries()) {
        if (value) params.append(key, value);
    }
    
    window.location.href = '/policies?' + params.toString();
}

function clearFilters() {
    document.getElementById('filterForm').reset();
    window.location.href = '/policies';
}

function exportPolicies() {
    // Implement export functionality
    alert('Export functionality will be implemented');
}

// Auto-refresh every 5 minutes to update expiry status
setInterval(function() {
    // Only refresh if user is still active
    if (document.hasFocus()) {
        window.location.reload();
    }
}, 300000); // 5 minutes
</script>

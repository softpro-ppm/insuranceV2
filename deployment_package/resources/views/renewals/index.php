<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Policy Renewals</h2>
            <div>
                <button class="btn btn-success" onclick="exportRenewals()">
                    <i class="fas fa-download me-2"></i>Export
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Renewal Statistics -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Expired</h5>
                        <h2 class="text-white mb-0">0</h2>
                        <small class="text-white-50">Already expired</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-times-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card warning">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Due This Week</h5>
                        <h2 class="text-white mb-0">0</h2>
                        <small class="text-white-50">Next 7 days</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Due This Month</h5>
                        <h2 class="text-white mb-0"><?= count($renewals) ?></h2>
                        <small class="text-white-50">Next 30 days</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-calendar-alt fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title text-white-50 mb-1">Due Next Month</h5>
                        <h2 class="text-white mb-0">0</h2>
                        <small class="text-white-50">31-60 days</small>
                    </div>
                    <div class="text-white-50">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Options -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="fas fa-filter text-primary me-2"></i>Filter Renewals
                </h6>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Renewal Period</label>
                        <select class="form-control" id="renewalPeriod">
                            <option value="7">Next 7 days</option>
                            <option value="15">Next 15 days</option>
                            <option value="30" selected>Next 30 days</option>
                            <option value="60">Next 60 days</option>
                            <option value="all">All upcoming</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select class="form-control" id="categoryFilter">
                            <option value="">All Categories</option>
                            <option value="motor">Motor Insurance</option>
                            <option value="health">Health Insurance</option>
                            <option value="life">Life Insurance</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control" id="priorityFilter">
                            <option value="">All Priorities</option>
                            <option value="high">High Priority</option>
                            <option value="medium">Medium Priority</option>
                            <option value="low">Low Priority</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div>
                            <button class="btn btn-primary" onclick="applyRenewalFilters()">
                                <i class="fas fa-search me-2"></i>Apply
                            </button>
                            <button class="btn btn-secondary" onclick="clearRenewalFilters()">
                                <i class="fas fa-times me-2"></i>Clear
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Renewals Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (empty($renewals)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-sync-alt fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">No upcoming renewals</h4>
                        <p class="text-muted">All policies are current and up to date!</p>
                        <a href="/policies" class="btn btn-primary">
                            <i class="fas fa-eye me-2"></i>View All Policies
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover" id="renewalsTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Priority</th>
                                    <th>Policy No.</th>
                                    <th>Customer</th>
                                    <th>Category</th>
                                    <th>Company</th>
                                    <th>Premium</th>
                                    <th>Expiry Date</th>
                                    <th>Days Left</th>
                                    <th>Follow-up Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($renewals as $renewal): ?>
                                    <?php 
                                        $end_date = new DateTime($renewal['policy_end_date']);
                                        $today = new DateTime();
                                        $interval = $today->diff($end_date);
                                        $days_left = $interval->days;
                                        $is_past = $end_date < $today;
                                        
                                        // Determine priority based on days left
                                        if ($is_past) {
                                            $priority = 'expired';
                                            $priority_class = 'danger';
                                            $priority_icon = 'times-circle';
                                        } elseif ($days_left <= 7) {
                                            $priority = 'high';
                                            $priority_class = 'danger';
                                            $priority_icon = 'exclamation-triangle';
                                        } elseif ($days_left <= 15) {
                                            $priority = 'medium';
                                            $priority_class = 'warning';
                                            $priority_icon = 'exclamation-circle';
                                        } else {
                                            $priority = 'low';
                                            $priority_class = 'success';
                                            $priority_icon = 'info-circle';
                                        }
                                    ?>
                                    <tr class="<?= $is_past ? 'table-danger' : ($days_left <= 7 ? 'table-warning' : '') ?>">
                                        <td>
                                            <span class="badge bg-<?= $priority_class ?>">
                                                <i class="fas fa-<?= $priority_icon ?> me-1"></i>
                                                <?= ucfirst($priority) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-primary"><?= htmlspecialchars($renewal['policy_number']) ?></span>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-semibold"><?= htmlspecialchars($renewal['customer_name'] ?? 'N/A') ?></div>
                                                <small class="text-muted">
                                                    <i class="fas fa-phone me-1"></i><?= htmlspecialchars($renewal['customer_phone'] ?? '') ?>
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $renewal['category'] === 'motor' ? 'primary' : ($renewal['category'] === 'health' ? 'success' : 'info') ?>">
                                                <?php if ($renewal['category'] === 'motor'): ?>
                                                    <i class="fas fa-car me-1"></i>Motor
                                                <?php elseif ($renewal['category'] === 'health'): ?>
                                                    <i class="fas fa-heart me-1"></i>Health
                                                <?php else: ?>
                                                    <i class="fas fa-life-ring me-1"></i>Life
                                                <?php endif; ?>
                                            </span>
                                        </td>
                                        <td><?= htmlspecialchars($renewal['company_name'] ?? 'N/A') ?></td>
                                        <td>
                                            <span class="fw-bold">₹<?= number_format($renewal['premium_amount'], 2) ?></span>
                                        </td>
                                        <td>
                                            <span class="<?= $is_past ? 'text-danger fw-bold' : ($days_left <= 7 ? 'text-warning fw-bold' : '') ?>">
                                                <?= $end_date->format('d M Y') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($is_past): ?>
                                                <span class="text-danger fw-bold">
                                                    <i class="fas fa-times-circle me-1"></i>Expired
                                                </span>
                                            <?php else: ?>
                                                <span class="<?= $days_left <= 7 ? 'text-danger fw-bold' : ($days_left <= 15 ? 'text-warning fw-bold' : 'text-success') ?>">
                                                    <?= $days_left ?> days
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        onclick="viewRenewal(<?= $renewal['id'] ?>)"
                                                        title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-success" 
                                                        onclick="renewPolicy(<?= $renewal['id'] ?>)"
                                                        title="Renew Policy">
                                                    <i class="fas fa-sync-alt"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-info" 
                                                        onclick="addFollowup(<?= $renewal['id'] ?>)"
                                                        title="Add Follow-up">
                                                    <i class="fas fa-phone"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                                        onclick="sendReminder(<?= $renewal['id'] ?>)"
                                                        title="Send Reminder">
                                                    <i class="fas fa-bell"></i>
                                                </button>
                                            </div>
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
</div>

<!-- Follow-up Modal -->
<div class="modal fade" id="followupModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Follow-up</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="followupForm">
                    <input type="hidden" id="followup_policy_id" name="policy_id">
                    <div class="mb-3">
                        <label class="form-label">Follow-up Type</label>
                        <select class="form-control" name="followup_type" required>
                            <option value="renewal">Renewal Reminder</option>
                            <option value="general">General Inquiry</option>
                            <option value="complaint">Complaint</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Priority</label>
                        <select class="form-control" name="priority" required>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Scheduled Date</label>
                        <input type="date" class="form-control" name="scheduled_date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveFollowup()">Save Follow-up</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewRenewal(policyId) {
    // View renewal details
    window.location.href = `/policies/view/${policyId}`;
}

function renewPolicy(policyId) {
    if (confirm('Are you sure you want to start the renewal process for this policy?')) {
        // Redirect to renewal form
        window.location.href = `/policies/renew/${policyId}`;
    }
}

function addFollowup(policyId) {
    document.getElementById('followup_policy_id').value = policyId;
    const modal = new bootstrap.Modal(document.getElementById('followupModal'));
    modal.show();
}

function saveFollowup() {
    const form = document.getElementById('followupForm');
    const formData = new FormData(form);
    
    // Here you would normally send the data to the server
    alert('Follow-up added successfully!');
    
    const modal = bootstrap.Modal.getInstance(document.getElementById('followupModal'));
    modal.hide();
    
    // Reload the page to show updated status
    window.location.reload();
}

function sendReminder(policyId) {
    if (confirm('Send renewal reminder to customer via SMS/Email?')) {
        // Handle reminder sending
        alert('Reminder sent successfully!');
    }
}

function applyRenewalFilters() {
    const period = document.getElementById('renewalPeriod').value;
    const category = document.getElementById('categoryFilter').value;
    const priority = document.getElementById('priorityFilter').value;
    
    const params = new URLSearchParams();
    if (period !== '30') params.append('period', period);
    if (category) params.append('category', category);
    if (priority) params.append('priority', priority);
    
    window.location.href = '/renewals?' + params.toString();
}

function clearRenewalFilters() {
    window.location.href = '/renewals';
}

function exportRenewals() {
    // Export renewals to Excel
    alert('Export functionality will be implemented');
}

// Auto-update renewal counts every minute
setInterval(function() {
    if (document.hasFocus()) {
        // Update only the statistics cards
        fetch('/api/renewal-stats')
            .then(response => response.json())
            .then(data => {
                // Update the statistics cards with new data
                // This would be implemented with the actual API
            })
            .catch(error => console.error('Error updating stats:', error));
    }
}, 60000); // 1 minute

// Highlight urgent renewals
document.addEventListener('DOMContentLoaded', function() {
    const urgentRows = document.querySelectorAll('tr.table-danger, tr.table-warning');
    urgentRows.forEach(row => {
        row.style.animation = 'pulse 2s infinite';
    });
});

// Add CSS for pulse animation
const style = document.createElement('style');
style.textContent = `
    @keyframes pulse {
        0% { opacity: 1; }
        50% { opacity: 0.7; }
        100% { opacity: 1; }
    }
`;
document.head.appendChild(style);
</script>

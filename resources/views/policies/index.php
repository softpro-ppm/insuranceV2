<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">All Policies</h2>
            <div>
                <a href="/policies/create" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New Policy
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Policies List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                // Include DataTable class
                require_once __DIR__ . '/../../../includes/DataTable.php';
                
                // Prepare data for DataTable
                $columns = [
                    [
                        'key' => 'policy_number',
                        'label' => 'Policy Details',
                        'sortable' => true,
                        'render' => function($policy) {
                            $statusClass = '';
                            $statusText = ucfirst($policy['status']);
                            switch($policy['status']) {
                                case 'active':
                                    $statusClass = 'bg-success';
                                    break;
                                case 'expired':
                                    $statusClass = 'bg-warning';
                                    break;
                                case 'cancelled':
                                    $statusClass = 'bg-danger';
                                    break;
                                default:
                                    $statusClass = 'bg-secondary';
                            }
                            
                            $categoryIcon = '';
                            switch($policy['category']) {
                                case 'motor':
                                    $categoryIcon = 'fas fa-car';
                                    break;
                                case 'health':
                                    $categoryIcon = 'fas fa-heartbeat';
                                    break;
                                case 'life':
                                    $categoryIcon = 'fas fa-user-shield';
                                    break;
                                default:
                                    $categoryIcon = 'fas fa-file-contract';
                            }
                            
                            return '<div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            <i class="' . $categoryIcon . ' text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">' . htmlspecialchars($policy['policy_number']) . '</h6>
                                            <small class="text-muted">' . ucfirst($policy['category']) . ' Insurance</small>
                                            <span class="badge ' . $statusClass . ' ms-2">' . $statusText . '</span>
                                        </div>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'customer_name',
                        'label' => 'Customer',
                        'sortable' => true,
                        'render' => function($policy) {
                            return '<div>
                                        <div class="fw-medium">' . htmlspecialchars($policy['customer_name'] ?? 'Unknown') . '</div>
                                        <small class="text-muted">' . htmlspecialchars($policy['customer_phone'] ?? 'No phone') . '</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'company_name',
                        'label' => 'Insurance Company',
                        'sortable' => false,
                        'render' => function($policy) {
                            return '<div>
                                        <div class="fw-medium">' . htmlspecialchars($policy['company_name'] ?? 'Unknown') . '</div>
                                        <small class="text-muted">' . htmlspecialchars($policy['policy_type_name'] ?? '') . '</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'premium_amount',
                        'label' => 'Premium & Coverage',
                        'sortable' => true,
                        'render' => function($policy) {
                            return '<div class="text-center">
                                        <div class="fw-bold text-primary">₹' . number_format($policy['premium_amount'], 2) . '</div>
                                        <small class="text-muted">Premium</small>
                                        <div class="fw-bold text-success mt-1">₹' . number_format($policy['sum_insured'] ?? 0, 2) . '</div>
                                        <small class="text-muted">Coverage</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'policy_start_date',
                        'label' => 'Policy Period',
                        'sortable' => true,
                        'render' => function($policy) {
                            return '<div class="text-center">
                                        <div class="fw-medium">' . date('M d, Y', strtotime($policy['policy_start_date'])) . '</div>
                                        <small class="text-muted">to</small>
                                        <div class="fw-medium">' . date('M d, Y', strtotime($policy['policy_end_date'])) . '</div>
                                        <small class="text-muted">' . htmlspecialchars($policy['agent_name'] ?? 'No agent') . '</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'actions',
                        'label' => 'Actions',
                        'sortable' => false,
                        'render' => function($policy) {
                            return '<div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/policies/' . $policy['id'] . '/view">
                                                    <i class="fas fa-eye me-2"></i>View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="/policies/' . $policy['id'] . '/edit">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="/policies/' . $policy['id'] . '/print">
                                                    <i class="fas fa-print me-2"></i>Print
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form method="POST" action="/policies/' . $policy['id'] . '/delete" 
                                                      onsubmit="return confirm(\'Are you sure you want to delete this policy?\')" 
                                                      class="d-inline">
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="fas fa-trash me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>';
                        }
                    ]
                ];

                $filters = [
                    [
                        'type' => 'select',
                        'name' => 'category',
                        'label' => 'Category',
                        'options' => [
                            '' => 'All Categories',
                            'motor' => 'Motor Insurance',
                            'health' => 'Health Insurance',
                            'life' => 'Life Insurance'
                        ],
                        'value' => $category
                    ],
                    [
                        'type' => 'select',
                        'name' => 'status',
                        'label' => 'Status',
                        'options' => [
                            '' => 'All Status',
                            'active' => 'Active',
                            'expired' => 'Expired',
                            'cancelled' => 'Cancelled'
                        ],
                        'value' => $status
                    ],
                    [
                        'type' => 'select',
                        'name' => 'company',
                        'label' => 'Insurance Company',
                        'options' => array_merge(
                            ['' => 'All Companies'],
                            array_column($companies, 'name', 'id')
                        ),
                        'value' => $company
                    ]
                ];

                $config = [
                    'searchPlaceholder' => 'Search policies by policy number, customer name, or company...',
                    'noDataMessage' => 'No policies found',
                    'entityName' => 'policy',
                    'entityNamePlural' => 'policies'
                ];

                $dataTable = new DataTable();
                echo $dataTable->render($policies, $columns, [
                    'currentPage' => $currentPage,
                    'totalPages' => $totalPages,
                    'totalCount' => $totalCount,
                    'per_page' => $per_page,
                    'sort' => $sort,
                    'order' => $order,
                    'search' => $search,
                    'filters' => $filters,
                    'config' => $config
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
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

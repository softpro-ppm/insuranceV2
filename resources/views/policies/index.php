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
                    'searchPlaceholder' => 'Search all policies (policy number, customer, company, vehicle, premium...)',
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
</script>

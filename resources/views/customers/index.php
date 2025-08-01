<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Customers Management</h2>
            <div>
                <a href="/customers/create" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Add New Customer
                </a>
            </div>
        </div>
    </div>
</div>

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
                        'key' => 'name',
                        'label' => 'Customer Name',
                        'sortable' => true,
                        'render' => function($customer) {
                            return '<div class="d-flex align-items-center">' .
                                   '<div class="avatar-sm me-3">' .
                                   '<div class="avatar-title bg-primary rounded-circle text-white">' . 
                                   strtoupper(substr($customer['name'], 0, 1)) . '</div></div>' .
                                   '<div><h6 class="mb-0">' . htmlspecialchars($customer['name']) . '</h6>' .
                                   '<small class="text-muted">' . htmlspecialchars($customer['customer_code']) . '</small></div></div>';
                        }
                    ],
                    [
                        'key' => 'email',
                        'label' => 'Email',
                        'sortable' => true
                    ],
                    [
                        'key' => 'phone',
                        'label' => 'Phone',
                        'sortable' => true
                    ],
                    [
                        'key' => 'city',
                        'label' => 'City',
                        'sortable' => true
                    ],
                    [
                        'key' => 'policy_count',
                        'label' => 'Total Policies',
                        'sortable' => true,
                        'render' => function($customer) {
                            $count = $customer['policy_count'] ?? 0;
                            $badgeClass = $count > 0 ? 'bg-primary' : 'bg-secondary';
                            return '<span class="badge ' . $badgeClass . '">' . $count . '</span>';
                        }
                    ],
                    [
                        'key' => 'created_at',
                        'label' => 'Joined',
                        'sortable' => true,
                        'render' => function($customer) {
                            return date('M d, Y', strtotime($customer['created_at']));
                        }
                    ],
                    [
                        'key' => 'actions',
                        'label' => 'Actions',
                        'sortable' => false,
                        'render' => function($customer) {
                            return '<div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    Actions
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="/customers/' . $customer['id'] . '"><i class="fas fa-eye me-2"></i>View</a></li>
                                    <li><a class="dropdown-item" href="/customers/' . $customer['id'] . '/edit"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteCustomer(' . $customer['id'] . ')"><i class="fas fa-trash me-2"></i>Delete</a></li>
                                </ul>
                            </div>';
                        }
                    ]
                ];

                // Use data passed from the controller
                // $customers is already available from the route

                // Create filters
                $filters = [
                    [
                        'type' => 'select',
                        'name' => 'city',
                        'label' => 'City',
                        'options' => [
                            '' => 'All Cities',
                            'Mumbai' => 'Mumbai',
                            'Delhi' => 'Delhi',
                            'Bangalore' => 'Bangalore',
                            'Chennai' => 'Chennai',
                            'Kolkata' => 'Kolkata'
                        ]
                    ]
                ];

                // Create and render DataTable
                $dataTable = new DataTable();
                
                $options = [
                    'currentPage' => 1,
                    'totalPages' => 1,
                    'totalCount' => count($customers),
                    'per_page' => 10,
                    'filters' => $filters,
                    'config' => [
                        'id' => 'customersTable',
                        'searchPlaceholder' => 'Search all customers (name, phone, email, city, PAN, Aadhar...)',
                        'exportButtons' => true
                    ]
                ];

                echo $dataTable->render($customers, $columns, $options);
                ?>
            </div>
        </div>
    </div>
</div>

<script>
function deleteCustomer(id) {
    if(confirm('Are you sure you want to delete this customer?')) {
        fetch('/customers/' + id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                location.reload();
            } else {
                alert('Error deleting customer');
            }
        });
    }
}
</script>

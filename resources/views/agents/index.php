<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Agents Management</h2>
            <div>
                <a href="/agents/create" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Add New Agent
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Agents List -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                // Prepare data for DataTable
                $columns = [
                    [
                        'key' => 'name',
                        'label' => 'Name',
                        'sortable' => true,
                        'render' => function($agent) {
                            $statusBadge = $agent['status'] === 'active' 
                                ? '<span class="badge bg-success ms-2">Active</span>' 
                                : '<span class="badge bg-danger ms-2">Inactive</span>';
                            return '<div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">' . htmlspecialchars($agent['name']) . '</h6>
                                            <small class="text-muted">' . htmlspecialchars($agent['username'] ?? '') . '</small>
                                        </div>
                                        ' . $statusBadge . '
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'email',
                        'label' => 'Contact',
                        'sortable' => true,
                        'render' => function($agent) {
                            return '<div>
                                        <div class="fw-medium">' . htmlspecialchars($agent['email'] ?? 'No email') . '</div>
                                        <small class="text-muted">' . htmlspecialchars($agent['phone'] ?? 'No phone') . '</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'total_policies',
                        'label' => 'Performance',
                        'sortable' => false,
                        'render' => function($agent) {
                            return '<div class="text-center">
                                        <div class="fw-bold text-primary">' . number_format($agent['total_policies']) . '</div>
                                        <small class="text-muted">Policies</small>
                                        <div class="fw-bold text-success mt-1">₹' . number_format($agent['total_premium'], 2) . '</div>
                                        <small class="text-muted">Premium</small>
                                        <div class="fw-bold text-info mt-1">₹' . number_format($agent['total_commission'], 2) . '</div>
                                        <small class="text-muted">Commission</small>
                                    </div>';
                        }
                    ],
                    [
                        'key' => 'created_at',
                        'label' => 'Joined',
                        'sortable' => true,
                        'render' => function($agent) {
                            return '<small class="text-muted">' . date('M d, Y', strtotime($agent['created_at'])) . '</small>';
                        }
                    ],
                    [
                        'key' => 'actions',
                        'label' => 'Actions',
                        'sortable' => false,
                        'render' => function($agent) {
                            return '<div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            Actions
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="/agents/' . $agent['id'] . '/edit">
                                                    <i class="fas fa-edit me-2"></i>Edit
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <form method="POST" action="/agents/' . $agent['id'] . '/delete" 
                                                      onsubmit="return confirm(\'Are you sure you want to delete this agent?\')" 
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
                        'name' => 'status',
                        'label' => 'Status',
                        'options' => [
                            '' => 'All Status',
                            'active' => 'Active',
                            'inactive' => 'Inactive'
                        ],
                        'value' => $status
                    ]
                ];

                $config = [
                    'searchPlaceholder' => 'Search agents by name, email, or phone...',
                    'noDataMessage' => 'No agents found',
                    'entityName' => 'agent',
                    'entityNamePlural' => 'agents'
                ];

                $dataTable = new DataTable();
                echo $dataTable->render($agents, $columns, [
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

<?php include 'resources/views/layouts/app.php'; ?>

<div class="page-content">
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Current Month Policies - <?php echo $summary['month_name']; ?></h4>
                    
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                                <li class="breadcrumb-item">
                                    <a href="<?php echo $breadcrumb['url']; ?>"><?php echo $breadcrumb['title']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Policies</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    <span class="counter-value" data-target="<?php echo $summary['total_policies']; ?>">0</span>
                                </h4>
                                <a href="#" class="text-decoration-underline">View all policies</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-success-subtle rounded fs-3">
                                    <i class="bx bx-shield-alt text-success"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Premium</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    ₹<span class="counter-value" data-target="<?php echo number_format($summary['total_premium'], 0); ?>">0</span>
                                </h4>
                                <a href="#" class="text-decoration-underline">View breakdown</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-info-subtle rounded fs-3">
                                    <i class="bx bx-money text-info"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Revenue</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    ₹<span class="counter-value" data-target="<?php echo number_format($summary['total_revenue'], 0); ?>">0</span>
                                </h4>
                                <a href="#" class="text-decoration-underline">View details</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-warning-subtle rounded fs-3">
                                    <i class="bx bx-trending-up text-warning"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="card card-animate">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1 overflow-hidden">
                                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Avg Premium</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-end justify-content-between mt-4">
                            <div>
                                <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                    ₹<span class="counter-value" data-target="<?php echo $summary['total_policies'] > 0 ? number_format($summary['total_premium'] / $summary['total_policies'], 0) : 0; ?>">0</span>
                                </h4>
                                <a href="#" class="text-decoration-underline">View analysis</a>
                            </div>
                            <div class="avatar-sm flex-shrink-0">
                                <span class="avatar-title bg-primary-subtle rounded fs-3">
                                    <i class="bx bx-calculator text-primary"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Policies Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title mb-0">Policies for <?php echo $summary['month_name']; ?></h4>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-success btn-add-policy" onclick="openAddPolicyModal()">
                                <i class="fas fa-plus me-2"></i>Add New Policy
                            </button>
                            <a href="/policies" class="btn btn-outline-primary">
                                <i class="fas fa-list me-2"></i>All Policies
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <?php if (empty($policies)): ?>
                            <div class="text-center py-5">
                                <div class="avatar-xl mx-auto mb-4">
                                    <div class="avatar-title bg-primary-subtle text-primary rounded-circle fs-4">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                </div>
                                <h5 class="fs-16">No Policies Found</h5>
                                <p class="text-muted mb-4">No policies have been created this month. Start by adding your first policy.</p>
                                <button type="button" class="btn btn-success btn-add-policy" onclick="openAddPolicyModal()">
                                    <i class="fas fa-plus me-2"></i>Add First Policy
                                </button>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover searchable-table" id="policiesTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Policy No.</th>
                                            <th>Customer</th>
                                            <th>Vehicle No.</th>
                                            <th>Company</th>
                                            <th>Type</th>
                                            <th>Premium</th>
                                            <th>Revenue</th>
                                            <th>Start Date</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($policies as $policy): ?>
                                            <tr>
                                                <td>
                                                    <span class="fw-medium"><?php echo htmlspecialchars($policy['policy_number']); ?></span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="fw-medium"><?php echo htmlspecialchars($policy['customer_name']); ?></span>
                                                        <br>
                                                        <small class="text-muted"><?php echo htmlspecialchars($policy['customer_phone']); ?></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary">
                                                        <?php echo htmlspecialchars($policy['vehicle_number']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <span class="fw-medium"><?php echo htmlspecialchars($policy['company_name']); ?></span>
                                                        <?php if ($policy['company_code']): ?>
                                                            <br><small class="text-muted"><?php echo htmlspecialchars($policy['company_code']); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info-subtle text-info">
                                                        <?php echo htmlspecialchars($policy['vehicle_type']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="fw-medium text-success">₹<?php echo number_format($policy['premium'], 2); ?></span>
                                                </td>
                                                <td>
                                                    <span class="fw-medium <?php echo $policy['revenue'] >= 0 ? 'text-success' : 'text-danger'; ?>">
                                                        ₹<?php echo number_format($policy['revenue'], 2); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php echo date('d M Y', strtotime($policy['policy_start_date'])); ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status_class = 'bg-success-subtle text-success';
                                                    if ($policy['status'] === 'expired') $status_class = 'bg-danger-subtle text-danger';
                                                    if ($policy['status'] === 'pending') $status_class = 'bg-warning-subtle text-warning';
                                                    ?>
                                                    <span class="badge <?php echo $status_class; ?>">
                                                        <?php echo ucfirst($policy['status']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-soft-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <a class="dropdown-item" href="/policies/<?php echo $policy['id']; ?>/view">
                                                                    <i class="fas fa-eye me-2"></i>View
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="/policies/<?php echo $policy['id']; ?>/edit">
                                                                    <i class="fas fa-edit me-2"></i>Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href="/policies/<?php echo $policy['id']; ?>/print" target="_blank">
                                                                    <i class="fas fa-print me-2"></i>Print
                                                                </a>
                                                            </li>
                                                            <li><hr class="dropdown-divider"></li>
                                                            <li>
                                                                <a class="dropdown-item text-danger" href="#" onclick="deletePolicy(<?php echo $policy['id']; ?>)">
                                                                    <i class="fas fa-trash me-2"></i>Delete
                                                                </a>
                                                            </li>
                                                        </ul>
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
    </div>
</div>

<script>
    // Delete policy function
    function deletePolicy(policyId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '/policies/' + policyId + '/delete';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

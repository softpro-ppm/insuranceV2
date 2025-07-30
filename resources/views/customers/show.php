<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0"><?= htmlspecialchars($customer['name']) ?></h2>
            <div>
                <a href="/customers" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to Customers
                </a>
                <a href="/customers/<?= $customer['id'] ?>/edit" class="btn btn-warning me-2">
                    <i class="fas fa-edit me-2"></i>Edit Customer
                </a>
                <a href="/policies/create?customer_id=<?= $customer['id'] ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Policy
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Customer Summary Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card stats-card">
            <div class="card-body text-center">
                <div class="avatar-initial rounded-circle bg-white text-primary mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; font-size: 24px; font-weight: bold;">
                    <?= strtoupper(substr($customer['name'], 0, 2)) ?>
                </div>
                <h6 class="text-white-50 mb-1">Customer Code</h6>
                <h5 class="text-white mb-0"><?= htmlspecialchars($customer['customer_code']) ?></h5>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card success">
            <div class="card-body text-center">
                <i class="fas fa-file-contract fa-3x text-white-50 mb-2"></i>
                <h6 class="text-white-50 mb-1">Total Policies</h6>
                <h5 class="text-white mb-0"><?= count($policies) ?></h5>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card warning">
            <div class="card-body text-center">
                <i class="fas fa-rupee-sign fa-3x text-white-50 mb-2"></i>
                <h6 class="text-white-50 mb-1">Total Premium</h6>
                <h5 class="text-white mb-0">₹<?= number_format(array_sum(array_column($policies, 'premium_amount')), 2) ?></h5>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card stats-card danger">
            <div class="card-body text-center">
                <i class="fas fa-calendar-alt fa-3x text-white-50 mb-2"></i>
                <h6 class="text-white-50 mb-1">Member Since</h6>
                <h5 class="text-white mb-0"><?= date('M Y', strtotime($customer['created_at'])) ?></h5>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Customer Details -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user text-primary me-2"></i>Customer Details
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <p class="mb-0"><?= htmlspecialchars($customer['name']) ?></p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone Number</label>
                    <p class="mb-0">
                        <a href="tel:<?= $customer['phone'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($customer['phone']) ?>
                        </a>
                    </p>
                </div>
                
                <?php if ($customer['alternate_phone']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Alternate Phone</label>
                    <p class="mb-0">
                        <a href="tel:<?= $customer['alternate_phone'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($customer['alternate_phone']) ?>
                        </a>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if ($customer['email']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Email Address</label>
                    <p class="mb-0">
                        <a href="mailto:<?= $customer['email'] ?>" class="text-decoration-none">
                            <?= htmlspecialchars($customer['email']) ?>
                        </a>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if ($customer['date_of_birth']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <p class="mb-0">
                        <?= date('d M Y', strtotime($customer['date_of_birth'])) ?>
                        <small class="text-muted">(<?= date_diff(date_create($customer['date_of_birth']), date_create('today'))->y ?> years old)</small>
                    </p>
                </div>
                <?php endif; ?>
                
                <?php if ($customer['gender']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Gender</label>
                    <p class="mb-0"><?= ucfirst($customer['gender']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Address Information -->
        <?php if ($customer['address'] || $customer['city'] || $customer['state']): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-map-marker-alt text-primary me-2"></i>Address Information
                </h5>
            </div>
            <div class="card-body">
                <?php if ($customer['address']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Address</label>
                    <p class="mb-0"><?= nl2br(htmlspecialchars($customer['address'])) ?></p>
                </div>
                <?php endif; ?>
                
                <div class="row">
                    <?php if ($customer['city']): ?>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">City</label>
                        <p class="mb-0"><?= htmlspecialchars($customer['city']) ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($customer['state']): ?>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">State</label>
                        <p class="mb-0"><?= htmlspecialchars($customer['state']) ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                
                <?php if ($customer['pincode']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Pincode</label>
                    <p class="mb-0"><?= htmlspecialchars($customer['pincode']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- Identity Documents -->
        <?php if ($customer['aadhar_number'] || $customer['pan_number']): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-id-card text-primary me-2"></i>Identity Documents
                </h5>
            </div>
            <div class="card-body">
                <?php if ($customer['aadhar_number']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Aadhar Number</label>
                    <p class="mb-0"><?= htmlspecialchars($customer['aadhar_number']) ?></p>
                </div>
                <?php endif; ?>
                
                <?php if ($customer['pan_number']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">PAN Number</label>
                    <p class="mb-0"><?= htmlspecialchars($customer['pan_number']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <!-- System Information -->
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-info-circle text-primary me-2"></i>System Information
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Created On</label>
                    <p class="mb-0"><?= date('d M Y, h:i A', strtotime($customer['created_at'])) ?></p>
                </div>
                
                <?php if ($customer['created_by_name']): ?>
                <div class="mb-3">
                    <label class="form-label fw-bold">Created By</label>
                    <p class="mb-0"><?= htmlspecialchars($customer['created_by_name']) ?></p>
                </div>
                <?php endif; ?>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Last Updated</label>
                    <p class="mb-0"><?= date('d M Y, h:i A', strtotime($customer['updated_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Policies -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-file-contract text-primary me-2"></i>Policies (<?= count($policies) ?>)
                </h5>
                <a href="/policies/create?customer_id=<?= $customer['id'] ?>" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i>Add Policy
                </a>
            </div>
            <div class="card-body">
                <?php if (empty($policies)): ?>
                    <div class="text-center py-4">
                        <i class="fas fa-file-contract fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">No policies found</h5>
                        <p class="text-muted mb-3">This customer doesn't have any policies yet.</p>
                        <a href="/policies/create?customer_id=<?= $customer['id'] ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>Add First Policy
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Policy No.</th>
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
                                            <strong><?= htmlspecialchars($policy['policy_number']) ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info"><?= ucfirst($policy['category']) ?></span>
                                        </td>
                                        <td><?= htmlspecialchars($policy['company_name']) ?></td>
                                        <td><?= htmlspecialchars($policy['policy_type_name']) ?></td>
                                        <td>₹<?= number_format($policy['premium_amount'], 2) ?></td>
                                        <td><?= date('d M Y', strtotime($policy['policy_start_date'])) ?></td>
                                        <td>
                                            <?= date('d M Y', strtotime($policy['policy_end_date'])) ?>
                                            <?php 
                                            $daysLeft = ceil((strtotime($policy['policy_end_date']) - time()) / (60 * 60 * 24));
                                            if ($daysLeft <= 30 && $daysLeft > 0): ?>
                                                <small class="text-warning d-block">Expires in <?= $daysLeft ?> days</small>
                                            <?php elseif ($daysLeft <= 0): ?>
                                                <small class="text-danger d-block">Expired</small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $statusClass = '';
                                            switch ($policy['status']) {
                                                case 'active': $statusClass = 'bg-success'; break;
                                                case 'expired': $statusClass = 'bg-danger'; break;
                                                case 'cancelled': $statusClass = 'bg-secondary'; break;
                                                default: $statusClass = 'bg-primary';
                                            }
                                            ?>
                                            <span class="badge <?= $statusClass ?>"><?= ucfirst($policy['status']) ?></span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" 
                                                        onclick="viewPolicy(<?= $policy['id'] ?>)"
                                                        title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-warning" 
                                                        onclick="editPolicy(<?= $policy['id'] ?>)"
                                                        title="Edit Policy">
                                                    <i class="fas fa-edit"></i>
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

<script>
function viewPolicy(policyId) {
    // Implementation for viewing policy details
    window.location.href = '/policies/' + policyId;
}

function editPolicy(policyId) {
    // Implementation for editing policy
    window.location.href = '/policies/' + policyId + '/edit';
}
</script>

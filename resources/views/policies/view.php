<?php
$expiry_date = $policy['policy_end_date'];
$days_to_expiry = ceil((strtotime($expiry_date) - time()) / (60 * 60 * 24));
?>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Policy Details</h2>
            <div>
                <a href="/policies/<?= $policy['id'] ?>/print" class="btn btn-outline-primary me-2" target="_blank">
                    <i class="fas fa-print me-2"></i>Print Policy
                </a>
                <a href="/policies/<?= $policy['id'] ?>/edit" class="btn btn-primary me-2">
                    <i class="fas fa-edit me-2"></i>Edit Policy
                </a>
                <a href="/policies" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Policies
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Policy Information -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-contract me-2"></i>
                    Policy Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Policy Number</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['policy_number']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Status</label>
                        <p class="form-control-plaintext">
                            <?php
                            $status = $policy['status'];
                            $badge_class = $status === 'active' ? 'success' : ($status === 'expired' ? 'warning' : 'danger');
                            $icon = $status === 'active' ? 'check-circle' : ($status === 'expired' ? 'clock' : 'times-circle');
                            ?>
                            <span class="badge bg-<?= $badge_class ?> fs-6">
                                <i class="fas fa-<?= $icon ?> me-1"></i>
                                <?= ucfirst($status) ?>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Vehicle Number</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['vehicle_number'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Vehicle Type</label>
                        <p class="form-control-plaintext"><?= ucfirst(str_replace('_', ' ', $policy['vehicle_type'] ?? 'N/A')) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Policy Start Date</label>
                        <p class="form-control-plaintext"><?= date('d M, Y', strtotime($policy['policy_start_date'])) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Policy End Date</label>
                        <p class="form-control-plaintext">
                            <?= date('d M, Y', strtotime($policy['policy_end_date'])) ?>
                            <?php if ($days_to_expiry > 0): ?>
                                <small class="text-muted">(<?= $days_to_expiry ?> days left)</small>
                            <?php else: ?>
                                <small class="text-danger">(Expired)</small>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Premium Amount</label>
                        <p class="form-control-plaintext">₹<?= number_format($policy['premium_amount'], 2) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Payout</label>
                        <p class="form-control-plaintext">₹<?= number_format($policy['payout'] ?? 0, 2) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Customer Paid</label>
                        <p class="form-control-plaintext">₹<?= number_format($policy['customer_paid'] ?? 0, 2) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Revenue</label>
                        <p class="form-control-plaintext text-success fw-bold">₹<?= number_format($policy['revenue'] ?? 0, 2) ?></p>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold">Business Type</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['business_type'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Customer Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Customer Code</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['customer_code'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Customer Name</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['customer_name']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['customer_phone']) ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['customer_email'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Insurance Company -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-building me-2"></i>
                    Insurance Company
                </h5>
            </div>
            <div class="card-body">
                <h6><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></h6>
            </div>
        </div>

        <!-- Agent Information -->
        <?php if (!empty($policy['agent_name'])): ?>
        <div class="card mb-4">
            <div class="card-header bg-warning text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user-tie me-2"></i>
                    Agent Information
                </h5>
            </div>
            <div class="card-body">
                <p class="mb-0"><?= htmlspecialchars($policy['agent_name']) ?></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Policy Documents -->
        <?php if (!empty($policy['documents'])): ?>
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-file-alt me-2"></i>
                    Documents
                </h5>
            </div>
            <div class="card-body">
                <?php foreach ($policy['documents'] as $doc): ?>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span><?= htmlspecialchars($doc['document_name']) ?></span>
                    <a href="/download/<?= $doc['id'] ?>" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
                                <?= ucfirst($status) ?>
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <p class="form-control-plaintext">
                            <i class="fas fa-<?= $policy['category'] === 'motor' ? 'car' : ($policy['category'] === 'health' ? 'heartbeat' : 'shield-alt') ?> me-2 text-primary"></i>
                            <?= ucfirst($policy['category']) ?> Insurance
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Policy Type</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['policy_type_name'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Insurance Company</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Agent</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['agent_name'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Customer Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['customer_name'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Phone</label>
                        <p class="form-control-plaintext">
                            <i class="fas fa-phone me-2 text-success"></i>
                            <?= htmlspecialchars($policy['customer_phone'] ?? 'N/A') ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p class="form-control-plaintext">
                            <i class="fas fa-envelope me-2 text-info"></i>
                            <?= htmlspecialchars($policy['customer_email'] ?? 'N/A') ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Date of Birth</label>
                        <p class="form-control-plaintext">
                            <?= $policy['customer_dob'] ? date('M d, Y', strtotime($policy['customer_dob'])) : 'N/A' ?>
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Address</label>
                        <p class="form-control-plaintext">
                            <?= htmlspecialchars($policy['customer_address'] ?? 'N/A') ?>
                            <?php if ($policy['customer_city']): ?>
                                <br><?= htmlspecialchars($policy['customer_city']) ?>
                                <?= $policy['customer_state'] ? ', ' . htmlspecialchars($policy['customer_state']) : '' ?>
                                <?= $policy['customer_pincode'] ? ' - ' . htmlspecialchars($policy['customer_pincode']) : '' ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Specific Information -->
        <?php if ($policy['category'] === 'motor'): ?>
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-car me-2"></i>
                    Vehicle Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Vehicle Number</label>
                        <p class="form-control-plaintext font-monospace fw-bold">
                            <?= htmlspecialchars($policy['vehicle_number'] ?? 'N/A') ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Vehicle Type</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['vehicle_type'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Make</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['vehicle_make'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Model</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['vehicle_model'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Year</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['vehicle_year'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Fuel Type</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['fuel_type'] ?? 'N/A') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif ($policy['category'] === 'health'): ?>
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-heartbeat me-2"></i>
                    Health Plan Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Plan Name</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['plan_name'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Coverage Type</label>
                        <p class="form-control-plaintext"><?= htmlspecialchars($policy['coverage_type'] ?? 'N/A') ?></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Room Rent Limit</label>
                        <p class="form-control-plaintext">
                            <?= $policy['room_rent_limit'] ? '₹' . number_format($policy['room_rent_limit']) : 'N/A' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif ($policy['category'] === 'life'): ?>
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-shield-alt me-2"></i>
                    Life Insurance Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Policy Term</label>
                        <p class="form-control-plaintext">
                            <?= $policy['policy_term'] ? $policy['policy_term'] . ' years' : 'N/A' ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Premium Payment Term</label>
                        <p class="form-control-plaintext">
                            <?= $policy['premium_payment_term'] ? $policy['premium_payment_term'] . ' years' : 'N/A' ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Maturity Amount</label>
                        <p class="form-control-plaintext">
                            <?= $policy['maturity_amount'] ? '₹' . number_format($policy['maturity_amount']) : 'N/A' ?>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Death Benefit</label>
                        <p class="form-control-plaintext">
                            <?= $policy['death_benefit'] ? '₹' . number_format($policy['death_benefit']) : 'N/A' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <!-- Financial Summary -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    Financial Details
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Premium Amount</label>
                    <p class="form-control-plaintext fs-4 fw-bold text-success">
                        ₹<?= number_format($policy['premium_amount'] ?? 0) ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Sum Insured</label>
                    <p class="form-control-plaintext fs-5 fw-bold text-primary">
                        ₹<?= number_format($policy['sum_insured'] ?? 0) ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Commission (%)</label>
                    <p class="form-control-plaintext"><?= $policy['commission_percentage'] ?? 0 ?>%</p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Commission Amount</label>
                    <p class="form-control-plaintext fw-bold text-warning">
                        ₹<?= number_format($policy['commission_amount'] ?? 0) ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Policy Dates -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>
                    Policy Timeline
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label fw-bold">Start Date</label>
                    <p class="form-control-plaintext">
                        <i class="fas fa-play text-success me-2"></i>
                        <?= date('M d, Y', strtotime($policy['policy_start_date'])) ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">End Date</label>
                    <p class="form-control-plaintext">
                        <i class="fas fa-stop text-danger me-2"></i>
                        <?= date('M d, Y', strtotime($policy['policy_end_date'])) ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Time Remaining</label>
                    <p class="form-control-plaintext">
                        <?php if ($days_to_expiry > 30): ?>
                            <span class="badge bg-success fs-6">
                                <i class="fas fa-check-circle me-1"></i>
                                <?= $days_to_expiry ?> days left
                            </span>
                        <?php elseif ($days_to_expiry > 0): ?>
                            <span class="badge bg-warning fs-6">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                <?= $days_to_expiry ?> days left
                            </span>
                        <?php else: ?>
                            <span class="badge bg-danger fs-6">
                                <i class="fas fa-times-circle me-1"></i>
                                Expired <?= abs($days_to_expiry) ?> days ago
                            </span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Created On</label>
                    <p class="form-control-plaintext">
                        <i class="fas fa-clock text-muted me-2"></i>
                        <?= date('M d, Y \a\t g:i A', strtotime($policy['created_at'])) ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">
                    <i class="fas fa-tools me-2"></i>
                    Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <?php if ($days_to_expiry <= 30 && $days_to_expiry > 0): ?>
                    <a href="/policies/create?renew=<?= $policy['id'] ?>" class="btn btn-warning">
                        <i class="fas fa-sync-alt me-2"></i>Renew Policy
                    </a>
                    <?php endif; ?>
                    <a href="/policies/<?= $policy['id'] ?>/print" class="btn btn-outline-primary" target="_blank">
                        <i class="fas fa-print me-2"></i>Print Certificate
                    </a>
                    <a href="mailto:<?= htmlspecialchars($policy['customer_email']) ?>?subject=Regarding Policy <?= htmlspecialchars($policy['policy_number']) ?>" class="btn btn-outline-info">
                        <i class="fas fa-envelope me-2"></i>Email Customer
                    </a>
                    <a href="tel:<?= htmlspecialchars($policy['customer_phone']) ?>" class="btn btn-outline-success">
                        <i class="fas fa-phone me-2"></i>Call Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

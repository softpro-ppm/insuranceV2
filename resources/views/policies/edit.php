<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Edit Policy</h2>
            <div>
                <a href="/policies/<?= $policy['id'] ?>/view" class="btn btn-outline-info me-2">
                    <i class="fas fa-eye me-2"></i>View Policy
                </a>
                <a href="/policies" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Policies
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <form method="POST" action="/policies/<?= $policy['id'] ?>/edit">
            
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
                            <label for="policy_number" class="form-label">Policy Number</label>
                            <input type="text" class="form-control" id="policy_number" 
                                   value="<?= htmlspecialchars($policy['policy_number']) ?>" readonly>
                            <small class="text-muted">Policy number cannot be changed</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="status" name="status" required>
                                <option value="active" <?= $policy['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="pending" <?= $policy['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="expired" <?= $policy['status'] === 'expired' ? 'selected' : '' ?>>Expired</option>
                                <option value="cancelled" <?= $policy['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="category" class="form-label">Category</label>
                            <input type="text" class="form-control" id="category" 
                                   value="<?= ucfirst($policy['category']) ?> Insurance" readonly>
                            <small class="text-muted">Category cannot be changed</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="insurance_company_id" class="form-label">Insurance Company <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="insurance_company_id" name="insurance_company_id" required>
                                <option value="">Select Insurance Company</option>
                                <?php foreach ($insurance_companies as $company): ?>
                                    <option value="<?= $company['id'] ?>" <?= $policy['insurance_company_id'] == $company['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($company['name']) ?> (<?= htmlspecialchars($company['code']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="policy_type_id" class="form-label">Policy Type <span class="text-danger">*</span></label>
                            <select class="form-select select2" id="policy_type_id" name="policy_type_id" required>
                                <option value="">Select Policy Type</option>
                                <?php foreach ($policy_types as $type): ?>
                                    <?php if ($type['category'] === $policy['category']): ?>
                                        <option value="<?= $type['id'] ?>" <?= $policy['policy_type_id'] == $type['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($type['name']) ?> (<?= htmlspecialchars($type['code']) ?>)
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (!empty($agents)): ?>
                        <div class="col-md-6 mb-3">
                            <label for="agent_id" class="form-label">Agent</label>
                            <select class="form-select select2" id="agent_id" name="agent_id">
                                <?php foreach ($agents as $agent): ?>
                                    <option value="<?= $agent['id'] ?>" <?= $policy['agent_id'] == $agent['id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($agent['name']) ?> (<?= htmlspecialchars($agent['username']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Agent responsible for this policy</small>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Policy Dates and Financial Details -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-calendar-dollar me-2"></i>
                        Policy Dates & Financial Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="policy_start_date" class="form-label">Policy Start Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="policy_start_date" name="policy_start_date" 
                                   value="<?= $policy['policy_start_date'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="policy_end_date" class="form-label">Policy End Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="policy_end_date" name="policy_end_date" 
                                   value="<?= $policy['policy_end_date'] ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="premium_amount" class="form-label">Premium Amount <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="premium_amount" name="premium_amount" 
                                       value="<?= $policy['premium_amount'] ?>" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sum_insured" class="form-label">Sum Insured <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="sum_insured" name="sum_insured" 
                                       value="<?= $policy['sum_insured'] ?>" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="commission_percentage" class="form-label">Commission Percentage</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="commission_percentage" name="commission_percentage" 
                                       value="<?= $policy['commission_percentage'] ?>" step="0.01" min="0" max="100">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="commission_amount" class="form-label">Commission Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="commission_amount" name="commission_amount" 
                                       value="<?= $policy['commission_amount'] ?>" step="0.01" min="0" readonly>
                            </div>
                            <small class="text-muted">Calculated automatically based on premium and commission percentage</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Specific Fields -->
            <?php if ($policy['category'] === 'motor'): ?>
            <div class="card mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">
                        <i class="fas fa-car me-2"></i>
                        Motor Insurance Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_number" class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control vehicle-check-input" id="vehicle_number" 
                                   name="vehicle_number" value="<?= htmlspecialchars($policy['vehicle_number'] ?? '') ?>" 
                                   style="text-transform: uppercase;" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_type" class="form-label">Vehicle Type</label>
                            <select class="form-select select2" id="vehicle_type" name="vehicle_type">
                                <option value="">Select Vehicle Type</option>
                                <option value="Two Wheeler" <?= $policy['vehicle_type'] === 'Two Wheeler' ? 'selected' : '' ?>>Two Wheeler</option>
                                <option value="Three Wheeler" <?= $policy['vehicle_type'] === 'Three Wheeler' ? 'selected' : '' ?>>Three Wheeler</option>
                                <option value="Four Wheeler" <?= $policy['vehicle_type'] === 'Four Wheeler' ? 'selected' : '' ?>>Four Wheeler</option>
                                <option value="Commercial Vehicle" <?= $policy['vehicle_type'] === 'Commercial Vehicle' ? 'selected' : '' ?>>Commercial Vehicle</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_make" class="form-label">Vehicle Make</label>
                            <input type="text" class="form-control" id="vehicle_make" name="vehicle_make" 
                                   value="<?= htmlspecialchars($policy['vehicle_make'] ?? '') ?>" placeholder="e.g., Maruti, Honda, Tata">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" 
                                   value="<?= htmlspecialchars($policy['vehicle_model'] ?? '') ?>" placeholder="e.g., Swift, City, Nexon">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="vehicle_year" class="form-label">Manufacturing Year</label>
                            <input type="number" class="form-control" id="vehicle_year" name="vehicle_year" 
                                   value="<?= $policy['vehicle_year'] ?? '' ?>" min="1990" max="<?= date('Y') + 1 ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fuel_type" class="form-label">Fuel Type</label>
                            <select class="form-select select2" id="fuel_type" name="fuel_type">
                                <option value="">Select Fuel Type</option>
                                <option value="Petrol" <?= $policy['fuel_type'] === 'Petrol' ? 'selected' : '' ?>>Petrol</option>
                                <option value="Diesel" <?= $policy['fuel_type'] === 'Diesel' ? 'selected' : '' ?>>Diesel</option>
                                <option value="CNG" <?= $policy['fuel_type'] === 'CNG' ? 'selected' : '' ?>>CNG</option>
                                <option value="Electric" <?= $policy['fuel_type'] === 'Electric' ? 'selected' : '' ?>>Electric</option>
                                <option value="Hybrid" <?= $policy['fuel_type'] === 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif ($policy['category'] === 'health'): ?>
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-heartbeat me-2"></i>
                        Health Insurance Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="plan_name" class="form-label">Plan Name</label>
                            <input type="text" class="form-control" id="plan_name" name="plan_name" 
                                   value="<?= htmlspecialchars($policy['plan_name'] ?? '') ?>" placeholder="e.g., Family Floater, Individual">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="coverage_type" class="form-label">Coverage Type</label>
                            <select class="form-select select2" id="coverage_type" name="coverage_type">
                                <option value="">Select Coverage Type</option>
                                <option value="Individual" <?= $policy['coverage_type'] === 'Individual' ? 'selected' : '' ?>>Individual</option>
                                <option value="Family Floater" <?= $policy['coverage_type'] === 'Family Floater' ? 'selected' : '' ?>>Family Floater</option>
                                <option value="Group" <?= $policy['coverage_type'] === 'Group' ? 'selected' : '' ?>>Group</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="room_rent_limit" class="form-label">Room Rent Limit</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="room_rent_limit" name="room_rent_limit" 
                                       value="<?= $policy['room_rent_limit'] ?? '' ?>" step="100" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php elseif ($policy['category'] === 'life'): ?>
            <div class="card mb-4">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        Life Insurance Details
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="policy_term" class="form-label">Policy Term</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="policy_term" name="policy_term" 
                                       value="<?= $policy['policy_term'] ?? '' ?>" min="1" max="100">
                                <span class="input-group-text">years</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="premium_payment_term" class="form-label">Premium Payment Term</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="premium_payment_term" name="premium_payment_term" 
                                       value="<?= $policy['premium_payment_term'] ?? '' ?>" min="1" max="100">
                                <span class="input-group-text">years</span>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="maturity_amount" class="form-label">Maturity Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="maturity_amount" name="maturity_amount" 
                                       value="<?= $policy['maturity_amount'] ?? '' ?>" step="1000" min="0">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="death_benefit" class="form-label">Death Benefit</label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" class="form-control" id="death_benefit" name="death_benefit" 
                                       value="<?= $policy['death_benefit'] ?? '' ?>" step="1000" min="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Submit Buttons -->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="/policies/<?= $policy['id'] ?>/view" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Policy
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Select2 CSS and JS for searchable dropdowns -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for all dropdowns
    $('.select2').select2({
        placeholder: function() {
            return $(this).data('placeholder') || 'Search and select...';
        },
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: 0
    });
    
    // Auto-calculate commission amount
    function calculateCommission() {
        const premium = parseFloat(document.getElementById('premium_amount').value) || 0;
        const percentage = parseFloat(document.getElementById('commission_percentage').value) || 0;
        const commission = (premium * percentage) / 100;
        
        document.getElementById('commission_amount').value = commission.toFixed(2);
    }
    
    document.getElementById('premium_amount').addEventListener('input', calculateCommission);
    document.getElementById('commission_percentage').addEventListener('input', calculateCommission);
    
    // Auto-calculate policy end date (start date + 1 year - 1 day)
    document.getElementById('policy_start_date').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDate = new Date(startDate);
        endDate.setFullYear(endDate.getFullYear() + 1);
        endDate.setDate(endDate.getDate() - 1); // Subtract 1 day
        
        document.getElementById('policy_end_date').value = endDate.toISOString().split('T')[0];
    });
    
    // Vehicle number formatting
    const vehicleNumberField = document.getElementById('vehicle_number');
    if (vehicleNumberField) {
        vehicleNumberField.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }
    
    // Form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating Policy...';
        submitBtn.disabled = true;
    });
});
</script>

<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Edit Customer</h2>
            <div>
                <a href="/customers/<?= $customer['id'] ?>" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back to Customer
                </a>
                <a href="/customers" class="btn btn-outline-secondary">
                    <i class="fas fa-list me-2"></i>All Customers
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/customers/<?= $customer['id'] ?>/update" class="needs-validation" novalidate>
                    <!-- Basic Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-user me-2"></i>Basic Information
                            </h5>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?= htmlspecialchars($customer['name']) ?>" required>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" 
                                   value="<?= htmlspecialchars($customer['phone']) ?>" 
                                   pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">
                                Please provide a valid 10-digit phone number.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="<?= htmlspecialchars($customer['email'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="alternate_phone" class="form-label">Alternate Phone</label>
                            <input type="tel" class="form-control" id="alternate_phone" name="alternate_phone" 
                                   value="<?= htmlspecialchars($customer['alternate_phone'] ?? '') ?>" 
                                   pattern="[0-9]{10}">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" 
                                   value="<?= $customer['date_of_birth'] ?>" max="<?= date('Y-m-d') ?>">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male" <?= $customer['gender'] === 'male' ? 'selected' : '' ?>>Male</option>
                                <option value="female" <?= $customer['gender'] === 'female' ? 'selected' : '' ?>>Female</option>
                                <option value="other" <?= $customer['gender'] === 'other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Customer Code</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($customer['customer_code']) ?>" readonly>
                            <small class="form-text text-muted">Customer code cannot be changed</small>
                        </div>
                    </div>

                    <!-- Address Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Address Information
                            </h5>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="address" class="form-label">Full Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" 
                                      placeholder="Enter complete address"><?= htmlspecialchars($customer['address'] ?? '') ?></textarea>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" 
                                   value="<?= htmlspecialchars($customer['city'] ?? '') ?>">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select State</option>
                                <?php 
                                $states = [
                                    'Andhra Pradesh', 'Arunachal Pradesh', 'Assam', 'Bihar', 'Chhattisgarh', 'Goa', 
                                    'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jharkhand', 'Karnataka', 'Kerala', 
                                    'Madhya Pradesh', 'Maharashtra', 'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 
                                    'Odisha', 'Punjab', 'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 
                                    'Uttar Pradesh', 'Uttarakhand', 'West Bengal', 'Delhi', 'Puducherry'
                                ];
                                foreach ($states as $state): ?>
                                    <option value="<?= $state ?>" <?= $customer['state'] === $state ? 'selected' : '' ?>>
                                        <?= $state ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" 
                                   value="<?= htmlspecialchars($customer['pincode'] ?? '') ?>" 
                                   pattern="[0-9]{6}" maxlength="6">
                        </div>
                    </div>

                    <!-- Documents -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-id-card me-2"></i>Identity Documents
                            </h5>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="aadhar_number" class="form-label">Aadhar Number</label>
                            <input type="text" class="form-control" id="aadhar_number" name="aadhar_number" 
                                   value="<?= htmlspecialchars($customer['aadhar_number'] ?? '') ?>"
                                   pattern="[0-9]{12}" maxlength="12" placeholder="XXXX XXXX XXXX">
                            <small class="form-text text-muted">12-digit Aadhar number</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pan_number" class="form-label">PAN Number</label>
                            <input type="text" class="form-control" id="pan_number" name="pan_number" 
                                   value="<?= htmlspecialchars($customer['pan_number'] ?? '') ?>"
                                   pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" maxlength="10" placeholder="ABCDE1234F" 
                                   style="text-transform: uppercase;">
                            <small class="form-text text-muted">10-character PAN number</small>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <!-- Delete button if customer has no policies -->
                                    <?php 
                                    $db = Database::getInstance();
                                    $policyCount = $db->fetch("SELECT COUNT(*) as count FROM policies WHERE customer_id = ?", [$customer['id']])['count'];
                                    if ($policyCount == 0): ?>
                                        <button type="button" class="btn btn-danger" 
                                                onclick="deleteCustomer(<?= $customer['id'] ?>, '<?= htmlspecialchars($customer['name']) ?>')">
                                            <i class="fas fa-trash me-2"></i>Delete Customer
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="/customers/<?= $customer['id'] ?>" class="btn btn-secondary">
                                        <i class="fas fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Customer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete customer <strong id="customerName"></strong>?</p>
                <p class="text-muted">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    <button type="submit" class="btn btn-danger">Delete Customer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Form validation
(function() {
    'use strict';
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

// Format phone numbers
document.getElementById('phone').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

document.getElementById('alternate_phone').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Format Aadhar number
document.getElementById('aadhar_number').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Format PAN number
document.getElementById('pan_number').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
});

// Format pincode
document.getElementById('pincode').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

function deleteCustomer(id, name) {
    document.getElementById('customerName').textContent = name;
    document.getElementById('deleteForm').action = '/customers/' + id + '/delete';
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}
</script>

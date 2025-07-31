<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Add New Policy</h2>
            <a href="/policies" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Policies
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form id="policyForm" method="POST" action="/policies/store" enctype="multipart/form-data">
                    <!-- Step 1: Policy Type Selection -->
                    <div class="step" id="step1">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-list text-primary me-2"></i>
                            Step 1: Select Insurance Type
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="policy-type-card" data-category="motor">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center">
                                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                                            <h5>Motor Insurance</h5>
                                            <p class="text-muted">Vehicle insurance for cars, bikes, commercial vehicles</p>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio" name="insurance_category" value="motor" id="motor">
                                                <label class="form-check-label fw-bold" for="motor">
                                                    Select Motor Insurance
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <div class="policy-type-card" data-category="health">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center">
                                            <i class="fas fa-heart fa-3x text-success mb-3"></i>
                                            <h5>Health Insurance</h5>
                                            <p class="text-muted">Medical coverage for individuals and families</p>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio" name="insurance_category" value="health" id="health">
                                                <label class="form-check-label fw-bold" for="health">
                                                    Select Health Insurance
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <div class="policy-type-card" data-category="life">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center">
                                            <i class="fas fa-life-ring fa-3x text-info mb-3"></i>
                                            <h5>Life Insurance</h5>
                                            <p class="text-muted">Life coverage and investment plans</p>
                                            <div class="form-check mt-3">
                                                <input class="form-check-input" type="radio" name="insurance_category" value="life" id="life">
                                                <label class="form-check-label fw-bold" for="life">
                                                    Select Life Insurance
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-end mt-4">
                            <button type="button" class="btn btn-primary" id="nextStep1" disabled>
                                Next Step <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 2: Customer Information -->
                    <div class="step d-none" id="step2">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-user text-primary me-2"></i>
                            Step 2: Customer Information
                        </h5>
                        
                        <!-- Customer Selection Toggle -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="btn-group w-100" role="group">
                                    <input type="radio" class="btn-check" name="customer_option" id="existing_customer" value="existing">
                                    <label class="btn btn-outline-primary" for="existing_customer">
                                        <i class="fas fa-search me-2"></i>Select Existing Customer
                                    </label>

                                    <input type="radio" class="btn-check" name="customer_option" id="new_customer" value="new" checked>
                                    <label class="btn btn-outline-primary" for="new_customer">
                                        <i class="fas fa-user-plus me-2"></i>Add New Customer
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Existing Customer Selection -->
                        <div id="existing_customer_section" class="d-none">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Select Customer <span class="text-danger">*</span></label>
                                    <select class="form-select" id="customer_id" name="customer_id">
                                        <option value="">Loading customers...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <!-- New Customer Form -->
                        <div id="new_customer_section">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Customer Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_name" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" name="customer_phone" required maxlength="10">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input type="email" class="form-control" name="customer_email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="customer_dob">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="customer_address" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevStep2">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <button type="button" class="btn btn-primary" id="nextStep2">
                                Next Step <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 3: Policy Details (Dynamic based on insurance type) -->
                    <div class="step d-none" id="step3">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-file-contract text-primary me-2"></i>
                            Step 3: Policy Details
                        </h5>
                        
                        <!-- Common Fields -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Insurance Company <span class="text-danger">*</span></label>
                                <select class="form-control" name="insurance_company_id" id="insuranceCompany" required>
                                    <option value="">Select Insurance Company</option>
                                    <?php foreach ($insurance_companies as $company): ?>
                                        <option value="<?= $company['id'] ?>" 
                                                data-motor="<?= $company['supports_motor'] ?>"
                                                data-health="<?= $company['supports_health'] ?>"
                                                data-life="<?= $company['supports_life'] ?>">
                                            <?= htmlspecialchars($company['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Policy Type <span class="text-danger">*</span></label>
                                <select class="form-control" name="policy_type_id" id="policyType" required>
                                    <option value="">Select Policy Type</option>
                                    <?php foreach ($policy_types as $type): ?>
                                        <option value="<?= $type['id'] ?>" data-category="<?= $type['category'] ?>" class="policy-type-option-select">
                                            <?= htmlspecialchars($type['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Policy Start Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="policy_start_date" id="policyStartDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Policy End Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="policy_end_date" id="policyEndDate" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Premium Amount <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="premium_amount" step="0.01" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Sum Insured</label>
                                <input type="number" class="form-control" name="sum_insured" step="0.01">
                            </div>
                        </div>
                        
                        <!-- Motor Insurance Specific Fields -->
                        <div id="motorFields" class="insurance-specific-fields d-none">
                            <h6 class="text-primary mb-3"><i class="fas fa-car me-2"></i>Vehicle Details</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-uppercase" name="vehicle_number" placeholder="MH12AB1234">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="vehicle_type">
                                        <option value="">Select Vehicle Type</option>
                                        <option value="two_wheeler">Two Wheeler</option>
                                        <option value="car">Car</option>
                                        <option value="commercial">Commercial Vehicle</option>
                                        <option value="tractor">Tractor</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Make</label>
                                    <input type="text" class="form-control" name="vehicle_make" placeholder="Honda, Maruti, etc.">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Vehicle Model</label>
                                    <input type="text" class="form-control" name="vehicle_model" placeholder="City, Swift, etc.">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Manufacturing Year</label>
                                    <input type="number" class="form-control" name="vehicle_year" min="1980" max="2025">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Fuel Type</label>
                                    <select class="form-control" name="fuel_type">
                                        <option value="">Select Fuel Type</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="cng">CNG</option>
                                        <option value="electric">Electric</option>
                                        <option value="hybrid">Hybrid</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Engine Number</label>
                                    <input type="text" class="form-control" name="engine_number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Chassis Number</label>
                                    <input type="text" class="form-control" name="chassis_number">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Health Insurance Specific Fields -->
                        <div id="healthFields" class="insurance-specific-fields d-none">
                            <h6 class="text-success mb-3"><i class="fas fa-heart me-2"></i>Health Plan Details</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Plan Name</label>
                                    <input type="text" class="form-control" name="plan_name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Coverage Type</label>
                                    <select class="form-control" name="coverage_type">
                                        <option value="">Select Coverage Type</option>
                                        <option value="individual">Individual</option>
                                        <option value="family">Family</option>
                                        <option value="group">Group</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Room Rent Limit</label>
                                    <input type="number" class="form-control" name="room_rent_limit" step="0.01">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Pre-existing Diseases</label>
                                    <textarea class="form-control" name="pre_existing_diseases" rows="2" placeholder="List any pre-existing medical conditions"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Life Insurance Specific Fields -->
                        <div id="lifeFields" class="insurance-specific-fields d-none">
                            <h6 class="text-info mb-3"><i class="fas fa-life-ring me-2"></i>Life Insurance Details</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Policy Term (Years)</label>
                                    <input type="number" class="form-control" name="policy_term" min="1" max="100">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Premium Payment Term (Years)</label>
                                    <input type="number" class="form-control" name="premium_payment_term" min="1" max="100">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Maturity Amount</label>
                                    <input type="number" class="form-control" name="maturity_amount" step="0.01">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Death Benefit</label>
                                    <input type="number" class="form-control" name="death_benefit" step="0.01">
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevStep3">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <button type="button" class="btn btn-primary" id="nextStep3">
                                Next Step <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Step 4: Additional Information -->
                    <div class="step d-none" id="step4">
                        <h5 class="card-title mb-4">
                            <i class="fas fa-clipboard-check text-primary me-2"></i>
                            Step 4: Additional Information
                        </h5>
                        
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Remarks/Notes</label>
                                <textarea class="form-control" name="remarks" rows="3" placeholder="Any additional notes or remarks about this policy"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commission Percentage</label>
                                <input type="number" class="form-control" name="commission_percentage" step="0.01" min="0" max="100">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commission Amount</label>
                                <input type="number" class="form-control" name="commission_amount" step="0.01" readonly>
                            </div>
                        </div>
                        
                        <!-- Document Upload -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3"><i class="fas fa-paperclip me-2"></i>Document Upload</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Policy Documents</label>
                                    <input type="file" class="form-control" name="policy_documents[]" multiple accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                    <small class="text-muted">Upload policy documents, RC copy, etc.</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="prevStep4">
                                <i class="fas fa-arrow-left me-2"></i>Previous
                            </button>
                            <button type="submit" class="btn btn-success" id="submitPolicy">
                                <i class="fas fa-save me-2"></i>Create Policy
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.policy-type-option {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid #e9ecef !important;
}

.policy-type-option:hover {
    border-color: #007bff !important;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,123,255,0.2);
}

.policy-type-option.selected {
    border-color: #007bff !important;
    background-color: #f8f9ff;
}

.insurance-specific-fields {
    border-left: 4px solid #007bff;
    padding-left: 20px;
    margin-top: 20px;
}

.step {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Step navigation
    let currentStep = 1;
    
    // Load initial data
    loadCustomers();
    
    // Fetch customers and populate dropdown
    async function loadCustomers() {
        try {
            const response = await fetch('/api/customers');
            const customers = await response.json();
            const select = document.getElementById('customer_id');
            select.innerHTML = '<option value="">Select Customer</option>';
            customers.forEach(customer => {
                select.innerHTML += `<option value="${customer.id}">${customer.customer_code} - ${customer.name} (${customer.phone})</option>`;
            });
        } catch (error) {
            console.error('Error loading customers:', error);
            const select = document.getElementById('customer_id');
            select.innerHTML = '<option value="">Error loading customers</option>';
            alert('Error loading customers. Please refresh the page.');
        }
    }
    
    // Customer option toggle functionality
    document.querySelectorAll('input[name="customer_option"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const existingSection = document.getElementById('existing_customer_section');
            const newSection = document.getElementById('new_customer_section');
            
            if (this.value === 'existing') {
                existingSection.classList.remove('d-none');
                newSection.classList.add('d-none');
                // Make customer_id required and customer_name not required
                document.getElementById('customer_id').required = true;
                document.querySelector('input[name="customer_name"]').required = false;
                document.querySelector('input[name="customer_phone"]').required = false;
            } else {
                existingSection.classList.add('d-none');
                newSection.classList.remove('d-none');
                // Make customer fields required and customer_id not required
                document.getElementById('customer_id').required = false;
                document.querySelector('input[name="customer_name"]').required = true;
                document.querySelector('input[name="customer_phone"]').required = true;
            }
        });
    });

    // Fetch policy types based on category
    async function loadPolicyTypes(category) {
        try {
            const response = await fetch(`/api/policy-types?category=${category}`);
            const policyTypes = await response.json();
            const select = document.getElementById('policy_type_id');
            select.innerHTML = '<option value="">Select Policy Type</option>';
            policyTypes.forEach(type => {
                select.innerHTML += `<option value="${type.id}">${type.name} (${type.code})</option>`;
            });
        } catch (error) {
            console.error('Error loading policy types:', error);
            alert('Error loading policy types. Please try again.');
        }
    }

    // Fetch insurance companies based on category
    async function loadInsuranceCompanies(category) {
        try {
            const response = await fetch(`/api/insurance-companies?category=${category}`);
            const companies = await response.json();
            const select = document.getElementById('insurance_company_id');
            select.innerHTML = '<option value="">Select Insurance Company</option>';
            companies.forEach(company => {
                select.innerHTML += `<option value="${company.id}">${company.name} (${company.code})</option>`;
            });
        } catch (error) {
            console.error('Error loading insurance companies:', error);
            alert('Error loading insurance companies. Please try again.');
        }
    }
    
    // Policy type selection
    document.querySelectorAll('.policy-type-option').forEach(card => {
        card.addEventListener('click', function() {
            const radio = this.querySelector('input[type="radio"]');
            radio.checked = true;
            
            // Update visual selection
            document.querySelectorAll('.policy-type-option').forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');
            
            // Enable next button
            document.getElementById('nextStep1').disabled = false;
            
            // Show/hide relevant insurance companies and policy types
            updateInsuranceOptions(radio.value);
        });
    });
    
    // Step navigation buttons
    document.getElementById('nextStep1').addEventListener('click', () => showStep(2));
    document.getElementById('prevStep2').addEventListener('click', () => showStep(1));
    document.getElementById('nextStep2').addEventListener('click', () => showStep(3));
    document.getElementById('prevStep3').addEventListener('click', () => showStep(2));
    document.getElementById('nextStep3').addEventListener('click', () => showStep(4));
    document.getElementById('prevStep4').addEventListener('click', () => showStep(3));
    
    function showStep(step) {
        // Hide all steps
        document.querySelectorAll('.step').forEach(s => s.classList.add('d-none'));
        
        // Show current step
        document.getElementById(`step${step}`).classList.remove('d-none');
        currentStep = step;
    }
    
    function updateInsuranceOptions(category) {
        // Set the category value in the hidden input
        const categoryInput = document.querySelector('input[name="category"]');
        if (!categoryInput) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'category';
            hiddenInput.value = category;
            document.getElementById('policyForm').appendChild(hiddenInput);
        } else {
            categoryInput.value = category;
        }
        
        // Load policy types and insurance companies for the selected category
        loadPolicyTypes(category);
        loadInsuranceCompanies(category);
        
        // Show/hide category-specific fields in step 3
        const motorFields = document.getElementById('motorFields');
        const healthFields = document.getElementById('healthFields');
        const lifeFields = document.getElementById('lifeFields');
        
        if (motorFields) motorFields.style.display = category === 'motor' ? 'block' : 'none';
        if (healthFields) healthFields.style.display = category === 'health' ? 'block' : 'none';
        if (lifeFields) lifeFields.style.display = category === 'life' ? 'block' : 'none';
        
        // Show relevant specific fields
        document.querySelectorAll('.insurance-specific-fields').forEach(field => {
            field.classList.add('d-none');
        });
        
        document.getElementById(`${category}Fields`).classList.remove('d-none');
        
        // Reset selections
        companySelect.value = '';
        policyTypeSelect.value = '';
    }
    
    // Auto-calculate policy end date (1 year from start date)
    document.getElementById('policyStartDate').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDate = new Date(startDate);
        endDate.setFullYear(endDate.getFullYear() + 1);
        
        document.getElementById('policyEndDate').value = endDate.toISOString().split('T')[0];
    });
    
    // Auto-calculate commission amount
    document.querySelector('input[name="premium_amount"]').addEventListener('input', calculateCommission);
    document.querySelector('input[name="commission_percentage"]').addEventListener('input', calculateCommission);
    
    function calculateCommission() {
        const premium = parseFloat(document.querySelector('input[name="premium_amount"]').value) || 0;
        const percentage = parseFloat(document.querySelector('input[name="commission_percentage"]').value) || 0;
        const commission = (premium * percentage) / 100;
        
        document.querySelector('input[name="commission_amount"]').value = commission.toFixed(2);
    }
    
    // Form validation
    document.getElementById('policyForm').addEventListener('submit', function(e) {
        // Add any additional validation here
        const submitBtn = document.getElementById('submitPolicy');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating Policy...';
        submitBtn.disabled = true;
    });
    
    // Phone number validation
    document.querySelector('input[name="customer_phone"]').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    
    // Vehicle number formatting
    document.querySelector('input[name="vehicle_number"]').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
});
</script>

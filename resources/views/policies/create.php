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
                                <div class="policy-type-card h-100" data-category="motor">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center d-flex flex-column">
                                            <i class="fas fa-car fa-3x text-primary mb-3"></i>
                                            <h5 class="mb-3">Motor Insurance</h5>
                                            <p class="text-muted flex-grow-1">Vehicle insurance for cars, bikes, commercial vehicles</p>
                                            <div class="form-check mt-auto">
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
                                <div class="policy-type-card h-100" data-category="health">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center d-flex flex-column">
                                            <i class="fas fa-heart fa-3x text-success mb-3"></i>
                                            <h5 class="mb-3">Health Insurance</h5>
                                            <p class="text-muted flex-grow-1">Medical coverage for individuals and families</p>
                                            <div class="form-check mt-auto">
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
                                <div class="policy-type-card h-100" data-category="life">
                                    <div class="card h-100 border-2 policy-type-option">
                                        <div class="card-body text-center d-flex flex-column">
                                            <i class="fas fa-life-ring fa-3x text-info mb-3"></i>
                                            <h5 class="mb-3">Life Insurance</h5>
                                            <p class="text-muted flex-grow-1">Life coverage and investment plans</p>
                                            <div class="form-check mt-auto">
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
                                    <select class="form-select" id="customer_id" name="customer_id" style="width: 100%;">
                                        <option value="">Search and select customer...</option>
                                    </select>
                                    <small class="form-text text-muted">Type customer name, phone number, or email to search</small>
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
                                    <input type="tel" class="form-control" name="customer_phone" required maxlength="10" pattern="[0-9]{10}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="customer_email" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="customer_dob" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender <span class="text-danger">*</span></label>
                                    <select class="form-control" name="customer_gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Occupation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_occupation" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="customer_address" rows="2" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">City <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_city" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="customer_pincode" required pattern="[0-9]{6}" maxlength="6">
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
                                <select class="form-control select2" name="insurance_company_id" id="insuranceCompany" data-placeholder="Search and select insurance company..." required>
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
                                <small class="text-muted">Type to search insurance companies</small>
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
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Assign to Agent <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="agent_id" id="agentSelect" data-placeholder="Search and select agent..." required>
                                    <option value="">Select Agent</option>
                                    <?php if ($_SESSION['user_role'] === 'admin'): ?>
                                        <option value="<?= $_SESSION['user_id'] ?>">Admin (Direct Business)</option>
                                    <?php endif; ?>
                                    <?php foreach ($agents as $agent): ?>
                                        <option value="<?= $agent['id'] ?>" <?= ($_SESSION['user_role'] === 'agent' && $_SESSION['user_id'] == $agent['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($agent['name']) ?> (<?= htmlspecialchars($agent['username']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Policy will be assigned to selected agent</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commission Percentage</label>
                                <input type="number" class="form-control" name="commission_percentage" step="0.01" min="0" max="100" value="10">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Commission Amount</label>
                                <input type="number" class="form-control" name="commission_amount" step="0.01" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Remarks/Notes</label>
                                <textarea class="form-control" name="remarks" rows="3" placeholder="Any additional notes or remarks about this policy"></textarea>
                            </div>
                        </div>
                        
                        <!-- Document Upload -->
                        <div class="mb-4">
                            <h6 class="text-primary mb-3"><i class="fas fa-paperclip me-2"></i>Document Upload</h6>
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-file-upload me-2"></i>Policy Documents
                                </h6>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="policy_document" class="form-label">
                                    Policy Document <span class="text-danger">*</span>
                                </label>
                                <input type="file" class="form-control" id="policy_document" name="policy_document" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                <small class="text-muted">Upload main policy document (PDF, JPG, PNG - Max 10MB)</small>
                                <div class="preview-container mt-2" id="policy_document_preview"></div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="proposal_form" class="form-label">Proposal Form</label>
                                <input type="file" class="form-control" id="proposal_form" name="proposal_form" 
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <small class="text-muted">Upload filled proposal form (PDF, JPG, PNG - Max 10MB)</small>
                                <div class="preview-container mt-2" id="proposal_form_preview"></div>
                            </div>
                        </div>
                        
                        <!-- Motor Insurance Specific Documents -->
                        <div class="motor-documents insurance-specific-docs d-none">
                            <h6 class="text-secondary mb-3">
                                <i class="fas fa-car me-2"></i>Motor Insurance Documents
                            </h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_rc" class="form-label">Vehicle RC Copy</label>
                                    <input type="file" class="form-control" id="vehicle_rc" name="vehicle_rc" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload vehicle registration certificate</small>
                                    <div class="preview-container mt-2" id="vehicle_rc_preview"></div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="driving_license" class="form-label">Driving License</label>
                                    <input type="file" class="form-control" id="driving_license" name="driving_license" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload valid driving license</small>
                                    <div class="preview-container mt-2" id="driving_license_preview"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Health Insurance Specific Documents -->
                        <div class="health-documents insurance-specific-docs d-none">
                            <h6 class="text-secondary mb-3">
                                <i class="fas fa-heartbeat me-2"></i>Health Insurance Documents
                            </h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="medical_report" class="form-label">Medical Reports</label>
                                    <input type="file" class="form-control" id="medical_report" name="medical_report" 
                                           accept=".pdf,.jpg,.jpeg,.png" multiple>
                                    <small class="text-muted">Upload medical checkup reports (if required)</small>
                                    <div class="preview-container mt-2" id="medical_report_preview"></div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="previous_policy" class="form-label">Previous Health Policy</label>
                                    <input type="file" class="form-control" id="previous_policy" name="previous_policy" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload previous health insurance policy (if any)</small>
                                    <div class="preview-container mt-2" id="previous_policy_preview"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Life Insurance Specific Documents -->
                        <div class="life-documents insurance-specific-docs d-none">
                            <h6 class="text-secondary mb-3">
                                <i class="fas fa-life-ring me-2"></i>Life Insurance Documents
                            </h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nominee_document" class="form-label">Nominee ID Proof</label>
                                    <input type="file" class="form-control" id="nominee_document" name="nominee_document" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload nominee identification document</small>
                                    <div class="preview-container mt-2" id="nominee_document_preview"></div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="income_proof" class="form-label">Income Proof</label>
                                    <input type="file" class="form-control" id="income_proof" name="income_proof" 
                                           accept=".pdf,.jpg,.jpeg,.png">
                                    <small class="text-muted">Upload salary slip, ITR, or income certificate</small>
                                    <div class="preview-container mt-2" id="income_proof_preview"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Documents -->
                        <div class="row mt-3">
                            <div class="col-md-12 mb-3">
                                <label for="other_documents" class="form-label">Other Documents (Optional)</label>
                                <input type="file" class="form-control" id="other_documents" name="other_documents[]" 
                                       accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" multiple>
                                <small class="text-muted">Upload any other relevant documents (Multiple files allowed)</small>
                                <div class="preview-container mt-2" id="other_documents_preview"></div>
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
            const response = await fetch('/api/customers', {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                if (response.status === 401) {
                    const errorData = await response.json();
                    if (errorData.redirect) {
                        window.location.href = errorData.redirect;
                        return;
                    }
                }
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            const customers = await response.json();
            
            // Handle error response from server
            if (customers.error) {
                if (customers.redirect) {
                    window.location.href = customers.redirect;
                    return;
                }
                throw new Error(`Server error: ${customers.error}`);
            }
            
            const select = document.getElementById('customer_id');
            select.innerHTML = '<option value="">Select Customer</option>';
            
            const customersList = Array.isArray(customers) ? customers : (customers.data || []);
            customersList.forEach(customer => {
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
            console.log('Loading policy types for category:', category);
            const response = await fetch(`/api/policy-types?category=${category}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                if (response.status === 401) {
                    const errorData = await response.json();
                    if (errorData.redirect) {
                        window.location.href = errorData.redirect;
                        return;
                    }
                }
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            const data = await response.json();
            console.log('Policy types response:', data);
            
            // Handle error response from server
            if (data.error) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }
                throw new Error(`Server error: ${data.error}`);
            }
            
            const policyTypes = Array.isArray(data) ? data : (data.data || []);
            const select = document.getElementById('policyType');
            select.innerHTML = '<option value="">Select Policy Type</option>';
            
            if (policyTypes.length === 0) {
                select.innerHTML += '<option value="" disabled>No policy types available for ' + category + '</option>';
                console.warn('No policy types found for category:', category);
            } else {
                policyTypes.forEach(type => {
                    select.innerHTML += `<option value="${type.id}">${type.name} (${type.code})</option>`;
                });
            }
        } catch (error) {
            console.error('Error loading policy types:', error);
            alert(`Error loading policy types: ${error.message}. Please check the console for details.`);
            
            // Add debug link
            console.log(`Debug URL: /api/debug/policy-types?category=${category}`);
        }
    }

    // Fetch insurance companies based on category
    async function loadInsuranceCompanies(category) {
        try {
            const response = await fetch(`/api/insurance-companies?category=${category}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                if (response.status === 401) {
                    const errorData = await response.json();
                    if (errorData.redirect) {
                        window.location.href = errorData.redirect;
                        return;
                    }
                }
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            const companies = await response.json();
            
            // Handle error response from server
            if (companies.error) {
                if (companies.redirect) {
                    window.location.href = companies.redirect;
                    return;
                }
                throw new Error(`Server error: ${companies.error}`);
            }
            
            const select = document.getElementById('insuranceCompany');
            select.innerHTML = '<option value="">Select Insurance Company</option>';
            
            const companiesList = Array.isArray(companies) ? companies : (companies.data || []);
            companiesList.forEach(company => {
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
    
    // Function to show/hide category-specific document sections
    function updateInsuranceOptions(category) {
        // Update policy types and companies as before
        if (category) {
            loadPolicyTypes(category);
            loadInsuranceCompanies(category);
            
            // Show/hide category-specific document sections
            document.querySelectorAll('.insurance-specific-docs').forEach(section => {
                section.classList.add('d-none');
            });
            
            const docsSection = document.querySelector(`.${category}-documents`);
            if (docsSection) {
                docsSection.classList.remove('d-none');
            }
        }
    }
    
    // Setup file preview functionality for all file inputs
    function setupFilePreview(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);
        
        if (!input || !preview) return;
        
        input.addEventListener('change', function(e) {
            const files = e.target.files;
            preview.innerHTML = '';
            
            if (files.length > 0) {
                Array.from(files).forEach(file => {
                    const reader = new FileReader();
                    
                    if (file.type.startsWith('image/')) {
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.className = 'img-thumbnail me-2 mb-2';
                            img.style.maxWidth = '100px';
                            img.style.maxHeight = '100px';
                            preview.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // For PDF and other files, show file info
                        const fileInfo = document.createElement('div');
                        fileInfo.className = 'file-info me-2 mb-2';
                        fileInfo.innerHTML = `
                            <div class="d-inline-flex align-items-center p-2 bg-light rounded border">
                                <i class="fas fa-file-pdf me-2 text-danger"></i>
                                <div>
                                    <small><strong>${file.name}</strong></small><br>
                                    <small class="text-muted">${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                                </div>
                            </div>
                        `;
                        preview.appendChild(fileInfo);
                    }
                });
            }
        });
    }
    
    // Initialize file previews for all document upload fields
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = [
            'policy_document', 'proposal_form', 'vehicle_rc', 'driving_license',
            'medical_report', 'previous_policy', 'nominee_document', 'income_proof',
            'other_documents'
        ];
        
        fileInputs.forEach(inputId => {
            setupFilePreview(inputId, inputId + '_preview');
        });
        
        // File size validation (10MB limit for policy documents)
        document.querySelectorAll('input[type="file"]').forEach(function(input) {
            input.addEventListener('change', function(e) {
                const files = Array.from(e.target.files);
                const maxSize = 10 * 1024 * 1024; // 10MB
                
                for (let file of files) {
                    if (file.size > maxSize) {
                        alert(`File "${file.name}" is too large. Maximum size allowed is 10MB.`);
                        e.target.value = '';
                        // Clear preview
                        const previewId = e.target.id + '_preview';
                        const preview = document.getElementById(previewId);
                        if (preview) preview.innerHTML = '';
                        return;
                    }
                }
            });
        });
    });
    
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
    
    // Auto-calculate policy end date (start date + 1 year - 1 day)
    document.getElementById('policyStartDate').addEventListener('change', function() {
        const startDate = new Date(this.value);
        const endDate = new Date(startDate);
        endDate.setFullYear(endDate.getFullYear() + 1);
        endDate.setDate(endDate.getDate() - 1); // Subtract 1 day
        
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

<!-- Select2 CSS and JS for searchable dropdowns -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for searchable dropdowns
    $('.select2').select2({
        placeholder: function() {
            return $(this).data('placeholder');
        },
        allowClear: true,
        width: '100%'
    });
});
</script>

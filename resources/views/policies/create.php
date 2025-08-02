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
    <div class="col-lg-8 mx-auto">
        <form id="policyForm" method="POST" enctype="multipart/form-data">
            
            <!-- Step 1: Select Insurance Type -->
            <div class="card mb-4 step" id="step1">
                <div class="card-body">
                    <h5 class="card-title mb-4">
                        <i class="fas fa-clipboard-list text-primary me-2"></i>
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
                </div>
                
                <!-- Step 2: Customer Information -->
                <div class="card mb-4 step d-none" id="step2">
                    <div class="card-body">
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
                                    <select class="form-control select2" id="customer_id" name="customer_id" style="width: 100%;">
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
                </div>
                    
                <!-- Step 3: Policy Details (Dynamic based on insurance type) -->
                <div class="card mb-4 step d-none" id="step3">
                    <div class="card-body">
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
                            
                            <!-- Vehicle Number Field (First in Motor Insurance) -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label class="form-label">Vehicle Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control text-uppercase" name="vehicle_number" id="vehicle_number" 
                                           placeholder="Enter vehicle number (e.g., MH12AB1234)" required>
                                    <small class="form-text text-muted">Enter vehicle number to check for existing policies</small>
                                    <div id="vehicleCheckResult" class="mt-2"></div>
                                </div>
                            </div>
                            
                            <div class="row">
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
                </div>
                    
                <!-- Step 4: Additional Information -->
                <div class="card mb-4 step d-none" id="step4">
                    <div class="card-body">
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
                </div>
            </form>
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
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
    transform: translateY(-2px);
}

.policy-type-option.selected .card-body {
    background-color: #f8f9ff;
}

.policy-type-option.selected h5 {
    color: #007bff;
}

.policy-type-option.selected .form-check-label {
    color: #007bff;
    font-weight: bold;
}

.insurance-specific-fields {
    border-left: 4px solid #007bff;
    padding-left: 20px;
    margin-top: 20px;
}

.step {
    animation: fadeIn 0.3s ease-in-out;
}

#vehicleCheckCard {
    border-left: 4px solid #007bff;
}

.policy-summary p {
    margin-bottom: 0.25rem;
    font-size: 0.9rem;
}

.vehicle-check-input {
    font-family: monospace;
    font-weight: bold;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Fix Select2 dropdown z-index to appear above sidebar */
.select2-container {
    z-index: 9999 !important;
}

.select2-dropdown {
    z-index: 9999 !important;
}

.select2-container--open .select2-dropdown {
    z-index: 9999 !important;
}

/* Ensure Select2 search input is visible */
.select2-search__field {
    z-index: 10000 !important;
}

/* Fix Select2 results container */
.select2-results {
    z-index: 10000 !important;
}

/* Ensure the dropdown is always on top */
.select2-container--open {
    z-index: 9999 !important;
}

/* Fix dropdown positioning relative to its container */
.select2-container .select2-dropdown {
    position: absolute !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vehicle Number Check for Motor Insurance Only
    let currentPolicyData = null;
    let isRenewal = false;
    let vehicleCheckPerformed = false;
    
    // Vehicle number input validation (only for motor insurance)
    document.addEventListener('blur', function(e) {
        if (e.target.id === 'vehicle_number' && e.target.value.trim()) {
            const selectedCategory = document.querySelector('input[name="insurance_category"]:checked')?.value;
            if (selectedCategory === 'motor' && !vehicleCheckPerformed) {
                checkVehicleNumber(e.target.value.trim().toUpperCase());
            }
        }
    }, true);
    
    // Check vehicle number for existing policies
    async function checkVehicleNumber(vehicleNumber) {
        if (vehicleNumber.length < 6) {
            return;
        }
        
        const resultDiv = document.getElementById('vehicleCheckResult');
        resultDiv.innerHTML = '<div class="spinner-border spinner-border-sm me-2"></div>Checking for existing policies...';
        
        try {
            const response = await fetch(`/api/check-vehicle?vehicle_number=${encodeURIComponent(vehicleNumber)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                credentials: 'same-origin'
            });
            
            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }
            
            const result = await response.json();
            vehicleCheckPerformed = true;
            
            if (result.exists) {
                currentPolicyData = result.policy;
                showRenewalDialog(result);
            } else {
                showNewPolicyMessage();
            }
            
        } catch (error) {
            console.error('Error checking vehicle:', error);
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    Error checking vehicle: ${error.message}
                </div>
            `;
        }
    }
    
    // Show renewal dialog
    function showRenewalDialog(result) {
        const resultDiv = document.getElementById('vehicleCheckResult');
        const policy = result.policy;
        
        const statusBadge = policy.status === 'active' ? 
            '<span class="badge bg-success">Active</span>' : 
            result.is_expired ? '<span class="badge bg-danger">Expired</span>' : 
            '<span class="badge bg-warning">Expiring Soon</span>';
        
        const renewalMessage = result.is_expired ? 
            'This policy has expired. Would you like to renew it?' :
            `This policy expires in ${result.days_to_expiry} days. Would you like to renew it?`;
        
        resultDiv.innerHTML = `
            <div class="alert alert-warning mt-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Existing Policy Found!</h6>
                        <div class="policy-summary">
                            <p><strong>Policy Number:</strong> ${policy.policy_number} ${statusBadge}</p>
                            <p><strong>Customer:</strong> ${policy.customer_name} (${policy.customer_phone})</p>
                            <p><strong>Company:</strong> ${policy.insurance_company_name}</p>
                            <p><strong>Policy Period:</strong> ${new Date(policy.policy_start_date).toLocaleDateString()} - ${new Date(policy.policy_end_date).toLocaleDateString()}</p>
                            <p><strong>Premium:</strong> ₹${parseFloat(policy.premium_amount).toLocaleString()}</p>
                        </div>
                        <p class="mb-2"><strong>${renewalMessage}</strong></p>
                    </div>
                    <div class="col-md-4 d-flex flex-column gap-2">
                        <button type="button" class="btn btn-primary btn-sm" onclick="startRenewal()">
                            <i class="fas fa-sync-alt me-2"></i>Yes, Renew Policy
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="continueNewPolicy()">
                            <i class="fas fa-plus me-2"></i>Create New Policy
                        </button>
                    </div>
                </div>
            </div>
        `;
    }
    
    // Show new policy message
    function showNewPolicyMessage() {
        const resultDiv = document.getElementById('vehicleCheckResult');
        resultDiv.innerHTML = `
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle me-2"></i>
                No existing policy found for this vehicle. Continue with new policy creation.
            </div>
        `;
        isRenewal = false;
        currentPolicyData = null;
    }
    
    // Start renewal process
    window.startRenewal = function() {
        if (!currentPolicyData) return;
        
        isRenewal = true;
        
        // Populate form with existing data
        populateRenewalData();
        
        // Show renewal banner
        showRenewalBanner();
        
        // Update submit button
        updateSubmitButton();
        
        // Hide the renewal dialog
        document.getElementById('vehicleCheckResult').innerHTML = `
            <div class="alert alert-info mt-3">
                <i class="fas fa-sync-alt me-2"></i>
                Renewing policy <strong>${currentPolicyData.policy_number}</strong> for vehicle <strong>${currentPolicyData.vehicle_number}</strong>
            </div>
        `;
    };
    
    // Continue with new policy
    window.continueNewPolicy = function() {
        isRenewal = false;
        currentPolicyData = null;
        showNewPolicyMessage();
    };
    
    // Populate form with renewal data
    function populateRenewalData() {
        if (!currentPolicyData) return;
        
        const policy = currentPolicyData;
        
        // Set dates for renewal (start from today, end date 1 year from today)
        const today = new Date();
        const nextYear = new Date(today);
        nextYear.setFullYear(today.getFullYear() + 1);
        
        setTimeout(() => {
            // Vehicle details
            if (policy.vehicle_type) {
                const vehicleTypeSelect = document.querySelector('select[name="vehicle_type"]');
                if (vehicleTypeSelect) {
                    vehicleTypeSelect.value = policy.vehicle_type;
                }
            }
            
            // Policy dates
            const startDateField = document.getElementById('policyStartDate');
            const endDateField = document.getElementById('policyEndDate');
            if (startDateField) startDateField.value = today.toISOString().split('T')[0];
            if (endDateField) endDateField.value = nextYear.toISOString().split('T')[0];
            
            // Premium (keep same or allow editing)
            const premiumField = document.querySelector('input[name="premium_amount"]');
            if (premiumField && policy.premium_amount) {
                premiumField.value = policy.premium_amount;
            }
            
            // Sum assured
            const sumAssuredField = document.querySelector('input[name="sum_assured"]');
            if (sumAssuredField && policy.sum_assured) {
                sumAssuredField.value = policy.sum_assured;
            }
            
            // Commission percentage
            const commissionField = document.querySelector('input[name="commission_percentage"]');
            if (commissionField && policy.commission_percentage) {
                commissionField.value = policy.commission_percentage;
            }
            
            // Coverage type
            if (policy.coverage_type) {
                const coverageSelect = document.querySelector('select[name="coverage_type"]');
                if (coverageSelect) {
                    coverageSelect.value = policy.coverage_type;
                }
            }
            
            // Plan name
            if (policy.plan_name) {
                const planNameField = document.querySelector('input[name="plan_name"]');
                if (planNameField) {
                    planNameField.value = policy.plan_name;
                }
            }
            
            // Pre-select insurance company and agent
            setTimeout(() => {
                if (policy.insurance_company_id) {
                    const companySelect = document.getElementById('insuranceCompany');
                    if (companySelect) {
                        companySelect.value = policy.insurance_company_id;
                        $(companySelect).trigger('change');
                    }
                }
                
                if (policy.agent_id) {
                    const agentSelect = document.getElementById('agentSelect');
                    if (agentSelect) {
                        agentSelect.value = policy.agent_id;
                        $(agentSelect).trigger('change');
                    }
                }
            }, 1000);
            
        }, 500);
    }
    
    // Show renewal banner
    function showRenewalBanner() {
        // Remove existing banner if any
        const existingBanner = document.querySelector('.renewal-banner');
        if (existingBanner) existingBanner.remove();
        
        const banner = document.createElement('div');
        banner.className = 'alert alert-info mb-4 renewal-banner';
        banner.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fas fa-sync-alt fa-2x me-3 text-primary"></i>
                <div>
                    <h5 class="mb-1">Policy Renewal Mode</h5>
                    <p class="mb-0">You are renewing policy <strong>${currentPolicyData.policy_number}</strong> for vehicle <strong>${currentPolicyData.vehicle_number}</strong></p>
                </div>
            </div>
        `;
        
        const step3 = document.getElementById('step3');
        if (step3) {
            step3.insertBefore(banner, step3.firstChild.nextSibling);
        }
    }

    // Step navigation functions
    function showStep1() {
        hideAllSteps();
        const step1 = document.getElementById('step1');
        if (step1) {
            step1.style.display = 'block';
            step1.classList.remove('d-none');
            updateProgressBar(1);
        } else {
            console.error('Step 1 element not found');
        }
    }

    // Show step based on insurance category
    function showInsuranceStep(category) {
        hideAllSteps();
        
        // Show step 2 (customer information)
        document.getElementById('step2').style.display = 'block';
        updateProgressBar(2);
        
        // Store selected category for step 3
        sessionStorage.setItem('selectedInsuranceCategory', category);
    }

    function showStep3() {
        hideAllSteps();
        const step3 = document.getElementById('step3');
        if (step3) {
            step3.style.display = 'block';
            step3.classList.remove('d-none');
            updateProgressBar(3);
        }
        
        // Show specific fields based on selected category
        const selectedCategory = sessionStorage.getItem('selectedInsuranceCategory');
        showInsuranceFields(selectedCategory);
    }

    function showStep4() {
        hideAllSteps();
        const step4 = document.getElementById('step4');
        if (step4) {
            step4.style.display = 'block';
            step4.classList.remove('d-none');
            updateProgressBar(4);
        }
    }

    function hideAllSteps() {
        const steps = document.querySelectorAll('.step');
        steps.forEach(step => {
            step.style.display = 'none';
            step.classList.add('d-none');
        });
    }

    function showInsuranceFields(category) {
        // Hide all insurance-specific fields first
        document.querySelectorAll('.insurance-specific-fields').forEach(field => {
            field.classList.add('d-none');
        });
        
        // Show specific fields based on category
        if (category === 'motor') {
            document.getElementById('motorFields').classList.remove('d-none');
        } else if (category === 'health') {
            document.getElementById('healthFields').classList.remove('d-none');
        } else if (category === 'life') {
            document.getElementById('lifeFields').classList.remove('d-none');
        }
    }

    function updateProgressBar(currentStep) {
        const progressBar = document.querySelector('.progress-bar');
        if (progressBar) {
            const percentage = (currentStep / 4) * 100;
            progressBar.style.width = percentage + '%';
            progressBar.setAttribute('aria-valuenow', percentage);
        }
        
        // Update step indicators if they exist
        for (let i = 1; i <= 4; i++) {
            const stepIndicator = document.querySelector(`.step-indicator[data-step="${i}"]`);
            if (stepIndicator) {
                if (i < currentStep) {
                    stepIndicator.className = 'step-indicator completed';
                } else if (i === currentStep) {
                    stepIndicator.className = 'step-indicator active';
                } else {
                    stepIndicator.className = 'step-indicator';
                }
            }
        }
    }

    // Update submit button for renewal
    function updateSubmitButton() {
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn && isRenewal) {
            submitBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Renew Policy';
            submitBtn.className = 'btn btn-success btn-lg';
        }
    }

    // Insurance category change handler
    document.addEventListener('change', function(e) {
        if (e.target.name === 'insurance_category') {
            // Enable the Next Step button
            const nextBtn = document.getElementById('nextStep1');
            if (nextBtn) {
                nextBtn.disabled = false;
                nextBtn.classList.add('btn-primary');
                nextBtn.classList.remove('btn-secondary');
            }
            
            // Add visual feedback to selected card
            document.querySelectorAll('.policy-type-option').forEach(card => {
                card.classList.remove('selected');
            });
            
            const selectedCard = e.target.closest('.policy-type-card').querySelector('.policy-type-option');
            if (selectedCard) {
                selectedCard.classList.add('selected');
            }
            
            // Store the selected category
            sessionStorage.setItem('selectedInsuranceCategory', e.target.value);
        }
    });

    // Make policy type cards clickable
    document.addEventListener('click', function(e) {
        // Handle clicking on policy type cards
        if (e.target.closest('.policy-type-card')) {
            const card = e.target.closest('.policy-type-card');
            const category = card.getAttribute('data-category');
            const radioButton = document.getElementById(category);
            
            if (radioButton && !radioButton.checked) {
                radioButton.checked = true;
                
                // Trigger change event
                const changeEvent = new Event('change', { bubbles: true });
                radioButton.dispatchEvent(changeEvent);
            }
            return;
        }
        
        // Handle Next Step button for Step 1
        if (e.target.id === 'nextStep1') {
            const selectedCategory = document.querySelector('input[name="insurance_category"]:checked');
            if (selectedCategory) {
                showStep2(); // Go directly to step 2 (customer information)
            } else {
                alert('Please select an insurance category');
            }
        }
        
        if (e.target.classList.contains('btn-next')) {
            const currentStep = e.target.closest('.step').id;
            
            if (currentStep === 'step1') {
                const selectedCategory = document.querySelector('input[name="insurance_category"]:checked');
                if (selectedCategory) {
                    showInsuranceStep(selectedCategory.value);
                } else {
                    alert('Please select an insurance category');
                }
            } else if (currentStep === 'step2') {
                showStep3();
            } else if (currentStep === 'step3') {
                showStep4();
            }
        }
        
        // Handle Previous buttons
        if (e.target.classList.contains('btn-prev')) {
            const currentStep = e.target.closest('.step').id;
            
            if (currentStep === 'step4') {
                showStep3();
            } else if (currentStep === 'step3') {
                showStep2();
            } else if (currentStep === 'step2') {
                showStep1();
            }
        }
        
        // Handle specific step navigation buttons
        if (e.target.id === 'nextStep2') {
            // Validate customer selection before proceeding
            const customerOption = document.querySelector('input[name="customer_option"]:checked')?.value;
            
            if (customerOption === 'existing') {
                const customerSelect = document.getElementById('customer_id');
                if (!customerSelect.value) {
                    alert('Please select a customer from the dropdown');
                    return;
                }
            } else {
                const customerName = document.querySelector('input[name="customer_name"]').value;
                const customerPhone = document.querySelector('input[name="customer_phone"]').value;
                const customerEmail = document.querySelector('input[name="customer_email"]').value;
                
                if (!customerName || !customerPhone || !customerEmail) {
                    alert('Please fill in all required customer information');
                    return;
                }
            }
            
            showStep3();
        }
        if (e.target.id === 'prevStep2') {
            showStep1();
        }
        if (e.target.id === 'nextStep3') {
            showStep4();
        }
        if (e.target.id === 'prevStep3') {
            showStep2();
        }
    });
    
    // Helper function for step 2
    function showStep2() {
        hideAllSteps();
        const step2 = document.getElementById('step2');
        if (step2) {
            step2.style.display = 'block';
            step2.classList.remove('d-none');
            updateProgressBar(2);
        } else {
            console.error('Step 2 element not found');
        }
    }

    // Form submission handler
    document.getElementById('policyForm').addEventListener('submit', function(e) {
        if (isRenewal && currentPolicyData) {
            // Add renewal flag and original policy ID to form data
            const renewalInput = document.createElement('input');
            renewalInput.type = 'hidden';
            renewalInput.name = 'is_renewal';
            renewalInput.value = '1';
            this.appendChild(renewalInput);
            
            const originalPolicyInput = document.createElement('input');
            originalPolicyInput.type = 'hidden';
            originalPolicyInput.name = 'original_policy_id';
            originalPolicyInput.value = currentPolicyData.id;
            this.appendChild(originalPolicyInput);
        }
    });

    // Initialize form
    showStep1();

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
            select.innerHTML = '<option value="">Search and select customer...</option>';
            
            const customersList = Array.isArray(customers) ? customers : (customers.data || []);
            customersList.forEach(customer => {
                select.innerHTML += `<option value="${customer.id}">${customer.customer_code} - ${customer.name} (${customer.phone})</option>`;
            });
            
            // Reinitialize Select2 after loading options
            if (window.jQuery && window.jQuery.fn.select2) {
                const $select = $(select);
                // Destroy existing Select2 if present
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }
                // Initialize Select2 with search
                $select.select2({
                    placeholder: 'Search and select customer...',
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0,
                    dropdownAutoWidth: true,
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                });
                
                // Add event listener for customer selection
                $select.on('select2:select', function(e) {
                    const selectedData = e.params.data;
                    console.log('Customer selected:', selectedData);
                });
                
                $select.on('select2:clear', function(e) {
                    console.log('Customer selection cleared');
                });
            }
        } catch (error) {
            console.error('Error loading customers:', error);
            const select = document.getElementById('customer_id');
            select.innerHTML = '<option value="">Error loading customers</option>';
            
            // Reinitialize Select2 even in error case
            if (window.jQuery && window.jQuery.fn.select2) {
                const $select = $(select);
                if ($select.hasClass('select2-hidden-accessible')) {
                    $select.select2('destroy');
                }
                $select.select2({
                    placeholder: 'Error loading customers',
                    allowClear: true,
                    width: '100%',
                    minimumResultsForSearch: 0,
                    dropdownAutoWidth: true,
                    escapeMarkup: function(markup) {
                        return markup;
                    }
                });
            }
            
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
                
                // Make customer_id required and customer fields not required
                const customerSelect = document.getElementById('customer_id');
                if (customerSelect) {
                    customerSelect.required = true;
                }
                
                // Make new customer fields not required
                const customerNameField = document.querySelector('input[name="customer_name"]');
                const customerPhoneField = document.querySelector('input[name="customer_phone"]');
                const customerEmailField = document.querySelector('input[name="customer_email"]');
                const customerDobField = document.querySelector('input[name="customer_dob"]');
                const customerGenderField = document.querySelector('select[name="customer_gender"]');
                const customerOccupationField = document.querySelector('input[name="customer_occupation"]');
                const customerAddressField = document.querySelector('textarea[name="customer_address"]');
                const customerCityField = document.querySelector('input[name="customer_city"]');
                const customerPincodeField = document.querySelector('input[name="customer_pincode"]');
                
                if (customerNameField) customerNameField.required = false;
                if (customerPhoneField) customerPhoneField.required = false;
                if (customerEmailField) customerEmailField.required = false;
                if (customerDobField) customerDobField.required = false;
                if (customerGenderField) customerGenderField.required = false;
                if (customerOccupationField) customerOccupationField.required = false;
                if (customerAddressField) customerAddressField.required = false;
                if (customerCityField) customerCityField.required = false;
                if (customerPincodeField) customerPincodeField.required = false;
                
            } else {
                existingSection.classList.add('d-none');
                newSection.classList.remove('d-none');
                
                // Make customer_id not required
                const customerSelect = document.getElementById('customer_id');
                if (customerSelect) {
                    customerSelect.required = false;
                }
                
                // Make new customer fields required
                const customerNameField = document.querySelector('input[name="customer_name"]');
                const customerPhoneField = document.querySelector('input[name="customer_phone"]');
                const customerEmailField = document.querySelector('input[name="customer_email"]');
                const customerDobField = document.querySelector('input[name="customer_dob"]');
                const customerGenderField = document.querySelector('select[name="customer_gender"]');
                const customerOccupationField = document.querySelector('input[name="customer_occupation"]');
                const customerAddressField = document.querySelector('textarea[name="customer_address"]');
                const customerCityField = document.querySelector('input[name="customer_city"]');
                const customerPincodeField = document.querySelector('input[name="customer_pincode"]');
                
                if (customerNameField) customerNameField.required = true;
                if (customerPhoneField) customerPhoneField.required = true;
                if (customerEmailField) customerEmailField.required = true;
                if (customerDobField) customerDobField.required = true;
                if (customerGenderField) customerGenderField.required = true;
                if (customerOccupationField) customerOccupationField.required = true;
                if (customerAddressField) customerAddressField.required = true;
                if (customerCityField) customerCityField.required = true;
                if (customerPincodeField) customerPincodeField.required = true;
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
        // Add renewal data if this is a renewal
        if (isRenewal && currentPolicyData) {
            // Add hidden fields for renewal
            const renewalInput = document.createElement('input');
            renewalInput.type = 'hidden';
            renewalInput.name = 'is_renewal';
            renewalInput.value = '1';
            this.appendChild(renewalInput);
            
            const originalPolicyInput = document.createElement('input');
            originalPolicyInput.type = 'hidden';
            originalPolicyInput.name = 'original_policy_id';
            originalPolicyInput.value = currentPolicyData.id;
            this.appendChild(originalPolicyInput);
            
            const originalPolicyNumberInput = document.createElement('input');
            originalPolicyNumberInput.type = 'hidden';
            originalPolicyNumberInput.name = 'original_policy_number';
            originalPolicyNumberInput.value = currentPolicyData.policy_number;
            this.appendChild(originalPolicyNumberInput);
        }
        
        // Add any additional validation here
        const submitBtn = document.getElementById('submitPolicy');
        submitBtn.innerHTML = isRenewal ? 
            '<i class="fas fa-spinner fa-spin me-2"></i>Renewing Policy...' : 
            '<i class="fas fa-spinner fa-spin me-2"></i>Creating Policy...';
        submitBtn.disabled = true;
    });
    
    // Phone number validation
    document.querySelector('input[name="customer_phone"]').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });
    
    // Vehicle number formatting for both fields
    document.getElementById('vehicle_number_check').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });
    
    const vehicleDisplayField = document.getElementById('vehicle_number_display');
    if (vehicleDisplayField) {
        vehicleDisplayField.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    }
    
    // Update submit button text based on renewal status
    function updateSubmitButton() {
        const submitBtn = document.getElementById('submitPolicy');
        if (isRenewal) {
            submitBtn.innerHTML = '<i class="fas fa-sync-alt me-2"></i>Renew Policy';
            submitBtn.className = 'btn btn-warning';
        } else {
            submitBtn.innerHTML = '<i class="fas fa-save me-2"></i>Create Policy';
            submitBtn.className = 'btn btn-success';
        }
    }
    
    // Call this when renewal status changes
    window.updateSubmitButton = updateSubmitButton;
});
</script>

<!-- Select2 CSS and JS for searchable dropdowns -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2 for searchable dropdowns (except customer dropdown which has special handling)
    $('.select2:not(#customer_id)').select2({
        placeholder: function() {
            return $(this).data('placeholder') || 'Search and select...';
        },
        allowClear: true,
        width: '100%',
        minimumResultsForSearch: 0
    });
    
    // Initialize customer dropdown specifically (if not already initialized)
    const customerSelect = $('#customer_id');
    if (customerSelect.length && !customerSelect.hasClass('select2-hidden-accessible')) {
        customerSelect.select2({
            placeholder: 'Search and select customer...',
            allowClear: true,
            width: '100%',
            minimumResultsForSearch: 0,
            dropdownAutoWidth: true,
            escapeMarkup: function(markup) {
                return markup;
            }
        });
    }
});
</script>

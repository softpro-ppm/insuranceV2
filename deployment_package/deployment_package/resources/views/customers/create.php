<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Add New Customer</h2>
            <a href="/customers" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Customers
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/customers/store" class="needs-validation" novalidate>
                    <!-- Basic Information -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-user me-2"></i>Basic Information
                            </h5>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <div class="invalid-feedback">
                                Please provide a valid name.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{10}" required>
                            <div class="invalid-feedback">
                                Please provide a valid 10-digit phone number.
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="alternate_phone" class="form-label">Alternate Phone</label>
                            <input type="tel" class="form-control" id="alternate_phone" name="alternate_phone" pattern="[0-9]{10}">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="date_of_birth" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" max="<?= date('Y-m-d') ?>">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
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
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter complete address"></textarea>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-control" id="state" name="state">
                                <option value="">Select State</option>
                                <option value="Andhra Pradesh">Andhra Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West Bengal</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Puducherry">Puducherry</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" pattern="[0-9]{6}" maxlength="6">
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
                                   pattern="[0-9]{12}" maxlength="12" placeholder="XXXX XXXX XXXX">
                            <small class="form-text text-muted">12-digit Aadhar number</small>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pan_number" class="form-label">PAN Number</label>
                            <input type="text" class="form-control" id="pan_number" name="pan_number" 
                                   pattern="[A-Z]{5}[0-9]{4}[A-Z]{1}" maxlength="10" placeholder="ABCDE1234F" style="text-transform: uppercase;">
                            <small class="form-text text-muted">10-character PAN number</small>
                        </div>
                    </div>

                    <!-- KYC Documents Upload -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="text-primary mb-3">
                                <i class="fas fa-file-upload me-2"></i>Upload KYC Documents
                            </h5>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="aadhar_document" class="form-label">
                                Aadhar Card Document <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="aadhar_document" name="aadhar_document" 
                                   accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="form-text text-muted">Upload Aadhar card (PDF, JPG, PNG - Max 5MB)</small>
                            <div class="preview-container mt-2" id="aadhar_preview"></div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="pan_document" class="form-label">
                                PAN Card Document <span class="text-danger">*</span>
                            </label>
                            <input type="file" class="form-control" id="pan_document" name="pan_document" 
                                   accept=".pdf,.jpg,.jpeg,.png" required>
                            <small class="form-text text-muted">Upload PAN card (PDF, JPG, PNG - Max 5MB)</small>
                            <div class="preview-container mt-2" id="pan_preview"></div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="passport_document" class="form-label">Passport (Optional)</label>
                            <input type="file" class="form-control" id="passport_document" name="passport_document" 
                                   accept=".pdf,.jpg,.jpeg,.png">
                            <small class="form-text text-muted">Upload passport if available (PDF, JPG, PNG - Max 5MB)</small>
                            <div class="preview-container mt-2" id="passport_preview"></div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="driving_license_document" class="form-label">Driving License (Optional)</label>
                            <input type="file" class="form-control" id="driving_license_document" name="driving_license_document" 
                                   accept=".pdf,.jpg,.jpeg,.png">
                            <small class="form-text text-muted">Upload driving license (PDF, JPG, PNG - Max 5MB)</small>
                            <div class="preview-container mt-2" id="driving_license_preview"></div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="/customers" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Create Customer
                                </button>
                            </div>
                        </div>
                    </div>
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

// Format PAN number to uppercase
document.getElementById('pan_number').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase();
});

// File upload preview functionality
setupFilePreview('aadhar_document', 'aadhar_preview');
setupFilePreview('pan_document', 'pan_preview');
setupFilePreview('passport_document', 'passport_preview');
setupFilePreview('driving_license_document', 'driving_license_preview');

// Validate file sizes (5MB limit)
document.querySelectorAll('input[type="file"]').forEach(function(input) {
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && file.size > 5 * 1024 * 1024) {
            alert('File size must be less than 5MB');
            e.target.value = '';
            // Clear preview
            const previewId = e.target.id + '_preview';
            const preview = document.getElementById(previewId);
            if (preview) preview.innerHTML = '';
            return;
        }
    });
});

function setupFilePreview(inputId, previewId) {
    const input = document.getElementById(inputId);
    const preview = document.getElementById(previewId);
    
    if (!input || !preview) return;
    
    input.addEventListener('change', function(e) {
        const file = e.target.files[0];
        preview.innerHTML = '';
        
        if (file) {
            const reader = new FileReader();
            
            if (file.type.startsWith('image/')) {
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '150px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            } else {
                // For PDF and other files, show file info
                const fileInfo = document.createElement('div');
                fileInfo.className = 'file-info';
                fileInfo.innerHTML = `
                    <div class="d-flex align-items-center p-2 bg-light rounded">
                        <i class="fas fa-file-pdf me-2 text-danger"></i>
                        <div>
                            <strong>${file.name}</strong><br>
                            <small class="text-muted">Size: ${(file.size / 1024 / 1024).toFixed(2)} MB</small>
                        </div>
                    </div>
                `;
                preview.appendChild(fileInfo);
            }
        }
    });
}

// Format PAN number
document.getElementById('pan_number').addEventListener('input', function(e) {
    this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
});

// Format pincode
document.getElementById('pincode').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>

<style>
.preview-container {
    max-height: 200px;
    overflow: hidden;
    border-radius: 4px;
    margin-top: 0.5rem;
}

.preview-container img {
    max-width: 100%;
    max-height: 150px;
    object-fit: cover;
    border-radius: 4px;
}

.file-info {
    font-size: 0.875rem;
}

.file-info .bg-light {
    background-color: #f8f9fa !important;
}

/* Upload area styling */
input[type="file"] {
    padding: 0.375rem 0.75rem;
}

input[type="file"]:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policy Certificate - <?= htmlspecialchars($policy['policy_number']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .btn, .no-print {
                display: none !important;
            }
            .card {
                border: 1px solid #000 !important;
                page-break-inside: avoid;
            }
            body {
                font-size: 12px;
            }
        }
        
        .certificate-header {
            text-align: center;
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .certificate-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        
        .policy-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #dc3545;
            border: 2px solid #dc3545;
            padding: 10px 20px;
            display: inline-block;
            margin: 20px 0;
        }
        
        .info-table th {
            background-color: #f8f9fa;
            font-weight: bold;
            width: 30%;
        }
        
        .signature-section {
            margin-top: 50px;
            border-top: 2px solid #007bff;
            padding-top: 30px;
        }
        
        .signature-box {
            border: 1px solid #ddd;
            height: 80px;
            margin-top: 20px;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 5rem;
            color: rgba(0, 123, 255, 0.1);
            font-weight: bold;
            z-index: -1;
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-4">
        <!-- Print Button -->
        <div class="no-print mb-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print me-2"></i>Print Certificate
            </button>
            <button onclick="window.close()" class="btn btn-secondary ms-2">
                <i class="fas fa-times me-2"></i>Close
            </button>
        </div>

        <!-- Certificate Content -->
        <div class="card shadow position-relative">
            <!-- Watermark -->
            <div class="watermark">INSURANCE CERTIFICATE</div>
            
            <div class="card-body p-5">
                <!-- Header -->
                <div class="certificate-header">
                    <h1 class="certificate-title">INSURANCE CERTIFICATE</h1>
                    <p class="lead mb-0">This certifies that the following policy is in force</p>
                    <div class="policy-number">
                        Policy No: <?= htmlspecialchars($policy['policy_number']) ?>
                    </div>
                </div>

                <!-- Policy Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-primary mb-3">
                            <i class="fas fa-file-contract me-2"></i>Policy Information
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Policy Number</th>
                                <td><?= htmlspecialchars($policy['policy_number']) ?></td>
                                <th>Category</th>
                                <td>
                                    <i class="fas fa-<?= $policy['category'] === 'motor' ? 'car' : ($policy['category'] === 'health' ? 'heartbeat' : 'shield-alt') ?> me-2 text-primary"></i>
                                    <?= ucfirst($policy['category']) ?> Insurance
                                </td>
                            </tr>
                            <tr>
                                <th>Insurance Company</th>
                                <td colspan="3"><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <th>Policy Type</th>
                                <td><?= htmlspecialchars($policy['policy_type_name'] ?? 'N/A') ?></td>
                                <th>Status</th>
                                <td>
                                    <strong class="text-<?= $policy['status'] === 'active' ? 'success' : ($policy['status'] === 'pending' ? 'warning' : 'danger') ?>">
                                        <?= ucfirst($policy['status']) ?>
                                    </strong>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-success mb-3">
                            <i class="fas fa-user me-2"></i>Insured Person Details
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Name</th>
                                <td><?= htmlspecialchars($policy['customer_name'] ?? 'N/A') ?></td>
                                <th>Phone</th>
                                <td><?= htmlspecialchars($policy['customer_phone'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td><?= htmlspecialchars($policy['customer_email'] ?? 'N/A') ?></td>
                                <th>Date of Birth</th>
                                <td><?= $policy['customer_dob'] ? date('d-m-Y', strtotime($policy['customer_dob'])) : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td colspan="3">
                                    <?= htmlspecialchars($policy['customer_address'] ?? 'N/A') ?>
                                    <?php if ($policy['customer_city']): ?>
                                        <br><?= htmlspecialchars($policy['customer_city']) ?>
                                        <?= $policy['customer_state'] ? ', ' . htmlspecialchars($policy['customer_state']) : '' ?>
                                        <?= $policy['customer_pincode'] ? ' - ' . htmlspecialchars($policy['customer_pincode']) : '' ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Category Specific Information -->
                <?php if ($policy['category'] === 'motor'): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-warning mb-3">
                            <i class="fas fa-car me-2"></i>Vehicle Details
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Vehicle Number</th>
                                <td><strong class="font-monospace"><?= htmlspecialchars($policy['vehicle_number'] ?? 'N/A') ?></strong></td>
                                <th>Vehicle Type</th>
                                <td><?= htmlspecialchars($policy['vehicle_type'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <th>Make & Model</th>
                                <td><?= htmlspecialchars(($policy['vehicle_make'] ?? '') . ' ' . ($policy['vehicle_model'] ?? '')) ?: 'N/A' ?></td>
                                <th>Year</th>
                                <td><?= htmlspecialchars($policy['vehicle_year'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <th>Fuel Type</th>
                                <td><?= htmlspecialchars($policy['fuel_type'] ?? 'N/A') ?></td>
                                <th>Engine No.</th>
                                <td><?= htmlspecialchars($policy['engine_number'] ?? 'N/A') ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php elseif ($policy['category'] === 'health'): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-info mb-3">
                            <i class="fas fa-heartbeat me-2"></i>Health Plan Details
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Plan Name</th>
                                <td><?= htmlspecialchars($policy['plan_name'] ?? 'N/A') ?></td>
                                <th>Coverage Type</th>
                                <td><?= htmlspecialchars($policy['coverage_type'] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <th>Room Rent Limit</th>
                                <td colspan="3">
                                    <?= $policy['room_rent_limit'] ? '₹' . number_format($policy['room_rent_limit']) . ' per day' : 'Not specified' ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php elseif ($policy['category'] === 'life'): ?>
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-secondary mb-3">
                            <i class="fas fa-shield-alt me-2"></i>Life Insurance Details
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Policy Term</th>
                                <td><?= $policy['policy_term'] ? $policy['policy_term'] . ' years' : 'N/A' ?></td>
                                <th>Premium Payment Term</th>
                                <td><?= $policy['premium_payment_term'] ? $policy['premium_payment_term'] . ' years' : 'N/A' ?></td>
                            </tr>
                            <tr>
                                <th>Maturity Amount</th>
                                <td><?= $policy['maturity_amount'] ? '₹' . number_format($policy['maturity_amount']) : 'N/A' ?></td>
                                <th>Death Benefit</th>
                                <td><?= $policy['death_benefit'] ? '₹' . number_format($policy['death_benefit']) : 'N/A' ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Financial Details -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-success mb-3">
                            <i class="fas fa-money-bill-wave me-2"></i>Financial Details
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Premium Amount</th>
                                <td><strong class="text-success fs-5">₹<?= number_format($policy['premium_amount'] ?? 0) ?></strong></td>
                                <th>Sum Insured</th>
                                <td><strong class="text-primary fs-5">₹<?= number_format($policy['sum_insured'] ?? 0) ?></strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Policy Timeline -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="text-info mb-3">
                            <i class="fas fa-calendar-alt me-2"></i>Policy Timeline
                        </h4>
                        <table class="table table-bordered info-table">
                            <tr>
                                <th>Policy Start Date</th>
                                <td><?= date('d-m-Y', strtotime($policy['policy_start_date'])) ?></td>
                                <th>Policy End Date</th>
                                <td><?= date('d-m-Y', strtotime($policy['policy_end_date'])) ?></td>
                            </tr>
                            <tr>
                                <th>Issue Date</th>
                                <td><?= date('d-m-Y', strtotime($policy['created_at'])) ?></td>
                                <th>Validity</th>
                                <td>
                                    <?php 
                                    $days_to_expiry = ceil((strtotime($policy['policy_end_date']) - time()) / (60 * 60 * 24));
                                    if ($days_to_expiry > 0) {
                                        echo "<strong class='text-success'>Valid for {$days_to_expiry} more days</strong>";
                                    } else {
                                        echo "<strong class='text-danger'>Expired " . abs($days_to_expiry) . " days ago</strong>";
                                    }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Important Notes -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <h5><i class="fas fa-info-circle me-2"></i>Important Notes:</h5>
                            <ul class="mb-0">
                                <li>This certificate is valid only if the policy is in force and premiums are paid up to date.</li>
                                <li>Claims are subject to policy terms and conditions.</li>
                                <li>For any queries or claims, please contact the insurance company or our office.</li>
                                <li>This is a computer-generated certificate and does not require a signature.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="signature-section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="signature-box d-flex align-items-end justify-content-center">
                                    <small class="text-muted">Authorized Signature</small>
                                </div>
                                <p class="mt-2 mb-0"><strong>Insurance Agent</strong></p>
                                <small class="text-muted"><?= htmlspecialchars($policy['agent_name'] ?? 'N/A') ?></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-center">
                                <div class="signature-box d-flex align-items-end justify-content-center">
                                    <small class="text-muted">Company Seal</small>
                                </div>
                                <p class="mt-2 mb-0"><strong>Insurance Company</strong></p>
                                <small class="text-muted"><?= htmlspecialchars($policy['company_name'] ?? 'N/A') ?></small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <small class="text-muted">
                            Generated on <?= date('d-m-Y \a\t H:i') ?> | 
                            Insurance Management System v2.0
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-print when page loads (optional)
        // window.onload = function() {
        //     window.print();
        // }
    </script>
</body>
</html>

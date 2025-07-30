<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-dark mb-0">Customer Management</h2>
            <div>
                <a href="/customers/create" class="btn btn-primary">
                    <i class="fas fa-user-plus me-2"></i>Add New Customer
                </a>
                <button class="btn btn-success" onclick="exportCustomers()">
                    <i class="fas fa-download me-2"></i>Export
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filters -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="/customers" class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Search Customers</label>
                        <input type="text" class="form-control" name="search" 
                               value="<?= htmlspecialchars($search ?? '') ?>" 
                               placeholder="Search by name, phone, email, or customer code...">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search me-2"></i>Search
                            </button>
                            <a href="/customers" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Clear
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Results</label>
                        <div class="form-control-plaintext">
                            <strong><?= number_format($totalCount ?? 0) ?></strong> customers found
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Customers Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php if (empty($customers)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-muted mb-4"></i>
                        <h4 class="text-muted">No customers found</h4>
                        <p class="text-muted mb-4">Start by adding your first customer!</p>
                        <a href="/customers/create" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Add First Customer
                        </a>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Customer Code</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Policies</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($customers as $customer): ?>
                                    <tr>
                                        <td>
                                            <span class="badge bg-primary"><?= htmlspecialchars($customer['customer_code']) ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-initial rounded-circle bg-primary text-white me-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                                    <?= strtoupper(substr($customer['name'], 0, 2)) ?>
                                                </div>
                                                <div>
                                                    <strong><?= htmlspecialchars($customer['name']) ?></strong>
                                                    <?php if ($customer['gender']): ?>
                                                        <small class="text-muted d-block"><?= ucfirst($customer['gender']) ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="tel:<?= $customer['phone'] ?>" class="text-decoration-none">
                                                <?= htmlspecialchars($customer['phone']) ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php if ($customer['email']): ?>
                                                <a href="mailto:<?= $customer['email'] ?>" class="text-decoration-none">
                                                    <?= htmlspecialchars($customer['email']) ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No email</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($customer['city'] ?? 'Not specified') ?></td>
                                        <td>
                                            <?php if ($customer['policy_count'] > 0): ?>
                                                <span class="badge bg-success"><?= $customer['policy_count'] ?> policies</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">No policies</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?= date('d M Y', strtotime($customer['created_at'])) ?>
                                                <?php if ($customer['created_by_name']): ?>
                                                    <br>by <?= htmlspecialchars($customer['created_by_name']) ?>
                                                <?php endif; ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="/customers/<?= $customer['id'] ?>" 
                                                   class="btn btn-sm btn-outline-primary" 
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/customers/<?= $customer['id'] ?>/edit" 
                                                   class="btn btn-sm btn-outline-warning" 
                                                   title="Edit Customer">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <?php if ($customer['policy_count'] == 0): ?>
                                                    <button class="btn btn-sm btn-outline-danger" 
                                                            onclick="deleteCustomer(<?= $customer['id'] ?>, '<?= htmlspecialchars($customer['name']) ?>')"
                                                            title="Delete Customer">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <?php if ($totalPages > 1): ?>
                        <nav aria-label="Customer pagination" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage - 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>">Previous</a>
                                </li>
                                
                                <?php for ($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++): ?>
                                    <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?><?= $search ? '&search=' . urlencode($search) : '' ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $currentPage + 1 ?><?= $search ? '&search=' . urlencode($search) : '' ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    <?php endif; ?>
                <?php endif; ?>
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
function deleteCustomer(id, name) {
    document.getElementById('customerName').textContent = name;
    document.getElementById('deleteForm').action = '/customers/' + id + '/delete';
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

function exportCustomers() {
    // Create CSV export
    const table = document.querySelector('table');
    let csv = [];
    
    // Headers
    const headers = ['Customer Code', 'Name', 'Phone', 'Email', 'City', 'Policies', 'Created'];
    csv.push(headers.join(','));
    
    // Data rows
    const rows = table.querySelectorAll('tbody tr');
    rows.forEach(row => {
        const cols = row.querySelectorAll('td');
        const rowData = [
            cols[0].textContent.trim(),
            cols[1].textContent.trim(),
            cols[2].textContent.trim(),
            cols[3].textContent.trim(),
            cols[4].textContent.trim(),
            cols[5].textContent.trim(),
            cols[6].textContent.trim()
        ];
        csv.push(rowData.join(','));
    });
    
    // Download
    const csvContent = csv.join('\n');
    const blob = new Blob([csvContent], { type: 'text/csv' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'customers_' + new Date().toISOString().split('T')[0] + '.csv';
    a.click();
    window.URL.revokeObjectURL(url);
}
</script>

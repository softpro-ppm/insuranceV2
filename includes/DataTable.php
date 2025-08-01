<?php
// DataTable component for standardized tables with all required features
class DataTable {
    
    public function render($data, $columns, $options = []) {
        // Extract options with defaults
        $currentPage = $options['currentPage'] ?? 1;
        $totalPages = $options['totalPages'] ?? 1;
        $totalCount = $options['totalCount'] ?? count($data);
        $per_page = $options['per_page'] ?? 10;
        $sort = $options['sort'] ?? '';
        $order = $options['order'] ?? 'asc';
        $search = $options['search'] ?? '';
        $filters = $options['filters'] ?? [];
        $config = $options['config'] ?? [];
        
        // Config defaults
        $searchPlaceholder = $config['searchPlaceholder'] ?? 'Search...';
        $noDataMessage = $config['noDataMessage'] ?? 'No records found';
        $entityName = $config['entityName'] ?? 'record';
        $entityNamePlural = $config['entityNamePlural'] ?? 'records';
        
        // Calculate pagination
        $start_record = ($currentPage - 1) * $per_page + 1;
        $end_record = min($currentPage * $per_page, $totalCount);
        
        // Get current URL for pagination links
        $base_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        ob_start();
        ?>
        
        <div class="datatable-wrapper">
            <!-- Controls Row -->
            <div class="datatable-controls mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <!-- Search Box -->
                        <div class="search-box d-flex align-items-center">
                            <form method="GET" class="d-flex" id="searchForm">
                                <input type="text" 
                                       name="search" 
                                       id="searchInput"
                                       class="form-control" 
                                       placeholder="<?= htmlspecialchars($searchPlaceholder) ?>" 
                                       value="<?= htmlspecialchars($search) ?>"
                                       style="margin-right: 10px;"
                                       autocomplete="off"
                                       title="Search across all records in the database">
                                <?php if (!empty($search)): ?>
                                    <button type="button" class="btn btn-secondary" onclick="clearSearch()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                <?php endif; ?>
                                <!-- Preserve other parameters -->
                                <?php foreach ($_GET as $key => $value): ?>
                                    <?php if ($key !== 'search'): ?>
                                        <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </form>
                            <?php if (!empty($search)): ?>
                                <small class="text-muted ms-2">
                                    <i class="fas fa-info-circle"></i> 
                                    Searching all <?= number_format($totalCount) ?> records
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end align-items-center">
                            <!-- Filters -->
                            <?php if (!empty($filters)): ?>
                                <div class="filters d-flex me-3">
                                    <form method="GET" class="d-flex">
                                        <?php foreach ($filters as $filter): ?>
                                            <select name="<?= htmlspecialchars($filter['name']) ?>" class="form-select me-2" style="width: auto;" onchange="this.form.submit()">
                                                <?php foreach ($filter['options'] as $value => $label): ?>
                                                    <option value="<?= htmlspecialchars($value) ?>" <?= ($filter['value'] ?? '') === $value ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($label) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        <?php endforeach; ?>
                                        <!-- Preserve other parameters -->
                                        <?php foreach ($_GET as $key => $value): ?>
                                            <?php if (!in_array($key, array_column($filters, 'name'))): ?>
                                                <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </form>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Per Page Selector -->
                            <div class="per-page-selector d-flex align-items-center">
                                <form method="GET" class="d-flex align-items-center">
                                    <label class="me-2">Show:</label>
                                    <select name="per_page" class="form-select" style="width: auto;" onchange="this.form.submit()">
                                        <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                        <option value="30" <?= $per_page == 30 ? 'selected' : '' ?>>30</option>
                                        <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                        <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                                    </select>
                                    <!-- Preserve other parameters -->
                                    <?php foreach ($_GET as $key => $value): ?>
                                        <?php if ($key !== 'per_page'): ?>
                                            <input type="hidden" name="<?= htmlspecialchars($key) ?>" value="<?= htmlspecialchars($value) ?>">
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Data Table -->
            <div class="table-responsive">
                <style>
                .table-dark th {
                    background-color: #495057 !important;
                    color: #ffffff !important;
                    border-color: #6c757d !important;
                    font-weight: 600 !important;
                }
                .table-dark th a {
                    color: #ffffff !important;
                    text-decoration: none !important;
                }
                .table-dark th a:hover {
                    color: #e9ecef !important;
                }
                .table-dark th .text-muted {
                    color: #adb5bd !important;
                }
                </style>
                <table class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th width="50">#</th> <!-- Serial Number Column -->
                            <?php foreach ($columns as $column): ?>
                                <th <?= isset($column['width']) ? 'width="' . $column['width'] . '"' : '' ?>>
                                    <?php if ($column['sortable'] ?? false): ?>
                                        <?php
                                        $query_params = $_GET;
                                        $query_params['sort'] = $column['key'];
                                        $query_params['order'] = ($sort === $column['key'] && $order === 'asc') ? 'desc' : 'asc';
                                        $sort_url = $base_url . '?' . http_build_query($query_params);
                                        ?>
                                        <a href="<?= $sort_url ?>" class="text-white text-decoration-none">
                                            <?= htmlspecialchars($column['label']) ?>
                                            <?php if ($sort === $column['key']): ?>
                                                <i class="fas fa-sort-<?= $order === 'asc' ? 'up' : 'down' ?>"></i>
                                            <?php else: ?>
                                                <i class="fas fa-sort text-muted"></i>
                                            <?php endif; ?>
                                        </a>
                                    <?php else: ?>
                                        <?= htmlspecialchars($column['label']) ?>
                                    <?php endif; ?>
                                </th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="<?= count($columns) + 1 ?>" class="text-center py-4">
                                    <div class="empty-state">
                                        <i class="fas fa-search fa-2x text-muted mb-2"></i>
                                        <p class="text-muted"><?= htmlspecialchars($noDataMessage) ?></p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($data as $index => $row): ?>
                                <tr>
                                    <!-- Serial Number -->
                                    <td><strong><?= $start_record + $index ?></strong></td>
                                    
                                    <!-- Data Columns -->
                                    <?php foreach ($columns as $column): ?>
                                        <td>
                                            <?php if (isset($column['render']) && is_callable($column['render'])): ?>
                                                <?= $column['render']($row) ?>
                                            <?php else: ?>
                                                <?= htmlspecialchars($row[$column['key']] ?? '') ?>
                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination and Count -->
            <div class="table-footer d-flex justify-content-between align-items-center mt-3">
                <div class="count-info">
                    <span class="text-muted">
                        <?php if (!empty($search)): ?>
                            Showing <?= number_format($start_record) ?> to <?= number_format($end_record) ?> of <?= number_format($totalCount) ?> search results
                            <small class="d-block">
                                <i class="fas fa-search"></i> 
                                Found in entire database for "<?= htmlspecialchars($search) ?>"
                            </small>
                        <?php else: ?>
                            Showing <?= number_format($start_record) ?> to <?= number_format($end_record) ?> of <?= number_format($totalCount) ?> <?= $entityNamePlural ?>
                        <?php endif; ?>
                    </span>
                </div>
                
                <?php if ($totalPages > 1): ?>
                    <nav aria-label="Table pagination">
                        <?php
                        $start_page = max(1, $currentPage - 2);
                        $end_page = min($totalPages, $currentPage + 2);
                        
                        // Build query string for pagination
                        $query_params = $_GET;
                        unset($query_params['page']);
                        $query_string = !empty($query_params) ? '&' . http_build_query($query_params) : '';
                        ?>
                        
                        <ul class="pagination pagination-sm mb-0">
                            <!-- First and Previous -->
                            <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $base_url ?>?page=1<?= $query_string ?>">First</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $base_url ?>?page=<?= $currentPage - 1 ?><?= $query_string ?>">Previous</a>
                                </li>
                            <?php endif; ?>
                            
                            <!-- Page Numbers -->
                            <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                                <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= $base_url ?>?page=<?= $i ?><?= $query_string ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>
                            
                            <!-- Next and Last -->
                            <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $base_url ?>?page=<?= $currentPage + 1 ?><?= $query_string ?>">Next</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="<?= $base_url ?>?page=<?= $totalPages ?><?= $query_string ?>">Last</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
        
        <?php
        return ob_get_clean();
    }
}

// Legacy function for backward compatibility
function renderDataTable($config) {
    $table_id = $config['table_id'] ?? 'dataTable';
    $columns = $config['columns'] ?? [];
    $data = $config['data'] ?? [];
    $total_count = $config['total_count'] ?? 0;
    $current_page = $config['current_page'] ?? 1;
    $per_page = $config['per_page'] ?? 10;
    $search = $config['search'] ?? '';
    $filters = $config['filters'] ?? [];
    $actions = $config['actions'] ?? [];
    $base_url = $config['base_url'] ?? '';
    
    $start_record = ($current_page - 1) * $per_page + 1;
    $end_record = min($current_page * $per_page, $total_count);
    
    ob_start();
    ?>
    
    <div class="data-table-container">
        <!-- Filters and Search Section -->
        <div class="table-controls mb-4">
            <div class="row">
                <div class="col-md-6">
                    <!-- Search Box -->
                    <div class="search-box">
                        <form method="GET" class="d-flex">
                            <input type="text" 
                                   name="search" 
                                   class="form-control" 
                                   placeholder="Search..." 
                                   value="<?= htmlspecialchars($search) ?>"
                                   style="margin-right: 10px;">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <?php if (!empty($search)): ?>
                                <a href="<?= $base_url ?>" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times"></i>
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Filters -->
                    <?php if (!empty($filters)): ?>
                        <div class="filters d-flex justify-content-end">
                            <?php foreach ($filters as $filter): ?>
                                <select name="<?= $filter['name'] ?>" class="form-select me-2" style="width: auto;" onchange="this.form.submit()">
                                    <option value=""><?= $filter['label'] ?></option>
                                    <?php foreach ($filter['options'] as $value => $label): ?>
                                        <option value="<?= $value ?>" <?= ($_GET[$filter['name']] ?? '') === $value ? 'selected' : '' ?>>
                                            <?= $label ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Per Page Selector -->
                    <div class="per-page-selector d-flex justify-content-end">
                        <form method="GET" class="d-flex align-items-center">
                            <label class="me-2">Show:</label>
                            <select name="per_page" class="form-select" style="width: auto;" onchange="this.form.submit()">
                                <option value="10" <?= $per_page == 10 ? 'selected' : '' ?>>10</option>
                                <option value="30" <?= $per_page == 30 ? 'selected' : '' ?>>30</option>
                                <option value="50" <?= $per_page == 50 ? 'selected' : '' ?>>50</option>
                                <option value="100" <?= $per_page == 100 ? 'selected' : '' ?>>100</option>
                            </select>
                            <!-- Preserve other parameters -->
                            <?php foreach ($_GET as $key => $value): ?>
                                <?php if ($key !== 'per_page'): ?>
                                    <input type="hidden" name="<?= $key ?>" value="<?= htmlspecialchars($value) ?>">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Data Table -->
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="<?= $table_id ?>">
                <thead class="table-dark">
                    <tr>
                        <th width="50">#</th> <!-- Serial Number Column -->
                        <?php foreach ($columns as $column): ?>
                            <th <?= isset($column['width']) ? 'width="' . $column['width'] . '"' : '' ?>>
                                <?php if ($column['sortable'] ?? false): ?>
                                    <a href="<?= $base_url ?>?sort=<?= $column['key'] ?>&order=<?= ($_GET['sort'] ?? '') === $column['key'] && ($_GET['order'] ?? '') === 'asc' ? 'desc' : 'asc' ?><?= !empty($search) ? '&search=' . urlencode($search) : '' ?>" 
                                       class="text-white text-decoration-none">
                                        <?= $column['label'] ?>
                                        <?php if (($_GET['sort'] ?? '') === $column['key']): ?>
                                            <i class="fas fa-sort-<?= ($_GET['order'] ?? '') === 'asc' ? 'up' : 'down' ?>"></i>
                                        <?php else: ?>
                                            <i class="fas fa-sort text-muted"></i>
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <?= $column['label'] ?>
                                <?php endif; ?>
                            </th>
                        <?php endforeach; ?>
                        <?php if (!empty($actions)): ?>
                            <th width="120">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data)): ?>
                        <tr>
                            <td colspan="<?= count($columns) + 1 + (!empty($actions) ? 1 : 0) ?>" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-search fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">No records found</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data as $index => $row): ?>
                            <tr>
                                <!-- Serial Number -->
                                <td><strong><?= $start_record + $index ?></strong></td>
                                
                                <!-- Data Columns -->
                                <?php foreach ($columns as $column): ?>
                                    <td>
                                        <?php if (isset($column['render'])): ?>
                                            <?= $column['render']($row) ?>
                                        <?php else: ?>
                                            <?= htmlspecialchars($row[$column['key']] ?? '') ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                                
                                <!-- Actions -->
                                <?php if (!empty($actions)): ?>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <?php foreach ($actions as $action): ?>
                                                <?php if (isset($action['condition']) && !$action['condition']($row)) continue; ?>
                                                <a href="<?= $action['url']($row) ?>" 
                                                   class="btn btn-sm <?= $action['class'] ?? 'btn-outline-primary' ?>"
                                                   <?= isset($action['onclick']) ? 'onclick="' . $action['onclick']($row) . '"' : '' ?>
                                                   title="<?= $action['title'] ?? '' ?>">
                                                    <i class="<?= $action['icon'] ?>"></i>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Pagination and Count -->
        <div class="table-footer d-flex justify-content-between align-items-center mt-3">
            <div class="count-info">
                <span class="text-muted">
                    Showing <?= number_format($start_record) ?> to <?= number_format($end_record) ?> of <?= number_format($total_count) ?> results
                </span>
            </div>
            
            <?php if ($total_count > $per_page): ?>
                <nav aria-label="Table pagination">
                    <?php
                    $total_pages = ceil($total_count / $per_page);
                    $start_page = max(1, $current_page - 2);
                    $end_page = min($total_pages, $current_page + 2);
                    
                    // Build query string for pagination
                    $query_params = $_GET;
                    unset($query_params['page']);
                    $query_string = !empty($query_params) ? '&' . http_build_query($query_params) : '';
                    ?>
                    
                    <ul class="pagination pagination-sm mb-0">
                        <!-- First and Previous -->
                        <?php if ($current_page > 1): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= $base_url ?>?page=1<?= $query_string ?>">First</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= $base_url ?>?page=<?= $current_page - 1 ?><?= $query_string ?>">Previous</a>
                            </li>
                        <?php endif; ?>
                        
                        <!-- Page Numbers -->
                        <?php for ($i = $start_page; $i <= $end_page; $i++): ?>
                            <li class="page-item <?= $i === $current_page ? 'active' : '' ?>">
                                <a class="page-link" href="<?= $base_url ?>?page=<?= $i ?><?= $query_string ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                        
                        <!-- Next and Last -->
                        <?php if ($current_page < $total_pages): ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= $base_url ?>?page=<?= $current_page + 1 ?><?= $query_string ?>">Next</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?= $base_url ?>?page=<?= $total_pages ?><?= $query_string ?>">Last</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Auto Search JavaScript -->
    <script>
    (function() {
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;
        
        if (searchInput && searchForm) {
            // Real-time search with minimal delay
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                
                // Search immediately for backspace/delete, or after minimal delay for typing
                const delay = this.value.length < searchInput.dataset.lastLength ? 100 : 200;
                searchInput.dataset.lastLength = this.value.length;
                
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, delay); // 100-200ms delay - much faster response
            });
            
            // Handle Enter key - immediate search
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });
            
            // Handle backspace/delete - immediate search
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Backspace' || e.key === 'Delete') {
                    clearTimeout(searchTimeout);
                    setTimeout(function() {
                        searchForm.submit();
                    }, 50); // Very fast for deletion
                }
            });
        }
        
        // Clear search function
        window.clearSearch = function() {
            const form = document.getElementById('searchForm');
            const searchInput = document.getElementById('searchInput');
            
            if (searchInput) {
                searchInput.value = '';
            }
            
            // Remove search parameter and submit
            const url = new URL(window.location);
            url.searchParams.delete('search');
            window.location.href = url.toString();
        };
        
        // Add visual feedback while searching
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                if (this.value.length > 0) {
                    this.style.borderLeft = '3px solid #007bff';
                } else {
                    this.style.borderLeft = '';
                }
            });
        }
    })();
    </script>
    
    <?php
    return ob_get_clean();
}
?>

<?php
// DataTable component for standardized tables with all required features
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
    
    <?php
    return ob_get_clean();
}
?>

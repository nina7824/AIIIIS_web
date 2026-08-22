<?= $this->extend('admin/layout') ?>

<?= $this->section('styles') ?>
<style>
.permissions-container {
    margin-top: 0.5rem;
}

.permissions-table-wrap {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 10px;
    overflow: hidden;
}

.permissions-table-wrap .table-header {
    padding: 0.75rem 1.5rem;
    background: var(--canvas);
    border-bottom: 1px solid var(--border);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.permissions-table-wrap .table-header .role-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--ink);
    margin: 0;
}

.permissions-table-wrap .table-header .role-title .role-name {
    color: var(--primary);
}

.permissions-table-wrap .table-header .header-actions {
    display: flex;
    gap: 0.5rem;
    align-items: center;
    flex-wrap: wrap;
}

.permissions-table-wrap .table-header .header-actions .select-all-btn {
    font-size: 0.65rem;
    color: var(--ink-muted);
    cursor: pointer;
    padding: 0.25rem 0.7rem;
    border-radius: 4px;
    border: 1px solid var(--border);
    background: var(--surface);
    transition: all 0.2s ease;
    white-space: nowrap;
}

.permissions-table-wrap .table-header .header-actions .select-all-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
}

.permissions-table-wrap .table-scroll {
    overflow-x: auto;
    padding: 0 0.5rem;
}

.permissions-table-wrap table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.85rem;
}

.permissions-table-wrap table thead {
    background: var(--canvas);
    position: sticky;
    top: 0;
    z-index: 10;
}

.permissions-table-wrap table th {
    padding: 0.8rem 0.75rem;
    text-align: left;
    font-weight: 600;
    color: var(--ink-muted);
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-bottom: 2px solid var(--border);
    white-space: nowrap;
}

.permissions-table-wrap table th:first-child {
    padding-left: 1.5rem;
    min-width: 280px;
}

.permissions-table-wrap table th.text-center {
    text-align: center;
    min-width: 90px;
}

.permissions-table-wrap table td {
    padding: 0.6rem 0.75rem;
    border-bottom: 1px solid var(--border);
    vertical-align: middle;
}

.permissions-table-wrap table td:first-child {
    padding-left: 1.5rem;
}

.permissions-table-wrap table tbody tr:hover {
    background: var(--surface-hover);
}

/* Category Row */
.permissions-table-wrap table .category-row {
    background: var(--canvas);
    border-bottom: 2px solid var(--border);
}

.permissions-table-wrap table .category-row td {
    padding: 0.5rem 1.5rem;
    font-weight: 700;
    font-size: 0.85rem;
    color: var(--ink);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.permissions-table-wrap table .category-row .category-icon {
    margin-right: 0.5rem;
    color: var(--primary);
}

/* Parent Menu Row */
.permissions-table-wrap table .parent-row {
    background: var(--surface);
    border-left: 3px solid var(--primary);
}

.permissions-table-wrap table .parent-row .module-name {
    font-weight: 700;
}

.permissions-table-wrap table .parent-row .module-icon {
    background: var(--primary-light);
    color: var(--primary);
}

/* Submenu Row */
.permissions-table-wrap table .submenu-row td:first-child {
    padding-left: 4rem;
}

.permissions-table-wrap table .submenu-row .module-icon {
    width: 28px;
    height: 28px;
    font-size: 0.7rem;
    background: var(--surface);
    color: var(--ink-muted);
    border: 1px solid var(--border);
}

.permissions-table-wrap table .submenu-row .module-name {
    font-weight: 400;
    font-size: 0.8rem;
}

.permissions-table-wrap table .submenu-row .module-slug {
    font-size: 0.6rem;
}

/* Module Column */
.permissions-table-wrap table .module-cell {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.permissions-table-wrap table .module-icon {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.permissions-table-wrap table .module-name {
    font-weight: 600;
    color: var(--ink);
    font-size: 0.85rem;
}

.permissions-table-wrap table .module-slug {
    font-size: 0.65rem;
    color: var(--ink-muted);
    font-family: monospace;
    margin-left: 0.25rem;
}

/* Permission Checkboxes */
.permissions-table-wrap table .perm-check {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.3rem 0.5rem;
    border-radius: 6px;
    transition: all 0.2s ease;
    min-width: 40px;
}

.permissions-table-wrap table .perm-check:hover {
    background: var(--canvas);
}

.permissions-table-wrap table .perm-check input[type="checkbox"] {
    width: 18px;
    height: 18px;
    cursor: pointer;
    accent-color: var(--primary);
    flex-shrink: 0;
}

.permissions-table-wrap table .perm-check input[type="checkbox"]:checked {
    accent-color: var(--primary);
}

.permissions-table-wrap table .perm-check .no-perm {
    color: var(--ink-muted);
    font-size: 0.7rem;
}

/* Permission Icons in Header */
.permissions-table-wrap table th .perm-header-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.permissions-table-wrap table th .perm-header-icon i {
    font-size: 0.9rem;
}

.permissions-table-wrap table th .perm-header-icon span {
    font-size: 0.55rem;
    text-transform: uppercase;
    font-weight: 700;
}

/* Action Buttons */
.permissions-actions {
    display: flex;
    gap: 0.75rem;
    justify-content: flex-end;
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border);
    background: var(--surface);
}

.permissions-actions .btn-primary {
    padding: 0.6rem 2rem;
    background: var(--primary);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.permissions-actions .btn-primary:hover {
    background: var(--primary-dark);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(7, 142, 206, 0.3);
}

.permissions-actions .btn-secondary {
    padding: 0.6rem 2rem;
    background: transparent;
    color: var(--ink-muted);
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 0.85rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'Inter', sans-serif;
}

.permissions-actions .btn-secondary:hover {
    border-color: var(--primary);
    color: var(--ink);
    background: var(--surface-hover);
}

/* Toast */
.toast-container {
    position: fixed;
    top: 80px;
    right: 20px;
    z-index: 99999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    max-width: 400px;
    width: 100%;
}

.toast {
    background: var(--surface);
    border-radius: 10px;
    padding: 1rem 1.25rem;
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    animation: slideInRight 0.4s ease;
    border-left: 4px solid var(--primary);
    min-width: 300px;
    transition: all 0.3s ease;
}

.toast.hiding {
    animation: slideOutRight 0.4s ease forwards;
}

.toast .toast-icon {
    font-size: 1.2rem;
    flex-shrink: 0;
}

.toast .toast-content {
    flex: 1;
}

.toast .toast-content .toast-title {
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--ink);
}

.toast .toast-content .toast-message {
    font-size: 0.78rem;
    color: var(--ink-muted);
}

.toast .toast-close {
    background: none;
    border: none;
    color: var(--ink-muted);
    cursor: pointer;
    font-size: 0.9rem;
    padding: 0.2rem;
    transition: all 0.2s ease;
}

.toast .toast-close:hover {
    color: var(--ink);
}

.toast.success { border-left-color: #059669; }
.toast.success .toast-icon { color: #059669; }
.toast.error { border-left-color: #dc2626; }
.toast.error .toast-icon { color: #dc2626; }
.toast.warning { border-left-color: #d97706; }
.toast.warning .toast-icon { color: #d97706; }
.toast.info { border-left-color: var(--primary); }
.toast.info .toast-icon { color: var(--primary); }

[data-theme="dark"] .toast {
    background: #1a1d27;
    border: 1px solid #2d3344;
}

@keyframes slideInRight {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}

@keyframes slideOutRight {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="permissions-container">
    <div class="permissions-table-wrap">
        <div class="table-header">
            <div class="role-title">
                <i class="fas fa-cubes" style="color: var(--primary);"></i> 
                <span class="role-name"><?= $role['name'] ?></span> 
                <span style="font-weight: 400; font-size: 0.75rem; color: var(--ink-muted);">
                    (<?= count($menuTree) ?> menus)
                </span>
            </div>
            <div class="header-actions">
                <span class="select-all-btn" onclick="toggleAllPermissions()">
                    <i class="fas fa-check-double"></i> All
                </span>
                <span class="select-all-btn" onclick="deselectAllPermissions()">
                    <i class="fas fa-times"></i> None
                </span>
                <span class="select-all-btn" onclick="toggleModulePermissions('view')" style="border-color: #3b82f6; color: #3b82f6;">
                    <i class="fas fa-eye"></i> View
                </span>
                <span class="select-all-btn" onclick="toggleModulePermissions('add')" style="border-color: #22c55e; color: #22c55e;">
                    <i class="fas fa-plus"></i> Add
                </span>
                <span class="select-all-btn" onclick="toggleModulePermissions('edit')" style="border-color: #eab308; color: #eab308;">
                    <i class="fas fa-edit"></i> Edit
                </span>
                <span class="select-all-btn" onclick="toggleModulePermissions('delete')" style="border-color: #ef4444; color: #ef4444;">
                    <i class="fas fa-trash"></i> Delete
                </span>
            </div>
        </div>
        
        <div class="table-scroll">
            <form id="permissionsForm">
                <?= csrf_field() ?>
                <input type="hidden" id="roleId" value="<?= $role['role_id'] ?>">
                
                <table>
                    <!-- In the table header, add condition for Super Admin -->
<thead>
    <tr>
        <th style="min-width: 280px;">
            <span style="display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-cubes" style="color: var(--primary);"></i>
                Menu / Module
            </span>
        </th>
        <?php if (!$isSuperAdmin): ?>
            <th class="text-center" style="min-width: 90px; width: 90px;">
                <div class="perm-header-icon">
                    <i class="fas fa-eye" style="color: #3b82f6;"></i>
                    <span>View</span>
                </div>
            </th>
            <th class="text-center" style="min-width: 90px; width: 90px;">
                <div class="perm-header-icon">
                    <i class="fas fa-plus" style="color: #22c55e;"></i>
                    <span>Add</span>
                </div>
            </th>
            <th class="text-center" style="min-width: 90px; width: 90px;">
                <div class="perm-header-icon">
                    <i class="fas fa-edit" style="color: #eab308;"></i>
                    <span>Edit</span>
                </div>
            </th>
            <th class="text-center" style="min-width: 90px; width: 90px;">
                <div class="perm-header-icon">
                    <i class="fas fa-trash" style="color: #ef4444;"></i>
                    <span>Delete</span>
                </div>
            </th>
        <?php else: ?>
            <th class="text-center" style="min-width: 90px; width: 90px;">
                <span style="color: var(--primary); font-weight: 700;">All Permissions</span>
            </th>
        <?php endif; ?>
    </tr>
</thead>
                    <tbody>
                        <?php if (!empty($menuTree)): ?>
                            <?php foreach ($menuTree as $category): ?>
                                <!-- Category Header -->
                                <tr class="category-row">
                                    <td colspan="5">
                                        <span class="category-icon"><i class="fas <?= $category['icon'] ?? 'fa-folder' ?>"></i></span>
                                        <?= $category['label'] ?>
                                        <span style="font-weight: 400; font-size: 0.7rem; color: var(--ink-muted); margin-left: 0.5rem;">
                                            (<?= count($category['items'] ?? []) ?> modules)
                                        </span>
                                    </td>
                                </tr>
                                
                                <?php foreach ($category['items'] as $menu): ?>
                                    <!-- Parent Menu -->
                                    <tr class="parent-row">
                                        <td>
                                            <div class="module-cell">
                                                <div class="module-icon">
                                                    <i class="fas <?= $menu['icon'] ?? 'fa-cube' ?>"></i>
                                                </div>
                                                <div>
                                                    <div class="module-name"><?= $menu['label'] ?></div>
                                                    <div class="module-slug"><?= $menu['slug'] ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <?php foreach (['view', 'add', 'edit', 'delete'] as $type): ?>
                                            <td class="text-center">
                                                <?php if (isset($menu['permissions'][$type])): 
                                                    $perm = $menu['permissions'][$type];
                                                    $isChecked = in_array($perm['permission_id'], $rolePermissionIds) ? 'checked' : '';
                                                    $permId = $perm['permission_id'];
                                                ?>
                                                    <div class="perm-check">
                                                        <input type="checkbox" 
                                                               id="perm_<?= $permId ?>" 
                                                               name="permissions[]" 
                                                               value="<?= $permId ?>" 
                                                               <?= $isChecked ?>
                                                               class="perm-checkbox" 
                                                               data-module="<?= $menu['slug'] ?>"
                                                               data-type="<?= $type ?>">
                                                    </div>
                                                <?php else: ?>
                                                    <span class="no-perm">—</span>
                                                <?php endif; ?>
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                    
                                    <!-- Submenus -->
                                    <?php if (!empty($menu['submenus'])): ?>
                                        <?php foreach ($menu['submenus'] as $submenu): ?>
                                            <tr class="submenu-row">
                                                <td>
                                                    <div class="module-cell" style="padding-left: 2.5rem;">
                                                        <div class="module-icon" style="width: 28px; height: 28px; font-size: 0.7rem;">
                                                            <i class="fas <?= $submenu['icon'] ?? 'fa-circle' ?>"></i>
                                                        </div>
                                                        <div>
                                                            <div class="module-name"><?= $submenu['label'] ?></div>
                                                            <div class="module-slug"><?= $submenu['slug'] ?></div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php foreach (['view', 'add', 'edit', 'delete'] as $type): ?>
                                                    <td class="text-center">
                                                        <?php if (isset($submenu['permissions'][$type])): 
                                                            $perm = $submenu['permissions'][$type];
                                                            $isChecked = in_array($perm['permission_id'], $rolePermissionIds) ? 'checked' : '';
                                                            $permId = $perm['permission_id'];
                                                        ?>
                                                            <div class="perm-check">
                                                                <input type="checkbox" 
                                                                       id="perm_<?= $permId ?>" 
                                                                       name="permissions[]" 
                                                                       value="<?= $permId ?>" 
                                                                       <?= $isChecked ?>
                                                                       class="perm-checkbox" 
                                                                       data-module="<?= $submenu['slug'] ?>"
                                                                       data-type="<?= $type ?>">
                                                            </div>
                                                        <?php else: ?>
                                                            <span class="no-perm">—</span>
                                                        <?php endif; ?>
                                                    </td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--ink-muted);">
                                    <i class="fas fa-info-circle"></i> No menus found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </form>
        </div>
        
        <div class="permissions-actions">
            <a href="<?= base_url('admin/roles') ?>" class="btn-secondary">
                <i class="fas fa-arrow-left"></i> Cancel
            </a>
            <button type="button" class="btn-primary" onclick="savePermissions()">
                <i class="fas fa-save"></i> Save Permissions
            </button>
        </div>
    </div>
</div>

<!-- Toast Container -->
<div class="toast-container" id="toastContainer"></div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// ============================================================
// TOAST NOTIFICATIONS
// ============================================================
function showToast(message, title = '', type = 'success', duration = 4000) {
    const container = document.getElementById('toastContainer');
    
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };
    
    const titles = {
        success: title || 'Success',
        error: title || 'Error',
        warning: title || 'Warning',
        info: title || 'Information'
    };
    
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `
        <div class="toast-icon">
            <i class="fas ${icons[type] || icons.info}"></i>
        </div>
        <div class="toast-content">
            <div class="toast-title">${titles[type]}</div>
            <div class="toast-message">${message}</div>
        </div>
        <button class="toast-close" onclick="this.closest('.toast').remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        if (toast.parentNode) {
            toast.classList.add('hiding');
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 400);
        }
    }, duration);
    
    toast.addEventListener('click', function(e) {
        if (e.target.closest('.toast-close')) return;
        toast.classList.add('hiding');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 400);
    });
    
    return toast;
}

// ============================================================
// CSRF token management
// ============================================================
const csrfName = '<?= csrf_token() ?>';
let csrfHash = '<?= csrf_hash() ?>';

function updateCsrfToken(newToken) {
    if (newToken) {
        csrfHash = newToken;
        document.querySelectorAll('input[name="' + csrfName + '"]').forEach(input => {
            input.value = newToken;
        });
    }
}

// ============================================================
// PERMISSIONS MANAGEMENT
// ============================================================
function toggleAllPermissions() {
    document.querySelectorAll('.perm-checkbox').forEach(cb => {
        cb.checked = true;
    });
}

function deselectAllPermissions() {
    document.querySelectorAll('.perm-checkbox').forEach(cb => {
        cb.checked = false;
    });
}

function toggleModulePermissions(type) {
    const checkboxes = document.querySelectorAll(`.perm-checkbox[data-type="${type}"]`);
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    checkboxes.forEach(cb => {
        cb.checked = !allChecked;
    });
}

function savePermissions() {
    const checkboxes = document.querySelectorAll('.perm-checkbox:checked');
    const permissions = Array.from(checkboxes)
        .filter(cb => cb.value !== '')
        .map(cb => parseInt(cb.value));
    
    const roleId = document.getElementById('roleId').value;
    
    const saveBtn = document.querySelector('.permissions-actions .btn-primary');
    const originalText = saveBtn.innerHTML;
    saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Saving...';
    saveBtn.disabled = true;
    
    const csrfInput = document.querySelector('input[name="csrf_test_name"]');
    const csrfName = csrfInput?.name || 'csrf_test_name';
    const csrfHash = csrfInput?.value || '';
    
    const params = new URLSearchParams();
    params.append(csrfName, csrfHash);
    params.append('permissions', JSON.stringify(permissions));

    fetch('<?= base_url('admin/roles/updatePermissions') ?>/' + roleId, {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Server error (Status: ' + response.status + ')');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            if (data.csrf_token) {
                updateCsrfToken(data.csrf_token);
            }
            showToast(data.message || 'Permissions updated successfully!', 'Success', 'success');
            setTimeout(() => {
                window.location.href = '<?= base_url('admin/roles') ?>';
            }, 1500);
        } else {
            let errorMessage = data.message || 'Failed to update permissions';
            if (typeof errorMessage === 'object') {
                errorMessage = Object.values(errorMessage).join(', ');
            }
            showToast(errorMessage, 'Error', 'error');
            saveBtn.innerHTML = originalText;
            saveBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error saving permissions:', error);
        showToast(error.message || 'Error saving permissions. Please check the console for details.', 'Error', 'error');
        saveBtn.innerHTML = originalText;
        saveBtn.disabled = false;
    });
}
</script>
<?= $this->endSection() ?>
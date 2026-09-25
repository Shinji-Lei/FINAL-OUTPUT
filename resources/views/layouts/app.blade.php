<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHINJI's Task Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
       body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url("{{ asset('images/bg.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            color: #f1f5f9;
        }

        /* Glassmorphism Styling */
        .glass-sidebar {
            background: rgba(15, 23, 42, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-right: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .glass-input {
            background: rgba(15, 23, 42, 0.5);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #ffffff;
            transition: all 0.2s ease;
        }

        .glass-input:focus {
            outline: none;
            border-color: rgba(255, 255, 255, 0.35);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
        }

        .glass-input option {
            background-color: #0f172a;
            color: #ffffff;
        }

        .glass-btn {
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            transition: all 0.2s ease;
        }

        .glass-btn:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .glass-btn-primary {
            background: rgba(56, 189, 248, 0.25);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(56, 189, 248, 0.4);
            color: #e0f2fe;
            transition: all 0.2s ease;
        }

        .glass-btn-primary:hover {
            background: rgba(56, 189, 248, 0.4);
            border-color: rgba(56, 189, 248, 0.6);
        }

        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: rgba(15, 23, 42, 0.2); }
        ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.2); border-radius: 9999px; }
    </style>
</head>
<body class="h-full flex flex-col md:flex-row overflow-x-hidden selection:bg-sky-500 selection:text-white">

    <!-- SIDEBAR NAVIGATION -->
    <aside class="w-full md:w-64 glass-sidebar flex flex-col justify-between p-6 shrink-0 md:min-h-screen z-20">
        <div>
            <!-- Branding -->
            <div class="flex items-center gap-3 mb-8">
                <div class="w-9 h-9 rounded-xl glass-card flex items-center justify-center text-sky-400 font-bold text-sm shadow-inner">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs tracking-wider uppercase text-slate-100">SHINJI's Task</h1>
                    <p class="text-[10px] text-slate-400 font-medium">Manager Dashboard</p>
                </div>
            </div>

            <!-- Navigation Links -->
            <div class="space-y-1.5 mb-6">
                <button onclick="setFilter('all')" id="nav-all" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium bg-white/10 border border-white/15 text-white shadow-sm transition-all">
                    <span class="flex items-center gap-2.5"><i class="fa-solid fa-folder-open w-4 text-sky-400"></i> All Tasks</span>
                    <span id="badge-all" class="text-[10px] px-2 py-0.5 rounded-md bg-white/10">0</span>
                </button>
                <button onclick="setFilter('pending')" id="nav-pending" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all">
                    <span class="flex items-center gap-2.5"><i class="fa-solid fa-hourglass-half w-4 text-amber-400"></i> Pending</span>
                    <span id="badge-pending" class="text-[10px] px-2 py-0.5 rounded-md bg-white/5">0</span>
                </button>
                <button onclick="setFilter('completed')" id="nav-completed" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all">
                    <span class="flex items-center gap-2.5"><i class="fa-solid fa-circle-check w-4 text-emerald-400"></i> Completed</span>
                    <span id="badge-completed" class="text-[10px] px-2 py-0.5 rounded-md bg-white/5">0</span>
                </button>
            </div>
        </div>

        <div class="pt-4 border-t border-white/10 flex items-center justify-between text-xs text-slate-400">
            <span class="flex items-center gap-2"><i class="fa-solid fa-sun text-amber-300 text-[11px]"></i> Light mode</span>
            <div class="w-8 h-4 rounded-full bg-white/10 p-0.5 flex items-center cursor-pointer">
                <div class="w-3 h-3 rounded-full bg-white/80"></div>
            </div>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col min-h-screen relative">
        
        <!-- TOP HEADER BAR -->
        <header class="w-full p-4 md:px-8 md:py-5 flex flex-col sm:flex-row items-center justify-between gap-4 z-10">
            <div id="alertBox" class="hidden px-4 py-2 rounded-xl glass-card text-emerald-300 text-xs font-medium flex items-center gap-2 animate-fade-in">
                <i class="fa-solid fa-circle-check"></i> <span id="alertText">Task added successfully.</span>
            </div>
            <div class="ml-auto flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="relative w-full sm:w-64">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" id="searchInput" oninput="handleSearch()" placeholder="Search tasks by title or tag..." class="w-full glass-input pl-10 pr-4 py-2 rounded-xl text-xs font-medium">
                </div>
                <button onclick="openModal()" class="glass-btn-primary px-4 py-2 rounded-xl text-xs font-semibold flex items-center gap-2 shrink-0 shadow-lg">
                    <i class="fa-solid fa-plus text-[10px]"></i> New Task
                </button>
            </div>
        </header>

        <!-- DASHBOARD BODY CONTENT -->
        <div class="flex-1 px-4 md:px-8 pb-12 max-w-7xl mx-auto w-full space-y-6">
            
            <!-- METRICS SUMMARY CARDS -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="glass-card rounded-2xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Tasks</p>
                        <h3 id="statTotal" class="text-xl font-bold mt-1 text-slate-100">0</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-slate-300">
                        <i class="fa-solid fa-clipboard-list text-sm"></i>
                    </div>
                </div>
                <div class="glass-card rounded-2xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Pending Tasks</p>
                        <h3 id="statPending" class="text-xl font-bold mt-1 text-amber-400">0</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-400">
                        <i class="fa-solid fa-hourglass-half text-sm"></i>
                    </div>
                </div>
                <div class="glass-card rounded-2xl p-4 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Completed</p>
                        <h3 id="statCompleted" class="text-xl font-bold mt-1 text-emerald-400">0</h3>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400">
                        <i class="fa-solid fa-circle-check text-sm"></i>
                    </div>
                </div>
            </div>

            <!-- TASK REGISTRY CONTAINER -->
            <div class="glass-card rounded-2xl p-6 space-y-4">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between pb-4 border-b border-white/10 gap-2">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="font-bold text-sm tracking-tight text-slate-100">Task Registry</h2>
                            <span id="registryFilterTag" class="text-[10px] px-2 py-0.5 rounded-full bg-white/10 text-slate-300 uppercase font-semibold">All Tasks</span>
                        </div>
                        <p class="text-xs text-slate-400 mt-0.5">Manage, edit, and track progress of your deliverables.</p>
                    </div>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <select id="priorityFilter" onchange="renderTasks()" class="glass-input px-3 py-1.5 rounded-xl text-xs font-medium w-full sm:w-auto">
                            <option value="all">All Priorities</option>
                            <option value="Urgent">Urgent</option>
                            <option value="Reminder">Reminder</option>
                        </select>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="hidden py-12 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-2xl glass-card flex items-center justify-center text-slate-400 text-sm">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                    <h3 class="font-semibold text-xs uppercase tracking-wider text-slate-200">No tasks found</h3>
                    <p class="text-xs text-slate-400 mt-1">Click "+ New Task" to create your first item.</p>
                </div>

                <!-- Task List Grid -->
                <div id="taskGrid" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    <!-- Dynamic Items -->
                </div>
            </div>
        </div>

    </main>

    <!-- ADD/EDIT TASK MODAL POPUP -->
    <div id="taskModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-md hidden">
        <div class="glass-card rounded-2xl p-6 w-full max-w-xl shadow-2xl border border-white/15 relative">
            <div class="flex items-center justify-between pb-4 mb-4 border-b border-white/10">
                <h3 id="modalTitle" class="font-bold text-sm text-slate-100 uppercase tracking-wider">Add Task</h3>
                <button onclick="closeModal()" class="w-7 h-7 rounded-lg glass-card flex items-center justify-center text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </button>
            </div>
            
            <form id="taskForm" onsubmit="handleFormSubmit(event)" class="space-y-4">
                <input type="hidden" id="taskId">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Task Name</label>
                        <input type="text" id="taskTitle" required placeholder="Enter task name..." class="w-full glass-input px-3.5 py-2.5 rounded-xl text-xs font-medium">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Due Date</label>
                        <input type="date" id="taskDueDate" required class="w-full glass-input px-3.5 py-2.5 rounded-xl text-xs font-medium">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Priority</label>
                        <select id="taskPriority" class="w-full glass-input px-3.5 py-2.5 rounded-xl text-xs font-medium">
                            <option value="Reminder">Reminder</option>
                            <option value="Urgent">Urgent</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Status</label>
                        <select id="taskStatusSelect" class="w-full glass-input px-3.5 py-2.5 rounded-xl text-xs font-medium">
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Description</label>
                    <textarea id="taskDesc" rows="3" placeholder="Enter task description..." class="w-full glass-input px-3.5 py-2.5 rounded-xl text-xs font-medium resize-none"></textarea>
                </div>

                <div class="flex items-center justify-end gap-2 pt-2">
                    <button type="button" onclick="closeModal()" class="glass-btn px-4 py-2 rounded-xl text-xs font-semibold text-slate-300">Cancel</button>
                    <button type="submit" id="submitBtn" class="glass-btn-primary px-5 py-2 rounded-xl text-xs font-semibold shadow-md">Save Task</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT ENGINE -->
        
   <script>
    // Bridge Laravel database records into your front-end JavaScript
    let tasks = @json($tasks);

    let currentFilter = 'all';
    let currentSearchQuery = '';

    window.onload = function() {
        const dueDateInput = document.getElementById('taskDueDate');
        if (dueDateInput) {
            dueDateInput.min = new Date().toISOString().split('T')[0];
        }
        renderApp();
    };

    function setFilter(filter) {
        currentFilter = filter;
        ['all', 'pending', 'completed'].forEach(f => {
            const btn = document.getElementById(`nav-${f}`);
            if (btn) {
                if (f === filter) {
                    btn.className = "w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium bg-white/10 border border-white/15 text-white shadow-sm transition-all";
                } else {
                    btn.className = "w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-medium text-slate-300 hover:text-white hover:bg-white/5 transition-all";
                }
            }
        });
        const filterTag = document.getElementById('registryFilterTag');
        if (filterTag) {
            filterTag.innerText = filter.charAt(0).toUpperCase() + filter.slice(1) + ' Tasks';
        }
        renderTasks();
    }

    function handleSearch() {
        const searchInput = document.getElementById('searchInput');
        currentSearchQuery = searchInput ? searchInput.value.toLowerCase().trim() : '';
        renderTasks();
    }

    function openModal(id = null) {
        const modal = document.getElementById('taskModal');
        if (!modal) return;
        modal.classList.remove('hidden');

        if (id) {
            const task = tasks.find(t => String(t.id) === String(id));
            if (!task) return;
            document.getElementById('modalTitle').innerText = 'Edit Task';
            document.getElementById('submitBtn').innerText = 'Update Task';
            document.getElementById('taskId').value = task.id;
            document.getElementById('taskTitle').value = task.title || '';
            document.getElementById('taskDesc').value = task.description || '';
            document.getElementById('taskPriority').value = task.priority || 'Reminder';
            document.getElementById('taskDueDate').value = task.due_date || task.dueDate || '';
            document.getElementById('taskStatusSelect').value = task.status ? task.status.toLowerCase() : 'pending';
        } else {
            document.getElementById('modalTitle').innerText = 'Add Task';
            document.getElementById('submitBtn').innerText = 'Save Task';
            document.getElementById('taskForm').reset();
            document.getElementById('taskId').value = '';
        }
    }

    function closeModal() {
        const modal = document.getElementById('taskModal');
        if (modal) modal.classList.add('hidden');
    }

    function showAlert(msg) {
        const alertBox = document.getElementById('alertBox');
        const alertText = document.getElementById('alertText');
        if (alertBox && alertText) {
            alertText.innerText = msg;
            alertBox.classList.remove('hidden');
            setTimeout(() => { alertBox.classList.add('hidden'); }, 3000);
        }
    }

    function renderApp() {
        updateStats();
        renderTasks();
    }

    function updateStats() {
        if (typeof tasks === 'undefined') return;
        const total = tasks.length;
        const pending = tasks.filter(t => (t.status || '').toLowerCase() === 'pending').length;
        const completed = tasks.filter(t => (t.status || '').toLowerCase() === 'completed').length;

        const setElementText = (id, val) => {
            const el = document.getElementById(id);
            if (el) el.innerText = val;
        };

        setElementText('statTotal', total);
        setElementText('statPending', pending);
        setElementText('statCompleted', completed);
        setElementText('badge-all', total);
        setElementText('badge-pending', pending);
        setElementText('badge-completed', completed);
    }

    function renderTasks() {
        if (typeof tasks === 'undefined') return;
        const priorityFilterEl = document.getElementById('priorityFilter');
        const priorityVal = priorityFilterEl ? priorityFilterEl.value : 'all';

        const filtered = tasks.filter(t => {
            const status = (t.status || '').toLowerCase();
            if (currentFilter !== 'all' && status !== currentFilter.toLowerCase()) return false;
            if (priorityVal !== 'all' && t.priority !== priorityVal) return false;
            if (currentSearchQuery && 
                !(t.title || '').toLowerCase().includes(currentSearchQuery) && 
                !(t.description || '').toLowerCase().includes(currentSearchQuery)) return false;
            return true;
        });

        const grid = document.getElementById('taskGrid');
        const emptyState = document.getElementById('emptyState');
        if (!grid || !emptyState) return;

        grid.innerHTML = '';

        if (filtered.length === 0) {
            emptyState.classList.remove('hidden');
            grid.classList.add('hidden');
            return;
        } else {
            emptyState.classList.add('hidden');
            grid.classList.remove('hidden');
        }

        filtered.forEach(task => {
            const isCompleted = (task.status || '').toLowerCase() === 'completed';
            const dueDateStr = task.due_date || task.dueDate || '';
            const card = document.createElement('div');
            card.className = "glass-card rounded-2xl p-4 flex flex-col justify-between transition-all hover:bg-slate-800/40";
            card.innerHTML = `
                <div>
                    <div class="flex items-center justify-between gap-2 mb-2">
                        <span class="px-2 py-0.5 rounded-md text-[10px] font-semibold uppercase border ${task.priority === 'Urgent' ? 'border-rose-500/30 bg-rose-500/10 text-rose-300' : 'border-sky-500/30 bg-sky-500/10 text-sky-300'}">${escapeHtml(task.priority || 'Normal')}</span>
                        <span class="text-[10px] font-medium text-slate-400"><i class="fa-regular fa-calendar mr-1"></i>${escapeHtml(dueDateStr)}</span>
                    </div>
                    <h4 class="font-semibold text-xs tracking-tight mb-1 text-slate-100 ${isCompleted ? 'line-through opacity-50' : ''}">${escapeHtml(task.title || '')}</h4>
                    <p class="text-xs text-slate-400 font-normal line-clamp-2 leading-relaxed">${escapeHtml(task.description || 'No description provided.')}</p>
                </div>
                <div class="mt-4 pt-3 border-t border-white/10 flex items-center justify-between">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-semibold uppercase tracking-wide ${isCompleted ? 'text-emerald-400' : 'text-amber-400'}">
                        <span class="w-1.5 h-1.5 rounded-full ${isCompleted ? 'bg-emerald-400' : 'bg-amber-400'}"></span>
                        ${isCompleted ? 'Completed' : 'Pending'}
                    </span>
                    <div class="flex items-center gap-1.5">
                        <button onclick="toggleStatus('${task.id}')" title="${isCompleted ? 'Reopen' : 'Complete'}" class="w-7 h-7 rounded-lg glass-btn flex items-center justify-center text-xs text-slate-300 hover:text-white">
                            <i class="fa-solid ${isCompleted ? 'fa-rotate-left' : 'fa-check'} text-[11px]"></i>
                        </button>
                        <button onclick="openModal('${task.id}')" title="Edit" class="w-7 h-7 rounded-lg glass-btn flex items-center justify-center text-xs text-slate-300 hover:text-white">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </button>
                        <button onclick="deleteTask('${task.id}')" title="Delete" class="w-7 h-7 rounded-lg glass-btn flex items-center justify-center text-xs text-slate-300 hover:text-rose-400">
                            <i class="fa-solid fa-trash-can text-[10px]"></i>
                        </button>
                    </div>
                </div>
            `;
            grid.appendChild(card);
        });
        updateStats();
    }

    async function handleFormSubmit(e) {
        e.preventDefault();
        const id = document.getElementById('taskId').value;
        const title = document.getElementById('taskTitle').value.trim();
        const description = document.getElementById('taskDesc').value.trim();
        const priority = document.getElementById('taskPriority').value;
        const due_date = document.getElementById('taskDueDate').value;
        const status = document.getElementById('taskStatusSelect').value;

        if (!title || !due_date) return;

        const formData = { title, description, priority, due_date, status };
        const url = id ? `/tasks/${id}` : '/tasks';
        const method = id ? 'PUT' : 'POST';

        try {
            let response = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                showAlert(id ? 'Task updated successfully.' : 'Task added successfully.');
                closeModal();
                location.reload();
            } else {
                const errorData = await response.json();
                console.error('Validation Errors:', errorData);
                
                let message = 'Failed to save task.';
                if (errorData.errors) {
                    message += ' ' + Object.values(errorData.errors).flat().join(' ');
                } else if (errorData.message) {
                    message += ' ' + errorData.message;
                }
                alert(message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An unexpected network error occurred.');
        }
    }

    async function toggleStatus(id) {
        try {
            let response = await fetch(`/tasks/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                location.reload();
            } else {
                alert('Failed to update status.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    async function deleteTask(id) {
        if (!confirm('Are you sure you want to delete this task?')) return;

        try {
            let response = await fetch(`/tasks/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });

            if (response.ok) {
                showAlert('Task deleted.');
                location.reload();
            } else {
                alert('Failed to delete task.');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    function escapeHtml(str) {
        if (!str) return '';
        return String(str).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
</script>
</body>
</html>
<?php $__env->startSection('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .report-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 90%;
        max-width: 1200px;
        padding: 30px;
        margin: 20px auto;
    }
    
    .report-header {
        color: #2c3e50;
        margin-bottom: 25px;
        font-weight: 600;
        text-align: center;
    }
    
    .summary-card {
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        color: white;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .income-card {
        background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
    }
    
    .expense-card {
        background: linear-gradient(135deg, #ff5e62 0%, #ff9966 100%);
    }
    
    .balance-card {
        background: linear-gradient(135deg, #5b86e5 0%, #36d1dc 100%);
    }
    
    .chart-container {
        position: relative;
        margin: 30px auto;
        height: 300px;
        width: 100%;
    }
    
    .note {
        margin-top: 25px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #6c757d;
        text-align: left;
    }
    
    .filter-form {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 25px;
    }
    
    @media (max-width: 768px) {
        .report-container {
            padding: 15px;
            width: 95%;
        }
        
        .chart-container {
            height: 250px;
        }
    }
</style>

<div class="report-container">
    <h2 class="report-header">Transactions Report</h2>

    
    <form method="GET" action="<?php echo e(route('transactions.report')); ?>" class="filter-form mb-4">
        <div class="row">
            <div class="col-md-3 mb-2">
                <select name="category_name" class="form-control">
                    <option value="">All Categories</option>
                    <option value="income" <?php echo e(request('category_name') == 'income' ? 'selected' : ''); ?>>Income</option>
                    <option value="expenses" <?php echo e(request('category_name') == 'expenses' ? 'selected' : ''); ?>>Expense</option>
                </select>
            </div>

            <div class="col-md-3 mb-2">
                <input type="date" name="start_date" class="form-control" value="<?php echo e(request('start_date')); ?>">
            </div>

            <div class="col-md-3 mb-2">
                <input type="date" name="end_date" class="form-control" value="<?php echo e(request('end_date')); ?>">
            </div>

            <div class="col-md-3 mb-2">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo e(route('transactions.report')); ?>" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>

    
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="summary-card income-card">
                <h4>Total Income</h4>
                <h3>₹<?php echo e($totalIncome); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card expense-card">
                <h4>Total Expense</h4>
                <h3>₹<?php echo e($totalExpenses); ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="summary-card balance-card">
                <h4>Balance</h4>
                <h3>₹<?php echo e($balance); ?></h3>
            </div>
        </div>
    </div>

    
    <div class="card mb-4">
        <div class="card-header bg-white">
            <h4 class="mb-0">Income vs Expenses</h4>
        </div>
        <div class="card-body">
            <div class="chart-container">
                <canvas id="incomeExpenseChart"></canvas>
            </div>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header bg-white">
            <h4 class="mb-0">Transaction Details</h4>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($loop->iteration + ($transactions->currentPage()-1)*$transactions->perPage()); ?></td>
                                <td><?php echo e($transaction->title); ?></td>
                                <td>₹ <?php echo e(number_format($transaction->amount, 2)); ?></td>
                                <td><?php echo e(ucfirst($transaction->category_name)); ?></td>
                                <td><?php echo e(\Carbon\Carbon::parse($transaction->date)->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">No transactions found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="mt-3 d-flex justify-content-center">
        <?php echo e($transactions->links()); ?>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Income vs Expense Chart
        const incomeExpenseCtx = document.getElementById('incomeExpenseChart').getContext('2d');
        const incomeExpenseChart = new Chart(incomeExpenseCtx, {
            type: 'pie',
            data: {
                labels: ['Income', 'Expenses'],
                datasets: [{
                    data: [<?php echo e($totalIncome); ?>, <?php echo e($totalExpenses); ?>],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(220, 53, 69, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            },
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                label += '₹' + context.raw.toLocaleString();
                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\expsenes\resources\views/transactions/report.blade.php ENDPATH**/ ?>
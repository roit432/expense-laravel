<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">Add Transaction</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('transactions.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" id="amount" name="amount" class="form-control" step="0.01" required>
                        </div>
                        <div class="mb-3">
    <label for="category_name" class="form-label">Category</label>
    <select id="category_name" name="category_name" class="form-control" required>
        <option value="">-- Select Category --</option>
        <option value="Income">Income</option>
        <option value="Expenses">Expenses</option>
    </select>
</div>
   <div class="mb-3">
                            <label for="date" class="form-label">Title</label>
                            <input type="date" id="date" name="date" class="form-control" required>

                        <button type="submit" class="btn btn-success w-100">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\expsenes\resources\views/transactions/create.blade.php ENDPATH**/ ?>
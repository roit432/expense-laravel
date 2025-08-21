<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">Edit Transaction</h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('transactions.update', $transaction->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control" value="<?php echo e($transaction->title); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" id="amount" name="amount" class="form-control" value="<?php echo e($transaction->amount); ?>" step="0.01" required>
                        </div> <div class="mb-3">
                            <label for="category_name" class="form-label">Category</label>
                            <input type="text" id="category_name" name="category_name" class="form-control" value="<?php echo e($transaction->category_name); ?>" step="0.01" required>
                        </div>
                         <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo e($transaction->date); ?>" step="0.01" required>
                        </div>
                        <button type="submit" class="btn btn-warning w-100">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\expsenes\resources\views/transactions/edit.blade.php ENDPATH**/ ?>
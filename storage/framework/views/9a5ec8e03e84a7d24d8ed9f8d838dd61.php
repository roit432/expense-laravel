<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            
            <?php if(session('success')): ?>
                <div class="alert alert-success text-center">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?> 
            <!-- this is for flash msg -->

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">My Transactions</h5>
                    <a href="<?php echo e(route('transactions.create')); ?>" class="btn btn-light btn-sm">+ Add Transaction</a>
                </div>
                <div class="card-body">
                    <?php if(isset($transactions)): ?>
                        
                        <h6 class="mb-3">Total Transactions: 
                            <span class="badge bg-secondary"><?php echo e($transactions->count()); ?></span>
                        </h6>

                        
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td><?php echo e($transaction->category_name); ?></td>
                                            <td>₹ <?php echo e(number_format($transaction->amount, 2)); ?></td>
                                            <td><?php echo e($transaction->date); ?></td>
                                            <td><?php echo e($transaction->created_at->format('h:i A')); ?></td>
                                            <td class="text-center">
                                                
                                                <a href="<?php echo e(route('transactions.edit', $transaction->id)); ?>" 
                                                   class="btn btn-sm btn-warning">Edit</a>

                                                
                                                <form action="<?php echo e(route('transactions.destroy', $transaction->id)); ?>" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure to delete this transaction?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-sm btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p class="text-muted text-center">No transactions found. Add your first one!</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laravel\expsenes\resources\views/transactions/index.blade.php ENDPATH**/ ?>
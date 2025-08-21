<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income vs Expenses</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            padding: 30px;
            text-align: center;
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
      
        
        
        .income {
            background: linear-gradient(135deg, #43cea2 0%, #185a9d 100%);
            color: white;
        }
        
        .expenses {
            background: linear-gradient(135deg, #ff5e62 0%, #ff9966 100%);
            color: white;
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
        
        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
            
          
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Income vs Expenses</h1>
        
       
        <div class="chart-container">
            <canvas id="incomeExpenseChart"></canvas>
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
                        data: [4582, 3247.5],
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
                                    label += '$' + context.raw.toLocaleString();
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\laravel\expsenes\resources\views/transactions/pie.blade.php ENDPATH**/ ?>
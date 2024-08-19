<!DOCTYPE html>
<html>
<head>
    <title>Agent Monthly Report</title>
    <!-- Add your CSS here for styling the table -->
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: right;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            background-color: #ffffe0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Agent Monthly Win / Lose Report</h1>

    <table>
        <thead>
            <tr>
                <th>Account</th>
                <th>Name</th>
                <th>Bet Amount</th>
                <th>Valid Amount</th>
                <th>Stake Count</th>
                <th>Gross Comm</th>
                <th colspan="3">Member</th>
                <th colspan="3">Downline</th>
                <th colspan="3">Myself</th>
                <th colspan="3">Upline</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>W/L</th>
                <th>Comm</th>
                <th>Total</th>
                <th>W/L</th>
                <th>Comm</th>
                <th>Total</th>
                <th>W/L</th>
                <th>Comm</th>
                <th>Total</th>
                <th>W/L</th>
                <th>Comm</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agentReports as $report)
                <tr>
                    <td>Agent {{ $report->agent_id }}</td>
                    <td>{{ $report->agent_name }}</td>
                    <td>Direct Member</td>
                    <td>{{ number_format($report->total_bet_amount, 2) }}</td>
                    <td>{{ number_format($report->total_valid_bet_amount, 2) }}</td>
                    <td><!-- Stake Count Placeholder --></td>
                    <td>{{ number_format($report->total_commission_amount, 2) }}</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>0</td> <!-- Comm placeholder -->
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td><!-- Downline W/L Placeholder --></td>
                    <td>0</td> <!-- Downline Comm Placeholder -->
                    <td><!-- Downline Total Placeholder --></td>
                    <td><!-- Myself W/L Placeholder --></td>
                    <td>0</td> <!-- Myself Comm Placeholder -->
                    <td><!-- Myself Total Placeholder --></td>
                    <td><!-- Upline W/L Placeholder --></td>
                    <td>0</td> <!-- Upline Comm Placeholder -->
                    <td><!-- Upline Total Placeholder --></td>
                </tr>
            @endforeach
            <tr class="summary">
                <td colspan="2">Summary:</td>
                <td>{{ number_format($agentReports->sum('total_bet_amount'), 2) }}</td>
                <td>{{ number_format($agentReports->sum('total_valid_bet_amount'), 2) }}</td>
                <td><!-- Stake Count Summary Placeholder --></td>
                <td>{{ number_format($agentReports->sum('total_commission_amount'), 2) }}</td>
                <td><!-- W/L Summary --></td>
                <td>0</td> <!-- Comm Summary Placeholder -->
                <td><!-- Total Summary --></td>
                <td><!-- Downline W/L Summary Placeholder --></td>
                <td>0</td> <!-- Downline Comm Summary Placeholder -->
                <td><!-- Downline Total Summary Placeholder --></td>
                <td><!-- Myself W/L Summary Placeholder --></td>
                <td>0</td> <!-- Myself Comm Summary Placeholder -->
                <td><!-- Myself Total Summary Placeholder --></td>
                <td><!-- Upline W/L Summary Placeholder --></td>
                <td>0</td> <!-- Upline Comm Summary Placeholder -->
                <td><!-- Upline Total Summary Placeholder --></td>
            </tr>
        </tbody>
    </table>
</body>
</html>

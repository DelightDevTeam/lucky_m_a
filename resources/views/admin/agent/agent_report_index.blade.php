<!DOCTYPE html>
<html>
<head>
    <title>Agent Monthly Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: right;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary {
            background-color: #ffffe0;
            font-weight: bold;
        }
        .qty {
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Agent Monthly Report</h1>

    <table>
        <thead>
            <tr>
                <th rowspan="2">Account</th>
                <th rowspan="2">Name</th>
                <th rowspan="2">Bet Amount</th>
                <th rowspan="2">Valid Amount</th>
                <th rowspan="2">Stake Count</th>
                <th rowspan="2">Gross Comm</th>
                <th colspan="3">Member</th>
                <th colspan="3">Downline</th>
                <th colspan="3">Myself</th>
                <th colspan="3">Upline</th>
            </tr>
            <tr>
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
                    <td class="qty">Qty: {{ $report->qty }}</td>
                    <td>{{ $report->agent_name }}</td>
                    <td>{{ number_format($report->total_bet_amount, 2) }}</td>
                    <td>{{ number_format($report->total_valid_bet_amount, 2) }}</td>
                    <td>--</td>
                    <td>{{ number_format($report->total_commission_amount, 2) }}</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>0</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>--</td>
                    <td>0</td>
                    <td>--</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>0</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>{{ number_format($report->total_payout_amount, 2) }}</td>
                    <td>0</td>
                </tr>
            @endforeach
            <tr class="summary">
                <td colspan="2">Summary:</td>
                <td>{{ number_format($agentReports->sum('total_bet_amount'), 2) }}</td>
                <td>{{ number_format($agentReports->sum('total_valid_bet_amount'), 2) }}</td>
                <td>--</td>
                <td>{{ number_format($agentReports->sum('total_commission_amount'), 2) }}</td>
                <td>{{ number_format($agentReports->sum('total_payout_amount'), 2) }}</td>
                <td>0</td>
                <td>{{ number_format($agentReports->sum('total_payout_amount'), 2) }}</td>
                <td>--</td>
                <td>0</td>
                <td>--</td>
                <td>{{ number_format($agentReports->sum('total_payout_amount'), 2) }}</td>
                <td>0</td>
                <td>{{ number_format($agentReports->sum('total_payout_amount'), 2) }}</td>
                <td>{{ number_format($agentReports->sum('total_payout_amount'), 2) }}</td>
                <td>0</td>
            </tr>
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Details</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #007bff;
            margin-bottom: 5px;
        }
        .details-container {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .detail-row {
            display: flex;
            margin-bottom: 10px;
        }
        .detail-label {
            font-weight: bold;
            width: 150px;
        }
        .detail-value {
            flex: 1;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        /* Status-specific styles */
        .status-approved {
            background-color: #28a745;
            color: white;
        }
        .status-rejected {
            background-color: #dc3545;
            color: white;
        }
        .status-pending {
            background-color: #ffc107;
            color: black;
        }
        .status-default {
            background-color: #6c757d;
            color: white;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Booking Confirmation</h1>
        <p>Reference ID: #{{ $booking->id }}</p>
    </div>

    <div class="details-container">
        <h2 style="margin-top: 0; color: #007bff;">Booking Information</h2>
        
        <div class="detail-row">
            <div class="detail-label">Facility:</div>
            <div class="detail-value">{{ $booking->room->name ?? 'N/A' }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Building:</div>
            <div class="detail-value">{{ $booking->room->building ?? 'N/A' }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Date:</div>
            <div class="detail-value">
                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                @if($booking->end_date)
                    to {{ \Carbon\Carbon::parse($booking->end_date)->format('d M Y') }}
                @endif
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Time:</div>
            <div class="detail-value">
                {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
            </div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Purpose Type:</div>
            <div class="detail-value">{{ $booking->purpose_type }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Purpose:</div>
            <div class="detail-value">{{ $booking->purpose }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Total Price:</div>
            <div class="detail-value">RM {{ number_format($booking->total_price, 2) }}</div>
        </div>
        
        <div class="detail-row">
            <div class="detail-label">Status:</div>
            <div class="detail-value">
                <span class="status-badge 
                    @if($booking->status === 'approved') status-approved
                    @elseif($booking->status === 'rejected') status-rejected
                    @elseif($booking->status === 'pending') status-pending
                    @else status-default
                    @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Generated on {{ now()->format('d M Y H:i') }}</p>
        <p>For any inquiries, please contact our support team.</p>
    </div>
</body>
</html>
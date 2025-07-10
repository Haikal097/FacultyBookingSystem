<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;
use App\Models\Booking;
use GuzzleHttp\Client;
        

class BookingApiController extends Controller
{
    public function generatePdf($id)
    {
        try {
            $booking = Booking::findOrFail($id);
            $html = view('partials.pdf-template', compact('booking'))->render();

            // Build payload
            $payload = json_encode([
                "source" => $html,
                "landscape" => false,
                "use_print" => false
            ]);

            // Initialize curl
            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://api.pdfshift.io/v3/convert/pdf",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $payload,
                CURLOPT_HTTPHEADER => [
                    'X-API-Key: ' . env('PDFSHIFT_API_KEY'), // or hardcode your key here
                    'Content-Type: application/json',
                ],
            ]);

            $response = curl_exec($curl);
            $error = curl_error($curl);
            curl_close($curl);

            if ($error) {
                \Log::error('PDFShift curl error: ' . $error);
                return response()->json([
                    'message' => 'PDF generation failed.',
                    'error' => $error
                ], 500);
            }

            return response($response, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="booking-' . $booking->id . '.pdf"',
            ]);
        } catch (\Exception $e) {
            \Log::error('PDF generation exception: ' . $e->getMessage());
            return response()->json([
                'message' => 'PDF generation failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}

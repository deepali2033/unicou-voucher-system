<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    /**
     * Display a listing of the quotes.
     */
    public function index()
    {
        $quotes = Quote::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.quotes.index', compact('quotes'));
    }

    /**
     * Display the specified quote.
     */
    public function show(Quote $quote)
    {
        $quote->load('user');
        return view('admin.quotes.show', compact('quote'));
    }

    /**
     * Remove the specified quote from storage.
     */
    public function destroy(Quote $quote)
    {
        $quote->delete();

        return redirect()->route('admin.quotes.index')
            ->with('success', 'Quote deleted successfully.');
    }

    /**
     * Send email with quote content.
     */
    public function sendEmail(Request $request, Quote $quote)
    {
        $request->validate([
            'email_content' => 'required|string',
        ]);

        try {
            $emailContent = $request->input('email_content');

            Mail::send([], [], function ($message) use ($quote, $emailContent) {
                $message->to($quote->email)
                    ->subject('Quote Response from KOA Services')
                    ->html($emailContent);
            });

            return response()->json([
                'success' => true,
                'message' => 'Mail sent successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send email: ' . $e->getMessage()
            ], 500);
        }
    }
}

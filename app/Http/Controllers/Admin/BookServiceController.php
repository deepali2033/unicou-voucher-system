<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookService;
use Illuminate\Http\Request;

class BookServiceController extends Controller
{
    /**
     * Display a listing of book service requests.
     */
    public function index(Request $request)
    {
        $query = BookService::with(['user', 'service']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $bookServices = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // This preserves query parameters in pagination links

        return view('admin.book-services.index', compact('bookServices'));
    }

    /**
     * Display the specified book service request.
     */
    public function show(BookService $bookService)
    {
        $bookService->load(['user', 'service']);
        return view('admin.book-services.show', compact('bookService'));
    }

    /**
     * Update the status of a book service request.
     */
    public function updateStatus(Request $request, BookService $bookService)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled'
        ]);

        $bookService->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Book service status updated successfully.');
    }

    /**
     * Remove the specified book service request from storage.
     */
    public function destroy(BookService $bookService)
    {
        $bookService->delete();
        return redirect()->route('admin.book-services.index')->with('success', 'Book service request deleted successfully.');
    }
}

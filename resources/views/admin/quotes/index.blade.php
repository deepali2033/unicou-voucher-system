@extends('admin.layouts.app')

@section('title', 'Quotes Management')
@section('page-title', 'Quotes Management')

@section('content')
<div class="card shadow-sm border-0 koa-tb-card">
    <div class="card-header border-0">
        <div class="d-flex justify-content-between align-items-center p-3">
            <h3 class="card-title mb-0 text-dark fs-4">All Submitted Quotes</h3>
            <div class="card-tools d-flex align-items-center gap-3">
                <span class="badge koa-badge-green fw-bold px-3 py-2">
                    {{ $quotes->total() }} Total Quotes
                </span>
            </div>
        </div>
    </div>

    <div class="card-body p-4 koa-tb-cnt">
        @if($quotes->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover table-borderless align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Square Footage</th>
                        <th>Service</th>
                        <th>User</th>
                        <th>Date</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotes as $quote)
                    <tr>
                        <td class="ps-4">
                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                #{{ $quote->id }}
                            </span>
                        </td>
                        <td>
                            <strong class="text-dark">{{ $quote->name }}</strong>
                        </td>
                        <td>
                            <a href="mailto:{{ $quote->email }}" class="text-decoration-none text-dark">
                                {{ $quote->email }}
                            </a>
                        </td>
                        <td>
                            <a href="tel:{{ $quote->phone }}" class="text-decoration-none text-dark">
                                {{ $quote->phone }}
                            </a>
                        </td>
                        <td>
                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                {{ $quote->total_square_footage }} sq ft
                            </span>
                        </td>
                        <td>
                            @if($quote->service)
                            <span class="badge koa-badge-light-green fw-normal px-3 py-2">{{ $quote->service }}</span>
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($quote->user)
                            <a href="{{ route('admin.users.show', $quote->user) }}" class="text-decoration-none">
                                <span class="badge koa-badge-light-green fw-normal px-3 py-2">
                                    {{ $quote->user->name }}
                                </span>
                            </a>
                            @else
                            <span class="text-muted">Guest</span>
                            @endif
                        </td>
                        <td>
                            <small class="text-muted">{{ $quote->created_at->format('M d, Y') }}</small>
                            <br>
                            <small class="text-muted">{{ $quote->created_at->format('h:i A') }}</small>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group" role="group" style="gap: 8px;">
                                <a href="{{ route('admin.quotes.show', $quote) }}"
                                    class="btn btn-sm rounded-circle action-btns koa-badge-light-green" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-sm rounded-circle action-btns koa-badge-green send-email-btn"
                                    title="Send Email"
                                    data-quote-id="{{ $quote->id }}"
                                    data-quote-email="{{ $quote->email }}"
                                    data-quote-name="{{ $quote->name }}"
                                    data-quote-phone="{{ $quote->phone }}"
                                    data-quote-footage="{{ $quote->total_square_footage }}"
                                    data-quote-service="{{ $quote->service ?? 'N/A' }}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <form action="{{ route('admin.quotes.destroy', $quote) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this quote?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm rounded-circle action-btns koa-badge-red-outline" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $quotes->links('pagination::bootstrap-5') }}
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-comment-alt fa-3x text-muted mb-3"></i>
            <h4 class="text-dark">No Quotes Submitted Yet</h4>
            <p class="text-muted">All quote submissions will appear here.</p>
        </div>
        @endif
    </div>
</div>

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Quote Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="emailForm">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Recipient Email:</label>
                        <p id="recipientEmail" class="text-muted"></p>
                    </div>
                    <div class="mb-3">
                        <label for="emailContent" class="form-label fw-bold">Email Content:</label>
                        <textarea id="emailContent" name="email_content" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn koa-badge-green" id="sendEmailBtn">
                        <i class="fas fa-paper-plane me-2"></i>Send Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Modal Styling */
    #emailModal .modal-content {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    #emailModal .modal-header {
        background: linear-gradient(135deg, #3ca200 0%, #2d7a00 100%);
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 20px 25px;
        border: none;
    }

    #emailModal .modal-title {
        font-weight: 600;
        font-size: 1.25rem;
    }

    #emailModal .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    #emailModal .btn-close:hover {
        opacity: 1;
    }

    #emailModal .modal-body {
        padding: 25px;
        background-color: #fafafa;
    }

    #emailModal .modal-footer {
        padding: 15px 25px;
        background-color: #f4f6f0;
        border-top: 1px solid #e0e0e0;
        border-radius: 0 0 12px 12px;
    }

    #recipientEmail {
        background-color: #e8f5d3;
        padding: 10px 15px;
        border-radius: 6px;
        font-weight: 500;
        color: #2d7a00;
        border-left: 4px solid #3ca200;
    }

    /* CKEditor Styling */
    .ck.ck-editor {
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .ck.ck-editor__main>.ck-editor__editable {
        min-height: 350px;
        max-height: 450px;
        background-color: #ffffff;
        border: 2px solid #e0e0e0;
        border-radius: 0 0 8px 8px;
        padding: 20px;
        font-size: 14px;
        line-height: 1.6;
    }

    .ck.ck-editor__main>.ck-editor__editable:focus {
        border-color: #3ca200;
        box-shadow: 0 0 0 3px rgba(60, 162, 0, 0.1);
    }

    .ck.ck-toolbar {
        background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #e0e0e0;
        border-bottom: none;
        border-radius: 8px 8px 0 0;
        padding: 10px;
    }

    .ck.ck-toolbar .ck-toolbar__items {
        gap: 4px;
    }

    .ck.ck-button:not(.ck-disabled):hover,
    .ck.ck-button:not(.ck-disabled):focus {
        background-color: #e8f5d3;
        border-color: #3ca200;
    }

    .ck.ck-button.ck-on {
        background-color: #3ca200;
        color: white;
    }

    .ck.ck-button.ck-on:hover {
        background-color: #2d7a00;
    }

    /* Button Styling */
    #sendEmailBtn {
        padding: 10px 25px;
        font-weight: 600;
        border-radius: 6px;
        border: none;
        transition: all 0.3s ease;
    }

    #sendEmailBtn:hover {
        background-color: #2d7a00;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(60, 162, 0, 0.3);
    }

    #sendEmailBtn:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
        transform: none;
    }

    .modal-footer .btn-secondary {
        padding: 10px 25px;
        font-weight: 500;
        border-radius: 6px;
    }

    /* Label Styling */
    #emailModal .form-label {
        color: #2d7a00;
        font-size: 15px;
        margin-bottom: 10px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    let editorInstance;
    let currentQuoteId;
    let currentQuoteEmail;

    // Initialize CKEditor
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize CKEditor when modal is shown
        const emailModal = document.getElementById('emailModal');
        emailModal.addEventListener('shown.bs.modal', function() {
            if (!editorInstance) {
                ClassicEditor
                    .create(document.querySelector('#emailContent'), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', '|',
                                'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'indent', 'outdent', '|',
                                'blockQuote', '|',
                                'undo', 'redo'
                            ]
                        },
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                            ]
                        }
                    })
                    .then(editor => {
                        editorInstance = editor;
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor:', error);
                    });
            }
        });

        // Clean up editor when modal is hidden
        emailModal.addEventListener('hidden.bs.modal', function() {
            if (editorInstance) {
                editorInstance.destroy()
                    .then(() => {
                        editorInstance = null;
                    })
                    .catch(error => {
                        console.error('Error destroying CKEditor:', error);
                    });
            }
        });

        // Handle send email button clicks
        document.querySelectorAll('.send-email-btn').forEach(button => {
            button.addEventListener('click', function() {
                currentQuoteId = this.dataset.quoteId;
                currentQuoteEmail = this.dataset.quoteEmail;
                const quoteName = this.dataset.quoteName;
                const quotePhone = this.dataset.quotePhone;
                const quoteFootage = this.dataset.quoteFootage;
                const quoteService = this.dataset.quoteService;

                // Set recipient email
                document.getElementById('recipientEmail').textContent = currentQuoteEmail;

                // Set default email content
                const defaultContent = `
                    <h2 style="color: #3ca200;">Quote Response from KOA Services</h2>
                    <p>Dear <strong>${quoteName}</strong>,</p>
                    <p>Thank you for requesting a quote from KOA Services. We appreciate your interest in our cleaning services.</p>

                    <h3 style="color: #2d7a00;">Quote Details:</h3>
                    <ul style="line-height: 1.8;">
                        <li><strong>Service Requested:</strong> ${quoteService}</li>
                        <li><strong>Square Footage:</strong> ${quoteFootage} sq ft</li>
                        <li><strong>Contact Phone:</strong> ${quotePhone}</li>
                    </ul>

                    <h3 style="color: #2d7a00;">Our Quotation:</h3>
                    <p><em>[Please add your detailed quote, pricing, and service information here]</em></p>

                    <p>Our professional cleaning team is ready to provide you with exceptional service. We use eco-friendly products and ensure the highest quality standards.</p>

                    <p>If you have any questions or would like to schedule our service, please don't hesitate to contact us at your convenience.</p>

                    <p style="margin-top: 20px;">Best regards,<br>
                    <strong>KOA Services Team</strong><br>
                    <span style="color: #3ca200;">Your Trusted Cleaning Partner</span></p>
                `;

                // Show modal
                const modal = new bootstrap.Modal(emailModal);
                modal.show();

                // Set content after a short delay to ensure editor is initialized
                setTimeout(() => {
                    if (editorInstance) {
                        editorInstance.setData(defaultContent);
                    }
                }, 500);
            });
        });

        // Handle form submission
        document.getElementById('emailForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const sendBtn = document.getElementById('sendEmailBtn');
            const originalBtnText = sendBtn.innerHTML;

            // Disable button and show loading state
            sendBtn.disabled = true;
            sendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';

            // Get content from CKEditor
            const emailContent = editorInstance.getData();

            // Send AJAX request
            fetch(`/admin/quotes/${currentQuoteId}/send-email`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    email_content: emailContent
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Hide modal
                    bootstrap.Modal.getInstance(emailModal).hide();

                    // Show success message
                    showAlert('success', data.message);
                } else {
                    showAlert('danger', data.message || 'Failed to send email');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'An error occurred while sending the email');
            })
            .finally(() => {
                // Re-enable button
                sendBtn.disabled = false;
                sendBtn.innerHTML = originalBtnText;
            });
        });
    });

    // Helper function to show alerts
    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.role = 'alert';
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        // Insert alert at the top of main content
        const mainContent = document.querySelector('.main-content');
        const firstChild = mainContent.querySelector('.d-flex.justify-content-between');
        firstChild.insertAdjacentElement('afterend', alertDiv);

        // Auto-hide after 5 seconds
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertDiv);
            bsAlert.close();
        }, 5000);
    }
</script>
@endpush

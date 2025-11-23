<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/images/favicon.ico" />

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        crossorigin="anonymous"
    />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>

    <title>LaraGigs | Find Laravel Jobs & Projects</title>
</head>

<body class="bg-gray-50">
    <!-- Navigation -->

    <nav class="bg-white shadow-sm border-b border-gray-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <a href="/">
                    <div class="bg-laravel w-24 h-24 flex items-center justify-center">
                        <span class="text-white text-4xl font-bold">LG</span>
                    </div>
                </a>
                <ul class="flex space-x-6 text-lg items-center">
                    @auth
                        <li>
                            <span class="text-gray-700">
                                <i class="fa-solid fa-user mr-1"></i> Welcome, {{ auth()->user()->name }}
                            </span>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="hover:text-laravel transition">
                                    <i class="fa-solid fa-door-open"></i> Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('register') }}" class="hover:text-laravel transition">
                                <i class="fa-solid fa-user-plus"></i> Register
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-laravel transition">
                                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <section
            class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
                style="background-image: url('images/laravel-logo.png')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Lara<span class="text-black">Gigs</span>
                </h1>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    Find or post Laravel jobs & projects
                </p>
                <div>
                    <a
                        href="register.html"
                        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black"
                        >Sign Up to List a Gig</a
                    >
                </div>
            </div>
        </section>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-32 space-y-6">
               <!-- Search -->
               <form action="">
                <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                    <div class="absolute top-4 left-3">
                        <i
                            class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                        ></i>
                    </div>
                    <input
                        type="text"
                        name="search"
                        class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                        placeholder="Search Laravel Gigs..."
                    />
                    <div class="absolute top-2 right-2">
                        <button
                            type="submit"
                            class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </form>
        @if (session('message'))
            <div class="rounded-lg border border-green-200 bg-green-50 px-6 py-4 text-green-800 shadow-sm">
                {{ session('message') }}
            </div>
        @endif
        @yield('content')

    </main>

    <!-- Custom Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-50" style="display: none;">
        <div class="fixed inset-0 bg-black bg-opacity-50"></div>
        <div class="fixed inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-xl shadow-2xl max-w-md w-full transform transition-all">
                <div class="p-6">
                    <div class="flex items-center justify-center w-16 h-16 mx-auto bg-red-100 rounded-full mb-4">
                        <i class="fa-solid fa-triangle-exclamation text-red-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 text-center mb-2">Confirm Deletion</h3>
                    <p class="text-gray-600 text-center mb-6" id="deleteModalMessage">
                        Are you sure you want to delete this listing? This action cannot be undone.
                    </p>
                    <div class="flex gap-3">
                        <button
                            type="button"
                            id="deleteModalCancel"
                            class="flex-1 bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded-lg hover:bg-gray-300 transition"
                        >
                            Cancel
                        </button>
                        <form id="deleteModalForm" method="POST" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="w-full bg-red-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-red-700 transition"
                            >
                                <i class="fa-solid fa-trash mr-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle delete button clicks
            document.querySelectorAll('.delete-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const formId = this.getAttribute('data-form-id');
                    const listingTitle = this.getAttribute('data-listing-title');
                    const form = document.getElementById(formId);

                    if (!form) {
                        console.error('Form not found:', formId);
                        return;
                    }

                    showDeleteModal(form, 'Are you sure you want to delete "' + listingTitle + '"? This action cannot be undone.');
                });
            });
        });

        function showDeleteModal(form, message) {
            const modal = document.getElementById('deleteModal');
            const modalForm = document.getElementById('deleteModalForm');
            const modalMessage = document.getElementById('deleteModalMessage');
            const cancelBtn = document.getElementById('deleteModalCancel');

            if (!modal) {
                console.error('Modal not found');
                return false;
            }

            if (!modalForm) {
                console.error('Modal form not found');
                return false;
            }

            // Set the form action
            modalForm.action = form.action;

            // Set custom message if provided
            if (message && modalMessage) {
                modalMessage.textContent = message;
            }

            // Show modal
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';

            // Close modal function
            function closeModal() {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }

            // Remove old event listeners by cloning
            const newCancelBtn = cancelBtn.cloneNode(true);
            cancelBtn.parentNode.replaceChild(newCancelBtn, cancelBtn);

            // Add new event listener
            newCancelBtn.addEventListener('click', function(e) {
                e.preventDefault();
                closeModal();
            });

            // Close modal on background click
            const modalOverlay = modal.querySelector('.bg-black');
            if (modalOverlay) {
                modalOverlay.addEventListener('click', function(e) {
                    closeModal();
                });
            }

            // Close modal on Escape key
            function escapeHandler(e) {
                if (e.key === 'Escape' && modal.style.display === 'block') {
                    closeModal();
                    document.removeEventListener('keydown', escapeHandler);
                }
            }
            document.addEventListener('keydown', escapeHandler);

            return false;
        }
    </script>

    <!-- Footer -->
    <footer class="fixed bottom-0 left-0 w-full bg-laravel text-white h-24 opacity-95 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center justify-between">
            <p class="font-bold">Copyright © 2025 dahss. All rights reserved</p>
            <a
                href="/listings/create"
                class="bg-black hover:bg-gray-900 text-white py-3 px-6 rounded transition font-semibold"
            >
                Post Job
            </a>
        </div>
    </footer>
</body>
</html>
